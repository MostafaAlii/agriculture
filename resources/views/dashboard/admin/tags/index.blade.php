@extends('dashboard.layouts.dashboard')
@section('css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"
        integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
@section('pageTitle')
    {{ __('Admin/site.tag') }}
@endsection
@section('content')
    @include('dashboard.common._partials.messages')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{ __('Admin/site.tag') }}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a
                                    href="{{ route('admin.dashboard') }}">{{ __('Admin/site.home') }}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">{{ __('Admin/site.tag') }}</a>
                            </li>

                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Zero configuration table -->
            <section id="configuration">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{ __('Admin/site.tag') }}</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    @can('tag-create')
                                        <button type="button" class="btn btn-primary btn-sm mb-3" data-toggle="modal"
                                            data-target="#addtag">
                                            <i class="material-icons">add_box</i>
                                            {{ __('Admin/site.create') }}
                                        </button>
                                    @endcan
                                    @can('tag-delete-all')
                                        <button type="button" class="btn btn-warning mb-3" id="btn_delete_all"
                                            data-toggle="modal" data-target="#bulkdelete">
                                            <i class="fa fa-trash"></i>
                                            {{ __('Admin/site.bulkdelete') }}
                                        </button>
                                    @endcan
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered zero-configuration"
                                            id="tags-table">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <input type="checkbox" name="select_all" id="select-all">
                                                    </th>
                                                    <th>#</th>
                                                    <th>{{ __('Admin/site.name') }}</th>
                                                    <th>{{ __('Admin/site.status') }}</th>
                                                    <th>{{ __('Admin/site.created_at') }}</th>
                                                    <th>{{ __('Admin/site.action') }}</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            @include('dashboard.admin.tags.btn.add')
            {{-- @include('dashboard.admin.tags.btn.update') --}}
        </div>
    </div>
    <!-- END: Content-->
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.js"
        integrity="sha512-uE2UhqPZkcKyOjeXjPCmYsW9Sudy5Vbv0XwAVnKBamQeasAVAmH6HR9j5Qpy6Itk1cxk+ypFRPeAZwNnEwNuzQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/styles/metro/notify-metro.min.js"
        integrity="sha512-cG69LpvCJkui4+Uuj8gn/zRki74/E7FicYEXBnplyb/f+bbZCNZRHxHa5qwci1dhAFdK2r5T4dUynsztHnOS5g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript">
        // $(document).ready( function () {
        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });

        let tagsTable = $('#tags-table').DataTable({
            // dom: "tiplr",
            serverSide: true,
            processing: true,
            lengthMenu: [
                [10, 25, 50, 100, 500],
                [10, 25, 50, 100, 500]
            ],
            "language": {
                "url": "{{ asset('assets/admin/datatable-lang/' . app()->getLocale() . '.json') }}"
            },
            ajax: {
                url: '{{ route("tags.data") }}',
            },
            columns: [
                { data: 'record_select',name: 'record_select',searchable: false,sortable: false,width: '1%'},
                { data: 'DT_RowIndex',name: '',orderable: false,searchable: false,width: '1%'},
                {
                    data: 'name',
                    name: 'name',
                    width: '10%'
                },
                {
                    data: 'status',
                    name: 'status',
                    searchable: false,
                    sortable: false,
                    width: '10%'
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    searchable: false,
                    width: '10%'
                },
                {
                    data: 'actions',
                    name: 'actions',
                    searchable: false,
                    sortable: false,
                    width: '20%'
                },
            ],
            order: [
                [4, 'desc']
            ],
        });

    </script>

@endsection
