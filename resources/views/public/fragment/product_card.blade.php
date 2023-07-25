<div class="col-md-4">

    <div class="card my-3 ">
        @if ($product->image)
            <img class="card-img-top" src="{{ asset($product->image) }}">
        @else
            <img class="card-img-top" src="{{ url('/images/noimagefound.jpg') }}">
        @endif
        <div class="card-body my-2 mx-1">
            <h5 class="card-title">
                <a href="{{route('public.product' , $product->id )}}" class="link"> {{ $product->title }}</a>
            </h5>
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

            <hr>

            <h6>: Description </h6>

            @if ($product->description)
                @if (str_word_count($product->description) < 4)
                    <p class="card-text">{{ $product->description }}</p>
                @elseif(str_word_count($product->description) >= 4)
                    <div class="de-flex justify-content-start">
                        <p class="card-text">{{ Illuminate\Support\Str::limit($product->description, 22) }}<a
                                href="" class="mx-1"> Read More </a></p>
                    </div>
                @endif
            @elseif(!$product->description)
                <em class="text-danger">No Descpription</em>
            @endif


            <hr>


            <form class="d-flex justify-content-between" action="{{ route('cart.manage', $product->id) }}"
                method="POST">
                <a href="{{route('shop.show' , $product->shop->id)}}">{{ $product->shop->title }}</a>

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
            <div class="alert alert-danger mt-2 hidden">

            </div>

        </div>
    </div>

</div>

