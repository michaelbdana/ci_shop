<!-- Sidebar -->
<div class="nav-left-sidebar sidebar-dark">
<div class="menu-list">
<nav class="navbar navbar-expand-lg navbar-light">
    <a class="d-xl-none d-lg-none" href="<?= base_url('dashboard'); ?>"><?= getenv("APPNAME"); ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav flex-column">
            <li class="nav-divider">Menu</li>
            <li class="nav-item">
                <a class="nav-link" href="<?= url_to('dashboard') ?>"><i class="fas fa-fw fa-link"></i>Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= url_to('products') ?>"><i class="fas fa-fw fa-tags"></i>Products</a>
            </li>
        </ul>
    </div>

</nav>
</div>
</div>
