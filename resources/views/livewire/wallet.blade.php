@push('styles')
<link href="{{ asset ('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endpush
<div>
    <x-slot name="header">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Wallets</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Wallets</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
    </x-slot> 
    <div class="row">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    
                    <div class="d-flex">
                        <div class="flex-shrink-0 me-4">
                            <i class="mdi mdi-account-circle text-primary h1"></i>
                        </div>

                        <div class="flex-grow-1">
                            <div class="text-muted">
                                <h5>{{auth()->user()->firstName. " ". auth()->user()->lastName}}</h5>
                                <p class="mb-1">{{auth()->user()->email}}</p>
                                <p class="mb-0">Id no: #{{Str::limit(auth()->user()->id, 7, '')}}</p>
                            </div>
                            
                        </div>

                        <div class="dropdown ms-2">
                            <a class="text-muted dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-dots-horizontal font-size-18"></i>
                            </a>
                          
                            <div class="dropdown-menu dropdown-menu-end">
                              <a class="dropdown-item" href="#">Action</a>
                              <a class="dropdown-item" href="#">Another action</a>
                              <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body border-top">
                    
                    <div class="row">
                        <div class="col">
                            <p class="text-muted mb-2">Virtual Account</p>
                            <div class="text-center">
                                <h6 class="text-muted mb-2">{{$bank}}</h6>
                                <h5>{{$accountName}}</h5>
                                <h5>{{$nuban}}</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body border-top">
                    <p class="text-muted mb-4">Manage Wallet</p>
                    @if (session()->has('error'))
                    <div class = 'font-medium text-sm text-danger'>
                        {{ session('error') }}
                    </div>
                    @elseif(session()->has('success'))
                    <div class = 'font-medium text-sm text-success'>
                        {{ session('success') }}
                    </div>
                    @endif
                    <div class="text-center">
                        <div class="row justify-content-between">
                            @if (is_null($wallet) || is_null($wallet->accountNumber))
                            <div class="col-sm-4">
                                <div class="mt-4 mt-sm-0">
                                    <div class="font-size-24 text-primary mb-2">
                                        <i class="bx bx-plus"></i>
                                    </div>

                                    <div class="mt-3">
                                        <button wire:click='generateWallet' class="btn btn-primary btn-sm w-md">Get Account <span wire:loading><i class="bx bx-loader-alt bx-spin"></i></span> </button>
                                    </div>
                                </div>
                            </div>
                            @endif
                            
                            <div class="col-sm-4">
                                <div>
                                    <div class="font-size-24 text-primary mb-2">
                                        <i class="bx bx-wallet"></i>
                                    </div>

                                    <div class="mt-3">
                                        <a data-bs-toggle="modal" data-bs-target="#fund-wallet" class="btn btn-primary btn-sm w-md">Fund</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mt-4 mt-sm-0">
                                    <div class="font-size-24 text-primary mb-2">
                                        <i class="bx bx-import"></i>
                                    </div>

                                    <div class="mt-3">
                                        <a href="javascript: void(0);" class="btn btn-primary btn-sm w-md">Withdraw</a>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                </div>
            </div>
        </div>
        
        <div class="col-xl-8">
            <div class="row">
                <div class="col-sm-4">
                    <div class="card mini-stats-wid">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3 align-self-center">
                                    <i class="mdi mdi-bitcoin h2 text-warning mb-0"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <p class="text-muted mb-2">Withdrawable Balance</p>
                                    <h5 class="mb-0"> ₦ {{number_format($withdrawableBalance)}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card mini-stats-wid">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3 align-self-center">
                                    <i class="mdi mdi-ethereum h2 text-primary mb-0"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <p class="text-muted mb-2">Referral Bonus</p>
                                    <h5 class="mb-0">₦ {{number_format($referralBonus)}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card mini-stats-wid">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3 align-self-center">
                                    <i class="mdi mdi-litecoin h2 text-info mb-0"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <p class="text-muted mb-2">Cumulative Payout</p>
                                    <h5 class="mb-0">0</span></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">Overview</h4>

                    <div>
                        <div id="overview-chart" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('modals')
<div class="modal fade" id="fund-wallet" tabindex="-1" aria-labelledby="fundWallet" aria-hidden="true">
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
                            <h4 class="text-primary">Proceed to Paystack!</h4>
                            <p class="text-muted font-size-14 mb-4">How much do you want to fund your wallet with?</p>
                            <div class="input-group bg-light rounded">
                                <input type="number" inputmode="numeric" class="form-control bg-transparent border-0" placeholder="Enter Amount">
                                
                                <button class="btn btn-primary" type="button" id="button-addon2">
                                    <i class="bx bxs-paper-plane"></i>
                                </button>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endpush
@push('scripts')
<script src="{{ asset ('assets/js/pages/crypto-wallet.init.js') }}" defer></script>
<script type="module" defer>

</script>
@endpush
