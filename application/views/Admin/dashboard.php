<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">

   


</head>

<body>
    <?php $this->load->view('includs/header') ?>



    <div class="container-fluid">
        <div class="row">


            <?php $this->load->view('includs/sidebar') ?>

            <div class="col-md-10 p-4">
                <h3 class="mb-4">Dashboard Overview</h3>

                <!-- <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card p-4">
                            <h5><i class="bi bi-people-fill text-primary me-2"></i>Users</h5>
                            <p class="text-muted">Total users: <strong>125</strong></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card p-4">
                            <h5><i class="bi bi-graph-up-arrow text-success me-2"></i>Analytics</h5>
                            <p class="text-muted">Visits today: <strong>890</strong></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card p-4">
                            <h5><i class="bi bi-envelope text-warning me-2"></i>Messages</h5>
                            <p class="text-muted">New messages: <strong>23</strong></p>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>