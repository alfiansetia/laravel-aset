@extends('layouts.template', ['title' => 'Tracking'])
@push('css')
    <link rel="stylesheet" href="{{ asset('lib/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <form class="form-inline" id="form_tracking">
                            <div class="form-group pl-0 pr-2 mb-2">
                                <label for="code" class="sr-only">Kode Aset</label>
                                <input type="text" class="form-control text-uppercase" id="code"
                                    placeholder="Kode Aset" required autofocus onkeypress="">
                            </div>
                            <button type="submit" class="btn btn-primary mb-2">Tracking</button>
                        </form>
                        <div class="mt-3" id="card_detail" style="display: none">
                            <table id="table_detail" class="table table-sm" style="width: 100%">
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('pages.location.modal')
@endsection

@push('js')
    <script src="{{ asset('lib/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('lib/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('lib/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('lib/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('lib/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('lib/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script>
        function close_card() {
            $('#card_detail').hide()
        }
        $(document).ready(function() {

            $('#form_tracking').submit(function(e) {
                e.preventDefault()
                let code = $('#code').val()
                if (code == '') {
                    show_toast('error', 'Empty Code')
                    return
                }
                code = code.toLocaleUpperCase();
                ajax_setup()
                $.get("{{ route('api.tracking.index', '') }}" + '/' + code).done(function(result) {
                    $('#table_detail').empty()
                    set_column('KODE', result.data.code)
                    set_column('NAMA', result.data.name)
                    set_column('JUMLAH', result.data.jumlah)
                    set_column('NILAI', 'Rp.' + hrg(result.data.nilai))
                    set_column('KATEGORI', result.data.category.name || '')
                    set_column('JENIS', result.data.jenis.name || '')
                    set_column('LOKASI', result.data.location.name || '')
                    set_column('TGL TERIMA', result.data.tgl_terima)
                    set_column('BATAS PEMAKAIAN', result.data.batas + ' Tahun')
                    set_column('KONDISI', result.data.kondisi)
                    set_column('STATUS', result.data.status)
                    set_column('IMAGE', `<img src="${result.data.image}" width="100" height="100">`)
                    $('#table_detail').append(`<tr>
                        <td colspan="2" style="text-align:right;">
                            <button type="button" class="btn btn-secondary" onclick="close_card()">Close</button></td>
                        </tr>`)
                    $('#card_detail').show()
                }).fail(function(xhr) {
                    $('#card_detail').hide()
                    show_toast('error', xhr.responseJSON.message || 'Server Error')
                })
            })


            function set_column(name, value) {
                $('#table_detail').append(`<tr>
                    <td style="width:20%">${name}</td>
                    <td style="width:2%">:</td>
                    <td style="width:78%">${value}</td>
                </tr>`)
            }
        })
    </script>
@endpush
