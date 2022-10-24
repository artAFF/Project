<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recommended Restaurants in Chiang Mai - @yield('title')</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}" />
</head>

<body>
    <main>

        <header class="navbar">

            <h1 id="header"> @yield('title')</h1>

            <ul class="nav-list">
                <li><a href="{{ route('restaurant-list') }}">Restaurants</a></li>
                <li><a href="">Location</a></li>
                <a href="{{ route('categories-list')}}">Category</a>
                <!--@.can('view', \App\Models\User::class)
                <li><a href="{.{ route('user-list') }}">User</a></li>
                @.endcan-->
            </ul>

            <!--@.auth
            <nav class="user-panel">
                <span>{.{ \Auth::user()->name }}</span> &nbsp;&nbsp;
                <a href="{.{ route('logout') }}">Logout</a>
            </nav>
            @.endauth -->

        </header>


        <br>

        <!--@.if(session()->has('status'))
        <div class="status">
            <span class="info">{.{ session()->get('status') }}</span>
        </div>
        @.endif-->

        <!--@.error('error')
        <div class="status">
            <span class="warn">{.{ $message }}</span>
        </div>
        @.enderror-->
        <br>


        <div class="content">

            @yield('content')

        </div>


        <footer>

            <br><br>

            &#xA9; Copyright Recommended Restaurants Near Chiang Mai University, 2022.

        </footer>

    </main>
</body>

</html>
