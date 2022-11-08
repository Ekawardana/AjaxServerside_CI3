<script src="<?= base_url("/assets/js/jquery-3.5.1.js") ?>"></script>
<script src="<?= base_url("/assets/js/bootstrap.bundle.min.js") ?>"></script>
<script src="<?= base_url("/assets/js/sweetalert2.all.min.js") ?>"></script>
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

    // Fungsi Message
    function message(icon, text) {
        Swal.fire({
            icon: icon,
            title: 'Data Mahasiswa',
            text: text,
            showCloseButton: false,
            showCancelButton: false,
            timer: 2600,
            timerProgressBar: true,
        })

    }

    function deleteQuestion(id, name) {
        Swal.fire({
            title: 'Apakah Yakin?',
            text: "Anda akan menghapus" + nama + "??",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    deleteData(id),
                )
            }
        })

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
                    if (saveData == 'tambah') {
                        message('success', 'Berhasil Ditambah')
                    } else {
                        message('success', 'Berhasil Diubah')
                    }
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
                message('error', 'Sedang Gangguan Silahkan Ulang Kembali')
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
                    deleteQuestion(response.id, response.nama);
                }
            },
            error: function() {
                // Pesan Error
                message('error', 'Sedang Gangguan Silahkan Ulang Kembali')
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
                message('success', 'Berhasil Dihapus')
            },
            error: function() {
                // Pesan Error
                message('error', 'Sedang Gangguan Silahkan Ulang Kembali')
            }
        })

    }
</script>