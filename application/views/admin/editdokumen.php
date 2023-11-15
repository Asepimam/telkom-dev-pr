<div class="container">
    <div class="card mx-auto" style="margin-top: 80px; width: 80%">
        <div class="card-body">
            <div class="d-flex justify-content-end">
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" id="searchInput" class="form-control" placeholder="Search Data...">
                    </div>
                </div>
                <div class="col-md-0">
                    <button id="searchButton" class="btn btn-primary">Cari</button>
                </div>
            </div>
            <span class="mt-2 p-2"><?php echo $this->session->flashdata('pesan') ?></span>
            <div class="table-responsive">
                <table class="table table-bordered table-striped mx-auto text-center">
                    <thead class="thead-dark">
                        <tr>
                            <th>PENGIRIM</th>
                            <th>DOKUMEN</th>
                            <th>TUJUAN</th>
                            <th>DESKRIPSI</th>
                            <th>TANGGAL PENGAJUAN</th>
                            <th>STATUS</th>
                            <th>EDIT DOKUMEN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($transaksi as $row) : ?>
                            <tr>
                                <td><?php echo $row->nama_depan; ?></td>
                                <td>
                                    <a href="<?php echo base_url('assets/upload/' . $row->dokumen); ?>" target="_blank"><?php echo $row->dokumen; ?></a><br>
                                    <a href="<?php echo base_url('admin/transaksi/qrcode/' . $row->id_dokumen); ?>" class="btn btn-default btn-xs generate-qrcode">
                                        Generate QR Code <i class="fa fa-qrcode"></i>
                                    </a>
                                </td>
                                <td><?php echo $row->penerima; ?></td>
                                <td><?php echo $row->tujuan; ?></td>
                                <td><?php echo $row->tanggal_upload; ?></td>
                                <td><?php echo $row->tanggal_selesai; ?></td>
                                <td>
                                    <button class="btn btn-danger delete-button" data-id="<?php echo $row->id_dokumen; ?>">Delete</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Event handler untuk tombol "Cari"
        $("#searchButton").on("click", function() {
            performSearch();
        });

        // Event handler untuk menangani tombol "Enter"
        $("#searchInput").on("keypress", function(e) {
            if (e.which === 13) { // 13 adalah kode tombol Enter
                performSearch();
            }
        });
        $(".delete-button").on("click", function() {
            var id_dokumen = $(this).data("id");

            if (confirm("Anda yakin ingin menghapus data ini?")) {
                // Jika user mengonfirmasi, kirim permintaan penghapusan ke server
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('admin/transaksi/delete/'); ?>" + id_dokumen,
                    success: function(response) {
                        if (response === "success") {
                            // Jika penghapusan berhasil, perbarui tampilan
                            $(this).closest("tr").remove();
                        } else {
                            alert("Berhasil dihapus.");
                        }
                        window.location.href = "<?php echo site_url('admin/transaksi'); ?>";
                    }
                });
            }
        });
        // Event handler for generating QR Code
        $(".generate-qrcode").on("click", function(e) {
            e.preventDefault();
            var id_dokumen = $(this).data("id");
            generateQRCode(id_dokumen);
        });

        function generateQRCode(id_dokumen) {
            // Make an AJAX request to generate a QR Code for the given id_dokumen
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('admin/transaksi/generate_qrcode'); ?>",
                data: {
                    id_dokumen: id_dokumen
                },
                success: function(response) {
                    // Reload the page or update the QR Code display as needed
                    window.location.href = "<?php echo site_url('admin/transaksi'); ?>";
                },
                error: function(xhr, status, error) {
                    alert("Error generating QR Code: " + error);
                }
            });
        }


    });

    function performSearch() {
        var searchText = $("#searchInput").val().toLowerCase();

        $("table tbody tr").each(function() {
            var nama = $(this).find("td:eq(0)").text().toLowerCase();
            var penerima = $(this).find("td:eq(2)").text().toLowerCase();
            var tujuan = $(this).find("td:eq(3)").text().toLowerCase();


            if (nama.includes(searchText) || penerima.includes(searchText) || tujuan.includes(searchText)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }
</script>