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
                                        <form wire:submit.prevent='updatePicture'>
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label for="profile-pic" class="form-label">Change Package Picture</label>
                                                    <input class="form-control" wire:model='picture' type="file" id="profile-pic">
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

                        <div class="col-xl-8">
                            <form class="mt-4 mt-xl-3" wire:submit.prevent='editPackage'>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="name">Package Name</label>
                                            <input type="text" wire:model='name' class="form-control" id="name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="code">Commodity Code</label>
                                            <input type="text" wire:model='code' class="form-control" id="code">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="price">Minimum Commitment</label>
                                            <input type="text" wire:model='price' class="form-control" id="price">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="duration">Duration (months)</label>
                                            <input type="number" inputmode="numeric" wire:model='duration' class="form-control" id="duration">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="profit">Profit (%)</label>
                                            <input type="number" inputmode="numeric" wire:model='profit' class="form-control" id="profit">
                                        </div>
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
                                        {!! $package->info !!}
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Update Package Info</button>
                                </div>
                            </form>
                            <div class="d-flex justify-content-between col-xl-8 mx-auto mt-4">
                                <button wire:click='disablePackage()' class="btn btn-warning waves-effect waves-light">Disable Package <i class="mdi mdi-stop ms-1"></i></button>
                                <button wire:click='deletePackage()' class="btn btn-danger waves-effect waves-light">Delete Package <i class="mdi mdi-trash-can-outline ms-1"></i></button>
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
</div>

@push('scripts')
<script src="//cdn.quilljs.com/1.3.6/quill.min.js" defer></script>
@endpush

@push('styles')
<link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">
@endpush