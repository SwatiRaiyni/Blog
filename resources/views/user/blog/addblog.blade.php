@extends('layouts.front_user.layout')
@section('content')
<div class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{__('msg.Add Blog')}}
                </h2>
            </div>
        </header>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <form method="post" onsubmit="validate()" action="insert"  encType="multipart/form-data">
        @csrf
        <div class="col-sm-6 m-3">
            <div class="mb-3">
                <label>{{__('msg.Title')}}</label>
                <input type="text" class="form-control" name="title" placeholder="{{__('msg.Title')}} {{__('msg.insert')}}">
            </div>
            <span style="color:red">@error('title'){{$message}}@enderror</span>

            <div class="mb-3">
                <label>{{__('msg.Description')}} </label>
                <textarea class="form-control" name="description" placeholder="{{__('msg.Description')}} {{__('msg.insert')}} "></textarea>
            </div>
            <span style="color:red">@error('description'){{$message}}@enderror</span>

            <div class="mb-3">
                <label>{{__('msg.Images')}} {{__('msg.select')}}</label>
                <input type="file" name="image" class="form-control" id="">
            </div>
            <span style="color:red">@error('image'){{$message}}@enderror</span>

            <div class="mb-3">
                <label>{{__('msg.Start_Date')}} {{__('msg.select')}}</label>
                <input type="date" name="sdate" class="form-control" id="date_picker">
            </div>
            <span style="color:red" class="s-date">@error('sdate'){{$message}}@enderror</span>

            <div class="mb-3">
                <label>{{__('msg.End_Date')}} {{__('msg.select')}}</label>
                <input type="date" name="edate" class="form-control " id="date_picker1">
            </div>
            <span style="color:red" class="e-date">@error('edate'){{$message}}@enderror</span>

            <button type="submit" class="btn btn-primary Createvent" >{{__('msg.save')}}</button>
            <a type="button" href="/{{app()->getLocale()}}/userpost1" class="btn btn-danger">{{__('msg.cancel')}}</a>
        </div>
    </form>
</div>
</div>
</div>
</div>
</div>
</div>
<script language="javascript">
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0');
    var yyyy = today.getFullYear();

    today = yyyy + '-' + mm + '-' + dd;
    $('#date_picker').attr('min',today);
    $('#date_picker1').attr('min',today);
</script>
@endsection


