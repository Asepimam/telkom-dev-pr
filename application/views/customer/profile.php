<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 justify-content-x">
            <?= $this->session->flashdata('pesan'); ?>
        </div>
    </div>

    <div class="card mb-3" style="max-width: 540px;">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="card-img" alt="User Image">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?= $user['nama_depan'] . ' ' . $user['nama_belakang']; ?></h5>
                    <p class="card-text"><?= $user['email']; ?></p>
                    <p class="card-text"><?= $user['unit']; ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="btn btn-info ml-3 my-3">
        <a href="<?= base_url('customer/ubahprofile'); ?>" class="text text-white">
            <i class="fas fa-user-edit"></i> Ubah Profil
        </a>
    </div>
</div>
<!-- /.container-fluid -->
<!-- End of Main Content -->
