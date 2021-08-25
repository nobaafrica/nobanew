<div>
    <x-slot name="header">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Packages</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route('packages')}}">Packages</a></li>
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
                                <a href="{{route('packages')}}" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"><i class="mdi mdi-plus me-1"></i> Add New Partnership</a>
                            </div>
                        </div><!-- end col-->
                    </div>

                    <div class="table-responsive">
                        <table id="datatable" class="table align-middle table-nowrap table-check text-center">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 20px;" class="align-middle">
                                        <div class="form-check font-size-16">
                                            <input class="form-check-input" type="checkbox" id="checkAll">
                                            <label class="form-check-label" for="checkAll"></label>
                                        </div>
                                    </th>
                                    <th class="align-middle">Order ID</th>
                                    <th class="align-middle">Package Name</th>
                                    <th class="align-middle">Date</th>
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
                                        <div class="form-check font-size-16">
                                            <input class="form-check-input" type="checkbox" id="orderidcheck01">
                                            <label class="form-check-label" for="orderidcheck01"></label>
                                        </div>
                                    </td>
                                    <td><a href="{{route('partnership',$partnership)}}" class="text-body fw-bold">#{{Str::limit($partnership->id, 7, '')}}</a> </td>
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
                                        ₦{{number_format($partnership->estimatedPayout)}}
                                    </td>
                                    <td>
                                        {{\Carbon\Carbon::parse($partnership->payoutDate)->format('d F, Y')}}
                                     </td>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <a href="{{route('partnership', $partnership)}}" class="btn btn-primary btn-sm btn-rounded">
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
<script src="{{ asset ('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}" defer></script>
<script src="{{ asset ('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}" defer></script>
<script type="module" defer>
    $(function () {
        $("#datatable").DataTable(), $(".dataTables_length select").addClass("form-select form-select-sm");
    });
</script>
@endpush