<div class="card m-2 shadow" style="max-width: 12rem; min-width: 12rem;">
    <?php if ($row->gender == 'female' && empty($row->image)) : ?>
        <img src="<?= ROOT ?>/assests/user_female.jpg" class="rounded-circle card-img-top w-75 d-block mx-auto mt-1" style="width:150px" />
    <?php elseif ($row->gender == 'male' && empty($row->image)) : ?>
        <img src="<?= ROOT ?>/assests/user_male.jpg" class="rounded-circle card-img-top w-75 d-block mx-auto mt-1 " style="width:150px" />
    <?php else : ?>
        <img src="<?= ROOT ?>/<?= $row->image ?>" class="rounded-circle card-img-top w-75 d-block mx-auto mt-1" style="width:150px" />
    <?php endif; ?>
    <div class="card-body">
        <h5 class="card-title"><?= $row->firstname ?> <?= $row->lastname ?></h5>
        <p class="card-text"><?= strtoupper($row->rank) ?></p>
        <a href="<?= ROOT ?>/profile/<?= $row->user_id ?>" class="btn btn-primary ">Profile</a>

        <?php if (isset($_GET['select'])) : ?>
            <button name="selected" value="<?= $row->user_id ?>" class="btn btn-danger float-end">Select</button>
        <?php endif; ?>
    </div>
</div>