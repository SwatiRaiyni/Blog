$(document).ready(function(){
    $("#disabledbtn").submit(function () {
     $("#login").prop("disabled", true);
   $(this).trigger("click");
 });

 $("#disabledbtnadmin").submit(function () {
    $("#loginadmin").prop("disabled", true);
  $(this).trigger("click");
});
});
var language = window.location.pathname.substring(1,3);
function cms(slug){

    $("#blogall").hide();
    $.ajax({
        type : 'GET',
        url : '/api/'+ language+'/cms/'+slug,

        success:function(data){
           // console.log(data.data[0].id);
            $("#pagination").hide();
            $("#blogempty").hide();
            $("#blogcms").html (

                         ` <div style="min-height: 1100px !important;">

                         <img src="/storage/images/bannerimage/${data.data[0].Banner_image}" id="responsive" >
                          <h2 class="title-main1">${data.data[0].Banner_header }</h2>
                          <div class="underline-design ">
                             <div class="line "></div>
                             <img src="/images/faq-star.png" alt=" ">
                             <div class="line "></div>
                          </div>
                          <br><br>
                          <div class="container">
                             <div class="row">
                                 <div class="col-sm-6"> <img src="/storage/images/leftblockimage/${data.data[0].LeftBlock_image}" style="width:1600px"  ></div>
                                 <div class="col-sm-6">${ data.data[0].Rightblock }</div>
                             </div>
                         </div>

                         <div class="container mt-4">
                             ${ data.data[0].Extrablock }
                         </div>
                </div>
            `);
        }

    });

}

