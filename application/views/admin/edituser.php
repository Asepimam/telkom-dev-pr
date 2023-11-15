<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        display: none;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
        border-radius: 34px;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
        border-radius: 50%;
    }

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }
</style>

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
                            <th>FIRST NAME</th>
                            <th>LAST NAME</th>
                            <th>UNIT</th>
                            <th>PASSWORD</th>
                            <th>STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($user as $cs) : ?>

                            <tr>
                                <td><?php echo $cs->Nama_Depan ?></td>
                                <td><?php echo $cs->Nama_Belakang ?></td>
                                <td><?php echo $cs->Nama_Role ?></td>
                                <td>**********</td>
                                <td><?php echo $cs->activate ?></td>
                                <td>
                                    <button class="btn btn-sm btn-info edit-btn" data-id="<?php echo $cs->ID ?>">Edit</button>
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

        $(".edit-btn").on("click", function() {
            var row = $(this).closest("tr");

            // Get the original values
            var firstName = row.find("td:eq(0)").text();
            var lastName = row.find("td:eq(1)").text();
            var unit = row.find("td:eq(2)").text();
            var status = row.find("td:eq(4)").text();

            // Replace cells with input elements
            row.html(`
        <td><input type="text" value="${firstName}" name="edit_firstName"></td>
        <td><input type="text" value="${lastName}" name="edit_lastName"></td>
        <td>
            <select name="edit_unit" id="edit_unit"></select>
        </td>
        <td>**********</td>
        <td>
            <label class="switch">
                <input type="checkbox" class="status-toggle" ${status === "Aktif" ? "checked" : ""}>
                <span class="slider"></span>
            </label>
        </td>
        <td>
            <button class="btn btn-sm btn-success save-btn">Save</button>
            <button class="btn btn-sm btn-danger cancel-btn">Cancel</button>
        </td>
    `);

            // Fetch unit data using AJAX
            $.ajax({
                url: "editusers/getUnitData", // Ganti dengan URL controller yang sesuai
                type: "GET",
                dataType: "json",
                success: function(data) {
                    // Populate the unit dropdown
                    var unitDropdown = $('#edit_unit');
                    unitDropdown.empty(); // Clear existing options

                    // Iterate through the data and add options to the dropdown
                    $.each(data, function(index, unit) {
                        unitDropdown.append('<option value="' + unit.ID + '">' + unit.Nama_Role + '</option>');
                    });

                    // Set the selected value based on the existing unit value
                    var existingUnitValue = row.find("select[name='edit_unit']").val();
                    if (existingUnitValue) {
                        unitDropdown.val(existingUnitValue);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching unit data: " + error);
                }
            });
        });



        $(".save-btn").on("click", function() {
            var row = $(this).closest("tr");

            // Get the user ID from the row (you may need to adjust this depending on your HTML structure)
            var userId = row.data("user-id");

            // Get the edited data from the input fields
            var editedData = {
                firstName: row.find("input[name='edit_firstName']").val(),
                lastName: row.find("input[name='edit_lastName']").val(),
                unit: row.find("select[name='edit_unit']").val(),
                status: row.find(".status-toggle").prop("checked") ? "Aktif" : "Tidak Aktif"
            };
            console.log(userId);
            // Send AJAX request to the CodeIgniter controller
            $.ajax({
                url: "<?php echo site_url(); ?>customer/editusers/editUser " + userId,
                type: "POST",
                data: editedData,
                dataType: "json",
                success: function(response) {
                    // Handle success, e.g., show a success message
                    console.log("User updated successfully");
                },
                error: function(xhr, status, error) {
                    // Handle error, e.g., show an error message
                    console.error("Error updating user: " + error);
                }
            });
        });


        $(".status-toggle").on("change", function() {
            var userId = $(this).data("id");
            var status = $(this).prop("checked") ? "Aktif" : "Tidak Aktif";

            // Send AJAX request to update status
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('admin/editdokumen/update_status'); ?>",
                data: {
                    id_user: userId,
                    status: status,
                },
                success: function(response) {
                    // Handle the response if needed
                    console.log(response);
                },
            });
        });

        function performSearch() {
            var searchText = $("#searchInput").val().toLowerCase();

            $("table tbody tr").each(function() {
                var firstName = $(this).find("td:eq(0)").text().toLowerCase();
                var lastName = $(this).find("td:eq(1)").text().toLowerCase();
                var unit = $(this).find("td:eq(2)").text().toLowerCase();

                if (firstName.includes(searchText) || lastName.includes(searchText) || unit.includes(searchText)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }
    });
</script>