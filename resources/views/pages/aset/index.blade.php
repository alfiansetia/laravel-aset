@extends('layouts.template', ['title' => 'Data Aset'])
@push('css')
    <link rel="stylesheet" href="{{ asset('lib/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('lib//bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('lib//select2/dist/css/select2.min.css') }}">
@endpush
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover" id="table" style="width: 100%;cursor: pointer;">
                        <thead>
                            <tr>
                                <th style="width: 30px;">#</th>
                                <th>Image</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Jenis</th>
                                <th>Kategori</th>
                                <th>Jumlah</th>
                                <th>Nilai</th>
                                <th>Lokasi</th>
                                <th>Kondisi</th>
                                <th>Tgl Terima</th>
                                <th>Batas Pemakaian</th>
                                <th>Status</th>
                                <th style="width: 50px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('pages.aset.modal')
@endsection

@push('js')
    <script src="{{ asset('lib/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('lib/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('lib/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('lib/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('lib/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('lib/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <script src="{{ asset('lib/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('lib/select2/dist/js/select2.full.min.js') }}"></script>

    <script>
        var url_index = "{{ route('api.asets.index') }}"
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
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            }, {
                data: 'image',
                sortable: false,
                render: function(data, type, row, meta) {
                    if (type == 'display') {
                        return `<img src="${data}" width="40" height="40">`
                    } else {
                        return data
                    }
                }
            }, {
                data: 'code',
            }, {
                data: 'name',
            }, {
                data: 'jenis_id',
                render: function(data, type, row, meta) {
                    if (type == 'display') {
                        return data != null ? row.jenis.name : ''
                    } else {
                        return data
                    }
                }
            }, {
                data: 'category_id',
                render: function(data, type, row, meta) {
                    if (type == 'display') {
                        return data != null ? row.category.name : ''
                    } else {
                        return data
                    }
                }
            }, {
                data: 'jumlah',
            }, {
                data: 'nilai',
                render: function(data, type, row, meta) {
                    if (type == 'display') {
                        return "Rp." + hrg(data)
                    } else {
                        return data
                    }
                }
            }, {
                data: 'location_id',
                render: function(data, type, row, meta) {
                    if (type == 'display') {
                        return data != null ? row.location.name : ''
                    } else {
                        return data
                    }
                }
            }, {
                data: 'kondisi',
            }, {
                data: 'tgl_terima',
            }, {
                data: 'batas',
                render: function(data, type, row, meta) {
                    if (type == 'display') {
                        if (data < 1) {
                            return ''
                        }
                        let initialDate = new Date(row.tgl_terima);
                        let yearsToAdd = row.batas;
                        let newDate = new Date(initialDate);
                        newDate.setFullYear(newDate.getFullYear() + yearsToAdd);
                        let formattedDate = newDate.toISOString().split('T')[0];
                        return formattedDate
                    } else {
                        return data
                    }
                }
            }, {
                data: 'status',
            }, {
                data: 'id',
                sortable: false,
                render: function(data, type, row, meta) {
                    if (type == 'display') {
                        return `<button class="btn btn-danger btn-sm btn-delete">Delete</button>`;
                    } else {
                        return data
                    }
                }
            }],
            buttons: [, {
                text: '<i class="fa fa-plus mr-1"></i>Add',
                className: 'btn btn-sm btn-primary bs-tooltip',
                attr: {
                    'data-toggle': 'tooltip',
                    'title': 'Add Data'
                },
                action: function(e, dt, node, config) {
                    modal_add()
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

        $('#table tbody').on('click', 'tr td:not(:first-child):not(:last-child)', function() {
            row = $(this).parents('tr')[0];
            id = table.row(row).data().id
            $.get(url_index + '/' + id).done(function(result) {
                $('#name').val(result.data.name)
                $('#jenis').val(result.data.jenis_id).change()
                $('#nilai').val(result.data.nilai)
                $('#kategori').val(result.data.category_id).change()
                $('#lokasi').val(result.data.location_id).change()
                $('#kondisi').val(result.data.kondisi).change()
                $("#tgl_terima").data('daterangepicker').setStartDate(result.data.tgl_terima);
                $("#tgl_terima").data('daterangepicker').setEndDate(result.data.tgl_terima);
                $('#tgl_terima').val(result.data.tgl_terima).change()
                $('#batas').val(result.data.batas)
                $('#status').val(result.data.status).change()
                $('#jumlah').val(result.data.jumlah)
                $('#form').attr('action', url_index + '/' + id)
                $('#modal_form_title').html('Edit Data')
                $('#modal_form_submit').val('PUT')
                $('#image').val('').change()
                $('#image_preview').show()
                $('#image_preview').attr('src', result.data.image).width(200).height(200);
                $('#modal_form').modal('show')
            }).fail(function(xhr) {
                show_toast('error', xhr.responseJSON.message || 'server Error!')
            })
        });

        $('#table tbody').on('click', 'tr .btn-delete', function() {
            row = $(this).parents('tr')[0];
            id = table.row(row).data().id
            send_delete(url_index + "/" + id)
        });

        $('#modal_form_submit').click(function() {
            send_ajax('form', $('#modal_form_submit').val())
        })

        function modal_add() {
            $('#form').attr('action', url_index)
            $('#modal_form_submit').val('POST')
            $('#modal_form_title').html('Tambah Data')
            $('#modal_form').modal('show')
            $('#name').val('')
            $('#jenis').val('').change()
            $('#nilai').val(0)
            $('#kategori').val('').change()
            $('#lokasi').val('').change()
            $('#kondisi').val('').change()
            $('#tgl_terima').val('')
            $('#image').val('').change()
            $('#image_preview').hide()
            $('#batas').val(0)
            $('#status').val('').change()
            $('#jumlah').val(1)
        }

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#image_preview').show()
                    $('#image_preview').attr('src', e.target.result).width(200).height(200);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush
