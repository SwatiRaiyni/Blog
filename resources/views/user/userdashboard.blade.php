{{-- @extends('layouts.userlayout')
@section('content')
<div class="font-sans antialiased">
<div class="min-h-screen bg-gray-100">
<header class="bg-white shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </div>
</header>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                  <p> Hello! <b>{{ Auth::user()->name }}</b>  </p>
                   @foreach($data as $li)
                   @if(Auth::user()->id == $li->id)
                 <p>  <b>Currently Login as </b> {{$li->uname}}</p>
                   @endif
                   @endforeach
                   @if(Session::get('status'))
                   <div class="alert alert-success alert-dismissible fade show" role="alert">
                     <strong>Hey!</strong> {{Session::get('status')}}
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                   </div>
                   @endif
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection --}}
@extends('layouts.front_user.layout')
@section('content')
<div class="font-sans antialiased">
<div class="min-h-screen bg-gray-100">
<header class="bg-white shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__('msg.Dashboard')}}
        </h2>
    </div>
</header>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                   {{__('msg.Hello')}}! {{ Auth::user()->name }} You're logged in as Role {{$roles[0]}}!
                   @if(Session::get('status'))
                   <div class="alert alert-success alert-dismissible fade show" role="alert">
                     <strong>Hey!</strong> {{Session::get('status')}}
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                   </div>
                   @endif
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

