<div class="card-group justify-content-center">

    <form action="" method="POST" style="width: 330px;">
        <h3 class="text-center">Add New Test</h3>
        <?php if (count($errors) > 0) : ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Errors:</strong>
                <?php foreach ($errors as $error) : ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <input autofocus type="text" value="<?= get_var('test') ?>" class="form-control" name="test" placeholder="Test Name"><br>
        <textarea placeholder="Add a description for the test" class="form-control" name="description" id="" cols="30" rows="5"><?= get_var('test') ?></textarea><br>
        <input type="submit" class="btn btn-primary float-end" value="Create">
        <a href="<?= ROOT ?>/single_class/<?= $row->class_id ?>?tab=tests">
            <input type="button" class="btn btn-warning text-white" value="Cancel">
        </a>
    </form>

</div>