<div>
    <x-slot name="header">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Package</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                            <li class="breadcrumb-item"><a href="{{route('packages')}}">Packages</a></li>
                            <li class="breadcrumb-item active">Package</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
    </x-slot>
    <!-- end header -->
    <x-alert />
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-4">
                            <div class="product-detai-imgs">
                                <div class="row">
                                    <div class="text-center mb-4">
                                        <img src="{{url_exists($package->picture) ? asset($package->picture) : asset('storage/'. $package->picture)}}" width="300" alt="" class="img-fluid mx-auto d-block">
                                    </div>
                                    <div class="text-center">
                                        <div>
                                            <a href="{{route('edit-package', $package)}}" class="btn btn-primary w-md">Edit Package</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-8">
                            <div class="mt-4 mt-xl-3">
                                <a href="{{route('packages')}}" class="text-primary">Package</a>
                                <h4 class="mt-1 mb-3">{{$package->name}}</h4>

                                {{-- <p class="text-muted float-start me-3">
                                    <span class="bx bxs-star text-warning"></span>
                                    <span class="bx bxs-star text-warning"></span>
                                    <span class="bx bxs-star text-warning"></span>
                                    <span class="bx bxs-star text-warning"></span>
                                    <span class="bx bxs-star text-warning"></span>
                                </p> --}}
                                {{-- <p class="text-muted mb-4">( 152 Customers Review )</p> --}}

                                <h6 class="text-success text-uppercase">{{$package->profitPercentage}}% Profit</h6>
                                <h5>Minimum Commitment : <b>₦{{number_format($package->price)}}</b></h5>
                                <h5 class="mb-4">Estimated Payout : <b>₦{{number_format($package->price + $package->price * ($package->profitPercentage/100))}}</b></h5>
                                <p class="text-muted mb-4">{!! $package->info !!}</p>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                </div>
            </div>
            <!-- end card -->
        </div>
    </div>
    <!-- end row -->
</div>
