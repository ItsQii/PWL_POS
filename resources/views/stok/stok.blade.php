@extends('layouts.template')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <button onclick="modalAction('{{ url('stok/create_ajax') }}')" class="btn btn-sm btn-success mt-1">Tambah data</button>
                <button onclick="modalAction('{{ url('stok/import') }}')" class="btn btn-info">Import Barang Excel</button>
                <a href="{{ url('stok/export_excel') }}" class="btn btn-primary"><i class="fa fa-file-excel"></i> Export Barang excel</a>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Filter:</label>
                        <div class="col-3">
                            <select class="form-control" id="supplier_id" name="supplier_id" required>
                                <option value="">- Semua -</option>
                                @foreach ($supplier as $item)
                                    <option value="{{ $item->supplier_id }}">{{ $item->supplier_nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-striped table-hover table-sm" id="table_user">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>nama supplier</th>
                        <th>nama barang</th>
                        <th>nama penerima</th>
                        <th>tanggal diterima</th>
                        <th>jumlah stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
            <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" databackdrop="static"
                data-keyboard="false" data-width="75%" aria-hidden="true"></div>
        @endsection
        @push('css')
        @endpush
        @push('js')
            <script>
                 function modalAction(url = '') {
        $('#myModal').load(url, function() {
            $('#myModal').modal('show');
        });
    }

    var dataUser;
    $(document).ready(function() {
        dataUser = $('#table_user').DataTable({
            serverSide: true,
            ajax: {
                "url": "{{ url('stok/list') }}",
                "dataType": "json",
                "type": "POST",
                "data": function(d) {
                    d.supplier_id = $('#supplier_id').val();
                }
            },
            columns: [{
                data: "DT_RowIndex",
                className: "text-center",
                orderable: false,
                searchable: false
            }, {
                data: "supplier.supplier_nama",
                orderable: true,
                searchable: true
            }, {
                data: "barang.barang_nama",
                orderable: true,
                searchable: true
            }, {
                data: "user.nama",
                orderable: true,
                searchable: true
            }, {
                data: "stok_tanggal",
                orderable: true,
                searchable: true
            }, {
                data: "stok_jumlah",
                orderable: true,
                searchable: true
            }, {
                data: "aksi",
                orderable: false,
                searchable: false
            }]
        });

        $('#table_user_filter input').unbind().bind().on('keyup', function(e) {
            if (e.keyCode == 13) {
                dataUser.search(this.value).draw();
            }
        });

        $('#supplier_id').change(function() {
            dataUser.draw();
        });
    });
            </script>
        @endpush