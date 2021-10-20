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
                        <h5>All Packages</h5>
                    </div>
                </div>
                <div class="col-lg-8 col-sm-6">
                    <div class="text-sm-end">
                        <a href="#" data-bs-target="#new-package" data-bs-toggle="modal" class="btn btn-primary btn-rounded waves-effect waves-light mb-2 me-2"><i class="mdi mdi-plus me-1"></i> Add New Package</a>
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
                                    <img src="{{url_exists($package->picture) ? asset('storage/'. $package->picture) : asset($package->picture)}}" alt="" class="img-fluid mx-auto d-block">
                                </a>
                            </div>
                            <div class="mt-4 text-center">
                                <h5 class="mb-3 text-truncate"><a href="{{route('admin-package', $package)}}" class="text-dark">{{$package->name}}</a></h5>
                                
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
    <div class="modal fade" id="new-package" tabindex="-1" aria-labelledby="new-package" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="transaction-detailModalLabel">New Package</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="mt-4 mt-xl-3 p-3" wire:submit.prevent='addPackage'>
                        <div class="col-lg">
                            <div class="mb-3">
                                <label for="name">Package Name</label>
                                <input type="text" wire:model='name' class="form-control" id="name">
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="mb-3">
                                <label for="code">Commodity Code</label>
                                <input type="text" wire:model='code' class="form-control" id="code">
                            </div>
                        </div>
                    
                        <div class="col-lg">
                            <div class="mb-3">
                                <label for="price">Minimum Commitment</label>
                                <input type="text" wire:model='price' class="form-control" id="price">
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="mb-3">
                                <label for="duration">Duration (months)</label>
                                <input type="number" inputmode="numeric" wire:model='duration' class="form-control" id="duration">
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="mb-3">
                                <label for="profit">Profit (%)</label>
                                <input type="number" inputmode="numeric" wire:model='profit' class="form-control" id="profit">
                            </div>
                        </div>
                        <div class="row" wire:ignore>
                            <div 
                                class="text-muted mb-4" 
                                id="description"
                                x-data
                                name="description"
                                x-ref="quillEditor"
                                x-init="
                                    quill = new Quill($refs.quillEditor, {theme: 'snow'});
                                    quill.on('text-change', function () {
                                        $dispatch('input', quill.root.innerHTML);
                                        @this.set('description', quill.root.innerHTML)
                                    });
                                "
                            >
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="package-pic" class="form-label">Change Package Picture</label>
                                <input class="form-control" wire:model='picture' type="file" id="package-pic">
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Add Package</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="//cdn.quilljs.com/1.3.6/quill.min.js" defer></script>
@endpush

@push('styles')
<link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">
@endpush