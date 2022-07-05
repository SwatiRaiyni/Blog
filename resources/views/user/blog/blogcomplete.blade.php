@extends('layouts.front_user.layout')
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




        <a href="/{{app()->getLocale()}}/userpost1" ><svg xmlns="http://www.w3.org/2000/svg" style="margin-left:20px" class="h-10 w-10" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z" clip-rule="evenodd" />
          </svg></a>
        @foreach ($data as $data1)
        <div class="m5">
          <div style="height: 300px; overflow:hidden"><img  src="/storage/images/blogimages/{{$data1['user_id_'.app()->getLocale()]}}/{{$data1['Image_'.app()->getLocale()]}}" class="mb-5"style="width:100%;"></div>
          <p class="m-0"><small class="">{{$data1['start_date_'.app()->getLocale()]}}</small></p>
          <p class="m-0"><small class="">{{$data1['name']}} {{__('msg.Posted By')}} </small></p>
          <div class="">
            <h2 class="card-title title" style="font-size:32px"><b>{{$data1['Title_'.app()->getLocale()]}}</b></h2>
            <p class="card-text"> {{$data1['Description_'.app()->getLocale()]}}</p>
          </div>
        </div>
        <br>
        <hr>

        <div class="m5">
        <div class="card-title title d-flex mt-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
          </svg>
          <b> {{$comment->count()}} Comments</b>
        </div>
        <input type="button" class="btnaddnewadd mb-2" value="+ Add Comment" id="addnewadd" onclick="btnaddnewadd()">
        <div class="alert alert-danger print-error-msg" style="display:none">
            <ul></ul>
        </div>
        <div id="formadd" class="forborder mt-20 border">
            <div class=" mt-20 ml-20">
                <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
                <input type="hidden" name="id" value="{{$data1['id']}}" id="id">
                    <label> Name</label>
                    <input type="name" name="name" class="form-control" placeholder="Enter Name" id="name">


                    <label>comment</label>
                    <textarea type="text" name="text" class="form-control" id="text" placeholder="Enter comment here..."></textarea>



            <div class="d-flex">

                <input type="button" value="save"  class="btnsave" onclick="addcomment()">
                <input type="button" value="cancel" class="btn btn-danger btncancel"  onclick="btncancel()">
            </div>
        </div>
    </div>
    @endforeach

    @if(Session::get('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Hey!</strong> {{Session::get('status')}}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if(Session::get('status1'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Hey!</strong> {{Session::get('status1')}}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
        @foreach($comment as $comment1)
        <div  class="forborder mt-20 border">
        <p class="card-text d-flex"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
          </svg> {{$comment1['name']}} </p>
          <p class="m-0"><small>Created at:{{$comment1['created_at']->format("d/m/Y")}}</small></p>
          <h5>{{$comment1['comment']}}</h5>

          <form method="GET" action="/deletecomment/{{$comment1['id']}}">
            @csrf
            <input name="_method" type="hidden" value="DELETE">
            <a role="button" type="submit" class="show_confirm btn btn-danger btndelete" data-toggle="tooltip"
             title='Delete'>Delete</a>
        </form>
        </div>
        <br>

        @endforeach



        </div>


      </div>
    </div>
  </div>
</div>
</div>
</div>
@endsection
