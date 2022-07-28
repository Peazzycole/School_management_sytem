<center>
    <h5>Test Questions</h5>
</center>

<div class="btn-group">
    <button type="button" class="btn btn-danger"><i class="fa fa-bars"></i> Action</button>
    <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
        <span class="visually-hidden">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href=" <?= ROOT ?>/single_test/addSubjective/<?= $row->test_id ?>">Add Multiple Choice Questions</a></li>
        <li><a class="dropdown-item" href="<?= ROOT ?>/single_test/addSubjective/<?= $row->test_id ?>">Add Objective Questions</a></li>
        <li>
            <hr class="dropdown-divider">
        </li>
        <li><a class="dropdown-item" href="<?= ROOT ?>/single_test/addSubjective/<?= $row->test_id ?>">Add Subjective Questions</a></li>
    </ul>
</div>