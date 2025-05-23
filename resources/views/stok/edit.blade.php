@empty($stok)
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kesalahan</h5>
                <button type="button" class="close" data-dismiss="modal" arialabel="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5>
                    Data yang anda cari tidak ditemukan
                </div>
                <a href="{{ url('/stok') }}" class="btn btn-warning">Kembali</a>
            </div>
        </div>
    </div>
@else
    <form action="{{ url('/stok/' . $stok->stok_id . '/update_ajax') }}" method="POST" id="formedit">
        @csrf
        @method('PUT')
        <div id="myModal" class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Stok Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" arialabel="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Supplier</label>
                        <select name="supplier_id" id="supplier_id" class="form-control" required>
                            <option value="">- Pilih nama supplier -</option>
                            @foreach ($supplier as $k)
                                <option {{ $k->supplier_id == $stok->supplier_id ? 'selected' : '' }} value="{{ $k->supplier_id }}">
                                    {{ $k->supplier_nama }}</option>
                            @endforeach
                        </select>
                        <small id="error-supplier_id" class="error-text form-text textdanger"></small>
                    </div>
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <select name="barang_id" id="barang_id" class="form-control" required>
                            <option value="">- Pilih nama barang -</option>
                            @foreach ($barang as $k)
                                <option {{ $k->barang_id == $stok->barang_id ? 'selected' : '' }} value="{{ $k->barang_id }}">
                                    {{ $k->barang_nama }}</option>
                            @endforeach
                        </select>
                        <small id="error-barang_id" class="error-text form-text textdanger"></small>
                    </div>
                    <div class="form-group">
                        <label>Nama penerima</label>
                        <select name="user_id" id="user_id" class="form-control" required>
                            <option value="">- Pilih nama penerima -</option>
                            @foreach ($user as $k)
                                <option {{ $k->user_id == $stok->user_id ? 'selected' : '' }} value="{{ $k->user_id }}">
                                    {{ $k->nama }}</option>
                            @endforeach
                        </select>
                        <small id="error-user_id" class="error-text form-text textdanger"></small>
                    </div>
                    <div class="form-group">
                        <label>tanggal terima</label>
                        <input value="{{ $stok->stok_tanggal }}" type="date" name="stok_tanggal" id="stok_tanggal"
                            class="form-control" required>
                        <small id="error-stok_tanggal" class="error-text form-text textdanger"></small>
                    </div>
                    <div class="form-group">
                        <label>jumlah barang</label>
                        <input value="{{ $stok->stok_jumlah }}" type="text" name="stok_jumlah" id="stok_jumlah" class="form-control"
                            required>
                        <small id="error-stok_jumlah" class="error-text form-text text-danger"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btnwarning">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </form>
    <script>
        $(document).ready(function() {
            $("#formedit").validate({
                rules: {
                },
                submitHandler: function(form) {
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: $(form).serialize(),
                        success: function(response) {
                            if (response.status) {
                                $('#myModal').modal('hide');
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message
                                });
                                dataUser.ajax.reload();
                            } else {
                                $('.error-text').text('');
                                $.each(response.msgField, function(prefix, val) {
                                    $('#error-' + prefix).text(val[0]);
                                });
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Terjadi Kesalahan',
                                    text: response.message
                                });
                            }
                        }
                    });
                    return false;
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endempty