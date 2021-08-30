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
                                        <img src="{{ asset($package->frontPicture ?? $package->pictures->picture) }}" width="300" alt="" class="img-fluid mx-auto d-block">
                                    </div>
                                    <div class="text-center">
                                        <form wire:submit.prevent='partner'>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="minimum-commitment" class="form-label">Minmum Commitment</label>
                                                        <input type="text" readonly wire:model='price' class="form-control" id="minimum-commitment">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="unit" class="form-label">Number Of Units</label>
                                                        <input type="number" inputmode="numeric" wire:model='unit' class="form-control" id="unit">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="duration" class="form-label">Duration</label>
                                                        <input type="text" readonly wire:model='duration' class="form-control" id="duration">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="profit" class="form-label">Profit Per Package</label>
                                                        <input type="text" readonly wire:model='profit' class="form-control" id="profit">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="commitment" class="form-label">Total Commitment</label>
                                                        <input type="text" readonly wire:model='commitment' class="form-control" id="commitment">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="payout" class="form-label">Expected Payout</label>
                                                        <input type="text" readonly wire:model='payout' class="form-control" id="payout">
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <button type="submit" class="btn btn-primary w-md">Partner</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-8">
                            <div class="mt-4 mt-xl-3">
                                <a href="{{route('packages')}}" class="text-primary">Packages</a>
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
    <!-- instruction-modal -->
    <div class="modal fade" id="instruction-modal" tabindex="-1" aria-labelledby="instructionmodalLabel" aria-hidden="true">
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
                                <h4 class="text-primary">Hello, {{Auth::user()->firstName}}!</h4>
                                <p class="text-muted font-size-14 mb-4">Here are the steps for you to partner with us</p>
                                <div class="text-left d-flex flex-column justify-content-start">
                                    <p class="text-muted font-size-14">1. Select your preferred number of units and click “Partner”</p>
                                    <p class="text-muted font-size-14">2. The amount to be committed will be automatically calculated</p>
                                    <p class="text-muted font-size-14">3. Click partner, to proceed and funds from your wallet would be committed to this package</p>
                                    <p class="text-muted font-size-14">Start a partnership!!!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal -->   
</div>
<script type="module" defer>
    setTimeout(function () {
        $("#instruction-modal").modal("show");
    }, 1e3);
</script>