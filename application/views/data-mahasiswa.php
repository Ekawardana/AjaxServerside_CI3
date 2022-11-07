<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" type="text/css" href="<?= base_url("/assets/css/boostrap.css") ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url("/assets/css/dataTables.bootstrap4.min.css") ?>" />
</head>

<body>
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




    <script src="<?= base_url("/assets/js/jquery-3.5.1.js") ?>"></script>
    <script src="<?= base_url("/assets/js/bootstrap.bundle.min.js") ?>"></script>

    <!-- <script src="<?= base_url("/assets/js/dataTables.bootstrap4.min.js") ?>"></script>
    <script src="<?= base_url("/assets/js/jquery.dataTables.min.js") ?>"></script> -->

    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script>
        var saveData;
        var modal = $('#modalData');
        var tableData = $('#myTable');
        var formData = $('#formData');
        var modalTitle = $('#modalTitle');
        var btnSave = $('#btnSave');

        $(document).ready(function() {
            tableData.DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    "url": "<?= base_url("mahasiswa/getData") ?>",
                    "type": "POST"
                },
                "columnDefs": [{
                    "target": [-1],
                    "orderable": false
                }]
            });
        });

        // Reload Table
        function reloadTable() {
            tableData.DataTable().ajax.reload();
            // btnSave.text('Tambah');
            // btnSave.attr('disabled', false);

        }

        // Menampilkan Modal
        function add() {
            saveData = 'tambah';
            formData[0].reset();
            modal.modal('show');
            modalTitle.text('Tambah Data Mahasiswa');
        }

        // Fungsi ketika btn tambah dan ubah diklik
        function save() {
            btnSave.text('Mohon Tunggu...');
            btnSave.attr('disabled', true);
            if (saveData == 'tambah') {
                url = "<?= base_url('mahasiswa/add'); ?>"
            } else {
                url = "<?= base_url('mahasiswa/update'); ?>"
            }

            $.ajax({
                type: "POST",
                url: url,
                data: formData.serialize(),
                dataType: "JSON",
                success: function(response) {
                    if (response.status == 'success') {
                        modal.modal('hide');
                        reloadTable();
                    } else {
                        for (var i = 0; i < response.inputerror.length; i++) {
                            $('[name="' + response.inputerror[i] + '"]').addClass('is-invalid');
                            $('[name="' + response.inputerror[i] + '"]').next().text(response.error_string[i]);
                        }
                    }
                    btnSave.text('Simpan Data..');
                    btnSave.attr('disabled', false);
                },
                error: function() {
                    // Pesan Error
                    console.log('error database');
                }
            })
        }

        // Ketika ada id yang di ambil
        function byid(id, type) {
            if (type == 'edit') {
                saveData = 'edit';
                formData[0].reset();
            }

            // Ajax Edit & Hapus
            $.ajax({
                type: "GET",
                url: "<?= base_url('mahasiswa/byid/') ?>" + id,
                dataType: "JSON",
                success: function(response) {
                    if (type == 'edit') {
                        formData.find('input').removeClass('is-invalid');
                        modalTitle.text('Ubah Data');
                        btnSave.text('Ubah');
                        btnSave.attr('disabled', false);
                        $('[name="id"]').val(response.id);
                        $('[name="nama"]').val(response.nama);
                        $('[name="alamat"]').val(response.alamat);
                        $('[name="email"]').val(response.email);
                        $('[name="no_hp"]').val(response.no_hp);
                        modal.modal('show');
                    } else {
                        var result = confirm('Anda akan menghapus ' + response.nama + ', Yakin??');
                        if (result) { //Jika ditekan OK
                            deleteData(response.id);

                        }
                    }
                }
            })
        }

        function deleteData(id) {
            $.ajax({
                type: "POST",
                url: "<?= base_url('mahasiswa/delete/'); ?>" + id,
                dataType: "JSON",
                success: function(response) {
                    reloadTable();
                }
            })

        }
    </script>
</body>

</html>