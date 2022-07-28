<div class="user-nav">
    <nav class="navbar bg-light">
        <form class="container-fluid">
            <div class="input-group">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i>&nbsp</span>
                <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="basic-addon1" style="max-width: 400px;">
            </div>
        </form>
    </nav>
    <a href="<?= ROOT ?>/single_class/testAdd/<?= $row->class_id ?>?tab=test-add">
        <button class="btn btn-sm btn-primary"><i class="fa fa-plus"> Add new Test</i></button>
    </a>
</div>
<table class="table table-striped table-hover">
    <tr>
        <th>Details</th>
        <th>Test Name</th>
        <th>Created by</th>
        <th>Active</th>
        <th>Date</th>
        <th></th>
    </tr>


    <?php if (isset($tests) && $tests) : ?>
        <?php foreach ($tests as $row) : ?>
            <?php if ($row->school_id == $_SESSION['USER']->school_id) : ?>
                <tr>
                    <td><a href=" <?= ROOT ?>/single_test/<?= $row->test_id ?>">
                            <button class="btn btn-sm btn-primary"><i class="fa fa-chevron-right"></i></button>
                        </a></td>
                    <td>
                        <?= $row->test ?>
                    </td>
                    <td>
                        <?= $row->user->firstname ?> <?= $row->user->lastname ?>
                    </td>
                    <?php $active = $row->disabled ? "NO" : "Yes"; ?>
                    <td>
                        <?= $active ?>
                    </td>
                    <td>
                        <?= get_date($row->date) ?>
                    </td>
                    <td>
                        <?php if (Auth::access('lecturer')) : ?>
                            <a href=" <?= ROOT ?>/single_class/testDelete/<?= $row->class_id ?>/<?= $row->test_id ?>?tab=tests">
                                <button class="btn btn-sm btn-danger float-end"> <i class="fa fa-trash-alt"></i></button>
                            </a>
                            <a href=" <?= ROOT ?>/single_class/testEdit/<?= $row->class_id ?>/<?= $row->test_id ?>?tab=tests">
                                <button class="btn btn-sm btn-info text-white float-end me-2"> <i class="fa fa-edit"></i></button>
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>

            <?php endif; ?>
        <?php endforeach; ?>
    <?php else : ?>
        <tr>
            <td colspan="6">
                <center>
                    <h4>No Tests were found at this time</h4>
                </center>
            </td>
        </tr>
    <?php endif; ?>
</table>