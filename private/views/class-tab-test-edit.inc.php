<div class="card-group justify-content-center">
    <?php if (isset($testRow) && is_object($testRow)) : ?>
        <form action="" method="POST" style="width: 330px;">
            <h3 class="text-center">Edit Test</h3>
            <?php if (count($errors) > 0) : ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Errors:</strong>
                    <?php foreach ($errors as $error) : ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <input autofocus type="text" value="<?= get_var('test', $testRow->test) ?>" class="form-control" name="test" placeholder="Test Name"><br>
            <textarea placeholder="Add a description for the test" class="form-control" name="description" id="" cols="30" rows="5"><?= get_var('description', $testRow->description) ?></textarea><br>

            <?php
            $disabled = get_var('disabled', $testRow->disabled);
            ?>
            <input type="radio" name="disabled" value="0" <?= $disabled == 0 ? 'checked' : ""   ?>> Active<br>
            <input type="radio" name="disabled" value="1" <?= $disabled == 1 ? 'checked' : ""   ?>> Disabled<br><br>
            <input type="submit" class="btn btn-primary float-end" value="Save">
            <a href="<?= ROOT ?>/single_class/<?= $row->class_id ?>?tab=tests">
                <input type="button" class="btn btn-warning text-white" value="Back">
            </a>
        </form>
    <?php else : ?>
        <div>
            <h3 class="mt-4">Sorry that test was not found</h3>
            <div>
                <center><a href="<?= ROOT ?>/single_class/<?= $row->class_id ?>?tab=tests">
                        <input type="button" class="btn btn-danger text-white" value="Back">
                    </a></center>
            </div>
        </div>
    <?php endif; ?>
</div>