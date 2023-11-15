<div class="container">
    <div class="card mx-auto" style="margin-top: 80px; width: 80%">
        <div class="card-body">
<section class="content-header">
    <h1>Items
        <small>data qrcode</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-Dashboard"></i></a></li>
        <li class="active">Items</li>
</ol>
</section>

<section class="content">
<?php echo $this->session->flashdata('pesan') ?>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">QRcode Generator</h3>
        <div class="pull-right">
        <a href="<?php echo base_url('admin/transaksi') ?>" class="btn btn-default btn-xs">
                <i class="fa fa-undo"></i>Back
            </a>
        </div>
    </div>
</div>

</section>

