@extends('layouts.backend_user.layout')
@section('content')
<br>
<div class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h3><b>
                    {{__('msg.CMS Page list')}}</b>
                </h3>
            </div>
        </header>
<div class="py-12 ">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">

                @if(Session::get('status1'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>Hey!</strong> {{Session::get('status1')}}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif


                <table class="table table-bordered table-striped table-responsive current-services" id="mytablecms">
                  <thead  class="thead-dark">
                    <tr>
                        <th scope="col"><b>{{__('msg.Page Name')}}</b></th>
                        <th scope="col"><b>{{__('msg.Action')}}</b></th>
                    </tr>
                  </thead>
                    <tbody>
                        @foreach($data as $li)
                    <tr>
                        <td>{{$li['pagename_'.app()->getLocale()]}}</td>
                        <td>
                            <a href="/{{app()->getLocale()}}/editcms/{{$li['id']}}" class="me-3"><svg xmlns="http://www.w3.org/2000/svg"   class="h-6 w-6 "  fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                              </svg></a>
                        </td>
                    </tr>
                        @endforeach
                    </tbody>
                </table>


            </div>
        </div>
    </div>
</div>

    </div>
</div>
@endsection
