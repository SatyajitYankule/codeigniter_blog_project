<!-- Navbar -->
<nav class="navbar navbar-expand-lg py-3">
    <div class="container-fluid px-4">
        <a class="navbar-brand" href="">Dashboard</a>
        <div class="ms-auto d-flex align-items-center gap-3">
            <span class="text-dark">Welcome, <?php echo $this->session->username ?></span>
            <a href="<?php echo base_url('Login/logout') ?>" class="btn btn-sm btn-outline-danger"><i class="bi bi-box-arrow-right"></i>
                Logout</a>
        </div>
    </div>
</nav>