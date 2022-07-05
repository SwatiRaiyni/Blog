@extends('layouts.front_user.layout')
@section('content')
<x-app-layout>
    <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Hello ! {{ Auth::user()->name }} Edit Your Profile Here...
            </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">


    <x-auth-card>
        <x-slot name="logo">

            <a href="#">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>

        </x-slot>
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="/{{app()->getLocale()}}/editprofile"  encType="multipart/form-data">

        @csrf
        <input type="hidden" name="id" value="{{$data['id']}}">
        <input type="hidden" name="user" value="{{$data['UserType']}}">
        <!-- Name -->
        <div>
            <x-label for="firstname" :value="__('FirstName')" />
            <x-input id="firstname" class="block mt-1 w-full" type="text" name="firstname" value="{{$dataname[0]}}" required autofocus />
        </div>

        <div class="mt-4">
            <x-label for="lastname" :value="__('LastName')" />
            <x-input id="LastName" class="block mt-1 w-full" type="text" name="lastname" value="{{$dataname[1]}}" required autofocus />
        </div>

        <!-- DOB -->
        <div class="mt-4">
            <x-label for="dob" :value="__('DoB')" />
            <x-input id="dob" class="block mt-1 w-full" type="date" name="dob" value="{{$data['DOB']}}" required />
        </div>

        <!--profile picture -->
        <div class="mt-4">
            <label>Select Profile</label>

            <input type="file" name="image" id="image" class=" block mt-1 w-full form-control" >
            <input type="hidden" name="hidden_image" value="{{$data["Profile"]}}" class="form-control" >
            <img id="showImage" src="/storage/images/userprofile/{{$data['Profile']}}"  width="100px" height="100px">
        </div>

        <!-- Email Address -->
        {{-- <div class="mt-4">
            <x-label for="email" :value="__('Email')" />
            <x-input id="email" class="block mt-1 w-full" type="email" name="email"  value="{{$data['email']}}" id="dis"  />
        </div>

        <script>
            $("#dis").prop('disabled', true);
        </script> --}}




        <div class="flex items-center justify-end mt-4">

            <x-button class="ml-4">
                {{ __('Save') }}
            </x-button>

    </form>


     <a class="ml-4 btn btn-danger" href="/{{app()->getLocale()}}/user_dashboard1">
         {{ __('Cancel') }}
     </a>



</x-auth-card>
 </div>
</div>
</div>
</div>
<script>
     $(document).ready(function(){
        $("#image").change(function(e){
            let reader = new FileReader();
            reader.onload = function(e){
                $("#showImage").attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
</x-app-layout>
@endsection

