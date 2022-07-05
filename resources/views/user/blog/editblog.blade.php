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
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="post" onsubmit="validate()" action="/{{app()->getLocale()}}/editpostuser" encType="multipart/form-data">
                        @csrf
                        <div class="col-sm-6 m-3">
                            <input type="hidden" name="id" value="{{$data['id']}}">

                            <div class="mb-3">

                                <input type="text" class="form-control" name="title" value="{{$data['Title_'.app()->getLocale()]}}">
                            </div>
                            <span style="color:red">@error('title'){{$message}}@enderror</span>


                            <div class="mb-3">
                                <label>{{__('msg.Description')}} </label>
                                <textarea class="form-control" name="description">  {{$data['Description_'.app()->getLocale()]}} </textarea>
                            </div>
                            <span style="color:red">@error('description'){{$message}}@enderror</span>

                            <div class="mb-3">
                                <label>{{__('msg.Images')}} {{__('msg.select')}}</label>
                                <input type="file" name="image" id="image" class="form-control" >
                                <input type="hidden" name="hidden_image" value="{{$data['Image_'.app()->getLocale()]}} " class="form-control" >
                                <img id="showImage" src="/storage/images/blogimages/{{$data['user_id_'.app()->getLocale()]}}/{{$data['Image_'.app()->getLocale()]}}"  width="150px">

                            </div>
                            <span style="color:red">@error('image'){{$message}}@enderror</span>

                            <div class="mb-3">
                                <label>{{__('msg.Start_Date')}} {{__('msg.select')}}</label>
                                <input type="date" name="sdate" value="{{$data['start_date_'.app()->getLocale()]}}" class="form-control" id="date_picker">
                            </div>
                            <span style="color:red" class="s-date">@error('sdate'){{$message}}@enderror</span>

                            <div class="mb-3">
                                <label>{{__('msg.End_Date')}} {{__('msg.select')}}</label>
                                <input type="date" name="edate"  value="{{$data['end_date_'.app()->getLocale()]}}" class="form-control " id="date_picker1">
                            </div>
                            <span style="color:red" class="e-date">@error('edate'){{$message}}@enderror</span>

                            <div class="mb-3">
                                <label>{{__('msg.status')}} {{__('msg.select')}}</label>
                                @if($data['Isactive_'.app()->getLocale()] == 0)
                                <select name="checkactive" class="form-select" aria-label="Default select example">

                                    <option value="1">{{__('msg.Active')}}</option>
                                    <option value="0" selected>{{__('msg.InActive')}}</option>

                                </select>
                                @else
                                <select name="checkactive" class="form-select" aria-label="Default select example">

                                    <option value="1" selected>{{__('msg.Active')}}</option>
                                    <option value="0" >{{__('msg.InActive')}}</option>

                                </select>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary">{{__('msg.save')}}</button>

                                <a type="button" href="/{{app()->getLocale()}}/userpost1" class="btn btn-danger">{{__('msg.cancel')}}</a>

                        </div>
                    </form>
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


</div>
</div>
@endsection

