$(function () {
    $(".js-basic-example").DataTable();

    $(".js-exportable").DataTable({
        dom: "Bfrtip",
        buttons: ["copy", "csv", "excel", "pdf", "print"],
        order: [[0, 'desc']],
        // ajax: "assets/data/objects.txt",
        //         columns: [
        //             {
        //                 className: "details-control",
        //                 orderable: false,
        //                 data: null,
        //                 defaultContent: "",
        //             },
        //             { data: "name" },
        //             { data: "position" },
        //             { data: "office" },
        //             { data: "salary" },
        //         ],
    });
});
// function format(d) {
//     return (
//         '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
//         "<tr>" +
//         "<td>Full name:</td>" +
//         "<td>" +
//         d.name +
//         "</td>" +
//         "</tr>" +
//         "<tr>" +
//         "<td>Extension number:</td>" +
//         "<td>" +
//         d.extn +
//         "</td>" +
//         "</tr>" +
//         "<tr>" +
//         "<td>Extra info:</td>" +
//         "<td>And any further details here (images etc)...</td>" +
//         "</tr>" +
//         "</table>"
//     );
// }
// $(document).ready(function () {
//     var table = $("#example").DataTable({
//         ajax: "assets/data/objects.txt",
//         columns: [
//             {
//                 className: "details-control",
//                 orderable: false,
//                 data: null,
//                 defaultContent: "",
//             },
//             { data: "name" },
//             { data: "position" },
//             { data: "office" },
//             { data: "salary" },
//         ],
        
//     });
//     $("#example tbody").on("click", "td.details-control", function () {
//         var tr = $(this).closest("tr");
//         var row = table.row(tr);
//         if (row.child.isShown()) {
//             row.child.hide();
//             tr.removeClass("shown");
//         } else {
//             row.child(format(row.data())).show();
//             tr.addClass("shown");
//         }
//     });
// });
// 