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
        let investments = {!!$investments!!}
        let payouts = {!!$payouts!!}
        var options = {
            series: [
                { type: "bar", name: "Investments", data: investments },
                { type: "bar", name: "Payouts", data: payouts },
            ],
            chart: { height: 240, type: "bar", toolbar: { show: !1 } },
            dataLabels: { enabled: !1 },
            stroke: { curve: "smooth", width: 2, dashArray: [0, 0, 3] },
            fill: { type: "solid", opacity: [0.15, 0.05, 1] },
            xaxis: { type: 'category', categories: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']},
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
    <div class="row mb-2">
        <div class="col">
            <div class="row">
                <div class="col-md-4 mb-2">
                    <div class="card mini-stats-wid h-100">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-muted fw-medium">Users</p>
                                    <h4 class="mb-0">{{$users->count()}}</h4>
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
                <div class="col-md-4 mb-2">
                    <div class="card mini-stats-wid h-100">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-muted fw-medium">Partnered Users</p>
                                    <h4 class="mb-0">{{$partnered->count()}}</h4>
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
                <div class="col-md-4 mb-2">
                    <div class="card mini-stats-wid h-100">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-muted fw-medium">Active Partnerships</p>
                                    <h4 class="mb-0">{{$activePartnerships->count()}}</h4>
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
                <div class="col-md-4 mb-2">
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
                <div class="col-md-4 mb-2">
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
                <div class="col-md-4 mb-2">
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
        <div class="col">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-sm-flex flex-wrap">
                        <h4 class="card-title mb-4">Transactions</h4>
                    </div>
                    <div id="overview-chart" class="apex-charts" dir="ltr"></div>
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
