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
                                    <th class="align-middle">Full Name</th>
                                    <th class="align-middle">Email</th>
                                    <th class="align-middle">Phone Number</th>
                                    <th class="align-middle">Partnerships</th>
                                    <th class="align-middle">Wallet Balance</th>
                                    <th class="align-middle">Total Commitment</th>
                                    <th class="align-middle">Expected Payout</th>
                                    <th class="align-middle">Total Payout</th>
                                    <th class="align-middle">Joined On</th>
                                    <th class="align-middle">View</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clients as $client)
                                <tr>
                                    <td><a href="#" class="text-body fw-bold">{{$loop->iteration}}</a></td>
                                    <td>{{$client->firstName ?? " "}} {{$client->lastName ?? " "}}</td>
                                    <td>{{$client->email}}</td>
                                    <td>
                                        {{$client->phoneNumber}}
                                    </td>
                                    <td>
                                        {{number_format($client->partnerships->count())}}
                                    </td>
                                    <td>
                                        ₦{{number_format($client->wallet->accountBalance)}}
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
                                        {{\Carbon\Carbon::parse($client->created_at)->format('Y-m-d')}}
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

<script src="{{ asset ('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}" defer></script>
<script src="{{ asset ('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}" defer></script>
<script src="{{ asset ('assets/libs/jszip/jszip.min.js') }}" defer></script>
<script src="{{ asset ('assets/libs/pdfmake/build/pdfmake.min.js') }}" defer></script>
<script src="{{ asset ('assets/libs/pdfmake/build/vfs_fonts.js') }}" defer></script>
<script src="{{ asset ('assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}" defer></script>
<script src="{{ asset ('assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}" defer></script>
<script src="{{ asset ('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}" defer></script>
<script src="{{ asset ('assets/js/pages/datatables.init.js') }}" defer></script>  
<script type="module" defer>
    $("#datatable").DataTable({
        order: [[8, 'desc']],
    })
</script>
@endpush