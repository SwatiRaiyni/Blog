@extends('layouts.front_user.layout')
@section('content')
    <div class="py-12" style="background-color: #F3F4F6; min-height:100vh">
          <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
              <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if(Session::get('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Hey!</strong> {{Session::get('status')}}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @if(Session::get('status1'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Hey!</strong> {{Session::get('status1')}}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @if(Auth::user()->hasPermission('blog-create'))
                <a href="add_post" class="btn btn-primary ms-auto d-block mt-3 me-4 d-flex" role="button" style="width:max-content; color:white!important; " >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>{{__('msg.Add Blog')}}
                </a>
                @endif
                {{-- <p>  <a href="{{action('App\Http\Controllers\userController@index1')}}" style="color: blue">Go To Dashboard </a></p> --}}

                    <div class="p-6 bg-white border-b border-gray-200">
                        <table class="table table-bordered table-striped table-responsive current-services" id="myblog">
                            <thead  class="thead-dark">
                              <tr>

                                <th scope="col"> {{__('msg.Title')}}</th>
                                <th scope="col"> {{__('msg.Description')}}</th>
                                <th scope="col"> {{__('msg.Start_Date')}}</th>
                                <th scope="col"> {{__('msg.End_Date')}}</th>
                                <th scope="col"> {{__('msg.Status')}}</th>
                                <th scope="col"> {{__('msg.Action')}}</th>

                              </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $li)
                              <tr>

                                  <td>{{$li[ 'Title_'.app()->getLocale() ]}}</td>
                                  <td>{{ \Illuminate\Support\Str::limit($li['Description_'.app()->getLocale()],10, $end='...') }}</td>
                                  <td>{{$li['start_date_'.app()->getLocale()]}}</td>
                                  <td>{{$li['end_date_'.app()->getLocale()]}}</td>
                                    @if($li['Isactive_'.app()->getLocale()] == 1)
                                    <td ><span class="Completed">{{__('msg.Active')}}</span></td>
                                    @else
                                    <td ><span class="Canceled">{{__('msg.InActive')}}</span></td>

                                  @endif
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      @if(Auth::user()->hasPermission('blog-update'))
                                      <a href="/{{app()->getLocale()}}/editpostuser/{{$li['id']}}" class="me-3"><svg xmlns="http://www.w3.org/2000/svg"   class="h-6 w-6 "  fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                      </svg></a>
                                      @endif
                                      @if(Auth::user()->hasPermission('blog-delete'))
                                      <form method="GET" action="/{{app()->getLocale()}}/deletepostuser/{{$li['id']}}">
                                        @csrf
                                        <input name="_method" type="hidden" value="DELETE">
                                        <a role="button" type="submit" class="show_confirm" data-toggle="tooltip" title='Delete'>
                                          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 me-3" fill="none" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                          </svg>
                                        </a>
                                      </form>
                                      @endif
                                      @if(Auth::user()->hasPermission('blog-read'))
                                      <a href="/{{app()->getLocale()}}/viewallbloguser/{{$li['id']}}" >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 " fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                      </a>
                                      @endif


                                    </div>
                                  </td>
                              </tr>
                              @endforeach

                            </tbody>
                          </table>
                    </div>
              </div>
          </div>
      </div>


      <script type="text/javascript">

        $('.show_confirm').click(function(event) {
             var form =  $(this).closest("form");
             var name = $(this).data("name");
             event.preventDefault();
             swal({
                 title: `Are you sure you want to delete this record?`,
                 text: "If you delete this, it will be gone forever.",
                 icon: "warning",
                 buttons: true,
                 dangerMode: true,
             })
             .then((willDelete) => {
               if (willDelete) {
                 form.submit();
               }
             });
         });

      </script>



@endsection









