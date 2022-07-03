<div class="user-nav">
    <nav class="navbar bg-light">
        <form class="container-fluid">
            <div class="input-group">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i>&nbsp</span>
                <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="basic-addon1" style="max-width: 400px;">
            </div>
        </form>
    </nav>
    <a href="<?= ROOT ?>/single_class/<?= $row->class_id ?>?tab=tests-add">
        <button class="btn btn-sm btn-primary"><i class="fa fa-plus"> Add new Test</i></button>
    </a>
</div>