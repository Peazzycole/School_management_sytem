<div class="container-fluid p-4 shadow mx-auto mt-3" style="max-width: 1200px;">
    <table class="table table-striped table-hover">
        <tr>
            <th>Details</th>
            <th>Test Name</th>
            <th>Created by</th>
            <th>Active</th>
            <th>Date</th>
        </tr>


        <?php if (isset($rows) && $rows) : ?>
            <?php foreach ($rows as $row) : ?>
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

                    </tr>

                <?php endif; ?>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="5">
                    <center>
                        <h4>No Tests were found at this time</h4>
                    </center>
                </td>
            </tr>
        <?php endif; ?>
    </table>
</div>