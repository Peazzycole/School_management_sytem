<?php $this->view('includes/header') ?>
<?php $this->view('includes/nav') ?>

<div class="container-fluid p-4 shadow mx-auto mt-3" style="max-width: 1000px;">
    <center>
        <h2>Edit Profile</h2>
    </center>
    <?php if (is_object($row)) : ?>
        <form method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <?php if ($row->gender == 'female' && empty($row->image)) : ?>
                        <img src="<?= ROOT ?>/assests/user_female.jpg" class="rounded-circle card-img-top w-75 d-block mx-auto mt-1" style="width:150px" />
                    <?php elseif ($row->gender == 'male' && empty($row->image)) : ?>
                        <img src="<?= ROOT ?>/assests/user_male.jpg" class="rounded-circle card-img-top w-75 d-block mx-auto mt-1" style="width:150px" />
                    <?php else : ?>
                        <img src="<?= ROOT ?>/<?= $row->image ?>" class="rounded-circle card-img-top w-75 d-block mx-auto mt-1" style="width:150px" />
                    <?php endif; ?>


                    <?php if (Auth::access('admin')) : ?>
                        <div class="text-center">
                            <label for="browseImage" class="btn btn-sm btn-info text-white mt-3">
                                <input onchange="displayName(this.files[0].name)" id="browseImage" type="file" name="image" style="display: none;">
                                Browse Image
                            </label><br>
                            <small class="fileInfo text-muted"></small>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-8 col-sm-12 bg-light p-2 ">
                    <div class="p-4 mr-4 mx-auto shadow rounded">

                        <?php if (count($errors) > 0) : ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Errors:</strong>
                                <?php foreach ($errors as $error) : ?>
                                    <li><?= $error ?></li>
                                <?php endforeach; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>
                        <input class=" mb-3 form-control" type="text" value="<?= get_var('firstname', $row->firstname) ?>" type="firstname" name="firstname" placeholder="First Name" autofocus>
                        <input class=" mb-3 form-control" type="text" value="<?= get_var('lastname', $row->lastname) ?>" type="lastname" name="lastname" placeholder="Last Name">
                        <input class=" mb-3 form-control" type="email" value="<?= get_var('email', $row->email) ?>" type="email" name="email" placeholder="Email">
                        <select class=" mb-3 form-control" name=gender>
                            <option <?= get_select('gender', $row->gender) ?> value="<?= $row->gender ?>"><?= ucwords($row->gender) ?></option>
                            <option <?= get_select('gender', 'male') ?> value="male">Male</option>
                            <option <?= get_select('gender', 'female') ?> value="female">Female</option>
                            <option <?= get_select('gender', 'others') ?> value="others">Others</option>
                        </select>


                        <select class=" mb-3 form-control" name="rank">
                            <option <?= get_select('rank', $row->rank) ?> value="<?= $row->rank ?>"><?= ucwords($row->rank) ?></option>
                            <option <?= get_select('rank', 'student') ?> value="student">Student</option>
                            <option <?= get_select('rank', 'reception') ?> value="reception">Reception</option>
                            <option <?= get_select('rank', 'lecturer') ?> value="lecturer">Lecturer</option>
                            <option <?= get_select('rank', 'admin') ?> value="admin">Admin</option>
                            <?php if (Auth::getRank() == 'superAdmin') : ?>
                                <option <?= get_select('rank', 'superAdmin') ?> value="superAdmin">Super Admin</option>
                            <?php endif ?>

                        </select>

                        <input class=" mb-3 form-control" value="<?= get_var('password') ?>" type="" name="password" placeholder="Password">

                        <input class="form-control" value="<?= get_var('password2') ?>" type="" name="password2" placeholder="Confirm Password"><br>


                        <button class="btn btn-primary float-end">Save Changes</button>
                        <a href="<?= ROOT ?>/profile/<?= $row->user_id ?>">
                            <button type="button" class="btn btn-danger">Back to Profile</button>
                        </a>


                    </div>
                </div>
            </div>
        </form>






</div>
<?php else : ?>
    <h4 class="text-center">That profile was not found!</h4>
<?php endif; ?>
</div>

<script>
    function displayName(fileName) {
        document.querySelector(".fileInfo").innerHTML = '<b>Selected file</b><br>' + fileName;
    }
</script>
<?php $this->view('includes/footer') ?>