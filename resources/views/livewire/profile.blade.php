<div>
    <x-slot name="header">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Profile</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Profile</li>
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
                    <div class="row mt-4">
                        <div class="col-sm-4">
                            <div class="avatar-md profile-user-wid mb-4">
                                <img src="{{asset("storage/".Auth::user()->profilePicture ?? "/assets/images/user.png")}}" alt="" class="img-thumbnail rounded-circle">
                            </div>
                            <h5 class="font-size-15 text-capitalize">{{auth()->user()->firstName. " ". auth()->user()->lastName}}</h5>
                            <p class="mb-1">{{auth()->user()->email}}</p>
                        </div>
            
                        <div class="col-sm-8">
                            <div class="pt-4">
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="font-size-15">Referral Code:</h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="font-size-15">{{auth()->user()->refCode}}</h5>
                                    </div>
                                </div>
                                <div class="mt-4 text-right">
                                    <a href="{{route('edit-profile',Auth::user())}}" class="btn btn-primary waves-effect waves-light btn-sm">Edit Profile <i class="mdi mdi-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-8">
            <div class="row">
            </div>
            <!-- end row -->

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">Overview</h4>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="first-name">First Name</label>
                                <input readonly type="text" value='{{ Auth::user()->firstName }}' class="form-control" id="first-name">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="last-name">Last name</label>
                                <input readonly type="text" value='{{ Auth::user()->lastName }}' class="form-control" id="last-name">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="basicpill-phoneno-input">Phone</label>
                                <input readonly type="text" value='{{ Auth::user()->phoneNumber }}' class="form-control" id="basicpill-phoneno-input">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="basicpill-email-input">Email</label>
                                <input readonly type="email" value='{{ Auth::user()->email }}' class="form-control" id="basicpill-email-input">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="basicpill-dob-input">Date Of Birth</label>
                                <input readonly type="text" value='{{ Auth::user()->birthday }}' class="form-control" id="basicpill-dob-input">
                            </div>
                        </div>
                        {{-- <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="basicpill-bvn-input">BVN</label>
                                <input readonly type="text" value='{{ Auth::user()->bank->first()->bvn }}' class="form-control" id="basicpill-bvn-input">
                            </div>
                        </div> --}}
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="basicpill-address-input">Address</label>
                                <textarea id="basicpill-address-input" readonly class="form-control" rows="2">
                                    {{ Auth::user()->address }}
                                </textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
