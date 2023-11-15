<div class="form-container sign-in-container">
    <form method="POST" action="<?php echo base_url('auth/login') ?>">
        <h1>Sign in</h1>
        <div class="form-group">

        </div>


        <input id="username" type="username" name="username" placeholder="Username" />
        <?php echo form_error('username', '<div class="text-danger text-small">', '</div>') ?>

        <input id="password" type="password" name="password" placeholder="Password" />
        <?php echo form_error('password', '<div class="text-danger text-small">', '</div>') ?>

        <span class="m-2"><?php echo $this->session->flashdata('pesan') ?></span>



        <button type="submit">Login</button>

    </form>
</div>