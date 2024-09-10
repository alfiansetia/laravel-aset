@extends('layouts.template', ['title' => 'Laporan'])
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
                                <th style="width: 30px;">No</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Jenis</th>
                                <th>Kategori</th>
                                <th>Jumlah</th>
                                <th>Nilai</th>
                                <th>Lokasi</th>
                                <th>Kondisi</th>
                                <th>Tgl Terima</th>
                                <th>Masa Pemakaian</th>
                                <th>Batas Pemakaian</th>
                                <th>Sisa Pemakaian</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('lib/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('lib/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('lib/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('lib/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('lib/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('lib/datatables-buttons/js/buttons.colVis.min.js') }}"></script>


    <script src="{{ asset('lib/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('lib/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('lib/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('lib/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('lib/datatables-buttons/js/buttons.print.min.js') }}"></script>

    <script src="{{ asset('lib/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('lib/select2/dist/js/select2.full.min.js') }}"></script>

    <script>
        var url_index = "{{ route('api.laporan.index') }}"
        var id = 0

        var table = $("#table").DataTable({
            ajax: url_index,
            processing: true,
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
                data: 'nilai_parse',
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
                data: 'masa_parse',
            }, {
                data: 'batas_parse',
            }, {
                data: 'sisa_parse',
            }, {
                data: 'status',
            }],
            buttons: [{
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
            }, {
                text: 'Export',
                className: 'btn btn-sm btn-warning bs-tooltip',
                attr: {
                    'data-toggle': 'tooltip',
                    'title': 'Export'
                },
                extend: 'collection',
                autoClose: true,
                buttons: [{
                        extend: 'pdf',
                        orientation: 'landscape',
                        title: function() {
                            const monthNames = [
                                "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli",
                                "Agustus", "September", "Oktober", "November", "Desember"
                            ];
                            const currentDate = new Date();
                            const currentMonth = monthNames[currentDate.getMonth()];
                            const currentYear = currentDate.getFullYear();
                            return (
                                    `PT MITRA ASA PRATAMA\nLAPORAN ASET BULAN ${currentMonth} ${currentYear}`
                                    )
                                .toUpperCase();
                        },
                        pageSize: 'A4',
                        customize: function(doc) {
                            doc.styles.title = {
                                alignment: 'center',
                                fontSize: 14,
                                bold: true
                            };
                            // doc.styles.tableHeader.color = '#000000';
                            // doc.styles.tableHeader.fillColor = '#ffffff';
                        }
                    }

                    // "csv", "excel", "copy", {
                    //     extend: 'pdf',
                    //     orientation: 'landscape',
                    //     title: function() {
                    //         const monthNames = [
                    //             "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli",
                    //             "Agustus", "September", "Oktober", "November", "Desember"
                    //         ];
                    //         const currentDate = new Date();
                    //         const currentMonth = monthNames[currentDate.getMonth()];
                    //         return `PT MITRA ASA PRATAMA\nLAPORAN ASET BULAN ${currentMonth.toUpperCase()}`;
                    //     },
                    //     pageSize: 'A4',
                    //     customize: function(doc) {
                    //         doc.styles.title = {
                    //             alignment: 'center',
                    //             fontSize: 14,
                    //             bold: true
                    //         };
                    //         // doc.styles.tableHeader.color = '#000000';
                    //         // doc.styles.tableHeader.fillColor = '#ffffff';
                    //     }
                    // }, {
                    //     extend: "print",
                    //     text: 'Print',
                    //     pageSize: 'A4',
                    //     orientation: 'landscape',
                    //     title: 'Laporan Aset',
                    // }
                ]
            }, ],
            initComplete: function() {
                $('#table').DataTable().buttons().container().appendTo(
                    '#tableData_wrapper .col-md-6:eq(0)');
            },
        });
    </script>
@endpush
