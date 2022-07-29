<center>
    <h5>Test Questions</h5>
    <p>Total Questions: <b><?= $totalQuestions ?></b></p>
</center>

<div class="btn-group pb-3">
    <button type="button" class="btn btn-danger"><i class="fa fa-bars"></i> Action</button>
    <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
        <span class="visually-hidden">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href=" <?= ROOT ?>/single_test/addSubjective/<?= $row->test_id ?>type=multiple">Add Multiple Choice Questions</a></li>
        <li><a class="dropdown-item" href="<?= ROOT ?>/single_test/addSubjective/<?= $row->test_id ?>?type=objective">Add Objective Questions</a></li>
        <li>
            <hr class="dropdown-divider">
        </li>
        <li><a class="dropdown-item" href="<?= ROOT ?>/single_test/addSubjective/<?= $row->test_id ?>">Add Subjective Questions</a></li>
    </ul>
</div>

<?php if (isset($questions) && is_array($questions)) : ?>
    <?php $num = $totalQuestions + 1; ?>
    <?php foreach ($questions as $quest) : $num-- ?>
        <div class="card mb-4 shadow">
            <div class="card-header">
                <span class=" rounded p-1 display-6">Question #<?= $num ?> </span> <span class="disabled float-end mt-3"><?= date("F jS, Y H:i:s a", strtotime($quest->date)) ?></span>

            </div>
            <div class="card-body">
                <h5 class="card-title"><?= esc($quest->question) ?></h5>
                <?php if (file_exists($quest->image)) : ?>
                    <img src="<?= ROOT ?>/<?= $quest->image ?>" style="width: 50%;" alt="">
                <?php endif; ?>
                <p class="card-text mt-3 float-end">
                    <button class="btn btn-info text-white"><i class="fa fa-edit"></i></button>
                    <button class="btn btn-danger text-white"><i class="fa fa-trash-alt"></i></button>
                </p>

            </div>
            <div class="card-footer text-muted">
                <p class="m-0"><b><?= $quest->comment ?></b></p>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>