<?php $this->view('includes/header') ?>
<?php $this->view('includes/nav') ?>

<style>
    .user-nav {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
</style>

<div class="container-fluid p-4 shadow mx-auto mt-3 mb-5" style="max-width: 1000px;">
    <?php $this->view('includes/crumbs', ['crumbs' => $crumbs]) ?>
    <?php if (is_object($row)) : ?>



        <center>
            <h2><?= esc(ucwords($row->test)) ?></h2>
        </center>

        <table class="table table-hover table-striped table-bordered">
            <tr>
                <th>Created By:</th>
                <td><?= esc($row->user->firstname) ?> <?= esc($row->user->lastname) ?></td>

                <th>Date Created:</th>
                <td><?= esc(get_date($row->date)) ?></td>

                <td>
                    <a href=" <?= ROOT ?>/single_class/<?= $row->class_id ?>?tab=tests">
                        <button class="btn btn-sm btn-primary"><i class="fa fa-chevron-right"> View Class</i></button>
                    </a>
                </td>
                </td>
            </tr>
            <?php $active = $row->disabled ? "NO" : "Yes"; ?>
            <tr>
                <td><b>Active: </b> <?= esc($active) ?></td>
                <td colspan="5"><b>Test Description: </b><br> <?= esc($row->description) ?></td>

            </tr>
        </table>


        <hr>
        <div class="container-fluid">


            <?php
            switch ($page_tab) {
                case 'view':
                    include(views_path('test-tab-view'));
                    break;
                case 'add-subjective':
                    include(views_path('test-tab-add-subjective'));
                    break;
                case 'add-multiple':
                    include(views_path('test-tab-add-multiple'));
                    break;
                case 'add-objective':
                    include(views_path('test-tab-add-objective'));
                    break;
                case 'edit':
                    include(views_path('test-tab-edit'));
                    break;
                case 'delete':
                    include(views_path('test-tab-delete'));
                    break;
                default:

                    break;
            }
            ?>
        </div>
    <?php else : ?>
        <h4 class="text-center">That Test was not found!</h4>
    <?php endif; ?>
</div>

<?php $this->view('includes/footer') ?>