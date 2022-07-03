<?php $this->view('includes/header') ?>



<div class="container-fluid mb-5 mt-5">
    <form method="POST">
        <div class="p-4 signup mx-auto shadow rounded">
            <h2>My School</h2>
            <img id="signup--img" src="https://fiverr-res.cloudinary.com/images/t_main1,q_auto,f_auto,q_auto,f_auto/gigs/182931242/original/dd61e730a9d6f9feb32b9f324517c785644e43da/design-university-school-company-and-college-logo.jpg" />
            <h3>Add User</h3>

            <?php if (count($errors) > 0) : ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Errors:</strong>
                    <?php foreach ($errors as $error) : ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <input class=" mb-3 form-control" type="text" value="<?= get_var('firstname') ?>" type="firstname" name="firstname" placeholder="First Name" autofocus>
            <input class=" mb-3 form-control" type="text" value="<?= get_var('lastname') ?>" type="lastname" name="lastname" placeholder="Last Name">
            <input class=" mb-3 form-control" type="email" value="<?= get_var('email') ?>" type="email" name="email" placeholder="Email">
            <select class=" mb-3 form-control" name=gender>
                <option <?= get_select('gender', '') ?> value="">--Select a Gender--</option>
                <option <?= get_select('gender', 'male') ?> value="male">Male</option>
                <option <?= get_select('gender', 'female') ?> value="female">Female</option>
                <option <?= get_select('gender', 'others') ?> value="others">Others</option>
            </select>

            <?php if ($mode == 'students') :  ?>
                <input type="text" readonly value="student" name="rank" class="form-control mb-3">
            <?php else : ?>
                <select class=" mb-3 form-control" name="rank">
                    <option <?= get_select('rank', '') ?> value="">--Select a Rank--</option>
                    <option <?= get_select('rank', 'student') ?> value="student">Student</option>
                    <option <?= get_select('rank', 'reception') ?> value="reception">Reception</option>
                    <option <?= get_select('rank', 'lecturer') ?> value="lecturer">Lecturer</option>
                    <option <?= get_select('rank', 'admin') ?> value="admin">Admin</option>
                    <?php if (Auth::getRank() == 'superAdmin') : ?>
                        <option <?= get_select('rank', 'superAdmin') ?> value="superAdmin">Super Admin</option>
                    <?php endif ?>

                </select>
            <?php endif; ?>
            <input class=" mb-3 form-control" value="<?= get_var('password') ?>" type="" name="password" placeholder="Password">

            <input class="form-control" value="<?= get_var('password2') ?>" type="" name="password2" placeholder="Confirm Password"><br>

            <div class="d-grid">
                <button class="btn btn-primary block mb-2">Add User</button>

                <?php if ($mode == 'students') :  ?>
                    <a href="<?= ROOT ?>/students" class="btn btn-danger block">Cancel</a>
                <?php else : ?>
                    <a href="<?= ROOT ?>/users" class="btn btn-danger block">Cancel</a>
                <?php endif; ?>
            </div>
        </div>
    </form>
</div>


<?php $this->view('includes/footer') ?>