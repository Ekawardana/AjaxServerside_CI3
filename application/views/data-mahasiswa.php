<div class="container mt-3">
    <h1 class="text-center mb-4">Data Mahasiswa Ajax-ServerSide</h1>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary mb-3" onclick="add()">
        Tambah Data
    </button>

    <!-- Modal -->
    <div class="modal fade" id="modalData" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Modal Title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body form">
                    <form action="#" id="formData">
                        <input type="hidden" name="id" id="id" value="">
                        <div class="form-group">
                            <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukan Nama Lengkap...">
                            <div class="invalid-feedback is-invalid"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Masukan Alamat....">
                            <div class="invalid-feedback is-invalid"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="email" id="email" placeholder="Masukan Email....">
                            <div class="invalid-feedback is-invalid"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="Masukan Nomor Telepon...">
                            <div class="invalid-feedback is-invalid"></div>
                        </div>

                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btnSave" onclick="save()">Tambah</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End modal -->

    <!-- Tabel Data -->
    <div class="card">
        <div class="card-body">
            <table id="myTable" class="table table-hover table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>

</html>