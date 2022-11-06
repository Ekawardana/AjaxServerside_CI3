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
                        <h5 class="modal-title" id="modalTitle">Tambah Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body form">
                        <form action="#" id="formData">
                            <div class="form-group">
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukan Nama Lengkap...">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Masukan Alamat....">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="Masukan Nomor Telepon...">
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
                            <th>Telepon</th>
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
            btnSave.text('Tambah');
            btnSave.attr('disabled', false);

        }

        // Menampilkan Modal
        function add() {
            formData[0].reset();
            modal.modal('show');
            modalTitle.text('Tambah Data Mahasiswa');
        }

        // Fungsi ketika btn tambah diklik
        function save() {
            btnSave.text('Mohon Tunggu...');
            btnSave.attr('disabled', true);
            url = "<?= base_url('mahasiswa/add'); ?>"

            $.ajax({
                type: "POST",
                url: url,
                data: formData.serialize(),
                dataType: "JSON",
                success: function(response) {
                    if (response.status == 'Success') {
                        modal.modal('hide');
                        reloadTable();
                    }
                },
                error: function() {
                    // Pesan Error
                    console.log('error database');
                }
            })
        }
    </script>
</body>

</html>