@extends('layouts.backend_user.layout')
@section('content')
<div class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{__('msg.Hello')}} {{Auth::user()->name}} {{__('msg.This is Your complete Blog')}}
                </h2>
            </div>
        </header>
    <div class="py-12" style="background-color: #F3F4F6; min-height:100vh">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 bg-white border-b border-gray-200">
        <a href="/{{app()->getLocale()}}/user_blog" ><svg xmlns="http://www.w3.org/2000/svg" style="margin-left:20px" class="h-10 w-10" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z" clip-rule="evenodd" />
          </svg></a>
          @foreach ($data as $data1)
        <div class="m5">
          <div style="height: 300px; overflow:hidden"><img  src="/storage/images/blogimages/{{$data1['user_id_'.app()->getLocale()]}}/{{$data1['Image_'.app()->getLocale()]}}" class="mb-5"style="width:100%;"></div>
          <p class="m-0"><small class="">{{$data1['start_date_'.app()->getLocale()]}}</small></p>
          <p class="m-0"><small class=""> {{$data1['name']}} {{__('msg.Posted By')}}</small></p>
          <div class="">
            <h2 class="card-title title">{{$data1['Title_'.app()->getLocale()]}}</h2>
            <p class="card-text"> {{$data1['Description_'.app()->getLocale()]}}</p>
          </div>
        </div>
        @endforeach
        <br>
        <hr>
        <b> {{$comment->count()}} Comments</b>
        @foreach($comment as $comment1)
        <div  class="forborder mt-20 border">
        <p class="card-text d-flex"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
          </svg> {{$comment1['name']}} </p>
          <p class="m-0"><small>Created at:{{$comment1['created_at']->format("d/m/Y")}}</small></p>
          <h5>{{$comment1['comment']}}</h5>


        </div>
        <br>

        @endforeach


      </div>
    </div>
  </div>
</div>
</div>
</div>
@endsection
