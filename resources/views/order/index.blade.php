<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Order Management
        </h2>
    </x-slot>

    <hr class="my-5">



    {{-- <form class="flex justify-start flex-wrap items-start my-2">

        @admin
            <div class="w-1/4  my-2 px-2">
                <x-label for="byResturant" value="Select By Resturant: " />
                <select name="byResturant"
                    class="select2 block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline w-full">
                        <option value="">-- Choose A Resturant -- </option>
                            @foreach ($shops as $shop)
                                <option @if (request('byResturant') == $shop->id) selected @endif value="{{ $shop->id}}">
                                    {{ $shop->full_rest }}
                                </option>
                            @endforeach
                </select>
            </div>
        @endadmin

        <div class="w-1/4 my-2 px-2">
            <x-label for="order" value="Order By: " />
                <select name="order"
                class="select2 block appearance-none w-full bg-white border border-gray-300 hover:border-indigo-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline w-full">
                <option value=""> -- Choose -- </option>
                    <option @if (request('order') == 1) selected @endif value="1">Cheapest</option>
                    <option @if (request('order') == 2) selected @endif value="2">Most Expensive</option>
                    <option @if (request('order') == 3) selected @endif value="3">Recently</option>
                    <option @if (request('order') == 4) selected @endif value="4">Oldest</option>
                </select>
        </div>


        <div class="w-1/4 my-2 px-2">
            <x-label for="byTitle" value="Title: " />
            <x-input id="byTitle" class="border-gray-300 w-full" type="text" name="byTitle" :value="request('byTitle') " />
        </div>



        <div class="w-1/4 my-2 px-2">            
            <x-label for="byDeleted" value="Show Deleted: " />
            <x-input id="byDeleted" type="checkbox" name="byDeleted" :value="1"  />
        </div>

        <div class="w-full"></div>

        <div class="w-1/5 my-2">
            <x-button class="ml-3"> Search </x-button>
        </div>
    </form> --}}



    {{-- <hr class="my-4"> --}}



    {{-- <hr class="my-4"> --}}


    <table class="my-5 ">

        <thead>
            <tr>
                <th> # </th>
                <th> User : </th>
                <th> Status: </th>
                <th> Code : </th>
                <th> Date : </th>
                <th colspan="2"> Operation : </th>
            </tr>
        </thead>
        @if ($orders->count())

            <tbody>
                @foreach ($orders as $key => $order)
                    <tr>
                        <th>{{ $key + 1 }}</th>
                        <td>
                            {{ $order->user->name }}
                        </td>
                        <td>
                            @if ($order->paid)
                                <div>
                                    <span class="tik">✔</span>
                                </div>
                            @else
                                <div>
                                    <span class="cross">✗</span>
                                </div>
                            @endif
                        </td>

                        <td>
                            @if ($order->code)
                                <div class="text-sky-600">{{ $order->code }}</div>
                            @else
                                <div class="text-red-500">Not Paid!</div>
                            @endif
                        </td>

                        <td>
                            {{ persianDate($order->created_at) }}
                        </td>


                        <td>
                            <a href="{{ route('order.show', $order->id) }}"
                                class="'inline-flex items-center px-3 py-2 bg-blue-300 border border-transparent rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-blue-200 focus:bg-blue-700 active:blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150'">
                                Details </a>
                        </td>

                        @admin
                            <td>
                                <form action="{{ route('order.destroy', $order->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center px-4 py-2 my-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-red-400 focus:bg-red-700 active:red-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                        id=""> Delete </button>
                                </form>
                            </td>
                        @endadmin
                    </tr>
                @endforeach
            </tbody>
        @endif
    </table>

    <div class="m-5 paginate">
        {!! $orders->render() !!}
    </div>





</x-app-layout>
