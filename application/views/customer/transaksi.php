<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<div class="d-flex" id="wrapper">
    <div class="container mt-4">
        <h2 class="text-start">Upload Dokumen</h2>
        <form method="post" action="<?php echo base_url('customer/dokumen/upload'); ?>" enctype="multipart/form-data">
            <div class="form-row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="from">User:</label>
                        <input type="text" id="from" name="from" class="form-control" value="<?php echo $this->session->userdata('user')->Nama_Depan; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="to">Kepada:</label>
                        <select id="to" name="to" class="form-control">
                            <?php foreach ($roles as $role) : ?>
                                <option value="<?php echo $role->ID; ?>"><?php echo $role->Nama_Role; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subject">Subjek:</label>
                        <input type="text" id="subject" name="subject" class="form-control" placeholder="Isi Subjek">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="dokumen">Upload Dokumen:</label>
                <input type="file" id="dokumen" name="dokumen" class="form-control-file">
            </div>
            <span class="m-2"><?php echo $this->session->flashdata('message') ?></span>
            <div class="form-group">
                <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Send File</button>
            </div>
        </form>
    </div>
</div>


<!-- Include Bootstrap and FontAwesome CSS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>