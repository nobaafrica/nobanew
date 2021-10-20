<div>
    <x-slot name="header">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Admins</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin-dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Admins</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
    </x-slot> 
    <x-alert />
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    <div class="row">
        <div class="row mb-2">
            <div class="col-sm-4">
                {{-- <div class="search-box me-2 mb-2 d-inline-block">
                    <div class="position-relative">
                        <input type="text" class="form-control" placeholder="Search...">
                        <i class="bx bx-search-alt search-icon"></i>
                    </div>
                </div> --}}
            </div>
            <div class="col-sm-8">
                <div class="text-sm-end">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#new-admin" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"><i class="mdi mdi-plus me-1"></i> Create Admin</a>
                </div>
            </div><!-- end col-->
        </div>
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
    {{-- Modal --}}
    <div class="modal fade" id="new-admin" wire:ignore.self tabindex="-1" aria-labelledby="newAdminModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <div class="avatar-md mx-auto mb-4">
                            <div class="avatar-title bg-light rounded-circle text-primary h1">
                                <i class="mdi mdi-shield-account"></i>
                            </div>
                        </div>
    
                        <div class="row justify-content-center">
                            <form wire:submit.prevent='createAdmin' class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="first-name">First Name</label>
                                            <input type="text" wire:model='firstName' class="form-control" id="first-name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="last-name">Last name</label>
                                            <input type="text" wire:model='lastName' class="form-control" id="last-name">
                                        </div>
                                    </div>
                                </div>
            
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="basicpill-phoneno-input">Phone</label>
                                            <input type="text" wire:model='phoneNumber' class="form-control" id="basicpill-phoneno-input">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="basicpill-email-input">Email</label>
                                            <input type="email" wire:model='email' class="form-control" id="basicpill-email-input">
                                        </div>
                                    </div>
                                </div>
    
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="password">Password</label>
                                            <input type="password" wire:model='password' class="form-control" id="password">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="password_confirmation">Confirm Password</label>
                                            <input type="password" wire:model='password_confirmation' class="form-control" id="password_confirmation">
                                        </div>
                                    </div>
                                </div>
    
                                <div class="text-center">
                                    <button class="btn btn-primary btn-lg">Create Profile</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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