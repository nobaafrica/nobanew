@push('scripts')
<script src="{{ asset('/assets/js/pages/dashboard.init.js') }}" defer></script>
@if (empty(Auth::user()->firstName))
<script type="module" defer>
    setTimeout(function () {
        $("#subscribeModal").modal("show");
    }, 1e3);
</script>
@endif
<script type="module" defer>
    document.addEventListener('DOMContentLoaded', function () {
        let txs = {!!$txs!!}
        var options = {
            series: [
                { type: "area", name: "Transactions", data: txs },
            ],
            chart: { height: 240, type: "line", toolbar: { show: !1 } },
            dataLabels: { enabled: !1 },
            stroke: { curve: "smooth", width: 2, dashArray: [0, 0, 3] },
            fill: { type: "solid", opacity: [0.15, 0.05, 1] },
            xaxis: { type: 'category' },
            colors: ["#8ebf49", "#3452e1", "#50a5f1"],
        },
        chartOverview = new ApexCharts(document.querySelector("#overview-chart"), options);
        chartOverview.render();
    });
</script>
@endpush
<div>
    <x-slot name="header">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Dashboard</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
    </x-slot>
    <div class="row">
        <div class="col-xl-4">
            <div class="card overflow-hidden">
                <div class="bg-primary bg-soft">
                    <div class="row">
                        <div class="col-7">
                            <div class="text-primary p-3">
                                <h5 class="text-primary">Welcome Back !</h5>
                                <p class="text-capitalize">{{Auth::user()->lastName. " ". Auth::user()->firstName ?? Auth::user()->email}}</p>
                            </div>
                        </div>
                        <div class="col-5 align-self-end">
                            {{-- <img src="{{asset(Auth::user()->profilePicture ?? "/assets/images/user.png")}}" alt="" class="img-fluid"> --}}
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="avatar-md profile-user-wid mb-4 align-self-end">
                                <img src="{{asset("storage/".Auth::user()->profilePicture ?? "/assets/images/user.png")}}" alt="" class="img-thumbnail rounded-circle">
                            </div>
                            <p class="text-muted mb-0">Wallet Balance</p>
                            <h5 class="font-size-15 text-truncate text-capitalize">₦{{number_format($withdrawableBalance)}}</h5>
                        </div>

                        <div class="col-sm-6">
                            <div class="pt-4">
                                <div class="mt-5">
                                    <a href="{{route('wallet')}}" class="btn btn-primary waves-effect waves-light btn-sm">Fund Wallet <i class="mdi mdi-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <div class="row">
                <div class="col-md-4">
                    <div class="card mini-stats-wid h-100">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-muted fw-medium">Partnerships</p>
                                    <h4 class="mb-0">{{$partnerships->count()}}</h4>
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
                <div class="col-md-4">
                    <div class="card mini-stats-wid h-100">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-muted fw-medium">Cummulative Partnership</p>
                                    <h4 class="mb-0">₦{{number_format($cummulativePartnership)}}</h4>
                                </div>

                                <div class="flex-shrink-0 align-self-center ">
                                    <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                        <span class="avatar-title rounded-circle bg-primary">
                                            <i class="bx bx-archive-in font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mini-stats-wid h-100">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-muted fw-medium">Cummulative Payout</p>
                                    <h4 class="mb-0">₦{{number_format($cummulativePayout)}}</h4>
                                </div>

                                <div class="flex-shrink-0 align-self-center">
                                    <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                        <span class="avatar-title rounded-circle bg-primary">
                                            <i class="bx bx-purchase-tag-alt font-size-24"></i>
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
    <div class="row mb-4">
        <div class="col-xl-6">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-sm-flex flex-wrap">
                        <h4 class="card-title mb-4">Transaction Volume</h4>
                        {{-- <div class="ms-auto">
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Week</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Month</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="#">Year</a>
                                </li>
                            </ul>
                        </div> --}}
                    </div>
                    <div id="overview-chart" class="apex-charts" dir="ltr"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card h-100">
                <div class="card-body">
                    <h4 class="card-title mb-4">Partnerships</h4>

                    <div class="table-responsive mt-4">
                        <table class="table align-middle table-nowrap">
                            <tbody>
                                @foreach ($partnerships as $partnership)
                                    @if (daysPercentage($partnership) <= $partnership->package->duration * 30)
                                        <tr class="align-content-center">
                                            <td class="text-center" style="width: 30%">
                                                <h5 class="mb-2">{{$partnership->package->name}}</h5>
                                                <p class="text-muted">Package</p>
                                            </td>
                                            <td class="d-flex flex-column">
                                                <div class="text-center">
                                                    <p class="text-muted">Investment value ₦{{number_format(growthPecentage($partnership))}}</p>
                                                </div>
                                                <div class="progress mb-2">
                                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary rounded" role="progressbar" style="width: {{completionPercentage($partnership)}}%" aria-valuenow="{{completionPercentage($partnership)}}" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <div class="text-center">
                                                    <p class="text-muted">{{daysPercentage($partnership)}}/{{$partnership->package->duration * 30}} Days</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- end row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Trending Packages</h4>
                    <div class="table-responsive">
                        <table class="table align-middle text-center table-nowrap mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="align-middle">Rank</th>
                                    <th class="align-middle">Package Name</th>
                                    <th class="align-middle">Duration</th>
                                    <th class="align-middle">Minimum Commitment</th>
                                    <th class="align-middle">Amount Committed</th>
                                    <th class="align-middle">Profit Percentage</th>
                                    <th class="align-middle">View Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($trending as $trend)
                                <tr>
                                    <td><a href="{{route('package', $trend->package)}}" class="text-body fw-bold">#{{$loop->iteration}}</a> </td>
                                    <td>{{$trend->package->name}}</td>
                                    <td>
                                        {{$trend->package->duration}} Months
                                    </td>
                                    <td>
                                        ₦{{number_format($trend->package->price)}}
                                    </td>
                                    <td>
                                        ₦{{number_format($trend->investment)}}
                                    </td>
                                    <td>
                                        <span class="badge badge-pill badge-soft-success font-size-13">{{$trend->package->profitPercentage}}%</span>
                                    </td>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <a href="{{route('package', $trend->package)}}" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light">
                                            View Package
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- end table-responsive -->
                </div>
            </div>
        </div>
    </div>

    @push('modals')
     <!-- Transaction Modal -->
    <div class="modal fade transaction-detailModal" tabindex="-1" role="dialog" aria-labelledby="transaction-detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="transaction-detailModalLabel">Order Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-2">Product id: <span class="text-primary">#SK2540</span></p>
                    <p class="mb-4">Billing Name: <span class="text-primary">Neal Matthews</span></p>

                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap">
                            <thead>
                                <tr>
                                    <th scope="col">Product</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">
                                        <div>
                                            <img src="/assets/images/product/img-7.png" alt="" class="avatar-sm">
                                        </div>
                                    </th>
                                    <td>
                                        <div>
                                            <h5 class="text-truncate font-size-14">Wireless Headphone (Black)</h5>
                                            <p class="text-muted mb-0">₦ 225 x 1</p>
                                        </div>
                                    </td>
                                    <td>₦ 255</td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        <div>
                                            <img src="/assets/images/product/img-4.png" alt="" class="avatar-sm">
                                        </div>
                                    </th>
                                    <td>
                                        <div>
                                            <h5 class="text-truncate font-size-14">Phone patterned cases</h5>
                                            <p class="text-muted mb-0">₦ 145 x 1</p>
                                        </div>
                                    </td>
                                    <td>₦ 145</td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <h6 class="m-0 text-right">Sub Total:</h6>
                                    </td>
                                    <td>
                                        ₦ 400
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <h6 class="m-0 text-right">Shipping:</h6>
                                    </td>
                                    <td>
                                        Free
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <h6 class="m-0 text-right">Total:</h6>
                                    </td>
                                    <td>
                                        ₦ 400
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal -->

    <!-- subscribeModal -->
    <div class="modal fade" id="subscribeModal" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <div class="avatar-md mx-auto mb-4">
                            <div class="avatar-title bg-light rounded-circle text-primary h1">
                                <i class="mdi mdi-check-outline"></i>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-xl-10">
                                <h4 class="text-primary">Welcome to {{config('app.name')}}!</h4>
                                <p class="text-muted font-size-14 mb-4">Here are your next steps to get started fully</p>
                                <div class="text-left d-flex flex-column justify-content-start">
                                    <p class="text-muted font-size-14">Verify your account using your bank account number</p>
                                    <p class="text-muted font-size-14">Fund your wallet</p>
                                    <p class="text-muted font-size-14">Start a partnership!!!</p>
                                </div>
                                <a class="btn btn-primary" href="{{route('verify-account')}}" id="button-addon2">
                                    <i class="mdi mdi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal -->
    @endpush
</div>
<!-- end main content-->
