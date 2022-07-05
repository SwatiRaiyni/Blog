<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <!-- Styles --> --}}
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

    </head>
    <body>
        @include('welcome')

<div id="blogcms">
    <div class="py-12" id="blogall" style="background-color: #F3F4F6; min-height:100vh">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">



                    <div id="blogall1111">
                                    <form action="#"  method="get" role="search" >
                                        <div class="d-flex mb-3"  style="justify-content:center;">
                                        <input type="text" style="width:200px;" placeholder="{{__('msg.search')}}.." id="name" name="search" class="form-control me-3">
                                         <button type="button" onclick="serchblog()" class="btn btn-primary"><i class="fa fa-search fa-sm"></i></button>
                                        </div>
                                    </form>
                                    @foreach ($data as $li )
                                    <div class="card flex-row mb-3">
                                        <div class="col-2"><img class="card-img-top-middle" src="/storage/images/blogimages/{{$li['user_id_'.app()->getLocale()]}}/{{$li['Image_'.app()->getLocale()]}}" style= "width:200px; height:200px;" alt="Card image cap"></div>
                                        <div class="col-9 d-flex flex-column justify-content-between ms-5">
                                          <div class="mt-3">
                                          <h3 class="card-title title ">{{$li['Title_'.app()->getLocale()]}}</h3>

                                          <p class="card-text"> {{ \Illuminate\Support\Str::limit($li['Description_'.app()->getLocale()],100, $end='...') }}</p>
                                          </div>

                                            <a href="#"  onclick="completeblog({{$li['id']}})">{{__('msg.Read more')}} <svg style="display: inline" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                              <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                            </svg></a>
                                            <div class=" d-flex justify-content-between ">
                                            <p class="card-text"><small class="text-muted">{{$li['start_date_'.app()->getLocale()]}}</small></p>


                                          <p class="card-text "><small class="text-muted"> {{$li['name']}} {{__('msg.posted by')}}</small></p>
                                        </div>
                                        </div>
                                      </div>
                                    @endforeach

                                    </div>

                                    <div id="pagination">
                                    <button type="button" id="prev" class="prev1 btn btn-light"><< {{__('msg.prev')}}</button>
                                    <button type="button" id="next" class="prev1 btn btn-light">{{__('msg.next')}} >></button>
                                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

{{-- </x-guest-layout> --}}
@include('footer')
    </body>
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script src="/js/front.js"></script>
    <script src="/js/api.js" ></script>

</html>



