@extends('layouts.template')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <a class="btn btn-sm btn-primary mt-1" href="{{ url('supplier/create') }}">Tambah</a>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <table class="table table-bordered table-striped table-hover table-sm" id="table_user">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>supplier kode</th>
                        <th>supplier nama</th>
                        <th>supplier alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        @endsection
        @push('css')
        @endpush
        @push('js')
            <script>
                $(document).ready(function() {
                    var dataUser = $('#table_user').DataTable({
                        // serverSide: true, jika ingin menggunakan server side processing
                        serverSide: true,
                        ajax: {
                            "url": "{{ url('supplier/list') }}",
                            "dataType": "json",
                            "type": "POST",
                        },
                        columns: [{
                            // nomor urut dari laravel datatable addIndexColumn()
                            data: "DT_RowIndex",
                            className: "text-center",
                            orderable: false,
                            searchable: false
                        }, {
                            data: "supplier_kode",
                            className: "",
                            // orderable: true, jika ingin kolom ini bisa diurutkan
                            orderable: true,
                            // searchable: true, jika ingin kolom ini bisa dicari
                            searchable: true
                        }, {
                            data: "supplier_nama",
                            className: "",
                            orderable: true,
                            searchable: true
                        }, {
                            data: "supplier_alamat",
                            className: "",
                            orderable: true,
                            searchable: true
                        }, {
                            data: "aksi",
                            className: "",
                            orderable: false,
                            searchable: false
                        }]
                    });x    
                });
            </script>
        @endpush