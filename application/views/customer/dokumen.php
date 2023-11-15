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
                            <th>LOG</th>
                            <th>PENGIRIM</th>
                            <th>DOKUMEN</th>
                            <th>TUJUAN</th>
                            <th>SUBJEK</th>
                            <th>TANGGAL PENGAJUAN</th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dokumens as $document) : ?>
                            <tr>
                                <td class="log-icon" style="cursor: pointer;">
                                    &#128065 <!-- Karakter Unicode untuk ikon mata -->
                                    <button><a href="<?= base_url('customer/activitylogs'); ?>" class="log-link" data-url="<?= base_url('customer/activitylogs'); ?>">
                                            <span class="log-text">Log</span>
                                        </a></button>
                                </td>
                                <td><?php echo $document->Nama_Depan; ?></td>
                                <td><?php echo $document->Document; ?></td>
                                <td><?php echo $document->Nama_Role; ?></td>
                                <td><?php echo $document->Deskripsi; ?></td>
                                <td><?php echo $document->created_at; ?></td>


                                <td>
                                    <button class="btn btn-sm btn-info delete-btn" data-document-id="<?php echo $document->ID_Doc ?>">hapus</button>
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
<!-- document_view.php -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete-btn');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const documentId = this.getAttribute('data-document-id');
                deleteDocument(documentId);
            });
        });

        function deleteDocument(documentId) {
            // Kirim permintaan AJAX ke kontroler
            const xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    location.reload();
                }
            };
            xhr.open('GET', "<?php echo site_url(); ?>customer/dokumen/delete_document/" + documentId, true);
            xhr.send();
        }
    });
</script>