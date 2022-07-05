@extends('layouts.backend_user.layout')
@section('content')
<br>
<div class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <p><b>
                    {{__('msg.Edit')}} {{$data['pagename_'.app()->getLocale()]}} </b>
                </p>
            </div>
        </header>
<div class="py-12 ">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                @if(Session::get('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Hey!</strong> {{Session::get('status')}}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <form method="post"  action="/{{app()->getLocale()}}/editcms" encType="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$data['id']}}">
                    <div class="mb-3">
                        <label for="pagename" class="form-label">{{__('msg.Page Name')}}:*</label>
                        <input type="text" id="pagename" name="pagename" value="{{$data['pagename_'.app()->getLocale()]}}" class="form-control" disabled >
                        <span style="color:red">@error('pagename'){{$message}}@enderror</span>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <label for="bannerheader" class="form-label">{{__('msg.Banner Header')}}:*</label>
                            <input type="text" id="bannerheader" name="bannerheader" value="{{$data['Banner_header_'.app()->getLocale()]}}" class="form-control">
                            <span style="color:red">@error('bannerheader'){{$message}}@enderror</span>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="bannerimage" class="form-label">{{__('msg.Banner Image')}}:*</label>
                            <input type="file" name="bannerimage" id="image" class="form-control" >
                            <input type="hidden" name="hidden_image" value="{{$data['Banner_image_'.app()->getLocale()]}} " class="form-control" >
                            <img id="showImage" src="/storage/images/bannerimage/{{$data['Banner_image_'.app()->getLocale()]}}" style=" width:200px; " >

                        </div>
                    </div>
                    <div class="row" >
                        <div class="col-sm-6 mb-3">
                            <label for="leftimage" class="form-label">{{__('msg.Left Block')}}':*</label>
                            <input type="file" name="leftimage" id="image1" class="form-control" >
                            <input type="hidden" name="hidden_image" value="{{$data['LeftBlock_image_'.app()->getLocale()]}} " class="form-control" >
                            <img id="showImage1" src="/storage/images/leftblockimage/{{$data['LeftBlock_image_'.app()->getLocale()]}}"  style=" width:200px; ">

                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="rightcontent" class="form-label">{{__('msg.Right Block')}}':*</label>
                            <textarea  class="ckeditor form-control" name="rightdescription">{{$data['Rightblock_'.app()->getLocale()]}}</textarea>
                            <span style="color:red">@error('rightdescription'){{$message}}@enderror</span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="extracontent" class="form-label">{{__('msg.Extra Block')}}:*</label>
                        <textarea class="ckeditor1 form-control" name="extradescription">{{$data['Extrablock_'.app()->getLocale()]}}</textarea>
                        <span style="color:red">@error('extradescription'){{$message}}@enderror</span>
                    </div>
                    <div class="mb-3 d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary mr-3">{{__('msg.save')}}</button>
                        <a type="button" href="/{{app()->getLocale()}}/cmsmanagement" class="btn btn-danger">{{__('msg.cancel')}}</a>
                    </div>
                    <div class="mb-4"></div>

                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){

 //  $('.ckeditor').ckeditor();

        ClassicEditor
            .create( document.querySelector( '.ckeditor' ) )
            .catch( error => {
                console.error( error );
            } );

            ClassicEditor
            .create( document.querySelector( '.ckeditor1' ) )
            .catch( error => {
                console.error( error );
            } );




    $("#image").change(function(e){
        let reader = new FileReader();
        reader.onload = function(e){
            $("#showImage").attr('src',e.target.result);
        }
        reader.readAsDataURL(e.target.files['0']);
    });
    $("#image1").change(function(e){
        let reader = new FileReader();
        reader.onload = function(e){
            $("#showImage1").attr('src',e.target.result);
        }
        reader.readAsDataURL(e.target.files['0']);
    });


});
</script>
</div>
</div>
@endsection
