<div class="col-md-2 sidebar">
    <ul class="list-unstyled">
        <li><a href="<?= base_url('Dashboard') ?>" class="m-2 rounded-3"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a></li>
        <li><a href="<?= base_url('CategoryController') ?>" class="m-2 rounded-3"><i class="bi bi-gear me-2"></i> Manage Category</a></li>
        <li><a href="<?= base_url('AuthorController') ?>" class="m-2 rounded-3"><i class="bi bi-person me-2"></i> Manage Author</a></li>
        <li><a href="<?= base_url('BlogController') ?>" class="m-2 rounded-3"><i class="bi bi-journal-text me-2"></i> Manage Blog</a></li>
    </ul>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
$(document).ready(function () {
    var currentURL = window.location.href;

    $('.sidebar a').each(function () {
        if (this.href === currentURL) {
            $(this).addClass('active');
        }
    });
});
</script>
