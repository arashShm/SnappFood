@extends('layouts.public')

@section('shops-active')
    active
@endsection

@section('content')
    <h4 class="text-center">Resurant's List</h4>
    <hr>

    @foreach ($shops as $shop)
        <div class="card my-3">
            <div class="card-header">
                <h5 class="title">{{$shop->title}}</h5>
            </div>
            <div class="card-body ">
                <div class="mb-4 d-flex justify-content-end">
                    <p class="card-text"> {{$shop->full_name}}</p>
                    <h5 class="card-title"> : Owner </h5>
                </div>
                <div class="d-flex justify-content-end ">
                    <p class="card-text"> {{$shop->address}}</p>
                    <h5 class="card-title"> : Address </h5>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <a href="{{route('shop.show' , $shop->id)}}" class="visit-btn btn btn-primary btn-sm">Visit</a>
                    <p>{{persianDate($shop->created_at)}}</p>
                </div>
            </div>
        </div>
    @endforeach

    {{$shops->links()}}
@endsection
