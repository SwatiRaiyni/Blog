
@extends('layouts.front_user.layout')

@section('content')
<x-app-layout>
    <x-slot name="header">
        <a href="#">
            <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
        </a>
    </x-slot>
    <div class="py-12" style="background-color: #F3F4F6; min-height:100vh">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">


        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-5" :errors="$errors" />

        <form method="POST" action="/{{app()->getLocale()}}/changepassuser">
            @csrf



            @if(Session::get('status1'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Hey!</strong> {{Session::get('status1')}}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if(Session::get('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Hey!</strong> {{Session::get('status')}}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <!-- old password-->
            <div>
                <x-label for="password" :value="__('Old Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="oldpassword"  required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4 ">
                <x-label for="password" :value="__('New Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Reset Password') }}
                </x-button>
                <a class="ml-4 p-1 btn btn-danger" href="/{{app()->getLocale()}}/user_dashboard1">
                    {{ __('Cancel') }}
                </a>
            </div>
        </form>

    </div>
</div>
</div>
</div>
</x-app-layout>
@endsection
