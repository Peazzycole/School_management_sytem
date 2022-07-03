<?php $this->view('includes/header') ?>
<?php $this->view('includes/nav') ?>

<style>
    h5 {
        text-align: center;
        font-size: 2rem;

    }
</style>


<div class="container-fluid">

    <div class="container-fluid p-4 shadow mx-auto mt-3" style="max-width: 1200px;">

        <?php $this->view('includes/crumbs', ['crumbs' => $crumbs]) ?>
        <h5>Schools</h5>
        <div class="card-group justify-content-center">


            <table class="table table-striped table-hover">
                <tr>
                    <th>Details</th>
                    <th>School</th>
                    <th>Created by</th>
                    <th>Date</th>
                    <th>
                        <a href=" <?= ROOT ?>/schools/add">
                            <button class="btn btn-sm btn-primary float-end"><i class="fa fa-plus"> Add new</i></button>
                        </a>
                    </th>

                </tr>


                <?php if (is_array($rows)) : ?>
                    <?php foreach ($rows as $row) : ?>

                        <tr>
                            <td><button class="btn btn-sm btn-primary"><i class="fa fa-chevron-right"></i></button></td>
                            <td>
                                <?= $row->school ?>
                            </td>
                            <td>
                                <?= $row->user->firstname ?> <?= $row->user->lastname ?>
                            </td>
                            <td>
                                <?= get_date($row->date) ?>
                            </td>
                            <td>
                                <a href=" <?= ROOT ?>/switch_school/<?= $row->id ?>">
                                    <button class="btn btn-sm btn-success float-end px-4 ms-5">Switch <i class="fa fa-chevron-right"></i></button>
                                </a>
                                <a href=" <?= ROOT ?>/schools/delete/<?= $row->id ?>">
                                    <button class="btn btn-sm btn-danger float-end"> <i class="fa fa-trash-alt"></i></button>
                                </a>
                                <a href=" <?= ROOT ?>/schools/edit/<?= $row->id ?>">
                                    <button class="btn btn-sm btn-info text-white float-end me-2"> <i class="fa fa-edit"></i></button>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <h4>No schools were found at this time</h4>
                <?php endif; ?>
            </table>
        </div>



    </div>

    <?php $this->view('includes/footer') ?>