@extends('layouts.main')

@section('title', $title)

@section('content')

    <main>
        <form action="{{ route('categories-view-product', ['categories' => $categories->code,]) }}" method="get" class="search-form">
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
                <a href="{{ route('categories-view-product', ['categories' => $categories->code,]) }}">
            <button type="button" class="accent">Clear</button>
            </a>
        </form>

        <nav>
            <ul>
                @can('create', $categories)
                    <li>
                        <a href="{{ route('categories-add-product-form', [
                            'categories' => $categories->code,
                            ]) }}">Add Product</a>
                    </li>
                @endcan
                <li>
                        <a href="{{ route('categories-view', 
                    ['categories' => $categories->code,]) }}">&lt; Back</a>
                </li>
            </ul>
        </nav>
            
            <div>{{ $products->withQueryString()->links() }}</div>
            
        <table class="cmp-data">
            <thead>
                <tr>
                    <td>Code</td>
                    <td>Name</td>
                    <td>Category</td>
                    <td>Price</td>
                </tr>
            </thead>

            <tbody>
                @foreach($products as $product)
                <tr>
                    <th>
                        <a href="{{ route('product-view', [
                        'product' => $product->code,]) }}">
                        {{ $product->code }} 
                    </a></th>
                    <td>
                        {{ $product->name }}
                    </td>
                    <td>
                        {{ $product->category->name }}
                    </td>
                    <td>
                        {{ $product->price }}
                    </td>
                    <td>
                            
                        <a href="{{ route('categories-remove-restaurant', [
                            'cateogries' => $cateogries->code,
                            'restaurant' => $restaurants->code,
                            ]) }}">Remove</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        <table>
    </main>

@endsection