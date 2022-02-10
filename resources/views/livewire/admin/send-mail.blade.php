<div>
    <x-slot name="header">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Emails</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Emails</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
    <x-alert />
    <div class="mb-3 row">
        <div class="col-xl-4 col-sm-6">
            <div class="mb-2 search-box me-2 d-inline-block">
                <div class="position-relative">
                    <input id='mail-search' type="text" class="form-control" placeholder="Search...">
                    <i class="bx bx-search-alt search-icon"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-sm-6">
            <div class="text-sm-end">
                <a href="#" data-bs-target="#send-mail" data-bs-toggle="modal" class="mb-2 btn btn-primary btn-rounded waves-effect waves-light "><i class="mdi mdi-plus me-1"></i> Send Mail</a>
            </div>
            {{-- Start Send Mail Modal --}}
            <div class="modal fade" id="send-mail" tabindex="-1" aria-labelledby="new-deposit" aria-hidden="true" wire:ignore.self>
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="transaction-detailModalLabel">Mail</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="p-3" wire:submit='sendMail'>
                                <div class="col-lg">
                                    <div class="mb-3">
                                        <label for="select-user">User</label>
                                        <select class="form-control" id="select-user" wire:model='user' wire:ignore>
                                            <option selected>Select User</option>
                                            @foreach ($users as $user)
                                                <option value="{{$user->id}}">{{$user->firstName}} {{$user->lastName}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-4 col-lg">
                                    <div class="mb-3">
                                        <label for="subject">Subject</label>
                                        <input type="text" wire:model='subject' class="form-control" id="subject">
                                    </div>
                                </div>
                                <div class="mb-4 col-lg" wire:ignore>
                                    <label for="description">Content</label>
                                    <div
                                        class="mb-4 text-muted"
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
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Send Mail</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End Send Mail Modal --}}
        </div>
        <div class="mb-4 row">
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="flex-wrap d-sm-flex">
                            <h4 class="mb-4 card-title">Emails</h4>
                        </div>
                        <div class="table-responsive">
                            <table id="datatable" class="table mb-0 text-center align-middle table-nowrap">
                                <thead class="table-light">
                                    <tr>
                                        <th class="align-middle">ID</th>
                                        <th class="align-middle">Name</th>
                                        <th class="align-middle">Subject</th>
                                        <th class="align-middle">Sent By</th>
                                        <th class="align-middle">Created At</th>
                                        <th class="align-middle">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($emails as $email)
                                        <tr>
                                            <td><a href="#" class="text-body fw-bold">#{{$loop->iteration}}</a> </td>
                                            <td>{{$email->user->firstName ?? "No Name"}} {{$email->user->lastName?? ""}}</td>
                                            <td>{{$email->subject}}</td>
                                            <td>{{isset($email->admin) ? $email->admin->firstName . ' ' . $email->admin->lastName : '' }}</td>
                                            <td>{{\Carbon\Carbon::parse($email->created_at)->format('Y-m-d')}}</td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <a href="#" data-bs-target="#view-mail-{{$loop->iteration}}" data-bs-toggle="modal" class="mb-2 btn btn-primary btn-rounded waves-effect waves-light">View Message</a>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="view-mail-{{$loop->iteration}}" tabindex="-1" aria-labelledby="view-deposit" aria-hidden="true" wire:ignore.self>
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="transaction-detailModalLabel">Sent Mail</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="col-lg">
                                                            <div class="mb-3">
                                                                <h5>Subject: {{ $email->subject }}</h5>
                                                                <p>{!! $email->content !!}</p>
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
@push('styles')
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset ('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}" defer></script>
    <script src="{{ asset ('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}" defer></script>

    <script src="{{ asset ('assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}" defer></script>
    <script src="{{ asset ('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}" defer></script>
    <script src="//cdn.quilljs.com/1.3.6/quill.min.js" defer></script>
    <script type="module" defer>
        document.addEventListener("DOMContentLoaded", () => {
            $("#datatable").DataTable({
                dom:"<'row mb-3'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'B>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                pageLength: 50,
            });
            $('#mail-search').on( 'keyup', function () {
                let table = $('#datatable').DataTable();
                table.search( this.value ).draw();
            });
            $(".dataTables_length select").addClass("form-select form-select-sm w-75");
            $(".dataTables_filter").addClass("d-none");
            $(".dataTables_length label").addClass("d-flex align-items-center justify-content-between align-content-center");
        })
        // $(function () {

        // });
    </script>
@endpush
