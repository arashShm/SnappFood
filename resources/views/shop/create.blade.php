<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Shop Management
        </h2>
    </x-slot>



    <form action="{{ route('shop.store') }}" method="POST" class="grid grid-cols-3 gap-4 m-1">
        @csrf
        <div class="col-span-1">
            <x-label for="title" value="Resturant's Name: " />
            <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
        </div>

        <div class="">
            <x-label for="first_name" value="Owner's FirstName: " />
            <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required/>
        </div>

        <div class="">
            <x-label for="last_name" value="Owner's LastName: " />
            <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required/>
        </div>

        <div class="">
            <x-label for="telephone" value="Phone Number: " />
            <x-input id="telephone" class="block mt-1 w-full" type="text" name="telephone" :value="old('telephone')" required/>
        </div>

        <div class="col-span-1">
            <x-label for="email" value="Email: " />
            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required/>
        </div>

        <div class="col-start-3 col-end-4 ">
            <x-label for="username" value="UserName: " />
            <x-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required/>
        </div>

        <div class="col-span-3">
            <x-label for="address" value="Address: " />
            <x-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')"/>
        </div>

            <hr class="col-span-3">
            
        <div class=" ">
            <x-button class="ml-4"> Save </x-button>
        </div>

    </form>

   <hr class="my-4"> 



</x-app-layout>
