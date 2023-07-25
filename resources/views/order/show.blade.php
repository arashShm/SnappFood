<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Order Datails
        </h2>
    </x-slot>


    <hr class="my-5">

    <table class="my-5 ">

        <thead>
            <tr>
                <th> # </th>
                <th> Food : </th>
                <th> Resturant: </th>
                <th> Count : </th>
                <th> Cost : </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->items as $key => $item)
                <tr>
                    <th>{{ $key + 1 }}</th>
                    <td>{{ $item->product->title }}</td>
                    <td>{{ $item->product->shop->title }}</td>
                    <td>{{ $item->count }}</td>
                    <td>{{ number_format($item->pay) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <hr class="my-5">

    <div class="flex justify-between items-center">

        <div class="total-price flex justify-around items-center m-5">
            <h3>Total Price : </h3>
            <h4>
                $ {{ number_format($order->sum) }}
            </h4>
        </div>

        <div class="total-count flex justify-between items-center ">
            <h3>Total Count :</h3>
            <h4>
                {{$order->count}}
            </h4>
        </div>

        <div>
            <a href="{{ route('order.index') }}"
                class="inline-flex items-center px-4 py-2 my-3 mx-3 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Back To Order List</a>
        </div>
    </div>

</x-app-layout>
