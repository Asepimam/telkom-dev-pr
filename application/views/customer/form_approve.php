<div class="container">
    <div class="card mx-auto" style="margin-top: 80px; width: 80%">
        <div class="card-body">
            <form method="post" action="<?= base_url('customer/approved/approved_document_id'); ?>" enctype="multipart/form-data">
                <div class="form-group">
                    <label style="margin-right: 20px;" for="">Document Review </label>
                    <a class="btn btn-primary btn-sm active" href="<?php echo base_url('assets/upload/' . $dokumen->Document); ?>" target="_blank"><?php echo $dokumen->Document; ?></a>

                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="Di Setujui">Di Setujui</option>
                        <option value="Di Tolak">Di Tolak</option>

                    </select>
                </div>
                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="exampleFormControlTextarea1">Catatan</label>
                    <textarea class="form-control" id="catatan" name="catatan" rows="3"></textarea>
                </div>
                <input type="hidden" name="id" value="<?= $dokumen->ID_Doc; ?>">
                <button type="submit" class="btn btn-primary">Send</button>
            </form>
        </div>
    </div>
</div>