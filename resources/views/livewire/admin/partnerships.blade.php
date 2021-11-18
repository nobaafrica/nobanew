<div>
    <x-slot name="header">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Partnerships</h4>

                    <div class="page-title-right">
                        <ol class="m-0 breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route('packages')}}">Admin</a></li>
                            <li class="breadcrumb-item active">Partnerships</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
    </x-slot>
    <x-alert />
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-2 row">
                        <div class="col-sm-4">
                            {{-- <div class="mb-2 search-box me-2 d-inline-block">
                                <div class="position-relative">
                                    <input type="text" class="form-control" placeholder="Search...">
                                    <i class="bx bx-search-alt search-icon"></i>
                                </div>
                            </div> --}}
                        </div>
                        <div class="col-sm-8">
                            <div class="text-sm-end">
                                <a href="{{route('packages')}}" class="mb-2 btn btn-success btn-rounded waves-effect waves-light me-2"><i class="mdi mdi-plus me-1"></i> Add New Partnership</a>
                            </div>
                        </div><!-- end col-->
                    </div>

                    <div class="table-responsive">
                        <table id="datatable" class="table text-center align-middle table-nowrap table-check">
                            <thead class="table-light">
                                <tr>
                                    <th class="align-middle">Agreement</th>
                                    <th class="align-middle">Client</th>
                                    <th class="align-middle">Package Name</th>
                                    <th class="align-middle">Payment Date</th>
                                    <th class="align-middle">Package Unit</th>
                                    <th class="align-middle">Total Commitment</th>
                                    <th class="align-middle">Estimated Payout</th>
                                    <th class="align-middle">Payout Date</th>
                                    <th class="align-middle">View Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($partnerships as $partnership)
                                <tr>
                                    <td>
                                        <a href="{{route('agreement', $partnership)}}" target="_blank" class="btn btn-primary btn-sm btn-rounded">
                                            Agreement
                                        </a>
                                    </td>
                                    <td><a href="{{route('package',$partnership->package)}}" class="text-body fw-bold">{{$partnership->user->firstName ?? " "}} {{$partnership->user->lastName ?? " "}}</a> </td>
                                    <td><a href="{{route('package',$partnership->package)}}" class="text-body fw-bold">{{$partnership->package_name}}</a> </td>
                                    <td>
                                       {{\Carbon\Carbon::parse($partnership->created_at)->format('d F, Y')}}
                                    </td>
                                    <td>
                                        {{$partnership->commodityUnit}}
                                    </td>
                                    <td>
                                        ₦{{number_format($partnership->amount)}}
                                    </td>
                                    <td>
                                        ₦{{number_format($partnership->estimatedPayout)}} {{$partnership->isRedeemed == 1 ? "(Paid Out)" : ""}}
                                    </td>
                                    <td>
                                        {{\Carbon\Carbon::parse($partnership->payoutDate)->format('d F, Y')}}
                                     </td>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <a href="{{$partnership->isRedeemed == 1 ? route('agreement', $partnership) : ( Auth::user()->isAdmin ? route('admin-partnership', $partnership) : route('partnership', $partnership) )}}" class="btn btn-primary btn-sm btn-rounded">
                                            View Details
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
</div>

@push('scripts')
<script src="{{ asset ('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}" defer></script>
<script src="{{ asset ('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}" defer></script>

<script src="{{ asset ('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}" defer></script>
<script src="{{ asset ('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}" defer></script>
<script src="{{ asset ('assets/libs/jszip/jszip.min.js') }}" defer></script>
<script src="{{ asset ('assets/libs/pdfmake/build/pdfmake.min.js') }}" defer></script>
<script src="{{ asset ('assets/libs/pdfmake/build/vfs_fonts.js') }}" defer></script>
<script src="{{ asset ('assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}" defer></script>
<script src="{{ asset ('assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}" defer></script>
<script src="{{ asset ('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}" defer></script>
<script type="module" defer>
    $(function () {
        $("#datatable").DataTable({
            dom:"<'row mb-3'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4 search-div text-center'f><'col-sm-12 col-md-4'B>>" +
                    "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            order: [[7, 'desc']],
            pageLength: 50,
        });
        $(".search-div").append("<div class='mb-2 search-box me-2 d-inline-block'>"
                            + "<div class='position-relative'>"
                                + "<input id='client-search' type='text' class='form-control' placeholder='Search...'>"
                                + "<i class='bx bx-search-alt search-icon'></i>"
                            + "</div>"
                        + "</div>"
        );
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
</script>
@endpush
