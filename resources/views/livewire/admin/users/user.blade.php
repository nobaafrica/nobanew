<div>
    <x-slot name="header">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Profile</h4>

                    <div class="page-title-right">
                        <ol class="m-0 breadcrumb">
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
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="mb-4 avatar-md profile-user-wid">
                                <img src="{{asset($user->profilePicture ? "storage/".$user->profilePicture :"/assets/images/user.png")}}" alt="" class="img-thumbnail rounded-circle">
                            </div>
                            <h5 class="font-size-15 text-capitalize">{{$user->firstName. " ". $user->lastName}}</h5>
                            <p class="mb-1">{{$user->email}}</p>
                        </div>

                        <div class="col-sm-4">
                            <div class="mt-4 text-right">
                                @if (is_null($user->deleted_at))
                                <button wire:click='suspend' class="btn btn-primary waves-effect waves-light btn-sm">Suspend User</button>
                                @else
                                <button wire:click='revokeSuspension' class="btn btn-primary waves-effect waves-light btn-sm">Revoke Suspension</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body border-top">
                    <div class="row">
                        <div class="col">
                            <p class="mb-2 text-muted">Virtual Account</p>
                            <div class="text-center">
                                <h6 class="mb-2 text-muted">{{$bank}}</h6>
                                <h5>{{$accountName}}</h5>
                                <div class="d-flex justify-content-center">
                                    <h5 id="nuban">{{$nuban}}</h5>
                                    <input type="text" class="d-none" id="account-number" value="{{$nuban}}">
                                    <button onclick="copyToClipBoard('account-number', 'nuban')" class="btn btn-primary btn-sm">Copy</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body border-top">
                    <div class="row">
                        <div class="col">
                            <h5 class="mb-2 text-muted">Wallet Balance</h5>
                            <div class="text-center">
                                <h4>₦{{number_format($accountBalance)}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body border-top">
                    <div class="row">
                        <div class="col">
                            <h5 class="mb-2 text-muted">Withdrawable Balance</h5>
                            <div class="text-center">
                                <h4>₦{{number_format($withdrawableBalance)}}</h4>
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
                    <h4 class="mb-3 card-title">Overview</h4>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="first-name">First Name</label>
                                <input readonly type="text" value='{{ $user->firstName }}' class="form-control" id="first-name">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="last-name">Last name</label>
                                <input readonly type="text" value='{{ $user->lastName }}' class="form-control" id="last-name">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="basicpill-phoneno-input">Phone</label>
                                <input readonly type="text" value='{{ $user->phoneNumber }}' class="form-control" id="basicpill-phoneno-input">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="basicpill-email-input">Email</label>
                                <input readonly type="email" value='{{ $user->email }}' class="form-control" id="basicpill-email-input">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="basicpill-dob-input">Date Of Birth</label>
                                <input readonly type="text" value='{{ $user->birthday }}' class="form-control" id="basicpill-dob-input">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="basicpill-bank-name">Bank Name</label>
                                <input readonly type="text" value='{{ $user->bank->first() ? $user->bank->first()->bank : '' }}' class="form-control" id="basicpill-bank-name">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="basicpill-acc-number">Account Number</label>
                                <input readonly type="text" value='{{ $user->bank->first() ? $user->bank->first()->nuban : '' }}' class="form-control" id="basicpill-acc-number">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="basicpill-address-input">Address</label>
                                <textarea id="basicpill-address-input" readonly class="form-control" rows="2">
                                    {{ $user->address }}
                                </textarea>
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
                    <h4 class="mb-4 card-title">Transactions</h4>
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
                                    @foreach ($transactions as $tx)
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
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-2 row">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-8">
                            <div class="text-sm-end">
                                {{-- <a href="{{route('packages')}}" class="mb-2 btn btn-success btn-rounded waves-effect waves-light me-2"><i class="mdi mdi-plus me-1"></i> Add New Partnership</a> --}}
                            </div>
                        </div><!-- end col-->
                    </div>

                    <div class="table-responsive">
                        <table id="datatable" class="table text-center align-middle table-nowrap table-check">
                            <thead class="table-light">
                                <tr>
                                    <th class="align-middle">Agreement</th>
                                    <th class="align-middle">Package Name</th>
                                    <th class="align-middle">Date</th>
                                    <th class="align-middle">Package Unit</th>
                                    <th class="align-middle">Total Commitment</th>
                                    <th class="align-middle">Estimated Payout</th>
                                    <th class="align-middle">Payout Date</th>
                                    <th class="align-middle">View Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($partnerships as $partnership)
                                <tr>
                                    <td>
                                        <a href="{{route('agreement', $partnership)}}" target="_blank" class="btn btn-primary btn-sm btn-rounded">
                                            Agreement
                                        </a>
                                    </td>
                                    <td><a href="{{route('package',$partnership->package)}}" class="text-body fw-bold">{{$partnership->package_name}}</a> </td>
                                    <td>
                                       {{\Carbon\Carbon::parse($partnership->created_at)->format('d F, Y')}}
                                    </td>
                                    <td>
                                        {{$partnership->commodityUnit}}
                                    </td>
                                    <td>
                                        ₦{{number_format($partnership->amount)}}
                                    </td>
                                    <td>
                                        ₦{{number_format($partnership->estimatedPayout)}} {{$partnership->isRedeemed == 1 ? "(Paid Out)" : ""}}
                                    </td>
                                    <td>
                                        {{\Carbon\Carbon::parse($partnership->payoutDate)->format('d F, Y')}}
                                     </td>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <a href="{{$partnership->isRedeemed == 1 ? route('agreement', $partnership) : route('partnership', $partnership) }}" class="btn btn-primary btn-sm btn-rounded">
                                            View Details
                                        </a>
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
