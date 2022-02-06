<div>
    <x-slot name="header">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Transfers</h4>

                    <div class="page-title-right">
                        <ol class="m-0 breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Finance</a></li>
                            <li class="breadcrumb-item active">Transfers</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
    </x-slot>
    <div class="mb-3 row">
        <div class="col-xl-4 col-sm-6">
            <div class="mb-2 search-box me-2 d-inline-block">
                <div class="position-relative">
                    <input id='client-search' type="text" class="form-control" placeholder="Search...">
                    <i class="bx bx-search-alt search-icon"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-sm-6">
            <div class="text-sm-end">
                <a href="#" data-bs-target="#new-deposit" data-bs-toggle="modal" class="mb-2 btn btn-primary btn-rounded waves-effect waves-light "><i class="mdi mdi-plus me-1"></i> Add Deposit</a>
            </div>
        </div>
    </div>
    <div class="mb-2 row">
        <div class="col">
            <div class="row">
                <div class="mb-2 col-md-4">
                    <div class="card mini-stats-wid h-100">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-muted fw-medium">Transfers</p>
                                    <h4 class="mb-0">{{$transfers->count()}}</h4>
                                </div>

                                <div class="flex-shrink-0 align-self-center">
                                    <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                        <span class="avatar-title">
                                            <i class="bx bx-copy-alt font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-2 col-md-4">
                    <div class="card mini-stats-wid h-100">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-muted fw-medium">Transfers Value</p>
                                    <h4 class="mb-0">₦{{number_format($transfers->sum('amount'))}}</h4>
                                </div>
                                <div class="flex-shrink-0 align-self-center">
                                    <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                        <span class="avatar-title">
                                            <i class="bx bx-copy-alt font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
    </div>
    <!-- end row -->
    <div class="mb-4 row">
        <div class="col">
            <div class="card h-100">
                <div class="card-body">
                    <div class="flex-wrap d-sm-flex">
                        <h4 class="mb-4 card-title">Transactions</h4>
                    </div>
                    <div class="table-responsive">
                        <table id="datatable" class="table mb-0 text-center align-middle table-nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th class="align-middle">ID</th>
                                    <th class="align-middle">Name</th>
                                    <th class="align-middle">Transfer Date</th>
                                    <th class="align-middle">Amount</th>
                                    <th class="align-middle">Transferred By</th>
                                    <th class="align-middle">Created At</th>
                                    <th class="align-middle">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transfers as $transfer)
                                <tr>
                                    <td><a href="#" class="text-body fw-bold">#{{$loop->iteration}}</a> </td>
                                    <td>{{$transfer->user->firstName ?? "No Name"}} {{$transfer->user->lastName ?? ""}}</td>
                                    <td>
                                        {{\Carbon\Carbon::parse($transfer->updated_at)->format('Y-m-d')}}
                                    </td>
                                    <td>
                                        ₦{{number_format($transfer->amount)}}
                                    </td>
                                    <td>
                                        {{(isset($transfer->admin) ?? $transfer->admin->firstName . ' ' . $transfer->admin->lastName) ?? "No Name"}}
                                    </td>
                                    <td>
                                        {{\Carbon\Carbon::parse($transfer->created_at)->format('Y-m-d')}}
                                    </td>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <a href="{{route('client', $transfer->user->id)}}" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light">
                                            View User
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
<script src="//cdn.quilljs.com/1.3.6/quill.min.js" defer></script>
<script type="module" defer>
    document.addEventListener("DOMContentLoaded", () => {
        $("#select-user").on('change', function (e) {
            let data = $('#select-user').val();
            @this.set('user', data)
        })
        $("#datatable").DataTable({
            dom:"<'row mb-3'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'B>>" +
                    "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            order: [[6, 'desc']],
        });
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
    })
    // $(function () {

    // });
</script>
@endpush
