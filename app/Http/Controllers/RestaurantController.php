<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Restaurant;

class RestaurantController extends Controller
{
    const ITEM_PER_PAGE = 5;

    private string $title = 'Restaurant';


    
    function list()
    {
        return view('restaurants.list', [
            'title' => "{$this->title} : List",
            'restaurants' => Restaurant::orderBy('code')->get(),
        ]);
    }

    function show($restaurantCode)
    {
        /*$restaurant = $this->find($restaurantCode);*/
        $restaurant = Restaurant ::where('code', $restaurantCode)->firstOrFail();

        return view('restaurants.view', [
            'title' => "{$this->title} : View", 'restaurant' => $restaurant,
        ]);
    }

    function createForm() 
    {
        $this->authorize('create', Product::class);

        $categories =Category::orderBy('code')->get();

        return view('products.create-form', [
        'title' => "{$this->title} : Create",
        'categories' => $categories,
        ]);
    }
    function create(Request $request) 
    {
        $this->authorize('create', Product::class);
        try {
            $product= new Product();
            $data = $request->getParsedBody();
            $product->fill($data);
            $category = Category::where('code', $data['category'])->firstOrFail();
            $product->category()->associate($category);
            $product->save();
            
        return redirect()->route('product-list')
        ->with('status', "Product {$product->code} was created.");
        } catch (QueryException $excp) {
        return redirect()->back()->withInput()->withErrors([
            'error' => $excp->errorInfo[2],
        ]);
    }
}

    /*function show($restaurantCode)
    {
        $restaurant = Restaurant
            ::where('code', $restaurantCode)
            ->firstOrFail();

        return view('restaurant-view', [
            'title' => "{$this->title} : View",
            'restaurant' => $restaurant,
        ]);
    }*/

    /*function list(Request $request) 
    {
        $search = $this->prepareSearch($request->getQueryParams());
        $query = $this->search($search);
        $query = $this->search($search)->withCount('restaurants');

        //session()->put('bookmark.product-view', $request->getUri());
        //session()->put('bookmark.shop-view', $request->getUri());

        return view('restaurants.list', [
        'title' => "{$this->title} : List",
        'search' => $search,
        'restaurants' =>$query->paginate(self::ITEM_PER_PAGE),
        ]);
    }
    function show($restaurantCode) 
    {
        $restaurant = $this->find($restaurantCode);
    
        return view('restaurants.view', [
        'title' => "{$this->title} : View",
        'restaurant' => $restaurant,
        ]);
    }*/
}
