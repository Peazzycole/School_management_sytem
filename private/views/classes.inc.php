<div class="container-fluid p-4 shadow mx-auto mt-3" style="max-width: 1200px;">
    <table class="table table-striped table-hover">
        <tr>
            <th>Details</th>
            <th>Class Name</th>
            <th>Created by</th>
            <th>Date</th>

            <?php if (Auth::access('admin')) : ?>
                <th>
                    <a href=" <?= ROOT ?>/classes/add">
                        <button class="btn btn-sm btn-primary float-end"><i class="fa fa-plus"> Add new</i></button>
                    </a>
                </th>
            <?php else : ?>
                <th></th>
            <?php endif; ?>


        </tr>


        <?php if (isset($rows) && $rows) : ?>
            <?php foreach ($rows as $row) : ?>
                <?php if ($row->school_id == $_SESSION['USER']->school_id) : ?>
                    <tr>
                        <td><a href=" <?= ROOT ?>/single_class/<?= $row->class_id ?>">
                                <button class="btn btn-sm btn-primary"><i class="fa fa-chevron-right"></i></button>
                            </a></td>
                        <td>
                            <?= $row->class ?>
                        </td>
                        <td>
                            <?= $row->user->firstname ?> <?= $row->user->lastname ?>
                        </td>
                        <td>
                            <?= get_date($row->date) ?>
                        </td>
                        <td>
                            <?php if (Auth::access('lecturer')) : ?>
                                <a href=" <?= ROOT ?>/classes/delete/<?= $row->id ?>">
                                    <button class="btn btn-sm btn-danger float-end"> <i class="fa fa-trash-alt"></i></button>
                                </a>
                                <a href=" <?= ROOT ?>/classes/edit/<?= $row->id ?>">
                                    <button class="btn btn-sm btn-info text-white float-end me-2"> <i class="fa fa-edit"></i></button>
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>

                <?php endif; ?>
            <?php endforeach; ?>
        <?php else : ?>
            <center>
                <h4>No classes were found at this time</h4>
            </center>
        <?php endif; ?>
    </table>
</div>