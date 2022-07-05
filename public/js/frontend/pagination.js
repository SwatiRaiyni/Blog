// const { get } = require("lodash");
var language = window.location.pathname.substring(1,3);
//console.log(language);

if(language == "hi"){
    language = "hi";
}else{
    language = "en-GB";
}
//console.log(language);
const dt1 = new DataTable("#mytable1", {
    // dom: 't<"table-bottom d-flex justify-content-between"<"table-bottom-inner d-flex"li>p>',
    responsive: false,
    pagingType: "full_numbers",

    language: {
        url: '//cdn.datatables.net/plug-ins/1.12.0/i18n/'+language+'.json',
        //cdn.datatables.net/plug-ins/1.12.0/i18n/en-GB.json

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

    columnDefs: [{ orderable: false, targets: 5 }],
});
// $(document).ready(function(){
// document.getElementById("formadd").style.display="none";
// document.getElementById("addnewadd").style.display="block";
// });
$("#formadd").hide();
$("#addnewadd").show();
function btnaddnewadd(){
    document.getElementById("addnewadd").style.display="none";
    document.getElementById("formadd").style.display="block";
  }
  function btncancel(){
    document.getElementById("formadd").style.display="none";
    document.getElementById("addnewadd").style.display="block";
  }


  $('.show_confirm').click(function(event) {
    var form =  $(this).closest("form");
    var name = $(this).data("name");
    event.preventDefault();
    swal({
        title: `Are you sure you want to delete this comment?`,
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

function addcomment(){
 var name = document.getElementById("name").value;//alert(name);
 var text = document.getElementById("text").value;
 var id = document.getElementById("id").value;
 $.ajax({
    url:'/addcomment',
    contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
    type: 'POST',
    dataType:'json',
    data: {
        "_token": $('#csrf-token')[0].content,
        "name" : name,
        "text" : text,
        "id" :id
    },
    success:function(data){
        //console.log(data);
        if($.isEmptyObject(data.error)){
            document.getElementById("formadd").style.display="none";
            document.getElementById("addnewadd").style.display="block";
            $("#name").val('');//alert(name);
            $("#text").val('');
            window.location = id;
        }
        else{
            printErrorMsg(data.error);
            //window.location = id;
        }

    }

});
}
function printErrorMsg (msg) {
    $(".print-error-msg").find("ul").html('');
    $(".print-error-msg").css('display','block');
    $.each( msg, function( key, value ) {
        $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
    });
}
const dt3 = new DataTable("#myblog", {
    // dom: 't<"table-bottom d-flex justify-content-between"<"table-bottom-inner d-flex"li>p>',
    responsive: false,
    pagingType: "full_numbers",
    language: {
        url: '//cdn.datatables.net/plug-ins/1.12.0/i18n/'+language+'.json',
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

    columnDefs: [{ orderable: false, targets: 5 }],
});

