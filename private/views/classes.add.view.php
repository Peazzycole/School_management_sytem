<?php $this->view('includes/header') ?>
<?php $this->view('includes/nav') ?>



<div class="container-fluid">

    <div class="container-fluid p-4 shadow mx-auto mt-3" style="max-width: 1000px;">
        <?php $this->view('includes/crumbs', ['crumbs' => $crumbs]) ?>

        <div class="card-group justify-content-center">

            <form action="" method="POST" style="width: 330px;">
                <h3 class="text-center">Add New Class</h3>
                <?php if (count($errors) > 0) : ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Errors:</strong>
                        <?php foreach ($errors as $error) : ?>
                            <li><?= $error ?></li>
                        <?php endforeach; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <input autofocus type="text" value="<?= get_var('class') ?>" class="form-control" name="class" placeholder="School Name"><br>
                <input type="submit" class="btn btn-primary float-end" value="Create">
                <a href="<?= ROOT ?>/classes">
                    <input type="button" class="btn btn-warning text-white" value="Cancel">
                </a>
            </form>

        </div>



    </div>

    <?php $this->view('includes/footer') ?>