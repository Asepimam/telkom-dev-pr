<div class="form-container sign-up-container">
    <div class="form-group">

    </div>
    <form method="POST" action="<?php echo base_url('auth/register') ?>">

        <h1>Create Account</h1>
        <div class="form-group">

        </div>

        <!-- <input id="username" type="text" name="username" placeholder="Input Username" />
        <?php echo form_error('username', '<div class="text-small text-danger">', '</div>') ?>


        <input id="nama_depan" type="text" name="nama_depan" placeholder="Input First Name" />
        <?php echo form_error('nama_depan', '<div class="text-small text-danger">', '</div>') ?>


        <input id="nama_belakang" type="text" name="nama_belakang" placeholder="Input Last Name" />
        <?php echo form_error('nama_belakang', '<div class="text-small text-danger">', '</div>') ?>


        <input id="email" type="text" name="email" placeholder="Email" />
        <?php echo form_error('email', '<div class="text-small text-danger">', '</div>') ?>

        <input id="password" type="password" name="password" placeholder="Password" />
        <?php echo form_error('password', '<div class="text-small text-danger">', '</div>') ?> -->

        <!--  buat label dan input sejajar dikanan  -->


        <input type="text" name="username" id="username" required placeholder="Username">

        <input type="text" name="nama_depan" id="nama_depan" required placeholder="First Name">


        <input type="text" name="nama_belakang" id="nama_belakang" required placeholder="Last Name">


        <input type="email" name="email" id="email" required placeholder="Email">


        <input type="password" name="password" id="password" required placeholder="Password">



        <button type="submit">Register</button>
    </form>
</div>