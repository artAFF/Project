@extends('layouts.main')

@section('title', $title)

@section('content')
    <main>
        <nav>
            <ul>
                {{-- @can('update', $categories) --}}
                <li>
                    <a href="{{ route('categories-update-form', [
                    'categories' => $categories->code,
                    ]) }}">Update</a>
                </li>
               {{--  @endcan   --}}  
               {{--  @can('delete', $categories) --}}
                    <li>
                        <a href="{{ route('categories-delete', [
                        'categories' => $categories->code,
                        ]) }}">Delete</a>
                    </li>
               {{--  @endcan     --}}
                <li><a href="{{ route('categories-view-restaurant', [
                    'categories' => $categories->code,
                    ]) }}">Show Restaurant</a>
                </li>
                <li>
                <a href="{{session()->get('bookmark.categories-view.', route('categories-list'))}}">&lt;Back</a>
                </li>
            </ul>
            </nav>
            
        <p>
            <b>Code ::</b>
            <span>{{ $categories->code }}</span><br />
            <b>Name ::</b>
            <span>{{ $categories->name }}</span><br />
            <b>Description ::</b>
            </p>
            <pre>{{ $categories->description }}</pre>
    </main>
@endsection