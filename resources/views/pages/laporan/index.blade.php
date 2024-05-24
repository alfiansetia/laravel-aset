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
                            @foreach ($data as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->code }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->jenis->name ?? '' }}</td>
                                    <td>{{ $item->category->name ?? '' }}</td>
                                    <td>Rp. {{ hrg($item->nilai) }}</td>
                                    <td>{{ $item->location->name }}</td>
                                    <td>{{ $item->kondisi }}</td>
                                    <td>{{ $item->tgl_terima }}</td>
                                    <td>{{ $item->masa_parse() }}</td>
                                    <td>{{ $item->batas_parse() }}</td>
                                    <td>{{ $item->sisa_parse() }}</td>
                                    <td>{{ $item->status }}</td>
                                </tr>
                            @endforeach
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

    <script src="{{ asset('lib/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('lib/select2/dist/js/select2.full.min.js') }}"></script>

    <script>
        var url_index = "{{ route('api.asets.index') }}"
        var id = 0

        var table = $("#table").DataTable({
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
            }],
            initComplete: function() {
                $('#table').DataTable().buttons().container().appendTo(
                    '#tableData_wrapper .col-md-6:eq(0)');
            },
        });
    </script>
@endpush
