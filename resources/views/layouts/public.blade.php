<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="utf-8">
    <title> Welecome To Our Website</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/public.css') }}">
</head>

<body>

    <div class="container py-4">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a href="{{ route('public') }}"
                    class="@yield('public-active') link-dark link-light nav-link link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Home
                    Page</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('public.products') }}"
                    class="@yield('products-active') link-dark link-light nav-link link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Foods</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('public.shops') }}"
                    class="@yield('shops-active') link-dark link-light nav-link link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Resturants</a>
            </li>

            @if (auth()->user())
                <li class="nav-item">
                    <a href="{{ route('public.carts') }}" id="cart"
                        class="@yield('carts-active') link-dark link-light nav-link link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Cart
                        <span>{{ cartCount() }}</span></a>
                </li>
            @endif

            @if (!auth()->user())
                <li class="login nav-item align-self-center">
                    <a href="{{ route('login') }}"
                        class="btn btn-info btn-sm link-dark link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Login</a>
                </li>
            @elseif(auth()->user())
                <li class="login nav-item align-self-center">
                    <a href="{{ route('dashboard') }}"
                        class="btn btn-info btn-sm link-dark link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Dashboard</a>
                </li>
            @endif

        </ul>

        <div class="card my-3">
            <div class="card-body">


                @if ($error = session('error'))
                    <div class="alert alert-danger">
                        {{ $error }}
                    </div>
                @endif

                @if ($message = session('message'))
                    <div class="alert alert-success">
                        {{ $message }}
                    </div>
                @endif



                @yield('content')

            </div>
        </div>
    </div>



    <script src="{{ asset('js/Jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/public.js') }}" charset="utf-8"></script>


</body>

</html>
