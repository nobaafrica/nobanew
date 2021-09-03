<div>
    <x-slot name="header">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Partnerships</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
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
                    {{-- <div class="row mb-2">
                        
                        <div class="col-sm-8">
                            <div class="text-sm-end buttons">
                                
                            </div>
                        </div><!-- end col-->
                    </div> --}}

                    <div class="table-responsive">
                        <table id="datatable" class="table align-middle table-nowrap table-check text-center">
                            <thead class="table-light">
                                <tr>
                                    <th class="align-middle">#ID</th>
                                    <th class="align-middle">First Name</th>
                                    <th class="align-middle">Last Name</th>
                                    <th class="align-middle">Email</th>
                                    <th class="align-middle">Phone Number</th>
                                    <th class="align-middle">Address</th>
                                    <th class="align-middle">Birthday</th>
                                    <th class="align-middle">Partnerships</th>
                                    <th class="align-middle">Total Commitment</th>
                                    <th class="align-middle">Expected Payout</th>
                                    <th class="align-middle">Total Payout</th>
                                    <th class="align-middle">View Partnerships</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clients as $client)
                                <tr>
                                    <td><a href="#" class="text-body fw-bold">{{$loop->iteration}}</a></td>
                                    <td>{{$client->firstName ?? " "}}</td>
                                    <td>{{$client->lastName ?? " "}}</td>
                                    <td>{{$client->email}}</td>
                                    <td>
                                        {{$client->phoneNumber}}
                                    </td>
                                    <td>
                                        {{$client->address}}
                                    </td>
                                    <td>
                                        {{$client->birthday}}
                                    </td>
                                    <td>
                                        {{number_format($client->partnerships->count())}}
                                     </td>
                                    <td>
                                        ₦{{number_format($client->partnerships->sum('amount'))}}
                                    </td>
                                    <td>
                                        ₦{{number_format($client->partnerships->where('isRedeemed', 0)->sum('estimatedPayout'))}}
                                    </td>
                                    <td>
                                        ₦{{number_format($client->partnerships->where('isRedeemed', 1)->sum('estimatedPayout'))}}
                                    </td>
                                    <td>
                                        <a href="{{route('client', $client)}}" class="btn btn-primary btn-sm btn-rounded">View Partnerships</a>
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
<script src="{{ asset ('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}" defer></script>
<script src="{{ asset ('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}" defer></script>
<script src="{{ asset ('assets/libs/pdfmake/build/pdfmake.min.js') }}" defer></script>
<script src="{{ asset ('assets/libs/pdfmake/build/vfs_fonts.js' ) }}" defer></script>
<script src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.11.0/b-2.0.0/b-html5-2.0.0/b-print-2.0.0/datatables.min.js" defer></script>
<script type="module" defer>
    $(function () {
        let table = $("#datatable").DataTable({
            dom: "<'row mb-3'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4 search-div text-center'f><'col-sm-12 col-md-4'B>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons: {
                buttons : [
                    {extend: 'csv', className: 'btn btn-primary btn-sm'},
                    {extend: 'excel', className: 'btn btn-primary btn-sm'},
                    {extend: 'pdf', className: 'btn btn-primary btn-sm'},
                    {extend: 'print', className: 'btn btn-primary btn-sm'},
                ],
            }
        });
        $(".search-div").append("<div class='search-box me-2 mb-2 d-inline-block'>"
                        + "<div class='position-relative'>"
                            + "<input id='client-search' type='text' class='form-control' placeholder='Search...'>"
                            + "<i class='bx bx-search-alt search-icon'></i>"
                        + "</div>"
                    + "</div>"
        );
        $('#client-search').on( 'keyup', function () {
            table.search( this.value ).draw();
        });
        $(".dataTables_length select").addClass("form-select form-select-sm w-75");
        $(".dataTables_filter").addClass("d-none");
        $(".dataTables_length label").addClass("d-flex align-items-center justify-content-between align-content-center");
        $(".dt-buttons").addClass("d-flex align-items-center justify-content-between align-content-center");
        $(".dt-button").addClass("btn-md");
        $(".dataTables_paginate").addClass("pagination");
        $(".paginate_button").addClass("page-item");
    });
</script>
@endpush