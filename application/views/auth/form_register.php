<div class="form-container sign-up-container">
    <div class="form-group">

    </div>
    <form method="POST" action="<?php echo base_url('auth/register') ?>">

        <h1>Create Account</h1>
        <div class="form-group">

        </div>

        <input type="text" name="username" id="username" required placeholder="Username">

        <input type="text" name="nama_depan" id="nama_depan" required placeholder="First Name">


        <input type="text" name="nama_belakang" id="nama_belakang" required placeholder="Last Name">


        <input type="email" name="email" id="email" required placeholder="Email">


        <input type="password" name="password" id="password" required placeholder="Password">

        <select id="unit" name="unit" class="form-control" style="margin-bottom: 20px;">
            <?php foreach ($units as $unit) : ?>
                <option value="<?php echo $unit->unit_id; ?>"><?php echo $unit->unit_name; ?></option>
            <?php endforeach; ?>
        </select>


        <button type="submit">Register</button>
    </form>
</div>