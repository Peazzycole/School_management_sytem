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
    <div class="card-group justify-content-center">


        <?php include(views_path('classes')) ?>
    </div>

    <?php $this->view('includes/footer') ?>
</div>