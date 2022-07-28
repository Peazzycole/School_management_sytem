<center>
    <h4>Add Subjective Questions</h4>
</center>

<form action="" method="POST" enctype="multipart/form-data">

    <?php if (count($errors) > 0) : ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Errors:</strong>
            <?php foreach ($errors as $error) : ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <label>Questions</label>
    <textarea autofocus name="question" id="" cols="30" rows="10" class="form-control" placeholder="Type your question here"></textarea>
    <div class="input-group mb-3 pt-4">
        <label class="input-group-text" for="inputGroupFile01"> <i class="fa fa-image"></i>Image</label>
        <input type="file" class="form-control" id="inputGroupFile01">
    </div>
    <a href="<?= ROOT ?>/single_test/<?= $row->test_id ?>">
        <button type="button" class="btn btn-danger px-4">Back</button>
    </a>
    <button type="submit" class="btn btn-primary float-end px-4">Save Question</button>

</form>