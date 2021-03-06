<div>
    <x-slot name="header">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Edit Profile</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route('profile')}}">Profile</a></li>
                            <li class="breadcrumb-item active">Edit Profile</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
    </x-slot> 
    <div class="row">
        <div class="col-xl-12">
            <div class="row">
            </div>
            <!-- end row -->
            <h4 class="card-title mb-3">Overview</h4>
            <div class="row">
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mt-4">
                                <div class="col">
                                    @if ($profilePicture)
                                    <div class="text-center">
                                        <div class="avatar-lg profile-user-wid mb-4">
                                            <img src="{{ $profilePicture->temporaryUrl() }}" alt="" class="img-thumbnail rounded-circle">
                                        </div>
                                    </div>   
                                    @endif
                                    <form wire:submit.prevent='updatePicture'>
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="profile-pic" class="form-label">Select Profile Picture</label>
                                                <input class="form-control" wire:model='profilePicture' type="file" id="profile-pic">
                                            </div>
                                        </div>
                                        <div class="mt-4 text-center">
                                            <button type="submit" class="btn btn-primary waves-effect waves-light btn-sm">Update Picture <i class="mdi mdi-arrow-right ms-1"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <div class="card">
                        <form wire:submit.prevent='updateProfileInfo' class="card-body">
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
                                        <input type="text" wire:model='phoneNumber' class="form-control" id="basicpill-phoneno-input">
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
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="basicpill-dob-input">Date Of Birth</label>
                                        <input type="text" wire:model='birthday' class="form-control" id="basicpill-dob-input">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="basicpill-address-input">Address</label>
                                        <textarea id="basicpill-address-input" wire:model='address' class="form-control" rows="2">
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg">Update Profile</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
