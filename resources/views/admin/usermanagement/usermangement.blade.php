@extends('layouts.backend_user.layout')
@section('content')

    <br>

        <div class="py-121 ">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">

                    <div class="search-section1">
                        {{-- <form action="searchuserdata" method="post" id="forreset1"> --}}
                          @csrf
                            <ul class="control-list">
                                <li>
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control w240" id="name_sel" placeholder="Name">
                                </li>
                                <li>
                                    <label>Email</label>
                                    <input type="text" name="email" class="form-control w240" id="email_sel" placeholder="Email">
                                </li>
                                {{-- <li>
                                    <label>Select Role</label>
                                    <select name="rolesel" class="form-select w220 " id="role_sel" aria-label="Default select example">
                                      <option value="">Role</option>
                                      <option value="1">User</option>
                                      <option value="2">Admin</option>
                                    </select>
                                </li> --}}
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
                                        <button type="button" class="search" onclick="search();">Search</button>
                                        <form action="usermangementajaxview">
                                          <button type="submit" class="clear">Clear</button>
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        {{-- </form> --}}
                </div>

            </div>
        </div>
    </div>
</div>
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <a  class="btn btn-primary ms-auto d-block mt-3 me-4" role="button" style="width:max-content; color:white !important;" href="/addnewuser">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>Add New User
                              </a>
                            <div class="p-6 bg-white border-b border-gray-200" >

                {{-- @if(Session::get('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Hey!</strong> {{Session::get('status')}}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                 --}}
                @if(Session::get('status1'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>Hey!</strong> {{Session::get('status1')}}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                    <table class="table table-bordered table-striped " id="mytable11"  >
                        <thead  class="thead-dark">
                          <tr>
                            <th scope="col">Name</th>
                            <th scope="col">DOB</th>
                            <th scope="col">UserType</th>
                            <th scope="col">Role</th>
                            <th scope="col">Email</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody id="bodyData">

                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>


<script type="text/javascript">



    function search(){
      var name_sel = $('#name_sel').val();
      var email_sel = $('#email_sel').val();
      var role_sel = $('#role_sel').val();
      var status_sel = $('#status_sel').val();

      var myTable1 = new DataTable("#mytable11", {
    dom: 't<"table-bottom d-flex justify-content-between"<"table-bottom-inner d-flex"li>p>',
    responsive: false,
    pagingType: "full_numbers",
    retrieve: true,
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
    columnDefs: [{ orderable: false, targets: 6 }],
});


    $.ajax({
    url:'/searchuserdata',
    contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
    type: 'POST',
    dataType:'json',
    data :{
      "_token": "{{ csrf_token() }}",
      "name_sel" : name_sel,
      "email_sel" : email_sel,
     // "role_sel" : role_sel,
      "status_sel" : status_sel,
    },
    success:function(data){
      var count = Object.keys(data).length;
                $('#bodyData').empty();
                myTable1.clear().draw();

                   for(let i=0;i < count; i++){
                  //     let om = data[i].UserType;
                  //     if(om == 1){
                  //       var ii = "User";
                  //   }
                  //   else{
                  //       var ii = "Admin";
                  //   }
                    let omm= data[i].IsApproved;
                    if(omm == 1){
                        var j="Active";
                        var jj = "Completed" ;
                    }else{
                        var j="InActive";
                        var jj="Canceled";
                    }
                    let typenew = data[i].UserType;
                    if(typenew == 1){
                        var term="Front User";
                    }else{
                        var term="Backend User";
                    }
                    var id = "{{Auth::user()->id}}";

                    myTable1.row.add($(
                        ` <tr>
                          <input type="hidden" name="id" value='${data[i].id}'>

                                <td>${data[i].uname}</td>
                                <td>${data[i].DOB} </td>
                                <td>${term}</td>
                                <td>${data[i].display_name}</td>
                                <td>${data[i].email}</td>
                                <td><span class="${jj}">${j}</span></td>
                                <td>
                                      <div class="d-flex">
                                          <a href="/edituser/${data[i].id}" class="me-3"><svg xmlns="http://www.w3.org/2000/svg"   class="h-6 w-6 "  fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                          </svg></a>


                                          ${ id != data[i].id ?
                                         ` <form method="GET" action="/deleteuser/${data[i].id}">
                                            @csrf
                                            <input name="_method" type="hidden" value="DELETE">
                                            <a role="button" type="submit" class="show_confirm" data-toggle="tooltip" title='Delete'>
                                              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 me-3" fill="none" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                              </svg>
                                            </a>
                                          </form>`
                                        : ` ` }

                                      </div>
                                </td>
                              </tr>`)).draw();
                            }

    },
    error:function(err){
      console.error(err);
    }

    });

    }




      $("#mytable11").on("click",".show_confirm",function(){

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
    var myTable = new DataTable("#mytable11", {
    dom: 't<"table-bottom d-flex justify-content-between"<"table-bottom-inner d-flex"li>p>',
    responsive: false,
    pagingType: "full_numbers",
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
    pageLength : 5,
   // lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'All']],
    buttons: ["excel"],
    columnDefs: [{ orderable: false, targets: 6 }],
});

       $.ajax({


                url: "/usermangementajax",
                contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                method: 'GET',
                dataType:'json',
                data : $('#bodyData').serialize(),

                success: function(data){
               //
                  var count = Object.keys(data).length;
                $('#bodyData').empty();
                myTable.clear().draw();

                   for(let i=0;i < count; i++){//console.log(data[i].UserType);
                    //   let om = data[i].UserType;
                    //   if(om == 1){
                    //     var ii = "User";
                    // }
                    // else{
                    //     var ii = "Admin";
                    // }
                    let omm= data[i].IsApproved;
                    if(omm == 1){
                        var j="Active";
                        var jj = "Completed" ;
                    }else{
                        var j="InActive";
                        var jj="Canceled";
                    }
                    let type= data[i].UserType;
                    if(type == 1){
                        var term="Front User";
                    }else{
                        var term="Backend User";
                    }
                    var id = "{{Auth::user()->id}}";

                    myTable.row.add($(
                        ` <tr>
                          <input type="hidden" name="id" value='${data[i].id}'>

                                <td>${data[i].uname}</td>
                                <td>${data[i].DOB} </td>
                                <td>${term}</td>
                                <td>${data[i].display_name}</td>
                                <td>${data[i].email}</td>
                                <td><span class="${jj}">${j}</span></td>
                                <td>
                                      <div class="d-flex">

                                          <a href="/edituser/${data[i].id}" class="me-3"><svg xmlns="http://www.w3.org/2000/svg"   class="h-6 w-6 "  fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                          </svg></a>


                                          ${ id != data[i].id ?
                                        ` <form method="GET" action="/deleteuser/${data[i].id}">
                                            @csrf
                                            <input name="_method" type="hidden" value="DELETE">
                                            <a role="button" type="submit" class="show_confirm" data-toggle="tooltip" title='Delete'>
                                              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 me-3" fill="none" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                              </svg>
                                            </a>
                                          </form>`
                                        : ` ` }

                                      </div>
                                </td>
                              </tr>`)).draw();
                            }
            },
            error:function(err){
                console.error(err);
            }


  });


});
</script>

@endsection



