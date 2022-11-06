<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" type="text/css" href="<?= base_url("/assets/css/boostrap.css") ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url("/assets/css/dataTables.bootstrap4.min.css") ?>" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" />
</head>

<body>
    <div class="container">
        <h1 class="text-center">Data Mahasiswa</h1>
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
    <!-- <script src="<?= base_url("/assets/js/dataTables.bootstrap4.min.js") ?>"></script>
    <script src="<?= base_url("/assets/js/jquery.dataTables.min.js") ?>"></script> -->
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
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
    </script>
</body>

</html>