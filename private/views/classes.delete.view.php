<?php $this->view('includes/header') ?>
<?php $this->view('includes/nav') ?>



<div class="container-fluid">

    <div class="container-fluid p-4 shadow mx-auto mt-3" style="max-width: 1000px;">
        <?php $this->view('includes/crumbs', ['crumbs' => $crumbs]) ?>

        <div class="card-group justify-content-center">
            <?php if ($row) : ?>
                <form action="" method="POST" style="width: 330px;">
                    <h3 class="text-center">Are you sure you want to delete?</h3>
                    <input readonly autofocus type="text" value="<?= get_var('class', $row->class) ?>" class="form-control" name="class" placeholder="Class Name"><br>
                    <input type="submit" class="btn btn-danger float-end" value="Delete">
                    <a href="<?= ROOT ?>/classes">
                        <input type="button" class="btn btn-warning text-white" value="Cancel">
                    </a>
                </form>

            <?php else : ?>
                <div class="text-center">
                    <h3>The Class was not found</h3>
                    <a href="<?= ROOT ?>/classes">
                        <button class="btn btn-danger mt-2 px-5 ">Back</button>
                    </a>
                </div>
            <?php endif; ?>


        </div>



    </div>

    <?php $this->view('includes/footer') ?>