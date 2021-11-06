@push('styles')
<link href="{{ asset ('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endpush
<div>
    <x-slot name="header">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Verify Account</h4>
                    <div class="page-title-right">
                        <ol class="m-0 breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Verify Account</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
    </x-slot>
    <div class="row" wire:ignore>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body" wire:ignore.self>
                    <h4 class="mb-4 card-title">Account Information</h4>

                    <div id="account-verification-steps" wire:ignore.self>
                        <!-- Seller Details -->
                        <h3>Bank Information</h3>
                        <section wire:ignore>
                            @if (session()->has('error'))
                            <div class = 'text-sm font-medium text-warning'>
                                {{ session('error') }}
                            </div>
                            @endif
                            <div class="row" wire:ignore>
                                <span>Our system us currently unable to verify access diamond bank accounts, please use any other alternative</span>
                                <span class="mb-4">Fetching your account information takes a minute, please wait for our systems to complete the process.</span>
                                <div class="col-lg-6" wire:ignore>
                                    <div class="mb-3" wire:ignore>
                                        <label>Select Bank</label>
                                        <select class="form-control" id="select-bank" wire:model='bankId' wire:ignore>
                                            <option selected>Select Bank</option>
                                            @foreach ($allbanks as $bnk)
                                            <option value="{{$bnk->id}}">{{$bnk->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="account-number">Account Number</label>
                                        <input type="text" wire:model.lazy='nuban' class="form-control bank-field" id="account-number" disabled>
                                    </div>
                                </div>
                            </div>
                            <div wire:loading class="mb-3">
                                <h4><i class="bx bx-loader-alt bx-spin"></i>Please wait, while we get your account information</h4>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="account-name">Account Name</label>
                                        <input type="text" class="form-control account-fields" wire:model='accountName' id="account-name" disabled>
                                    </div>
                                </div>
                            </div>

                        </section>

                        <!-- Company Document -->
                        <h3>Bio Data</h3>
                        <section>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="first-name">First Name</label>
                                        <input type="text" wire:model='firstName' class="form-control account-fields" id="first-name" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="last-name">Last name</label>
                                        <input type="text" wire:model='lastName' class="form-control account-fields" id="last-name" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="basicpill-phoneno-input">Phone</label>
                                        <input type="text" wire:model='phone' class="form-control account-fields" disabled id="basicpill-phoneno-input">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="basicpill-email-input">Email</label>
                                        <input type="email" wire:model='email' class="form-control account-fields" disabled id="basicpill-email-input">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="basicpill-address-input">Address</label>
                                        <textarea id="basicpill-address-input" wire:model='address' class="form-control account-fields" disabled rows="2"></textarea>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- Confirm Details -->
                        <h3>Confirm Detail</h3>
                        <section>
                            <div class="row justify-content-center">
                                <div class="col-lg-6">
                                    <div class="text-center">
                                        <div class="mb-4">
                                            <i class="mdi mdi-check-circle-outline text-success display-4"></i>
                                        </div>
                                        <div>
                                            <h5>Confirm Detail</h5>
                                            <p class="text-muted">Review your information and confirm details are accurate</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>

                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
</div>
@push('scripts')
<script src="{{ asset ('/assets/libs/jquery-steps/build/jquery.steps.min.js') }}" defer></script>
<script type="module" defer>
    $("#account-verification-steps").steps({
        headerTag: "h3",
        bodyTag: "section",
        transitionEffect: "slide",
        onFinished: function (event, currentIndex) {
            @this.submit()
        }
    });

    $("#select-bank").select2({
        placeholder: "Select your bank"
    })
    $("#select-bank").on('change', function (e) {
        let data = $('#select-bank').select2("val");
        @this.set('bankId', data)
    })
    document.addEventListener("DOMContentLoaded", () => {
        Livewire.hook('element.updated', function(el, component) {
            if(@this.selectBank == 'true') {
                var element =  document.getElementById("account-number")
                element.removeAttribute("disabled")
            }
            else if (@this.getAccountInfo == 'true') {
                var elements = document.getElementsByClassName("account-fields");
                for (var e = 0; e < elements.length; e++) { // For each element
                    var element = elements[e];
                    element.removeAttribute("disabled");
                }
            }
        })
    })
</script>
@endpush
