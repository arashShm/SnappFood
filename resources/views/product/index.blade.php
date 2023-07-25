<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Product Management
        </h2>
    </x-slot>

    <div class="flex">
        <a href="{{ route('product.create') }}"
            class="inline-flex items-center px-4 py-2 my-3 mx-3 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
            Add New Food </a>
    </div>



    <hr class="my-5">



    <form class="flex justify-start flex-wrap items-start my-2">

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
                    <option @if(request('order') == 1) selected @endif value="1">Cheapest</option>
                    <option @if(request('order') == 2) selected @endif value="2">Most Expensive</option>
                    <option @if(request('order') == 3) selected @endif value="3">Recently</option>
                    <option @if(request('order') == 4) selected @endif value="4">Oldest</option>
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
    </form>



    <hr class="my-4">



    @if ($products->count())
        <hr class="my-4">


        <table class="my-5 ">

            <thead>
                <tr>
                    <th> # </th>
                    @admin
                        <th> Resturant : </th>
                    @endadmin
                    <th> Food : </th>
                    <th> Price : </th>
                    <th> Discount : </th>
                    <th> Total Cost : </th>
                    <th> Image : </th>
                    <th colspan="2"> Operation : </th>
                </tr>
            </thead>

            <tbody>
                @foreach ($products as $key => $product)
                    <tr>
                        <th> {{ $key+1 }}</th>
                        @admin
                            {{-- <td> {{ $product->shop->full_rest  'No Shops Found!!!' }}</td> --}}
                            <td>
                                @if ($product->shop)
                                    {{ $product->shop->full_rest }}
                                @else
                                    <h3 class="text-red-600">No Shops Found!!!</h3>
                                @endif
                            </td>
                        @endadmin
                        <td>{{ $product->title }}</td>
                        <td>{{ number_format($product->price) }}</td>
                        <td>{{ $product->discount }}</td>
                        <td>{{ number_format($product->cost) }}</td>

                        @if ($product->image)
                            <td> <img src="{{ asset($product->image) }}" width="150px"></td>
                        @else
                            {{-- <td>
                                <h3 class="text-red-600">No Picture Found!!!</h3>
                            </td> --}}
                            <td> <img src="{{ url('/images/noimagefound.jpg') }}" width="150px"></td>

                        @endif




                        @if ($product->trashed())

                            <td colspan="2">
                                <form action="{{ route('product.restore', $product->id) }}" method="POST">
                                    @csrf
                                    <button 
                                        class="inline-flex items-center px-4 py-2 my-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-green-400 focus:bg-red-700 active:green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                        id=""> Restore </button>
                                </form>

                            </td>


                        @else
                            <td>
                                <a href="{{ route('product.edit', $product->id) }}"
                                    class="'inline-flex items-center px-4 py-2 my-2 bg-yellow-300 border border-transparent rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-yellow-200 focus:bg-yellow-700 active:yellow-900 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150'">
                                    Edit </a>
                            </td>

                            <td>
                                <form action="{{ route('product.destroy', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                        class="delete-record inline-flex items-center px-4 py-2 my-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-red-400 focus:bg-red-700 active:red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                        id=""> Delete </button>
                                </form>
                            </td>
                            
                        @endif

                    </tr>
                @endforeach
            </tbody>

        </table>

        <div class="m-5 paginate">
            {{$products->links()}}
        </div>
        
    @endif



</x-app-layout>
