<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Shop Management
        </h2>
    </x-slot>

    <div class="flex">
        <a href="{{ route('shop.create') }}"
            class="'inline-flex items-center px-4 py-2 my-3 mx-3 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'">
            Add New Resturant </a>
    </div>


    <hr class="my-5">


    <form action="" class="flex justify-start flex-wrap items-start my-2 mx-4">

        <div class="w-1/4 my-2 px-2">
            <x-label for="order" value="Order By: " />
            <select name="order"
                class="select2 block appearance-none w-full bg-white border border-gray-300 hover:border-indigo-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline w-full">
                <option value=""> -- Choose -- </option>
                <option @if (request('order') == 1) selected @endif value="1">Recently</option>
                <option @if (request('order') == 2) selected @endif value="2">Oldest</option>
            </select>
        </div>



        <div class="w-1/4 my-2 px-2">
            <x-label for="byName" value="Name Of Resturant: " />
            <x-input id="byName" class="border-gray-300 w-full" type="text" name="byName" :value="request('byName')" />
        </div>



        <div class="w-1/4 my-2 px-2">
            <x-label for="byPhone" value="PhoneNumber: " />
            <x-input id="byPhone" class="border-gray-300 w-full" type="text" name="byPhone" :value="request('byPhone')" />
        </div>


        <div class="w-1/4 my-2 px-2">
            <x-label for="byDeleted" value="Show Deleted: " />
            <x-input id="byDeleted" type="checkbox" name="byDeleted" :value="1" />
        </div>


        <div class="w-1/5 my-2">
            <x-button class="ml-3"> Search </x-button>
        </div>


    </form>








    @if ($shops->count())
        <hr class="my-4">


        <table class="my-5 ">

            <thead>
                <tr>
                    <th> # </th>
                    <th> Title : </th>
                    <th> Owner's Name : </th>
                    <th> Telephone : </th>
                    <th> Email : </th>
                    <th> Username : </th>
                    <th> Commencing Date : </th>
                    <th colspan="2"> Operation : </th>
                </tr>
            </thead>

            <tbody>
                @foreach ($shops as $key => $shop)
                    <tr>
                        <th> {{ $key + 1 }}</th>
                        <td>{{ $shop->title }}</td>
                        <td>{{ $shop->full_name }}</td>
                        <td>{{ $shop->telephone }}</td>
                        {{-- <td>{{ $shop->user->email ?? 'No Email Found!!!' }}</td> --}}
                        <td>
                            @if ($shop->user)
                                {{ $shop->user->email }}
                            @else
                                <h3 class="text-red-600">No Shops Found!!!</h3>
                            @endif
                        </td>
                        {{-- <td>{{ $shop->user->name ?? 'No UserName Found!!!' }} </td> --}}

                        <td>
                            @if ($shop->user)
                                {{ $shop->user->name }}
                            @else
                                <h3 class="text-red-600">No Username Found!!!</h3>
                            @endif
                        </td>


                        <td>{{ persianDate($shop->created_at) }}</td>




                        @if ($shop->trashed())
                            <td colspan="2">
                                <form action="{{ route('shop.restore', $shop->id) }}" method="POST">
                                    @csrf
                                    <button
                                        class="inline-flex items-center px-4 py-2 my-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-green-400 focus:bg-red-700 active:green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                        id=""> Restore </button>
                                </form>

                            </td>
                        @else
                            <td>
                                <a href="{{ route('shop.edit', $shop->id) }}"
                                    class="'inline-flex items-center px-4 py-2 my-2 bg-yellow-300 border border-transparent rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-yellow-200 focus:bg-yellow-700 active:yellow-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'">
                                    Edit </a>
                            </td>
                            <td>
                                <form action="{{ route('shop.destroy', $shop->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                        class="delete-record inline-flex items-center px-4 py-2 my-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-red-400 focus:bg-red-700 active:red-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                        id=""> Delete </button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>

        </table>


        <div class="m-5 paginate">
            {{$shops->links()}}
        </div>

    @endif



</x-app-layout>
