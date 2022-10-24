@extends('layouts.main')

@section('title', $title)

@section('content')

    
        <main>
            <form action="{{ route('categories-create') }}" method="post">
                @csrf
                    <label>
                        Code <input type="text" name="code" value="{{ old('code') }}" required />
                    </label><br />
                    <label>
                        Name <input type="text" name="name" value="{{ old('name') }}" required />
                    </label><br />
                    <label>
                        Description
                        <textarea name="description" cols="80" rows="10"  required>{{ old('description') }}</textarea>
                    </label><br />

                <button type="submit">Create</button>
                </form>
            
        </main>
   

@endsection