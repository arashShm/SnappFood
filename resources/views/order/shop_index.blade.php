<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Order Management
        </h2>
    </x-slot>

    <hr class="my-5">


    <table class="my-5">


        <thead>
            <tr>
                <th> # </th>
                <th> Cutomer : </th>
                <th> Food : </th>
                <th> Count : </th>
                <th> Cost : </th>
                <th> Date Of Order : </th>
                <th> Time Of Order : </th>
                <th> Status : </th>
                <th> Change Status : </th>
            </tr>
        </thead>

        @if ($items)
            <tbody>
                @foreach ($items as $key => $item)
                    <tr>
                        <th>{{ $key + 1 }}</th>
                        <td>{{ $item->cart->user->name ?? '-' }}</td>
                        <td>{{ $item->product->title }}</td>
                        <td>{{ $item->count }}</td>
                        <td>{{ number_format($item->pay) }}</td>
                        <td>{{ persianDate($item->created_at) }}</td>
                        <td>{{ $item->created_at->format('H:i:s') }}</td>
                        <td>
                            @if ($item->status == 1)
                                <div class="flex justify-between text-blue-500 text-xl p-1">
                                    <span>New Order</span>
                                    <span class="font-bold ">⬆️</span>
                                </div>
                            @elseif($item->status == 2)
                                <div class="flex justify-between text-green-700 text-xl p-1">
                                    <span>Delivered</span>
                                    <span class="font-bold ">✔</span>
                                </div>
                            @elseif($item->status == 3)
                                <div class="flex justify-between text-red-500 text-xl p-1">
                                    <span>Rejected</span>
                                    <span class="font-bold ">✗</span>
                                </div>
                            @endif
                        </td>
                        <td>
                            <form action="{{route('order.status' , $item->id)}}" method="POST" class="flex">
                                @csrf
                                <select name="status" id="" class="appearance-none w-full bg-white border border-gray-300 hover:border-indigo-500 rounded shadow leading-tight focus:outline-none focus:shadow-outline w-8">
                                    <option value=""> --- </option>
                                    <option value="1">New Order</option>
                                    <option value="2">Delivered</option>
                                    <option value="3">Rejected</option>
                                </select>
                                <div class="">
                                    <x-button class="ml-1" type="submit">submit</x-button>
                                </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        @endif

    </table>
    <div class="m-5 paginate">
        {!! $items->render() !!}
    </div>

</x-app-layout>
