<div>
    <x-slot name="header">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Verify Email</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Verify Email</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
    </x-slot> 
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card">
                
                <div class="card-body"> 
                    
                    <div class="p-2">
                        <div class="text-center">

                            <div class="avatar-md mx-auto">
                                <div class="avatar-title rounded-circle bg-light">
                                    <i class="bx bxs-envelope h1 mb-0 text-primary"></i>
                                </div>
                            </div>
                            <div class="p-2 mt-4">
                                <h4>Verify your email</h4>
                                <div class="mb-4 text-sm text-gray-600">
                                    <p>Thanks for signing up! Before getting started, could you verify your email (<span class="fw-semibold">{{Auth::user()->email}}</span>) by clicking on the link we just emailed to you? </p>
                                    <p>If you didn't receive the email, we will gladly send you another</p>
                                </div>
                                @if (session('status') == 'verification-link-sent')
                                    <div class="alert alert-success alert-dismissable" role="alert">
                                        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                                        <button type="button" class="btn-close btn-success text-success" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                                <div class="mt-4">
                                    <form method="POST" action="{{ route('verification.send') }}">
                                        @csrf
                        
                                        <div>
                                            <button type="submit" class="btn btn-success w-md">Resend Verification Email</button>
                                        </div>
                                    </form>
                        
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                        
                                        <button type="submit" class="mt-5 btn btn-secondary">
                                            {{ __('Log Out') }}
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
</div>
