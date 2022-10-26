@extends('layouts.main')

@section('title', $title)

@section('content')

   
        <main>
            <form action="{{ route('categories-view-restaurant', ['categories' => $categories->code,]) }}" method="get" class="search-form">
                <label>
                    Search
                        <input type="text" name="term" value="{{ $search['term'] }}" />
                </label><br />

                <label>
                Min Price
                    <input type="number" name="minPrice" value="{{ $search['minPrice'] }}"
                    step="any" />
                </label><br />

                <label>
                Max Price
                    <input type="number" name="maxPrice" value="{{ $search['maxPrice'] }}"
                    step="any" />  
                </label><br />
                
                <button type="submit" class="primary">Search</button>
                    <a href="{{ route('categories-view-restaurant', ['categories' => $categories->code,]) }}">
                <button type="button" class="accent">Clear</button>
                </a>
            </form>

            <nav>
                <ul>
                    <li>
                        <a href="{{ route('categories-add-restaurant-form', [
                            'categories' => $categories->code,
                            ]) }}">Remove Product</a>
                    </li>
                    <li><a href="{{ route('categories-view-restaurant', 
                    ['categories' => $categories->code,]) }}"> Back</a></li>
                </ul>
            </nav>

                <div>{{ $products->withQueryString()->links() }}</div>
                
            <form action="{{ route('categories-add-restaurant-form', [
                    'categories' => $categories->code, ]) }}" method="post">
                    @csrf       
                <table class="cmp-data">
                    <thead>
                        <tr>
                            <td>Code</td>
                            <td>Name</td>
                            <td>Category</td>
                            <td>Price</td>
                            <td>Add</td>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($restaurants as $restaurants)
                        <tr>
                            <th>
                                <a href="{{ route('restaurant-view', [
                                'restaurant' => $restaurant->code,]) }}">
                                {{ $restaurant->code }} 
                            </a></th>
                            <td>
                                {{ $restaurant->name }}
                            </td>
                            <td>
                                {{ $restaurant->category->name }}
                            </td>
                            <td>
                                {{ $restaurant->price }}
                            </td>
                            <td>          
                                <button type="submit" name="restaurant" value="{{ $restaurant->code }}">Add</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                <table>
            </form>
        </main>
    

@endsection