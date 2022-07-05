let page = 1;
let last_page =1;
var language = window.location.pathname.substring(1,3);
if(language == "hi"){
    language = "hi";
}else{
    console.log(language);
    language = "en";
}

//console.log(language);
function completeblog(id){

    $("#pagination").hide();

    $.ajax({
        url:'/api/'+language+'/viewallblog1/'+id,
        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
        type: 'GET',
        dataType:'json',
        data: '',
        success:function(data){
            console.log(data);

            $("#blogall1111").html(` <a href="#" onclick="getmoreblog(page)"><svg xmlns="http://www.w3.org/2000/svg" style="margin-left:20px" class="h-10 w-10" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z" clip-rule="evenodd" />
          </svg></a>
                    <div class="m5">
                       <div style="height:300px; overflow:hidden"><img  src="/storage/images/blogimages/${data.data[0].user_id}/${data.data[0].Image}" class="mb-5" style="width:100%;"></div>
                       <p class="m-0"><small class="">${data.data[0].start_date}</small></p>
                       <p class="m-0"><small class=""> ${data.data[0].uname} ${data.postedby}</small></p>
                       <div class="">
                         <h2 class="card-title title">${data.data[0].Title}</h2>
                         <p class="card-text"> ${data.data[0].Description}</p>
                       </div>
                    </div><br><hr><div class="m5" id="abc">
                    <div class="card-title title d-flex mt-2" >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                      </svg>
                      <b> ${data.data.length} Comments</b>
                    </div>
            `);

            for(let i=0;i < data.data.length; i++){
                if(data.data[i].comment != null){
                //var date = ;
                const date = new Date(data.data[i].created_at);
                let day = date.getDate();
                let year = date.getFullYear();
                let month = date.getMonth();
                let comdate = day +"-"+ month +"-"+ year;
               // console.log(comdate);

               // console.log(data.data[i].comment);
                $("#blogall1111").html (
                $("#blogall1111").html () +
                  ` <div  class="forborder mt-20 border">
                  <p class="card-text d-flex"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                    </svg>${data.data[i].cname} </p>
                    <p class="m-0"><small>Created at:${comdate}</small></p>
                    <h5>${data.data[i].comment}</h5>


                  </div>
                  <br>`);
                }else{
                    $("#abc").hide();
                    $("#blogall1111").html (
                        $("#blogall1111").html () +
                    `<div class="card-title title d-flex mt-2" id="abc">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                  </svg>
                  <b> 0 Comments</b>
                </div>`);
                }
            }
        }

        });

}

function serchblog(){
    page=1;
    $("#prev").prop("disabled",true);

    var name = $('#name').val();
    $.ajax({
        url:'/api/'+language+'/search',
        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
        type: 'GET',
        dataType:'json',
        data:{
            "_token": "{{ csrf_token() }}",
            "name":name
        },
        success:function(data){
            if(data.data.last_page <= page){
                page = data.data.last_page;
                $("#next").prop("disabled",true);
            }else{
                $("#next").prop("disabled",false);
            }
            $("#pagination").show();

            if(data.data.data.length == 0){
                //alert(data);
                $("#pagination").hide();
                $("#blogall1111").html(`<form action="#" method="get" role="search" >
                <div class="d-flex mb-3"  style="justify-content:center;">
                <input type="text" style="width:200px;" name="search" id="name" class="form-control me-3">
                 <button type="button"  onclick="serchblog()" class="btn btn-primary"><i class="fa fa-search fa-sm"></i></button>
                </div>
            </form> <br><p style="text-align:center; color:red"> No record found </p>`);

            }else{
            $("#blogall1111").html(` <form action="#" method="get" role="search" >
            <div class="d-flex mb-3"  style="justify-content:center;">
            <input type="text" style="width:200px;" placeholder="${data.search}.." name="search" id="name" class="form-control me-3">
             <button type="button"  onclick="serchblog()" class="btn btn-primary"><i class="fa fa-search fa-sm"></i></button>
            </div>
        </form>`);


            for(let i=0;i < data.data.data.length; i++){

                let Description = '';
                if(data.data.data[i].Description.length > 100){
                   Description =  data.data.data[i].Description.substring(0,100) + "...";
                }else{
                    Description =  data.data.data[i].Description;
                }


             $("#blogall1111").html (


                  $("#blogall1111").html () +
                         ` <div class="card flex-row mb-3">
                            <div class="col-2"><img class="card-img-top-middle" src="/storage/images/blogimages/${data.data.data[i].user_id}/${data.data.data[i].Image}" style= "width:200px; height:200px;" alt="Card image cap"></div>
                            <div class="col-9 d-flex flex-column justify-content-between ms-5">
                              <div class="mt-3">
                              <h3 class="card-title title ">${data.data.data[i].Title}</h3>
                              <p class="card-text">  ${Description}</p>

                              </div>

                                <a href="#" onclick="completeblog(${data.data.data[i].id})">${data.readmore} <svg style="display: inline" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg></a>
                                <div class=" d-flex justify-content-between ">
                                <p class="card-text"><small class="text-muted">${data.data.data[i].start_date}</small></p>


                              <p class="card-text "><small class="text-muted"> ${data.data.data[i].uname} ${data.postedby}</small></p>
                            </div>
                            </div>
                          </div>
                         <span>

                         </span>
                         `);
                }}
        }


    });

}



