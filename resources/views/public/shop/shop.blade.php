@extends('layouts.public')
@section('about-active')
    active
@endsection

@section('content')
    <div class="text-align-">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link @yield('about-active')" href="{{ route('shop.show', $shop->id) }}">This Resturant</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @yield('shop-active')" href="{{ route('shop.info', $shop->id) }}">Info</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @yield('product-active')" href="{{ route('shop.product', $shop->id) }}">Products</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <h4 class="shop-title">{{ $shop->title }}</h4>
            <hr>
            <p class="card-text font-weight-bold">!Welecome to Our shop</p>
        </div>

        @include('public.fragment.comments' , ['list' => $shop->comments , 'owner_type' => 'Shop' , 'owner_id' => $shop->id])

    </div>
@endsection
