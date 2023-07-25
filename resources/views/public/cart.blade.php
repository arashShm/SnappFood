@extends('layouts.public')

@section('carts-active')
    active
@endsection

@section('content')
    <h4 class="text-center">Your Orders</h4>
    <hr>

    @if ($cart)
        @foreach ($cart->items as $key => $item)
            <div class="card mb-3" style="max-width: full; text-align:end;">
                <div class="row g-1 ">
                    <div class="col-md-4 card-image d-flex align-items-stretch ">
                        @if ($item->product->image)
                            <img class="image img-fluid rounded-start" src="{{ asset($item->product->image) }}">
                        @else
                            <img class="image img-fluid rounded-start" src="{{ url('/images/noimagefound.jpg') }}">
                        @endif
                    </div>

                    <div class="col-md-8">
                        <div class="card-body cart-body">
                            <div class="d-flex justify-content-between">
                                <form action="{{ route('cart.destroy', $item->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete Item</button>
                                </form>

                                
                                <h5 class="card-title"><a href="{{ route('public.product', $item->product->id) }}" class="link">{{ $item->product->title }}</a></h5>
                            </div>

                            <hr>
                            <div class="d-flex justify-content-end text-align-end ml-2 align-item-center">
                                <div>
                                    @if ($item->product->description)
                                        @if (str_word_count($item->product->description) < 5)
                                            <p class="card-text">{{ $item->product->description }}</p>
                                        @elseif(str_word_count($item->product->description) >= 4)
                                            <div class="d-flex justify-content-start">
                                                <p class="card-text">
                                                    {{ Illuminate\Support\Str::limit($item->product->description, 33) }}<a
                                                        href="" class="mx-1"> Read More </a></p>
                                            </div>
                                        @endif
                                    @elseif(!$item->product->description)
                                        <em class="text-danger">No Descpription</em>
                                    @endif
                                </div>
                                <h6> : Description </h6>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <p>
                                    @if ($item->product->discount)
                                        <span
                                            class="price text-danger off mx-2">{{ number_format($item->product->price) }}</span>
                                    @endif
                                    <span class="price">{{ number_format($item->product->cost) ?? '-' }}</span>
                                </p>
                                <p> : Price</p>
                            </div>

                            <div class="d-flex justify-content-between">
                                <p>
                                    <span class="count"><a
                                            href="{{ route('shop.show', $item->product->shop->id) }}">{{ $item->product->shop->title ?? '-' }}</a></span>
                                </p>
                                <p> : Shop</p>
                            </div>

                            <div class="d-flex justify-content-between">
                                <div class="d-flex justify-content-start">

                                    <form action="{{ route('cart.manage', $item->product_id) }}" method="POST">
                                        @csrf
                                        <div>
                                            <span class="count-item">{{ $item->count }}</span>
                                            <button type="button" name="type" value="minus"
                                                class="quantity1 bg btn btn-warning btn-sm mx-1 manage-cart "> - </button>
                                            <button type="button" name="type" value="add"
                                                class="quantity1 bg btn btn-warning btn-sm mx-1 manage-cart"> + </button>
                                        </div>
                                    </form>
                                </div>

                                <p> : Count</p>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        @endforeach



        <div class="d-flex justify-content-end align-items-center">

            <form action="{{ route('cart.pay') }}" class="text-center mb-3" method="POST">
                @csrf
                <button class="pay btn btn-primary btn-lg mx-4" type="submit">Confirm and Pay</button>
            </form>

            <div class="alert total-price d-flex justify-content-between text-align-start">
                <h4>
                    $ {{ number_format($cart->sum) }}
                </h4>

                <h3 class="">
                    : Totall Price
                </h3>
            </div>
        </div>
    @else
        <div class="alert alert-info">
            !Your Cart is EMPTY
        </div>
    @endif
@endsection
