<div>
    <x-slot name="header">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Withdrawal Requests</h4>

                    <div class="page-title-right">
                        <ol class="m-0 breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Finance</a></li>
                            <li class="breadcrumb-item active">Withdrawal Requests</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
    </x-slot>
    <x-alert />
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
        </div>
    </div>
    <div class="mb-2 row">
        <div class="col">
            <div class="row">
                <div class="mb-2 col-md-3">
                    <div class="card mini-stats-wid h-100">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-muted fw-medium">Withdrawal Requests</p>
                                    <h4 class="mb-0">{{$withdrawalRequests->count()}}</h4>
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
                <div class="mb-2 col-md-3">
                    <div class="card mini-stats-wid h-100">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-muted fw-medium">Declined Withdrawal Requests</p>
                                    <h4 class="mb-0">{{$declinedRequests->count()}}</h4>
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
                <div class="mb-2 col-md-3">
                    <div class="card mini-stats-wid h-100">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-muted fw-medium">Approved Requests</p>
                                    <h4 class="mb-0">{{$approvedRequests->count()}}</h4>
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
                <div class="mb-2 col-md-3">
                    <div class="card mini-stats-wid h-100">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-muted fw-medium">Deposit Value</p>
                                    <h4 class="mb-0">₦{{number_format($withdrawalRequests->sum('amount'))}}</h4>
                                </div>
                                {{-- {{dd($users)}} --}}
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
                        <h4 class="mb-4 card-title">Withdrawal Requests</h4>
                    </div>
                    <div class="table-responsive">
                        <table id="datatable" class="table mb-0 text-center align-middle table-nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th class="align-middle">ID</th>
                                    <th class="align-middle">User</th>
                                    <th class="align-middle">Bank</th>
                                    <th class="align-middle">Account Number</th>
                                    <th class="align-middle">Amount</th>
                                    <th class="align-middle">Requested</th>
                                    <th class="align-middle">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($withdrawalRequests as $withdrawal)
                                <tr>
                                    <td><a href="#" class="text-body fw-bold">#{{$loop->iteration}}</a> </td>
                                    <td>{{$withdrawal->user->firstName?? "No Name"}} {{$withdrawal->user->lastName?? ""}}</td>
                                    <td>{{ $withdrawal->bank->bank}}</td>
                                    <td>{{ $withdrawal->bank->nuban}}</td>
                                    <td>
                                        ₦{{number_format($withdrawal->amount)}}
                                    </td>
                                    <td>
                                        {{\Carbon\Carbon::parse($withdrawal->created_at)->format('Y-m-d')}}
                                    </td>
                                    <td>
                                        <div class="dropdown d-inline-block">
                                            <button type="button" class="btn btn-transparent header-item waves-effect" id="withdrawal-action" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded font-size-24"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="withdrawal-action">
                                                <button wire:click='approve({{$withdrawal->id}})' class="text-center dropdown-item btn rounded-0 bg-primary border-primary">Pay</button>
                                                <div class="dropdown-divider"></div>
                                                <button wire:click='decline({{$withdrawal->id}})' class="text-center dropdown-item btn rounded-0 bg-danger border-danger">Decline</button>
                                            </div>
                                        </div>
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
@push('styles')
<link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">
@endpush

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
            pageLength: 100,
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
