@extends('layouts.main')

@section('title',$title)

@section('content')

<main>
    <!--<nav>
        <ul></ul>
            <li>
                <a href="{.{ route('product-view-shop', ['product' => $product->code,]) }}">Show shop</a>
            </li>
            <li>
                <a href="{.{ route('product-update-form', ['product' => $product->code,]) }}">Update</a>
            </li>
            @.endcan
            <li>
                <a href="{.{ route('product-delete', ['product' => $product->code,]) }}">Delete</a>
            </li>
            @.endcan
            <li>
                <a href="{.{session()->get('bookmark.product-view', route('product-list'))}}">&lt; Back</a>
            </li>
        </ul>
    </nav> -->:

    <table class="pro-view">
        <p>
            <tr> 
                <td><span>{{ $restaurant->picture }}</span></td>
            </tr>
            <tr>
                <td><b>Name </b></td>
                <td><b>::</b></td>   
                <td><span>{{ $restaurant->name }}</span></td>
            </tr>
            <tr>
                <td><b>Category </b></td>
                <td><b>::</b></td>   
                <td><span>{{ $restaurant->category }}</span></td>
            </tr>
            <tr>
                <td><b>Price </b></td>
                <td><b>::</b></td>   
                <td><span>{{ number_format((double)$restaurant->price, 2) }}</span></td>
            </tr>
            <tr>
                <td><b>Location </b></td>
                <td><b>::</b></td>   
                <td><span>{{ $restaurant->location }}</span></td>
            </tr>
        </p>
    </table>
            <pre>{{ $restaurant->description }}</pre>
</main>

@endsection