$(document).ready(function(){
    getmoreblog(page);
    $("#prev").prop("disabled",true);
});


$(document).on('click','#prev',function(event){
    //console.log("prev");
    page--;//0
    if(page <= 1){//0<=1
        page=1;
        $("#prev").prop("disabled",true);
    }
    $("#next").prop("disabled",false);
    getmoreblog(page);
});

$(document).on('click','#next',function(event){

    page++;//2
    if(last_page <= page){//3<=2
        page = last_page;
        $("#next").prop("disabled",true);
    }
    getmoreblog(page);
    $("#prev").prop("disabled",false);
});



function getmoreblog(page){
   // url = 'api/'+language +'/userpost?page='+page;
    //console.log(url);
    $.ajax({
        type : 'GET',
        url : '/api/'+language+'/userpost?page='+page,

        success:function(data){
            //console.log(data.data);
            $("#pagination").show();

            last_page = data.data.last_page;//last_page=3;
            if(last_page == 1){
                $("#next").prop("disabled",true);
                $("#prev").prop("disabled",true);
            }
            $("#blogall1111").html(` <form action="#" method="get" role="search" >
            <div class="d-flex mb-3"  style="justify-content:center;">
            <input type="text" style="width:200px;" placeholder="${data.search}.." name="search" id="name" class="form-control me-3">
             <button type="button"  onclick="serchblog()" class="btn btn-primary"><i class="fa fa-search fa-sm"></i></button>
            </div>
        </form>`);

            for(let i=0;i < data.data.data.length; i++){
                let Description = '';
                if(data.data.data[i].Description.length > 100){
                   Description =  data.data.data[i].Description.substring(0,100) + "...";
                }else{
                    Description =  data.data.data[i].Description;
                }


             $("#blogall1111").html (


                  $("#blogall1111").html () +
                         ` <div class="card flex-row mb-3">
                            <div class="col-2"><img class="card-img-top-middle" src="/storage/images/blogimages/${data.data.data[i].user_id}/${data.data.data[i].Image}" style= "width:200px; height:200px;" alt="Card image cap"></div>
                            <div class="col-9 d-flex flex-column justify-content-between ms-5">
                              <div class="mt-3">
                              <h3 class="card-title title ">${data.data.data[i].Title}</h3>
                              <p class="card-text">  ${Description}   </p>

                              </div>

                                <a href="#" onclick="completeblog(${data.data.data[i].id})">${data.readmore} <svg style="display: inline" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg></a>
                                <div class=" d-flex justify-content-between ">
                                <p class="card-text"><small class="text-muted">${data.data.data[i].start_date}</small></p>


                              <p class="card-text "><small class="text-muted"> ${data.data.data[i].uname}  ${data.postedby} </small></p>
                            </div>
                            </div>
                          </div>
                         <span>

                         </span>

                         `);
                      }
            }

    });
}



