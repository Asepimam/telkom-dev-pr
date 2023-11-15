<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timeline</title>
</head>

<body>

    <h2>Timeline Aktivitas</h2>

    <!-- Tabel daftar log aktivitas -->
    <table border="1">
        <thead>
            <tr>
                <th>Waktu</th>
                <th>Aktivitas</th>
                <th>Pelaku</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($log_aktivitas as $log) : ?>
                <tr>
                    <td><?php echo $log->Waktu; ?></td>
                    <td><?php echo $log->Aktivitas; ?></td>
                    <td><?php echo $log->Pengguna_ID; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>