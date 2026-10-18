<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Add Blog </title>

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
                    <h3 class="">Add Blog</h3>
                    <a href="<?php echo base_url('BlogController') ?>" class="btn btn-primary">Show Blog</a>
                </div>

                <div class="row g-4">
                    <div class="col-md-12">
                        <div class="card p-4">
                            <div class="card-header">
                                <h3>Add Blog</h3>
                            </div>

                            <div class="card-body">

                                <form id="addBlogForm" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="" class="form-label">Select Category</label>
                                            <select class="form-control" name="category" id="" required>
                                                <option value="">Select Category</option>
                                                <?php foreach ($category as $val): ?>
                                                    <option value="<?php echo $val->c_auto_id ?>">
                                                        <?php echo $val->c_category ?>
                                                    </option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="" class="form-label" required>Select Author</label>
                                            <select class="form-control" name="author" id="">
                                                <option value="">Select Author</option>
                                                <?php foreach ($author as $val): ?>
                                                    <option value="<?php echo $val->a_auto_id ?>">
                                                        <?php echo $val->a_author_name ?>
                                                    </option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="" class="form-label">Add Title</label>
                                            <input type="text" class="form-control" id="" name="add_title" placeholder="Add Title" required>
                                        </div>



                                        <div class="col-md-6 mb-3">
                                            <label for="" class="form-label">Short Content</label>
                                            <textarea class="form-control" name="short_content" id=""
                                                placeholder="Enter short content" required></textarea>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="" class="form-label">Main Content</label>
                                            <textarea class="form-control" name="main_content" id=""
                                                placeholder="Enter Main content" rows="4" cols="50" required></textarea>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="" class="form-label">Blog Image</label>
                                            <input type="file" class="form-control" id="" name="image" required>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="" class="form-label">Meta Title</label>
                                            <input type="text" class="form-control" id="" name="meta_title" placeholder="Add Meta Title" required>
                                        </div>


                                        <div class="col-md-6 mb-3">
                                            <label for="" class="form-label"> Meta description </label>
                                             <textarea class="form-control" name="meta_description" id=""
                                               placeholder="Add Meta description" required></textarea>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="" class="form-label">Meta keywords </label>
                                            <input type="text" class="form-control" id="" name="meta_keywords" placeholder="Add Meta keywords" required>
                                        </div>


                                    </div>

                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>

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
        $(document).ready(function () {
            $('#addBlogForm').on('submit', function (e) {
                e.preventDefault();


                let formData = new FormData(this);
                console.log(formData);

                $.ajax({
                    url: "<?= base_url('BlogController/insert_blog') ?>",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function (response) {
                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message,
                                showConfirmButton: false,
                                timer: 1500
                            });

                            $('#addBlogForm')[0].reset();
                            setTimeout(function () {
                                window.location.href = "<?= base_url('BlogController') ?>";
                            }, 1500)

                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message || 'Something went wrong!',
                                confirmButtonColor: '#3085d6'
                            });
                        }
                    },
                    error: function () {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'AJAX request failed.',
                            confirmButtonColor: '#3085d6'
                        });
                    }
                });
            });
        });
    </script>


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



</body>

</html>