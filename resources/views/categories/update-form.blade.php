@extends('layouts.main')

@section('title', $title)

@section('content')

    
        <main>
            <form action="{{ route('categories-update', [
                'categories' => $categories->code,
                ]) }}" method="post">
                @csrf
                
                <label>Code
                    <input type="text" name="code" value="{{ $categories->code }}"  value="{{ old('name') }}" required/>
                </label><br />
                <label>Name
                    <input type="text" name="name" value="{{ $categories->name }}" value="{{ old('name') }}" required />
                </label><br />
                <label>
                    Description
                    <textarea
                    name="description" cols="80" rows="10"
                    >{{ old($categories->description) }}</textarea>
                </label><br />
                    
                    <button type="submit">Update</button>
                    </form>
        </main>
   

@endsection