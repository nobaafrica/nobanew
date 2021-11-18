$(function () {
    $("#datatable").DataTable({
        dom:"<'row mb-3'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4 search-div text-center'f><'col-sm-12 col-md-4'B>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        order: [[8, 'desc']],
        pageLength: 50,
    })
    $(".search-div").append("<div class='search-box me-2 mb-2 d-inline-block'>"
                        + "<div class='position-relative'>"
                            + "<input id='client-search' type='text' class='form-control' placeholder='Search...'>"
                            + "<i class='bx bx-search-alt search-icon'></i>"
                        + "</div>"
                    + "</div>"
    )
    $('#client-search').on( 'keyup', function () {
        let table = $('#datatable').DataTable();
        table.search( this.value ).draw();
    });
    $(".dataTables_length select").addClass("form-select form-select-sm w-75");
    $(".dataTables_filter").addClass("d-none");
    $(".dataTables_length label").addClass("d-flex align-items-center justify-content-between align-content-center");
    $("#datatable").DataTable(),
        $("#datatable-buttons")
            .DataTable({ lengthChange: !1, buttons: ["copy", "excel", "pdf", "colvis"] })
            .buttons()
            .container()
            .appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)"),
        $(".dataTables_length select").addClass("form-select form-select-sm");
});

