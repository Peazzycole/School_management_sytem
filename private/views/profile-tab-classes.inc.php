<h3>My Classes</h3>
<nav class="navbar bg-light">
    <form class="container-fluid">
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i>&nbsp</span>
            <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="basic-addon1">
        </div>
    </form>
</nav>




<?php $rows = $student_classes; ?>
<?php include(views_path('classes')) ?>