<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Shop Management
        </h2>
    </x-slot>



    <form action="{{ route('shop.update' , $shop->id) }}" method="POST" class="grid grid-cols-3 gap-4 m-1">
        @csrf
        @method('PUT')
        
        <div class="col-span-1">
            <x-label for="title" value="Resturant's Name: " />
            <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="$shop->title" required autofocus />
        </div>

        <div class="">
            <x-label for="first_name" value="Owner's FirstName: " />
            <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="$shop->first_name" required/>
        </div>

        <div class="">
            <x-label for="last_name" value="Owner's LastName: " />
            <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="$shop->last_name" required/>
        </div>

        <div class="">
            <x-label for="telephone" value="Phone Number: " />
            <x-input id="telephone" class="block mt-1 w-full" type="text" name="telephone" :value="$shop->telephone" required/>
        </div>

        <div class="col-span-3">
            <x-label for="address" value="Address: " />
            <x-input id="address" class="block mt-1 w-full" type="text" name="address" :value="$shop->address"/>
        </div>

            <hr class="col-span-3">
            
        <div class=" ">
            <x-button class="ml-4"> Save </x-button>
        </div>

    </form>

   <hr class="my-4"> 



</x-app-layout>
