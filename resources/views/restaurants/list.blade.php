@extends('layouts.main')

@section('title',$title)

@section('content')

<body>
    <header>
        <h1></h1>
    </header>
    <!--<form action="{.{ route('restaurant-list') }}" method="get" class="search-form">
        <tr>
            <td>
                <label>
                    Search ::
                    <input type="text" name="term" value="{.{ $search['term'] }}" />
                </label>
                <br />
                <label>
                    Min Price ::
                    <input type="number" name="minPrice" value="{.{ $search['minPrice'] }}" step="any" />
                </label>
                <br />
                <label>
                    Max Price ::
                    <input type="number" name="maxPrice" value="{.{ $search['maxPrice'] }}" step="any" />
                </label>
            
            </td>
        </tr>
        <tr>
            <td>
                <button type="submit" class="primary">Search</button>
                <a href="{.{ route('restaurant-list') }}"></a>
                    <button type="button" class="accent">Clear</button>
                </a>
            </td>
        </tr>
    </form>-->

    <nav>
        <ul>
            
            <li>
                <a class="new" href="{{ route('restaurant-create-form') }}">New Restaurant</a> 
            </li>
           
        </ul>
    </nav>

    <!-- <div class="page">{.{ $products->withQueryString()->links() }}</div> -->

    <!--<table class="pro-list">
        <thead>
            <tr>
                <th>Picture</th>
                <th>Code</th>
                <th>Name</th>
                <th>Start Price</th>
                <th>Location</th>
            </tr>
        </thead>
       <tbody>-->
            @foreach($restaurants as $restaurant)
            <div class="card ">
                <div class="res card-1">
            <tr>
                <td><img class="pic"  src={{ asset('images/restaurants')."/".$restaurant->code.".jpg" }}>
                </td>   
                <br>
                <td>
                    <a class="link" href="{{ route('restaurant-view', ['restaurant' => $restaurant['code']]) }}">
                        {{ $restaurant['code'] }}
                    </a>
                </td>
                <td>{{ $restaurant['name'] }}</td>
                <td>{{ $restaurant['price'] }}</td>
                <td>{{ $restaurant['location'] }}</td>
            </tr>
                </div>
                @endforeach
            </div>
            
        </tbody>
    </table>
</body>

@endsection
