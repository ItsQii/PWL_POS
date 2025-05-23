@extends('layouts.template')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <button onclick="modalAction('{{ url('penjualan/create_ajax') }}')" class="btn btn-sm btn-success mt-1">Tambah list pembelian</button>
                <a href="{{ url('penjualan/export_pdf') }}" class="btn btn-warning"><i class="fa fa-file-pdf"></i> Export Penjualan</a>
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
                            <select class="form-control" id="user_id" name="user_id" required>
                                <option value="">- Semua -</option>
                                @foreach ($user as $item)
                                    <option value="{{ $item->user_id }}">{{ $item->nama }}</option>
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
                        <th>kode penjualan</th>
                        <th>tanggal penjualan</th>
                        <th>nama pembeli</th>
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
                    $('#myModal').load(url, function () {
                        $('#myModal').modal('show');
                    });
                }

                var dataUser;
                $(document).ready(function () {
                    dataUser = $('#table_user').DataTable({
                        serverSide: true,
                        ajax: {
                            "url": "{{ url('penjualan/list') }}",
                            "dataType": "json",
                            "type": "POST",
                            "data": function (d) {
                                d.user_id = $('#user_id').val();
                            }
                        },
                        columns: [{
                            data: "DT_RowIndex",
                            className: "text-center",
                            orderable: false,
                            searchable: false
                        }, {
                            data: "penjualan_kode",
                            orderable: true,
                            searchable: true
                        }, {
                            data: "penjualan_tanggal",
                            orderable: true,
                            searchable: true
                        }, {
                            data: "user.nama",
                            orderable: true,
                            searchable: true
                        },{
                            data: "aksi",
                            orderable: false,
                            searchable: false
                        }]
                    });

                    $('#table_user_filter input').unbind().bind().on('keyup', function (e) {
                        if (e.keyCode == 13) {
                            dataUser.search(this.value).draw();
                        }
                    });

                    $('#user_id').change(function () {
                        dataUser.draw();
                    });
                });
            </script>
        @endpush