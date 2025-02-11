<?php
include 'db.php'; // Koneksi database

$nota_id = '200311-B1';
$query = "SELECT * FROM nota WHERE nota_id = '$nota_id'";
$result = mysqli_query($conn, $query);
$nota = mysqli_fetch_assoc($result);

$query_items = "SELECT * FROM detail_nota WHERE nota_id = '$nota_id'";
$items = mysqli_query($conn, $query_items);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Nota Pemeriksaan</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .nota { width: 60%; margin: auto; border: 1px solid black; padding: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        .total { text-align: right; font-weight: bold; }
    </style>
</head>
<body>

<div class="nota">
    <h2>Nota Biaya Periksa / Obat / Tindakan</h2>
    <p><strong>No Nota:</strong> <?= $nota['nota_id'] ?></p>
    <p><strong>Tanggal:</strong> <?= $nota['tanggal'] ?></p>
    <p><strong>Pasien:</strong> <?= $nota['pasien_nama'] ?></p>
    <p><strong>Alamat:</strong> <?= $nota['pasien_alamat'] ?></p>
    <p><strong>Jenis Kelamin:</strong> <?= $nota['pasien_kelamin'] ?></p>
    <p><strong>Umur:</strong> <?= $nota['pasien_umur'] ?></p>

    <table>
        <tr>
            <th>No.</th>
            <th>Keterangan</th>
            <th>Harga Satuan</th>
            <th>Qty</th>
            <th>Subtotal</th>
        </tr>
        <?php $no = 1; while ($item = mysqli_fetch_assoc($items)) { ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $item['keterangan'] ?></td>
                <td><?= number_format($item['harga_satuan'], 0, ',', '.') ?></td>
                <td><?= $item['qty'] ?></td>
                <td><?= number_format($item['subtotal'], 0, ',', '.') ?></td>
            </tr>
        <?php } ?>
    </table>

    <p class="total">Total: Rp <?= number_format($nota['total_biaya'], 0, ',', '.') ?></p>
</div>

</body>
</html>
