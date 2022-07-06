<style>
    nav ul li a {
        width: 150px;
        text-align: center;
        border-left: 1px solid #eee;
        border-right: 1px solid #fff;
    }

    nav ul li a:hover {
        background-color: gray !important;
        color: white !important;
    }
</style>


<nav class="navbar navbar-expand-lg bg-light p-2">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= ROOT ?>">
            <img src="<?= ROOT ?>/assests/logo.png" style="width: 50px;" />
            <?= Auth::getSchool_name() ?>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="<?= ROOT ?>">DASHBOARD</a>
                </li>
                <?php if (Auth::access('superAdmin')) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= ROOT ?>/schools">SCHOOLS</a>
                    </li>
                <?php endif; ?>
                <?php if (Auth::access('admin')) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= ROOT ?>/users">STAFFS</a>
                    </li>
                <?php endif; ?>

                <?php if (Auth::access('reception')) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= ROOT ?>/students">STUDENTS</a>
                    </li>
                <?php endif; ?>

                <?php if (Auth::access('admin')) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= ROOT ?>/classes">CLASSES</a>
                    </li>
                <?php endif; ?>

                <li class="nav-item">
                    <a class="nav-link" href="<?= ROOT ?>/tests">TESTS</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?= Auth::getFirstname() ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="<?= ROOT ?>/profile">Profile</a></li>
                        <li><a class="dropdown-item" href="<?= ROOT ?>">Dashboard</a></li>
                        <div class="dropdown-divider"></div>
                        <li><a class="dropdown-item" href="<?= ROOT ?>/logout">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>