<form method="POST" action="" class="mx-auto" style="width: 100%; max-width: 400px;">
    <br>
    <h4>Remove Lecturer</h4>
    <?php if (count($errors) > 0) : ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Errors:</strong>
            <?php foreach ($errors as $error) : ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <input class="form-control" type="text" name="name" value="<?= get_var('name') ?>" placeholder="Lecturer Name" autofocus>
    <br><a href="<?= ROOT ?>/single_class/<?= $row->class_id ?>?tab=lecturers"><button type="button" class="btn btn-danger  px-4">Cancel</button></a>
    <button class="btn btn-primary float-end px-4" name="search">Search</button>
    <div class="clearfix"></div>
</form><br>

<div class="card-group justify-content-center">
    <form action="" method="POST">
        <?php if (isset($results) && is_array($results)) : ?>

            <div class="card-group justify-content-center">

                <?php foreach ($results as $row) : ?>
                    <?php include(views_path('user')) ?>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <?php if (count($_POST) > 0) : ?>
                <hr>
                <center>
                    <h4 class="mt-4">
                        No Results were found
                    </h4>
                </center>
            <?php endif ?>
        <?php endif; ?>
    </form>

</div>