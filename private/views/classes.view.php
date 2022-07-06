<?php $this->view('includes/header') ?>
<?php $this->view('includes/nav') ?>

<style>
    h5 {
        text-align: center;
        font-size: 2rem;

    }
</style>


<div class="container-fluid">

    <?php $this->view('includes/crumbs', ['crumbs' => $crumbs]) ?>
    <h5>Classes</h5>

    <nav class="navbar bg-light ms-5">
        <form class="container-fluid">
            <div class="input-group">
                <button class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i>&nbsp</button>
                <input type="text" class="form-control" value="<?= isset($_GET['find']) ? $_GET['find'] : ""; ?>" name="find" placeholder="Search" aria-label="Search" aria-describedby="basic-addon1" style="max-width: 400px;">
            </div>
        </form>
    </nav>
    <div class="card-group justify-content-center">



        <?php include(views_path('classes')) ?>
    </div>

    <?php $this->view('includes/footer') ?>
</div>