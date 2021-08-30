@push('styles')
<link href="{{ asset ('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset ('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset ('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />  
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
    <x-alert />
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
                                <div class="d-flex justify-content-center">
                                    <h5 id="nuban">{{$nuban ?? 111}}</h5>
                                    <input type="text" class="d-none" id="account-number" value="{{$nuban ?? 11111}}">
                                    <h5><span style="cursor: pointer" onclick="copyToClipBoard('account-number', 'nuban')"><i class="bx bx-copy"></i></span> </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body border-top p-0">
                    <p class="text-muted mb-4 ps-4 pt-4">Manage Wallet</p>
                    <div class="text-center overflow-hidden">
                        <div class="d-flex flex-sm-column flex-md-row flex-lg-row justify-content-sm-center justify-content-lg-between p-2">
                            @if (is_null($wallet) || is_null($wallet->accountNumber))
                            <div class="w-50 me-1">
                                <div>
                                    <div class="font-size-24 text-primary mb-2">
                                        <i class="bx bx-plus"></i>
                                    </div>

                                    <div class="mt-3">
                                        <button wire:click='generateWallet' class="btn btn-primary btn-sm w-md">Get Account <span wire:loading><i class="bx bx-loader-alt bx-spin"></i></span> </button>
                                    </div>
                                </div>
                            </div>
                            @endif
                            
                            <div class="w-50 me-1">
                                <div>
                                    <div class="font-size-24 text-primary mb-2">
                                        <i class="bx bx-wallet"></i>
                                    </div>

                                    <div class="mt-3">
                                        <a data-bs-toggle="modal" data-bs-target="#fund-wallet" class="btn btn-primary btn-sm w-md">Fund</a>
                                    </div>
                                </div>
                            </div>
                            <div class="w-50 me-1">
                                <div>
                                    <div class="font-size-24 text-primary mb-2">
                                        <i class="bx bx-import"></i>
                                    </div>

                                    <div class="mt-3">
                                        <a  data-bs-toggle="modal" data-bs-target="#withdraw-funds" class="btn btn-primary btn-sm w-md">Withdraw</a>
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
                                    {{-- <i class="mdi mdi-bitcoin h2 text-warning mb-0"></i> --}}
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
                                    {{-- <i class="mdi mdi-ethereum h2 text-primary mb-0"></i> --}}
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
                                    {{-- <i class="mdi mdi-litecoin h2 text-info mb-0"></i> --}}
                                </div>
                                <div class="flex-grow-1">
                                    <p class="text-muted mb-2">Total Withdrawn</p>
                                    <h5 class="mb-0">₦ {{number_format($totalWithdrawn)}}</span></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">Referral</h4>
                    <div class="row">
                        <div class="col">
                            <div class="border p-3 rounded mt-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar-xs me-3">
                                        <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                            <i class="mdi mdi-share"></i>
                                        </span>
                                    </div>
                                    <h5 class="font-size-14 mb-0">Share with friends and earn 2% of their first partnership with us</h5>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="text-muted mt-3">
                                            <p>Referral Code</p>
                                            <input type="text" class="d-none" id="ref-code" value="{{Auth::user()->refCode}}">
                                            <h4 id="refcode">{{Auth::user()->refCode}}</h4>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 align-self-end">
                                        <div class="float-end mt-3">
                                            <button onclick="copyToClipBoard('ref-code', 'refcode')" class="btn btn-primary">Copy</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Transactions</h4>
                    <div class="mt-4">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Transaction Status</th>
                                        <th>Transaction Type</th>
                                        <th>Payment Method</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($credits as $tx)
                                    <tr class="text-capitalize">
                                        <td>{{\Carbon\Carbon::parse($tx->time)->format('d F, Y')}}</td>
                                        <td>₦{{number_format($tx->amount)}}</td>
                                        <td>
                                            @if(Str::lower($tx->status) == 'success')
                                            <span class="badge badge-pill badge-soft-success font-size-11">{{$tx->status}}</span>
                                            @else
                                            <span class="badge badge-pill badge-soft-danger font-size-11">{{$tx->status}}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($tx->transactionType == 'credit')
                                            <span class="badge badge-pill badge-soft-success font-size-11">{{$tx->transactionType}}</span>
                                            @else
                                            <span class="badge badge-pill badge-soft-danger font-size-11">{{$tx->transactionType}}</span>
                                            @endif
                                        <td>
                                            <i class="fab fa-cc-mastercard me-1"></i> {{$tx->payment_method}}
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
    </div>
    <!-- end row -->
    <div class="modal fade" id="fund-wallet" tabindex="-1" aria-labelledby="fundWallet" aria-hidden="true" wire:ignore.self>
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
                                <form class="input-group bg-light rounded" wire:submit.prevent='fundWallet'>
                                    <input type="number" inputmode="numeric" wire:model='fundingAmount' class="form-control bg-transparent border-0" placeholder="Enter Amount">
                                    <button class="btn btn-primary" type="submit" id="button-addon2">
                                        <i class="bx bxs-paper-plane"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="withdraw-funds" tabindex="-1" aria-labelledby="withdwaw-funds" aria-hidden="true" wire:ignore.self>
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
                                <h4 class="text-primary">Withdraw Funds!</h4>
                                <div class="flex flex-column justify-content-start mt-4 mb-4">
                                    <p class="text-muted font-size-13">Funds would be paid into this account</p>
                                    <p class="text-muted font-size-12">Bank: {{$userBank}}</p>
                                    <p class="text-muted font-size-12">Account Number: {{$userAccount}}</p>
                                    <p class="text-muted font-size-12">Account Name: {{$this->user->firstName. " ". $this->user->lastName}}</p>
                                </div>
                                <p class="text-muted font-size-14 mb-4">How much do you want to withdraw?</p>
                                <form class="input-group bg-light rounded" wire:submit.prevent='withdrawFunds'>
                                    <input type="number" inputmode="numeric" wire:model='withdrawalAmount' class="form-control bg-transparent border-0" placeholder="Enter Amount">
                                    <button class="btn btn-primary" type="submit" id="button-addon2">
                                        <i class="bx bxs-paper-plane"></i>
                                    </button>
                                </form>
                            </div>
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
<script src="{{ asset ('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}" defer></script>
<script src="{{ asset ('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}" defer></script>
<script type="module" defer>
    document.addEventListener('DOMContentLoaded', function () {
        $(function () {
            $("#datatable").DataTable(), $(".dataTables_length select").addClass("form-select form-select-sm");
        });
    });
</script>
@endpush
