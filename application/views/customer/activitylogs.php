<link href="<?php echo base_url() ?>assets/css/logstyle.css" rel="stylesheet">
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

<div class="main">
    <h3 class="head">Document Tracking</h3>
    <div class="container">
        <ul>
            <?php foreach ($logs as $log) { ?>
                <li>
                    <h3 class="heading"><?php echo $log->Nama_Role ?></h3>
                    <p><?php echo $log->Aktivitas ?> </p>
                    <a href="#">Read More ></a>
                    <span class="date"><?php echo $log->Waktu ?></span>
                    <span class="circle"></span>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>