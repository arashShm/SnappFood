<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Product Management
        </h2>
    </x-slot>



    <form enctype="multipart/form-data" action="{{ route('product.store') }}" method="POST"
        class="grid grid-cols-3 gap-4 m-1">
        @csrf


        <div class="col-span-1">
            <x-label for="title" value="Food's Name: " />
            <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required
                autofocus />
        </div>

        <div class="col-span-1">
            <x-label for="price" value="Price: " />
            <x-input id="price" class="block mt-1 w-full" type="text" name="price" :value="old('price')"
                required />
        </div>


        <div class="col-span-1">
            <x-label for="discount" value="Discount: " />
            <x-input id="discount" class="block mt-1 w-full" type="text" name="discount" :value="old('discount')" />
        </div>

        <div class="col-span-1">
            <x-label for="image" value="Food's Image: " />
            <x-input id="image" class="" type="file" name="image" />
        </div>

        @admin
            <div class="col-start-2 col-end-4">
                <x-label for="resturant" value="Resturant: " />
                <select name="shop_id"
                    class="select2 block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">-- choose a Resturant -- </option>
                    @foreach ($shops as $shop)
                        <option value="{{ $shop->id }}">
                            {{ $shop->full_rest }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endadmin

        <div class="col-span-3">
            <x-label for="description" value="Description: " />
            <textarea
                class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                id="description"rows="3" placeholder="Food Info" name="description"></textarea>

        </div>


        <hr class="col-span-3">

        <div class=" ">
            <x-button class="ml-4 "> Save </x-button>
        </div>

    </form>

    <hr class="my-4">



</x-app-layout>
