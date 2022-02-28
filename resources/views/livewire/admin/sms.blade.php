<div>
    <x-slot name="header">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">SMS</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">SMS</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
    </x-slot>
    <x-alert />
    <x-auth-validation-errors />
    <div class="col">
        <div class="text-sm-end">
            <a href="#" data-bs-target="#sendSms" data-bs-toggle="modal" class="mb-2 btn btn-primary btn-rounded waves-effect waves-light "><i class="mdi mdi-plus me-1"></i> Send SMS</a>
        </div>
        {{-- Start Send SMS Modal --}}
        <div class="modal fade" id="sendSms" tabindex="-1" aria-labelledby="sendSms" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="transaction-detailModalLabel">SMS</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="p-3" wire:submit.prevent='sendSms'>
                            <div class="col-lg">
                                <div class="mb-3">
                                    <label for="select-user">User</label>
                                    <input class="form-control" list="datalistOptions" placeholder="Type to search..." wire:model='phoneNumber' wire:ignore>
                                    <datalist id="datalistOptions">
                                        @foreach ($users as $user)
                                            <option value="{{$user->phoneNumber}}">{{$user->firstName . ' ' . $user->lastName }}</option>
                                        @endforeach
                                    </datalist>
                                </div>
                            </div>
                            <div class="mb-4 col-lg" wire:ignore>
                                <label for="content">Content</label>
                                <textarea id="content" class="form-control" name="content" rows="4" wire:model='content'></textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Send SMS</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- End Send SMS Modal --}}
        <div class="mb-4 row">
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="flex-wrap d-sm-flex">
                            <h4 class="mb-4 card-title">Text Messages</h4>
                        </div>
                        <div class="table-responsive">
                            <table id="datatable" class="table mb-0 text-center align-middle table-nowrap">
                                <thead class="table-light">
                                <tr>
                                    <th class="align-middle">ID</th>
                                    <th class="align-middle">Name</th>
                                    <th class="align-middle">Sent By</th>
                                    <th class="align-middle">Status</th>
                                    <th class="align-middle">Created At</th>
                                    <th class="align-middle">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($sms as $text)
                                    <tr>
                                        <td><a href="#" class="text-body fw-bold">#{{$loop->iteration}}</a> </td>
                                        <td>{{$text->user->firstName ? $text->user->firstName . ' ' . $text->user->lastName: $text->user->email}}</td>
                                        <td>{{isset($text->admin) ? $text->admin->firstName . ' ' . $text->admin->lastName : '' }}</td>
                                        <td>{{$text->status}}</td>
                                        <td>{{\Carbon\Carbon::parse($text->created_at)->format('Y-m-d')}}</td>
                                        <td>
                                            <!-- Button trigger modal -->
                                            <a href="#" data-bs-target="#view-mail-{{$loop->iteration}}" data-bs-toggle="modal" class="mb-2 btn btn-primary btn-rounded waves-effect waves-light">View Message</a>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="view-mail-{{$loop->iteration}}" tabindex="-1" aria-labelledby="view-deposit" aria-hidden="true" wire:ignore.self>
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="transaction-detailModalLabel">Text Message #{{$loop->iteration}}</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="col-lg">
                                                        <div class="mb-3">
                                                            <h5>Content</h5>
                                                            <p>{{$text->content}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                </tbody>
                            </table>
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
    <script src="{{ asset ('assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}" defer></script>
    <script src="{{ asset ('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}" defer></script>
    <script type="module" defer>
        document.addEventListener("DOMContentLoaded", () => {
            $("#datatable").DataTable({
                dom:"<'row mb-3'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'B>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                pageLength: 50,
            });
            $(".dataTables_length select").addClass("form-select form-select-sm w-75");
            $(".dataTables_filter").addClass("d-none");
            $(".dataTables_length label").addClass("d-flex align-items-center justify-content-between align-content-center");
        })
    </script>
@endpush
