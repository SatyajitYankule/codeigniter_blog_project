<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Blog </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.1/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">

</head>

<body>
    <?php $this->load->view('includs/header') ?>



    <div class="container-fluid">
        <div class="row">


            <?php $this->load->view('includs/sidebar') ?>

            <div class="col-md-10 p-4">
                <div class="d-flex justify-content-between mb-4">
                    <h3 class="">Blog</h3>
                    <a href="<?php echo base_url('BlogController/add_blog') ?>" class="btn btn-primary">Add Blog</a>
                </div>

                <div class="row g-4">
                    <div class="col-md-12">
                        <div class="card p-4">
                            <div class="table-responsive p-2">
                                <table class="table table-striped table-bordered" id="myTable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Blog Image</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Category Name</th>
                                            <th scope="col">Author Name</th>
                                            <!-- <th scope="col">Short Content</th> -->
                                            <th scope="col">Date</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>





    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.1/js/dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        reload();

        function reload() {
            $('#myTable').DataTable({
                destroy: true,
                ajax: {
                    url: "<?= base_url('BlogController/get_blogs') ?>",
                    type: "POST",
                    dataType: "json"
                },
                language: {
                    emptyTable: "Data Not Found"
                }
            });
        }
    </script>


    <script>
        function delete_blog(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2d91f5',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= base_url('BlogController/delete_blog') ?>",
                        type: "POST",
                        data: { id: id },
                        dataType: "json",
                        success: function (response) {
                            if (response.status === 'success') {
                                Swal.fire(
                                    'Deleted!',
                                    response.message || 'Blog has been deleted.',
                                    'success'
                                );
                                $('#myTable').DataTable().ajax.reload();
                            } else {
                                Swal.fire(
                                    'Error!',
                                    response.message || 'Could not delete the Blog.',
                                    'error'
                                );
                            }
                        }
                    });
                }
            });
        }
    </script>

</body>

</html>