<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    @admin
       <div class="text-green-800 text-2xl flex justify-center my-3 font-semibold">You've Logged in as "ADMIN"</div> 
    @endadmin

    @shop
        <div class="text-blue-600 text-2xl flex justify-center my-3 font-semibold">You've Logged in as "SHOP"</div>
    @endshop

    @user
        <div class="text-rose-600 text-2xl flex justify-center my-3 font-semibold">You've Logged in as "USER"</div>
    @enduser
</x-app-layout>
