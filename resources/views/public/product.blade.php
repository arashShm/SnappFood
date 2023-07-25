@extends('layouts.public')



@section('content')
    <div class="card mb-3">
        <img class="card-img-top" src="{{ asset($product->image) }}" alt="Card image cap">
        <div class="card-body my-2 mx-1">
            <h5 class="card-title">{{ $product->title }}</h5>
            <hr class="my-3">
            <div class="">
                <h6> : Description </h6>
                @if ($product->description)
                    <div>
                        <p class="card-text">{{ $product->description }}</p>
                    </div>
                @else
                    <em class="text-danger">No Descpription</em>
                @endif
            </div>
            <hr>
            <div class="d-flex justify-content-between">
                <p>
                    @if ($product->discount)
                        <span class="price text-danger off mx-2">{{ number_format($product->price) }}</span>
                    @endif
                    <span class="price">{{ number_format($product->cost) }}</span>
                </p>

                <p> : Price</p>
            </div>

            <form class="d-flex justify-content-between" action="{{ route('cart.manage', $product->id) }}" method="POST">
                <a href="{{ route('shop.show', $product->shop->id) }}">{{ $product->shop->title }}</a>

                <div class="in-cart @unless ($cart_item = $product->isInCart()) hidden @endunless">

                    <button type="button" name="type" value="minus"
                        class="manage-cart quantity bg btn btn-warning btn-sm mx-1 "> - </button>

                    <span class="count-item">{{ $cart_item->count ?? 0 }}</span>

                    <button type="button" name="type" value="add"
                        class="manage-cart quantity bg btn btn-warning btn-sm mx-1 "> + </button>

                </div>

                <div class="not-in-cart @if ($product->isInCart()) hidden @endif">
                    <button type="button" name="type"
                        value="add"class="manage-cart bg btn btn-primary btn-sm px-2">Add Food to
                        Cart</button>
                </div>

            </form>

            <hr>

            <div class="d-flex justify-content-between text-align-end ml-2 align-item-center">
                <a href="{{ URL::previous() }}" class="btn btn-dark btn-sm">Go To Previous Page</a>
                <p class="card-text"><small class="text-muted">Last updated :
                        {{ persianDate($product->updated_at) }}</small></p>
            </div>
        </div>
    </div>

    @include('public.fragment.comments' , ['list' => $product->comments , 'owner_type' => 'Product' , 'owner_id' => $product->id])


@endsection
