<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Restaurant; 
use Illuminate\Database\QueryException;


class CategoryController extends SearchableController
{
    const ITEM_PER_PAG=5;

    private string $title = 'Category';

    function getQuery() : Builder {
        return Category::orderBy('code');
    }
    
    
    function filterByTerm(Builder|Relation $query, ?string $term) : Builder|Relation {
        if(!empty($term)) {
            foreach(\preg_split('/\s+/', \trim($term)) as $word) {
                 $query->where(function(Builder $innerQuery) use ($word) {
                     $innerQuery
                        ->where('code', 'LIKE', "%{$word}%")
                            ->orWhere('name', 'LIKE', "%{$word}%");
                           
                });
             }
        }
        
        return $query;
        }

    function list(Request $request) {
        $search = $this->prepareSearch($request->getQueryParams());
        $query = $this->search($search)->withCount('products');

        session()->put('bookmark.categories-view', $request->getUri());

        return view('categories.list', [
        'title' => "{$this->title} : List",
        'search' => $search,
        'categories' => $query->paginate(self::ITEM_PER_PAG),
        ]);
    }

    function show($categoriesCode) {

        $categories = $this->find($categoriesCode); 

        return view('categories.view', [
        'title' => "{$this->title} : View",'categories' => $categories,
        ]);
    
    }     

    function createForm() {
       /*  $this->authorize('create', Category::class); */

        return view('categories.create-form', [
            'title' => "{$this->title} : Create",
        ]);
    }
            
    function create(Request $request) {
       /*  $this->authorize('create', Category::class); */

        try {
            $categories = Category::create($request->getParsedBody());
                
            return redirect()->route('categories-list')
                ->with('status', "Category {$categories->code} was created.");
            
            } catch(QueryException $excp) {
                return redirect()->back()->withInput()->withErrors([
                    'error' => $excp->errorInfo[2],
                ]);
            }
    }

    function updateForm($categoriesCode) {
        /* $this->authorize('update', Category::class); */

        $categories = $this->find($categoriesCode);
        
        return view('categories.update-form', [
        'title' => "{$this->title} : Update",
        'categories' => $categories,
        ]);
        }

    function update(Request $request, $categoriesCode) {
        /* $this->authorize('update', Category::class); */
        try {
            $categories = $this->find($categoriesCode);
            $categories->fill($request->getParsedBody());
            $categories->save(); 

            return redirect()->route('categories-view', [
                'categories' => $categories->code,
                ]) ->with('status', "Category {$categories->code} was Updated.");
            } catch(QueryException $excp) {
                return redirect()->back()->withInput()->withErrors([
                'error' => $excp->errorInfo[2],
                ]);
        }
    }    

    function delete($categoriesCode) {
        /* $this->authorize('delete', Category::class); */

        try {
            $categories = $this->find($categoriesCode);
            /* $this->authorize('delete', $categories); */
            $categories->delete();
            
            return redirect(session()->get('bookmark.categories-view' ,route('categories-list')))
                ->with('status', "Category {$categories->code} was deleted.");
            } catch(QueryException $excp) {
                return redirect()->back()->withErrors([
                    'error' => $excp->errorInfo[2],
                    ]);
            }    
    }

    function showRestaurant(
        Request $request,
        RestaurantController $RestaurantController,
        $categoriesCode
        ) {
        $categories = $this->find($categoriesCode);
        $search = $productController->prepareSearch($request->getQueryParams());
        $query = $productController->filterBySearch($categories->products(), $search);
        
        session()->put('bookmark.restaurants-view.', $request->getUri());

        return view('categories.restaurants-product', [
        'title' => "{$this->title} {$categories->code} : Restaurants",
        'categories' => $categories,
        'search' => $search,
        'restaurants' => $query->paginate(RestaurantController::ITEM_PER_PAG),
        ]);
        }

    /* ---------- เริ่มตรงนี้ ---------- */

    function addRestaurantForm(
        Request $request,
        RestaurantController $RestaurantController,
        $categoryCode,    
    )   {
            /* $this->authorize('add', Category::class); */
            $category =$this->find($categoryCode);

            $restaurantQuery = Product::orderBy('code')->whereDoesntHave('category', function(Builder $innerQuery) use ($category) {
                return $innerQuery->where('code', $category->code);
            });

            $search = $restaurantController->prepareSearch($request->getQueryParams());
            $query = $restaurantController->filterBySearch($restaurantQuery, $search);

            session()->put('bookmark.restaurants-view.', $request->getUri());

            return view('categories.add-restaurants-form', [
                'title' => "{$this->title} {$category->code} : Add Restaurant"
                ,
                
                'search' => $search,
                'categories' => $category,
                'restaurants' => $restaurantQuery->paginate(categoryController::ITEM_PER_PAG),
                ]);
        }

    function addRestaurant(Request $request, $categoryCode) {
        /* $this->authorize('add', Category::class); */

        try {
            $category = $this->find($categoryCode);
            $data = $request->getParsedBody(); 

            $restaurantQuery = Restaurant::orderBy('code')->whereDoesntHave('category', function(Builder $innerQuery) use ($category) {
                return $innerQuery->where('code', $category->code);
                })
                ->where('code', $data['restaurant'])->firstOrFail();

            $category->restaurants()->save($restaurantQuery);

            return redirect()->back()
                ->with('status', "Category {$restaurantQuery->code} was added to Category");

            } catch(QueryException $excp) {
                return redirect()->back()->withErrors([
                'error' => $excp->errorInfo[2],
                ]);
            }
        }
        
    function removeRestaurant($categoryCode, $restaurantCode) {
       /*  $this->authorize('remove', Category::class); */

        try { 
            $category = $this->find($categoryCode);
            $restaurant = $category->restaurants()
            ->where('code', $restaurantCode)
            ->firstOrFail()
            ;
            $category->restaurants()->detach($restaurant);
                
            return redirect()->back();

            } catch(QueryException $excp) {
            return redirect()->back()->withErrors([
                'error' => $excp->errorInfo[2],
                ]);
            }

        }



}
