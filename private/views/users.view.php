<?php $this->view('includes/header') ?>
<?php $this->view('includes/nav') ?>

<style>
    h4 {
        text-align: center;
    }

    .user-nav {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
</style>


<div class="container-fluid">

    <div class="container-fluid p-4 shadow mx-auto mt-3 mb-3" style="max-width: 1000px;">
        <?php $this->view('includes/crumbs', ['crumbs' => $crumbs]) ?>
        <div class="user-nav">
            <nav class="navbar bg-light">
                <form class="container-fluid">
                    <div class="input-group">
                        <button class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i>&nbsp</button>
                        <input type="text" class="form-control" value="<?= isset($_GET['find']) ? $_GET['find'] : ""; ?>" name="find" placeholder="Search" aria-label="Search" aria-describedby="basic-addon1" style="max-width: 400px;">
                    </div>
                </form>
            </nav>
            <a href=" <?= ROOT ?>/signup">
                <button class="btn btn-sm btn-primary"><i class="fa fa-plus"> Add new</i></button>
            </a>
        </div>
        <div class="card-group justify-content-center">

            <?php if (is_array($rows)) : ?>
                <?php foreach ($rows as $row) : ?>

                    <?php include(views_path('user')) ?>

                <?php endforeach; ?>
            <?php else : ?>
                <h4>
                    No Staffs members
                </h4>
            <?php endif; ?>
        </div>



    </div>

    <?php $this->view('includes/footer') ?>