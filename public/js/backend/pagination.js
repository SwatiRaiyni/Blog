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


const dt2 = new DataTable("#mytablecms", {
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

    columnDefs: [{ orderable: false, targets: 1 }],
});

// const { get } = require("lodash");

const dt3 = new DataTable("#myblog", {
    // dom: 't<"table-bottom d-flex justify-content-between"<"table-bottom-inner d-flex"li>p>',
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
    buttons: ["excel"],

    columnDefs: [{ orderable: false, targets: 5 }],
});




