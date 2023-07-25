@extends('layouts.public')

@section('products-active')
    active
@endsection

@section('content')
    <h4 class="text-center">Food's List</h4>
    <hr>


    <form action="" class="row justify-content-end text-start align-items-center" method="get">
        <div class="col-md-2">
            <div class="mb-4"></div>
            <button type="submit" class="btn btn-primary mt-2">Search</button>
        </div>

        <div class="col-md-4 form-group">
            <label for="" class="mb-2">:Food Name </label>
            <input type="text" class="food-input form-control" name="food" value="{{ request('food') }}">
        </div>

        <div class="col-md-4 form-group">
            <label for="" class="mb-2">:OrderBy </label>
            <select name="order" id="" class="form-control">
                <option value=""> -- Choose --</option>
                <option value="1" @if (request('order') == 1) selected @endif>Most Expensive</option>
                <option value="2" @if (request('order') == 2) selected @endif>Cheapest</option>
                <option value="3" @if (request('order') == 3) selected @endif>Recent</option>
            </select>
        </div>

    </form>

    <hr>


 
    <div class="row">

        @foreach ($products as $product)
            @include('public.fragment.product_card')
        @endforeach
    </div>

    <hr>

    <div class="m-3 paginate">
        {{ $products->links() }}
    </div>
@endsection
