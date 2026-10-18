<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Author</title>

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
                    <h3 class="">Author</h3>
                    <button type="button" class="btn btn-primary" id="add_author">Add Author</button>
                </div>

                <div class="row g-4">
                    <div class="col-md-12">
                        <div class="card p-4">
                            <div class="table-responsive p-2">
                                <table class="table table-striped table-bordered" id="myTable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Author Name</th>
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



    <!-- Modal -->
    <div class="modal fade" id="open_auth_model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Author</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="p-2">
                        <form>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label"> Author</label>
                                <input type="text" class="form-control" id="author" placeholder="Enter Author">
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="save_auth">Save </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <!-- Edit Model -->
    <div class="modal fade" id="edit_auth_model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Author</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="p-2">
                        <form>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label"> Author</label>
                                <input type="text" class="form-control" id="edit_author" placeholder="Enter Category">
                            </div>
                            <input type="hidden" id="hid_id">

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="update_auth">update </button>
                            </div>
                        </form>
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
                url: "<?= base_url('AuthorController/get_author') ?>",
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
        $(document).ready(function () {
            $('#add_author').click(function () {
                $('#open_auth_model').modal('show');
            });
        });


        // start save category ajax call

        $(document).ready(function () {
            $('#save_auth').click(function () {
                let author = $('#author').val();

                if (author === '') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Empty Field',
                        text: 'Please enter a author name!',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    });
                    return false;
                }

                $.ajax({
                    url: "<?php echo base_url('AuthorController/save_author') ?>",
                    type: "POST",
                    data: { author: author },
                    dataType: "json",
                    success: function (data) {
                        Swal.fire({
                            icon: data.status,
                            title: data.status.charAt(0).toUpperCase() + data.status.slice(1),
                            text: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        });

                        if (data.status === 'success') {
                            $('#author').val('');
                            $('#open_auth_model').modal('hide');
                            $('#myTable').DataTable().ajax.reload();

                        }
                    }
                });
            });
        });

    </script>


    <script>
        function edit_auth(id) {
            // alert(id);
            $('#edit_auth_model').modal('show');
            $('#hid_id').val(id);

            $.ajax({
                url: "<?php echo base_url('AuthorController/edit_auth') ?>",
                type: "POST",
                data: { id: id },
                dataType: "json",
                success: function (data) {
                    // console.log(data);
                    $('#edit_author').val(data.a_author_name);
                }
            });
        }


        $(document).ready(function () {
            $('#update_auth').click(function () {
                let edit_author = $('#edit_author').val();
                let hid_id = $('#hid_id').val();


                if (edit_author == '') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Empty Field',
                        text: 'Please enter a Author name!',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    });
                    return false;
                }

                $.ajax({
                    url: "<?php echo base_url('AuthorController/update_author') ?>",
                    type: "POST",
                    data: { edit_author: edit_author, hid_id: hid_id },
                    dataType: "json",
                    success: function (data) {
                        Swal.fire({
                            icon: data.status,
                            title: data.status.charAt(0).toUpperCase() + data.status.slice(1),
                            text: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        });

                        if (data.status === 'success') {
                            $('#edit_auth_model').modal('hide');
                            $('#myTable').DataTable().ajax.reload();
                        }
                    }
                });


            });
        });
    </script>

    <script>
        function delete_auth(id) {
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
                        url: "<?= base_url('AuthorController/delete_author') ?>",
                        type: "POST",
                        data: { id: id },
                        dataType: "json",
                        success: function (response) {
                            if (response.status === 'success') {
                                Swal.fire(
                                    'Deleted!',
                                    response.message || 'Author has been deleted.',
                                    'success'
                                );
                                $('#myTable').DataTable().ajax.reload();
                            } else {
                                Swal.fire(
                                    'Error!',
                                    response.message || 'Could not delete the author.',
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