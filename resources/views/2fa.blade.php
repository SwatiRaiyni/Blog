<x-guest-layout>

    @section('content')
    <div id="blogcms"></div>
    <div id="blogempty">
                    <div class="py-12" style="background-color: #F3F4F6; min-height:100vh">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-center">2FA Verification</h1>

                    <div class="card-body">
                        <form>
                            @csrf

                            <p class="text-center">Please Enter Two Facotor Varification code here... We sent code to email : {{ substr(auth()->user()->email, 0, 5) . '******' . substr(auth()->user()->email,  -2) }}</p>
                            <p class="text-center">If you have not received it!
                            <a class="btn btn-link"  role="button" id="myBtn"  href="{{ route('2fa.resend') }}">Click here</a></p>



                            <div class="form-group row">


                                <div class="col-md-6 " style="margin-left: 290px">
                                    @if ($message = Session::get('success'))
                                    <div class="row">
                                      <div class="col-md-12">
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <strong>{{ $message }}</strong>

                                          </div>
                                      </div>
                                    </div>
                                @endif

                                @if ($message = Session::get('error'))
                                    <div class="row">
                                      <div class="col-md-12">
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>OOPs! {{ $message }}</strong>
                                        </div>

                                      </div>
                                    </div>
                                @endif

                                    <div class="signup-msg"></div>
                                    <input id="code" type="number" maxlength="6" placeholder="Varification code" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code') }}" required autocomplete="code" autofocus>

                                    {{-- @error('code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror --}}
                                </div>
                            </div>




                            <div class="form-group row mb-0 mt-4">
                                <div class="col-md-8 offset-md-8">
                                    <button type="button" id="clickBtn" class="btn btn-primary" style="color: white; background-color:#212529">
                                        Submit
                                    </button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <script>


        $('#myBtn').addClass('d-none');
        setTimeout(function abc(){
            $('#myBtn').removeClass('d-none');
        },(60000 *5));
        $("#myBtn").click(function(){
            $('#myBtn').addClass('d-none');
        });

        $("#clickBtn").on('click', function(){
    var code=document.getElementById("code").value;


   if(code == ''){

    alertMsg =`<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>OOPs!</strong> Please Enter code first for continue! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div> `;
    $('.signup-msg').html(alertMsg);
     }else{
    $.ajax({
       url:'/2fa1',
       type: "post",
       dataType: 'json',
       data:{
        "_token": "{{ csrf_token() }}",
        "code" : code,

        },
        success:function(result){
            console.log(result);
            if(result.data.status == 'expire'){
                $('#myBtn').removeClass('d-none');
                alertMsg =`<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Hey!</strong> ${result.data.msg} <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div> `;
            $('.signup-msg').html(alertMsg);
            var code = $("#code").val('');

            }
           if(result.data.status == 'error'){
             alertMsg =`<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Hey!</strong> ${result.data.msg} <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div> `;
            $('.signup-msg').html(alertMsg);
            var code = $("#code").val('');
            }

            if(result.data == 'no'){
                window.location = "login";
            }
            else if(result.data == 'user'){ //console.log("user");
                window.location = "user_dashboard1";
            }


       }
   });
    }


});



    </script>
    </x-guest-layout>
