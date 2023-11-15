<!-- form_pengajuan.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pengajuan Dokumen</title>
</head>

<body>

    <h2>Form Pengajuan Dokumen</h2>

    <form method="post" action="<?php echo site_url('dokumen/submit_form'); ?>">
        <label for="judul">Judul Dokumen:</label>
        <input type="text" name="judul" id="judul" required>

        <label for="deskripsi">Deskripsi Dokumen:</label>
        <textarea name="deskripsi" id="deskripsi" required></textarea>

        <label for="role_tujuan_id">Role Tujuan:</label>
        <select name="role_tujuan_id" id="role_tujuan_id" required>
            <?php foreach ($roles as $role) : ?>
                <option value="<?php echo $role->ID; ?>"><?php echo $role->Nama_Role; ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Ajukan Dokumen</button>
    </form>

</body>

</html>