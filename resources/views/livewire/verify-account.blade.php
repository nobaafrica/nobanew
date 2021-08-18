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
                        <ol class="breadcrumb m-0">
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
                    <h4 class="card-title mb-4">Account Information</h4>

                    <div id="account-verification-steps" wire:ignore.self>
                        <!-- Seller Details -->
                        <h3>Bank Information</h3>
                        <section wire:ignore>
                            @if (session()->has('error'))
                            <div class = 'font-medium text-sm text-warning'>
                                {{ session('error') }}
                            </div>
                            @endif
                            <div class="row" wire:ignore>
                                <div class="col-lg-6" wire:ignore>
                                    <div class="mb-3" wire:ignore>
                                        <label>Select Bank</label>
                                        <select class="form-control" id="select-bank" wire:model='bankId' wire:ignore>
                                            <option selected>Select Bank</option>
                                            @foreach ($allbanks as $bank)
                                            <option value="{{$bank->id}}">{{$bank->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="account-number">Account Number</label>
                                        <input type="text" wire:model.lazy='nuban' class="form-control" id="account-number">
                                    </div>
                                </div>
                            </div>
                            <div wire:loading class="mb-3">
                                <h4><i class="bx bx-loader-alt bx-spin"></i> Fetching data</h4>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="account-name">Account Name</label>
                                        <input type="text" class="form-control" wire:model='accountName' id="account-name">
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
                                        <input type="text" wire:model='firstName' class="form-control" id="first-name">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="last-name">Last name</label>
                                        <input type="text" wire:model='lastName' class="form-control" id="last-name">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="basicpill-phoneno-input">Phone</label>
                                        <input type="text" wire:model='phone' class="form-control" id="basicpill-phoneno-input">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="basicpill-email-input">Email</label>
                                        <input type="email" wire:model='email' class="form-control" id="basicpill-email-input">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="basicpill-address-input">Address</label>
                                        <textarea id="basicpill-address-input" wire:model='address' class="form-control" rows="2"></textarea>
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
    
</script>
@endpush
