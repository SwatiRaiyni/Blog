@extends('layouts.backend_user.layout')
@section('content')


<br>

<div class="py-121 ">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">

            <div class="search-section1">


                    <ul class="control-list">
                        <li>
                            <label>Name</label>
                            <input type="text" name="name" class="form-control w240" id="name_sel" placeholder="Name">
                        </li>
                        <li>
                            <label>Email</label>
                            <input type="text" name="email" class="form-control w240" id="email_sel" placeholder="Email">
                        </li>

                        <li>
                            <label>UserType</label>
                            <select name="type" id="type_sel" required  class="form-select w140" aria-label="Default select example">
                                <option value="">UserType</option>
                                <option value="1">Front User</option>
                                <option value="2">Backend User</option>
                            </select>
                        </li>

                        <li>
                            <label>Role</label>
                            <select name="roles" id="role_sel" required  class="form-select w120" aria-label="Default select example">
                                <option value="">Role</option>
                            @foreach($data1 as $data)
                                <option  value={!! $data->display_name !!}>
                                    {{$data->display_name}}
                                </option>
                            @endforeach
                            </select>
                        </li>
                        <li>
                            <label>Select Status</label>
                            <select name="statussel" class="form-select w120" id="status_sel" aria-label="Default select example">
                                <option value="">Status</option>
                                <option value="1">Active</option>
                                <option value="0">InActive</option>
                            </select>
                        </li>
                        <li>
                            <div class="buttons">
                                <button type="button" class="search" id="search" >Search</button>
                                {{-- <form action="/usermangementajaxviewserverside"> --}}
                                  <button type="button" class="clear" id="clear">Clear</button>
                                {{-- </form> --}}
                            </div>
                        </li>
                    </ul>

        </div>

    </div>
</div>
</div>
</div>

              <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                            <a  class="btn bg-info ms-auto d-block mt-3 me-4" role="button" style="width:max-content; color:white !important;" href="/{{app()->getLocale()}}/addnewuser">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>Add New User
                              </a>
                              {{-- <a  class="btn bg-warning ms-auto d-block mt-3 me-4" role="button" style="width:max-content; color:white !important;" href="/addnewuser">
                                Export
                              </a> --}}

                            <div class="p-6 bg-white border-b border-gray-200">


                @if(Session::get('status1'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>Hey!</strong> {{Session::get('status1')}}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                    <table class="table table-bordered table-striped" id="servertable"  width="100%" >
                        <thead  class="thead-dark">
                          <tr>
                            <th scope="col">Name</th>
                            <th scope="col">DOB</th>
                            <th scope="col"> UserType </th>
                            <th scope="col">Role</th>
                            <th scope="col">Email</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>


<script type="text/javascript">

$("#servertable").on("click",".show_confirm",function(){

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


$(document).ready(function() {
    search();
    var language = window.location.pathname.substring(1,3);
    function search(name_sel='',email_sel='',role_sel='',status_sel='',type_sel = ''){
        var name_sel = $('#name_sel').val();
        var email_sel = $('#email_sel').val();
        var type_sel = $("#type_sel").val();
        var role_sel = $('#role_sel').val();
        var status_sel = $('#status_sel').val();
    var table1=  $('#servertable').DataTable({
       "pageLength" : -1,
        "processing": true,
        "serverSide": true,
        //"deferRender": true,
        //"retrieve": true,
        //'searching':true,
      //  dom: 't<"table-bottom d-flex justify-content-between"<"table-bottom-inner d-flex"li>p>',
        //"paging": false,
        ajax: {
            url: "/"+language+"/usermangementajaxviewserverside",
           // type: "POST",
            //dataType: "JSON",
            data :{
                _token : "{{ csrf_token() }}",
                name_sel: name_sel,
                email_sel : email_sel,
                role_sel : role_sel,
                status_sel : status_sel,
                type_sel : type_sel,
            },
        },
        language: {
        paginate: {
        first: "<img src='/images/pagination-first.png' alt='first'/>",
        previous: "<img src='/images/pagination-left.png' alt='previous' />",
        next: '<img src="/images/pagination-left.png" alt="next" style="transform: rotate(180deg)" />',
        last: "<img src='/images/pagination-first.png' alt='first' style='transform: rotate(180deg) ' />",
        },
       info: "Total Record: _MAX_",
    lengthMenu: "Show_MENU_Entries",
    },
    buttons: ["excel"],

   lengthMenu: [[5, 10, 20, -1], [5, 10, 20, "All"]],
    columnDefs: [{ orderable: false, targets: 6 }],
    columns: [
        { data: "uname",name:'uname' },
        { data: "DOB",name:'DOB' },
        { data: "UserType",name:'UserType', render: function(data) {
            if (data === 1) {
                status="Front User";
            }
            else if (data == 2) {
                status= "Backend User";
            }
            return '<span>' + status + '</span>';
        }
        },
        {data: "display_name" , name:'display_name'},
        {data:"email",name:'email'},
        {data:"IsApproved",name:'IsApproved', render: function(data) {
            if (data === 1) {
                status="Active";
                class1 = "Completed";
            }
            else if (data == 0) {
                status= "InActive";
                class1 = "Canceled";
            }
            return '<span class="' + class1 + '">' + status + '</span>';
        }
        },
        {data:"id",name:'id',render: function(data) {
                    var id = "{{Auth::user()->id}}";
                    var data =   `<div class="d-flex">

                    <a href="/${language}/edituser/${data}" class="me-3"><svg xmlns="http://www.w3.org/2000/svg"   class="h-6 w-6 "  fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg></a>

                    ${ id != data ?
                    ` <form method="GET" action="/${language}/deleteuser/${data}">
                    @csrf
                    <input name="_method" type="hidden" value="DELETE">
                    <a role="button" type="submit" class="show_confirm" data-toggle="tooltip" title='Delete'>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 me-3" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    </a>
                    </form>`
                    : ` ` }
                    </div>`;
                    return data;
                }
        }

        ],
    });

    }//complete search function

    $("#search").on("click",function(){
        var name_sel = $('#name_sel').val();
        var email_sel = $('#email_sel').val();
        var role_sel = $('#role_sel').val();
        var status_sel = $('#status_sel').val();
        var type_sel = $('#type_sel').val();
        $("#servertable").DataTable().destroy();
        search(name_sel,email_sel,role_sel,status_sel);
    });//complete search onclick
    $("#clear").on("click",function(){
        $('#name_sel').val('');
        $('#email_sel').val('');
        $('#role_sel').val('');
        $('#status_sel').val('');
        $('#type_sel').val('');
        $("#servertable").DataTable().destroy();
        search();
    });//complete clear onclick
});

</script>

@endsection



