@extends('layouts.public')
@section('product-active')
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
        <div class="row card-body">
                <h4 class="shop-title m-2">{{ $shop->title }} Products</h4>
                <hr>
                @foreach ($products as $product)
                    @include('public.fragment.product_card')
                @endforeach

                {{$products->links()}}

        </div>
    @endsection
