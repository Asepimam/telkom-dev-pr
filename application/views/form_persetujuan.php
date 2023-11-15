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
                            <th>Approved</th>
                            <th>PENGIRIM</th>
                            <th>DOKUMEN</th>
                            <th>SUBJEK</th>
                            <th>TANGGAL PENGAJUAN</th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dokumens as $document) : ?>
                            <tr>

                                <td>
                                    <!-- <a href="#" class="btn btn-primary generate-qr-code" data-dokumen-id="<?php echo $document->ID_Doc; ?>">Generate QR Code</a> -->
                                    <button type="button" class="btn btn-primary generate-qr-code" data-toggle="modal" data-target="#exampleModal" data-dokumen-id="<?php echo $document->ID_Doc; ?>">
                                        Launch demo modal
                                    </button>
                                </td>
                                <td><?php echo $document->Nama_Depan; ?></td>
                                <td><?php echo $document->Document; ?></td>
                                <td><?php echo $document->Deskripsi; ?></td>
                                <td><?php echo $document->created_at; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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

        function performSearch() {
            var searchText = $("#searchInput").val().toLowerCase();

            $("table tbody tr").each(function() {
                var nama = $(this).find("td:eq(1)").text().toLowerCase();
                var penerima = $(this).find("td:eq(3)").text().toLowerCase();
                var tujuan = $(this).find("td:eq(4)").text().toLowerCase();


                if (nama.includes(searchText) || penerima.includes(searchText) || tujuan.includes(searchText)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }

    });
</script>

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- buat body itu ditengah -->
            <div class="modal-body  ">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">QR Code</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="d-flex justify-content-center">

                                            <div class="align-self-center" id="qrcode"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#exampleModal').on('show.bs.modal', function(event) {
            // Ambil ID dokumen dari atribut data
            var dokumenId = $(event.relatedTarget).data("dokumen-id");

            // Generate QR code menggunakan library qrcode.js
            var qrcode = new QRCode(document.getElementById("qrcode"), {
                text: "<?php echo site_url(); ?>customer/approved/approved_document/" + dokumenId,
                width: 200,
                height: 200
            });

            // Set up event handler untuk tombol Tutup
            $("#close-qr-code-dialog").click(function() {
                // Sembunyikan modal QR code
                $('#exampleModal').modal('hide');
            });
        });
    });
</script>