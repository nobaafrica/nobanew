<div>
    <x-slot name="header">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Packages</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Packages</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
    </x-slot>
    <!-- end header -->
    <x-alert />
    <x-auth-validation-errors />
    <div class="row">
        <div class="col-lg-12">

            <div class="row mb-3">
                <div class="col-xl-4 col-sm-6">
                    <div class="mt-2">
                        <h5>All Disabled Packages</h5>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($packages as $package)
                    <div class="col-xl-4 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="product-img position-relative">
                                    <a href="{{route('admin-package', $package)}}">
                                        <img src="{{url_exists($package->picture) ? asset($package->picture) : asset('storage/'. $package->picture)}}" alt="" class="img-fluid mx-auto d-block">
                                    </a>
                                </div>
                                <div class="mt-4 text-center">
                                    <h5 class="mb-3 text-truncate">
                                        <a href="{{route('admin-package', $package)}}" class="text-dark">{{$package->name}}</a>
                                    </h5>

                                    <h5 class="my-0"><b>₦{{number_format($package->price)}}</b></h5>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- end row -->
            {{ $packages->links() }}
        </div>
    </div>
    <!-- end row -->
</div>
