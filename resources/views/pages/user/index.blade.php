@extends('layouts.template', ['title' => 'Data User'])
@push('css')
    <link rel="stylesheet" href="{{ asset('lib/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush
@section('content')
    {{-- <h2 class="section-title">DataTables</h2>
    <p class="section-lead">
        We use 'DataTables' made by @SpryMedia. You can check the full documentation <a
            href="https://datatables.net/">here</a>.
    </p> --}}

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Data User</h4>
                </div>
                <div class="card-body">
                    <table class="table table-hover" id="table" style="width: 100%;cursor: pointer;">
                        <thead>
                            <tr>
                                <th class="dt-no-sorting" style="width: 30px;">Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('pages.user.modal')
@endsection

@push('js')
    <script src="{{ asset('lib/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('lib/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('lib/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('lib/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('lib/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('lib/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script>
        $(document).ready(function() {

            var url_index = "{{ route('api.users.index') }}"
            var id = 0

            var table = $("#table").DataTable({
                processing: true,
                rowId: 'id',
                ajax: url_index,
                dom: "<'dt--top-section'<'row'<'col-sm-12 col-md-6 d-flex justify-content-md-start justify-content-center'B><'col-sm-12 col-md-6 d-flex justify-content-md-end justify-content-center mt-md-0 mt-3'f>>>" +
                    "<'table-responsive'tr>" +
                    "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
                oLanguage: {
                    oPaginate: {
                        sPrevious: '<i class="fas fa-chevron-left"></i>',
                        sNext: '<i class="fas fa-chevron-right"></i>'
                    },
                    sSearch: '',
                    sSearchPlaceholder: "Search...",
                    sLengthMenu: "Results :  _MENU_",
                },
                lengthMenu: [
                    [10, 50, 100, 500, 1000],
                    ['10 rows', '50 rows', '100 rows', '500 rows', '1000 rows']
                ],
                pageLength: 10,
                lengthChange: true,
                columnDefs: [],
                columns: [{
                    data: 'id',
                }, {
                    data: 'name',
                }, {
                    data: 'email',
                }, {
                    data: 'role',
                }],
                columnDefs: [{
                    sortable: false,
                    targets: [0]
                }],
                buttons: [, {
                    text: '<i class="fa fa-plus mr-1"></i>Add',
                    className: 'btn btn-sm btn-primary bs-tooltip',
                    attr: {
                        'data-toggle': 'tooltip',
                        'title': 'Add Data'
                    },
                    action: function(e, dt, node, config) {
                        $('#modal_form_password_help').hide()
                        $('#form').attr('action', url_index)
                        $('#modal_form_submit').val('POST')
                        $('#modal_form_title').html('Add Data')
                        $('#modal_form').modal('show')
                    }
                }, {
                    extend: "colvis",
                    attr: {
                        'data-toggle': 'tooltip',
                        'title': 'Column Visible'
                    },
                    className: 'btn btn-sm btn-primary'
                }, {
                    extend: "pageLength",
                    attr: {
                        'data-toggle': 'tooltip',
                        'title': 'Page Length'
                    },
                    className: 'btn btn-sm btn-info'
                }],
                initComplete: function() {
                    $('#table').DataTable().buttons().container().appendTo(
                        '#tableData_wrapper .col-md-6:eq(0)');
                },
            });

            $('#table tbody').on('click', 'tr td:not(:first-child)', function() {
                row = $(this).parents('tr')[0];
                id = table.row(row).data().id
                $.get(url_index + '/' + id).done(function(result) {
                    $('#name').val(result.data.name)
                    $('#email').val(result.data.email)
                    $('#password').val('')
                    $('#role').val(result.data.role).change()
                    $('#form').attr('action', url_index + '/' + id)
                    $('#modal_form_title').html('Edit Data')
                    $('#modal_form_submit').val('PUT')
                    $('#modal_form_password_help').show()
                    $('#modal_form').modal('show')
                }).fail(function(xhr) {
                    show_toast('error', xhr.responseJSON.message || 'server Error!')
                })
            });

            $('#modal_form_submit').click(function() {
                send_ajax('form', $('#modal_form_submit').val())
            })

            function send_ajax(formID, method) {
                $.ajax({
                    url: $('#' + formID).attr('action'),
                    type: method,
                    data: $('#' + formID).serialize(),
                    success: function(result) {
                        show_toast('success', result.message || 'Success!')
                        $('button').prop('disabled', false)
                        table.ajax.reload()
                        $('#modal_form').modal('hide')
                    },
                    beforeSend: function() {
                        $('button').prop('disabled', true)
                    },
                    error: function(xhr, status, error) {
                        $('button').prop('disabled', false)
                        show_toast('error', xhr.responseJSON.message || 'Server Error!')
                    }
                })
            }

        })
    </script>
@endpush
