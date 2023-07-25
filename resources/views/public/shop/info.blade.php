@extends('layouts.public')

@section('shop-active')
    active
@endsection

@section('content')
    <div class="text-align-">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link @yield('about-active')" href="{{route('shop.show' , $shop->id)}}">This Resuturant</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @yield('shop-active')" href="{{route('shop.info' , $shop->id)}}">Info</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @yield('product-active')" href="{{route('shop.product' , $shop->id)}}">Products</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <h4 class="shop-title">{{ $shop->title }}</h4>
            <hr>
            <div class="m-2 d-flex justify-content-end">
                <p class="card-text"> {{ $shop->full_name }}</p>
                <h5 class="card-title"> : Owner </h5>
            </div>
   
            <div class="m-2 d-flex justify-content-end ">
                <p class="card-text"> {{$shop->telephone}}</p>
                <h5 class="card-title"> : Telephone </h5>
            </div>
            <div class="m-2 d-flex justify-content-end ">
                <p class="card-text"> {{persianDate($shop->created_at)}}</p>
                <h5 class="card-title"> : Date Of Register </h5>
            </div>

            <div class="m-2 d-flex justify-content-end ">
                <p class="card-text"> {{$shop->address}}</p>
                <h5 class="card-title"> : Address </h5>
            </div>
        </div>
    </div>
@endsection
