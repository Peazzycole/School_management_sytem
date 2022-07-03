<?php $this->view('includes/header') ?>

<div class="container-fluid ">
    <form method="POST">
        <div class="p-4 login mx-auto shadow rounded">
            <h2>My School</h2>
            <img id="logo--img" src="https://fiverr-res.cloudinary.com/images/t_main1,q_auto,f_auto,q_auto,f_auto/gigs/182931242/original/dd61e730a9d6f9feb32b9f324517c785644e43da/design-university-school-company-and-college-logo.jpg" />
            <h3>Login</h3>

            <?php if (count($errors) > 0) : ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Errors:</strong>
                    <?php foreach ($errors as $error) : ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <input class="form-control" type="email" value="<?= get_var('email') ?>" name="email" placeholder="Email" autofocus><br>
            <input class="form-control" type="password" value="<?= get_var('password') ?>" name="password" placeholder="Password">
            <br>
            <div class="d-grid">
                <button class="btn btn-primary block">Login</button>
            </div>
            <h4 class="text-center my-3">Or</h4>
            <div class="d-grid">
                <a href="<?= ROOT ?>/signup" class="btn btn-success block">Sign Up</a>
            </div>

        </div>
    </form>
</div>


<?php $this->view('includes/footer') ?>