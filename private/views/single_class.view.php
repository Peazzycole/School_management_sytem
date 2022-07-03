<?php $this->view('includes/header') ?>
<?php $this->view('includes/nav') ?>

<style>
    .user-nav {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
</style>

<div class="container-fluid p-4 shadow mx-auto mt-3" style="max-width: 1000px;">
    <?php $this->view('includes/crumbs', ['crumbs' => $crumbs]) ?>
    <?php if (is_object($row)) : ?>



        <center>
            <h2><?= esc(ucwords($row->class)) ?></h2>
        </center>

        <table class="table table-hover table-striped table-bordered">
            <tr>
                <th>Created By:</th>
                <td><?= esc($row->user->firstname) ?> <?= esc($row->user->lastname) ?></td>

                <th>Date Created:</th>
                <td><?= esc(get_date($row->date)) ?></td>
            </tr>
        </table>


        <hr>
        <div class="container-fluid">
            <ul class="nav nav-tabs">

                <li class="nav-item">
                    <a class="nav-link <?= $page_tab == 'lecturers' ? 'active' : ''; ?>" aria-current="page" href=" <?= ROOT ?>/single_class/<?= $row->class_id ?>?tab=lecturers">
                        Lecturers</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= $page_tab == 'students' ? 'active' : ''; ?>" href=" <?= ROOT ?>/single_class/<?= $row->class_id ?>?tab=students"> Students</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= $page_tab == 'tests' ? 'active' : ''; ?>" href="<?= ROOT ?>/single_class/<?= $row->class_id ?>?tab=tests">Tests</a>
                </li>
            </ul>



            <?php
            switch ($page_tab) {
                case 'lecturers':
                    include(views_path('class-tab-lecturers'));
                    break;
                case 'students':
                    include(views_path('class-tab-students'));
                    break;
                case 'tests':
                    include(views_path('class-tab-tests'));
                    break;
                case 'lecturers-add':
                    include(views_path('class-tab-lecturers-add'));
                    break;
                case 'lecturers-remove':
                    include(views_path('class-tab-lecturers-remove'));
                    break;
                case 'students-remove':
                    include(views_path('class-tab-students-remove'));
                    break;
                case 'students-add':
                    include(views_path('class-tab-students-add'));
                    break;
                case 'tests-add':
                    include(views_path('class-tab-tests-add'));
                    break;
                default:

                    break;
            }
            ?>
        </div>
    <?php else : ?>
        <h4 class="text-center">That Class was not found!</h4>
    <?php endif; ?>
</div>

<?php $this->view('includes/footer') ?>