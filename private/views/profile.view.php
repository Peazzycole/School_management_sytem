<?php $this->view('includes/header') ?>
<?php $this->view('includes/nav') ?>

<div class="container-fluid p-4 shadow mx-auto mt-3" style="max-width: 1000px;">
    <?php $this->view('includes/crumbs', ['crumbs' => $crumbs]) ?>
    <?php if (is_object($row)) : ?>


        <div class="row">
            <div class="col-md-4 col-sm-12">
                <?php if ($row->gender == 'female' && empty($row->image)) : ?>
                    <img src="<?= ROOT ?>/assests/user_female.jpg" class="rounded-circle card-img-top w-75 d-block mx-auto mt-1" style="width:150px" />
                <?php elseif ($row->gender == 'male' && empty($row->image)) : ?>
                    <img src="<?= ROOT ?>/assests/user_male.jpg" class="rounded-circle card-img-top w-75 d-block mx-auto mt-1 " style="width:150px" />
                <?php else : ?>
                    <img src="<?= ROOT ?>/<?= $row->image ?>" class="rounded-circle card-img-top w-75 d-block mx-auto mt-1" style="width:150px" />
                <?php endif; ?>
                <h3 class="text-center mt-1"><?= esc($row->firstname) ?> <?= esc($row->lastname) ?></h3>
                <?php if (Auth::access('admin')) : ?>
                    <div class="text-center">
                        <a href="<?= ROOT ?>/profile/edit/<?= $row->user_id ?>">
                            <button class="mt-2 btn btn-sm btn-success">Edit Profile</button>
                        </a>
                        <a href="<?= ROOT ?>/profile/delete/<?= $row->user_id ?>">
                            <button class="mt-2 btn btn-sm btn-danger">Delete Profile</button>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-md-8 col-sm-12 bg-light p-2 ">
                <table class="table table-hover table-striped table-bordered">
                    <tr>
                        <th>First Name:</th>
                        <td><?= esc($row->firstname) ?></td>
                    </tr>
                    <tr>
                        <th>Last Name</th>
                        <td><?= esc($row->lastname) ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?= esc($row->email) ?></td>
                    </tr>
                    <tr>
                        <th>Gender:</th>
                        <td><?= esc(ucfirst($row->gender)) ?></td>
                    </tr>
                    <tr>
                        <th>Rank:</th>
                        <td><?= esc(ucfirst(str_replace("er", "er ", ($row->rank)))) ?></td>
                    </tr>
                    <tr>
                        <th>Date Created:</th>
                        <td><?= esc(get_date($row->date)) ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <hr>
        <div class="container-fluid">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link <?= $page_tab == 'info' ? 'active' : '' ?>" aria-current="page" href="<?= ROOT ?>/profile/<?= $row->user_id ?>">Basic Info</a>
                </li>
                <?php if (Auth::access('lecturer') || Auth::iOwnContent($row)) : ?>
                    <li class="nav-item">
                        <a class="nav-link <?= $page_tab == 'classes' ? 'active' : '' ?>" href="<?= ROOT ?>/profile/<?= $row->user_id ?>?tab=classes">Classes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $page_tab == 'tests' ? 'active' : '' ?>" href="<?= ROOT ?>/profile/<?= $row->user_id ?>?tab=tests">Tests</a>
                    </li>
                <?php endif; ?>
            </ul>

            <?php
            switch ($page_tab) {
                case 'info':
                    include(views_path('profile-tab-info'));
                    break;
                case 'classes':
                    if (Auth::access('lecturer') || Auth::iOwnContent($row)) {
                        include(views_path('profile-tab-classes'));
                    } else {
                        include(views_path('access-denied'));
                    }
                    break;
                case 'tests':
                    include(views_path('profile-tab-tests'));
                    break;
            }
            ?>

        </div>
    <?php else : ?>
        <h4 class="text-center">That profile was not found!</h4>
    <?php endif; ?>
</div>

<?php $this->view('includes/footer') ?>