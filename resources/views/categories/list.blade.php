@extends('layouts.main')

@section('title', $title)

@section('content')

    <main>
        <form action="{{ route('categories-list') }}" method="get" class="search-form">
            <label>
                Search
                    <input type="text" name="term" value="{{ $search['term'] }}" />
            </label><br />

            <button type="submit" class="primary">Search</button>
                <a href="{{ route('categories-list') }}">
            <button type="button" class="accent">Clear</button>
            </a>
        </form>

        <nav>
            <ul>
                {{-- @can('create', \App\Models\Category::class) --}}
                    <li>
                        <a href="{{ route('categories-create-form') }}">New Categories</a>
                    </li>
                {{-- @endcan --}}
            </ul>
        </nav>
            
        <div>{{ $categories->withQueryString()->links() }}</div>
            
        <table class="cmp-data">
            <thead>
                <tr>
                    <td>Code</td>
                    <td>Name</td>
                    <td>Number of Products</td>
                </tr>
            </thead>

            <tbody>
                @foreach($categories as $categories)
                <tr>
                    <th>
                        <a href="{{ route('categories-view', [
                        'categories' => $categories->code,]) }}">
                        {{ $categories->code }} 
                    </a></th>
                    <td>
                        {{ $categories->name }}
                    </td>
                    <td>
                        {{ $categories->products_count }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        <table>
    </main>

@endsection