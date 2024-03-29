<div class="user-nav">
    <nav class="navbar bg-light">
        <form class="container-fluid">
            <div class="input-group">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i>&nbsp</span>
                <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="basic-addon1" style="max-width: 400px;">
            </div>
        </form>
    </nav>
    <div>
        <a href=" <?= ROOT ?>/single_class/lecturerAdd/<?= $row->class_id ?>?select=true">
            <button class="btn btn-sm btn-primary"><i class="fa fa-plus"> Add new</i></button>
        </a>
        <a href=" <?= ROOT ?>/single_class/lecturerRemove/<?= $row->class_id ?>?select=true">
            <button class="btn btn-sm btn-danger"><i class="fa fa-minus"> Remove</i></button>
        </a>

    </div>
</div>

<div class="card-group justify-content-center">
    <?php if (is_array($lecturers)) : ?>
        <?php foreach ($lecturers as $lecturer) : ?>
            <?php $row = $lecturer->user;
            include(views_path('user')) ?>
        <?php endforeach; ?>

    <?php else : ?>
        <center>
            <h4>No lecturer were found in this class</h4>
        </center>
    <?php endif; ?>
</div>
<?php $pager->display() ?>