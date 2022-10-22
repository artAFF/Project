@extends('layouts.main')

@section('title', $title)

@section('content')

<form action="{{ route('product-create') }}" method="post">
@csrf
    <label>Code :: <input type="text" name="code" value="{{ old('code') }}"/></label><br />
    <label>Name :: <input type="text" name="name" value="{{ old('name') }}"/></label><br />
    <label>Category :: 
        <select name="category" required>
            <option value="">-- Please Select Category --</option>
           
        </select>
    </label><br />
    <label>Price :: <input type="number" step="any" name="price" required value="{{ old('price') }}"/></label><br />
    <label>Description :: 
    <textarea name="description" cols="80" rows="10" required >{{old('description') }}</textarea>
    </label><br />
    
    <button type="submit">Create</button>
</form>

@endsection