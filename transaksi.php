<?php
// transaksi.php
session_start();
include 'includes/cek_session.php';
include 'config/koneksi.php';

if(!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = array();
}

$daftar_barang = mysqli_query($koneksi, "SELECT * FROM tbl_barang WHERE stok > 0");
$total = 0;
foreach ($_SESSION['keranjang'] as $item) {
    $total += $item['subtotal'];
}
?>
<!DOCTYPE html>
<html>
    <head><title>transaksi - warung ABC</title></head>
<body>
    <h1>Transaksi penjualan</h1>

    <?php if (isset($_SESSION['pesan_error'])) {
        echo '<P>' . $_SESSION['pesan_error'] . '</p>';
        unset($_SESSION['pesan_error']);
    } ?>

    <h3>Pilih barang</h3>
    <form action="proses_tambah_keranjang.php" method="POSST">
        <select name="id_barang" required>
          <?php while ($b = mysqli_fetch_assoc($daftar_barang)) { ?>
          <option value="<?php echo $b['id_barang']; ?>">
            <?php echo $b['nama_barang'] . ' (Stok: ' . $b['stok']. ')'; ?>
          </option>
          <?php } ?>
        </select>
        jumlah: <input type="number" name="jumlah" min="1" required>
        <input type="submit" value="Tambah ke keranjang">
    </form>

    <h3>keranjang</h3>
    <table border= "1" cellpanding="6">
        <tr><th>Nama barang</th><th>Harga</th><th>jumlah</th><th>subtotal</th><th>aksi</th></tr>
        <?php foreach ($_SESSION['keranjang'] as $id_barang => $item) { ?>
        <tr>
            <td><?php echo $item['nama_barang']; ?></td>
            <td><?php echo number_format ($item['harga'], 0, ',', '.'); ?></td>
            <td><?php echo $item['jumlah']; ?></td>
            <td><?php echo number_format ($item['subtotal'], 0, ',', '.'); ?></td>
            <td><a href="hapus_keranjang.php?id=?php echo $id_barang; ?>">Hapus</a></td>
        </tr>
        <?php }  ?>
        <tr><td colspan="3">$tota></td>
            <td colspan="2"?php echo number_format($total, 0,',', '.'); ?></td></tr>
    </table>
    <form action="proses_simpan_transaksi.php" method="POST">
        <input type="submit" value="Simpan Transaksi">
    </form>
    <p><a href="dashboard.php">Kembali ke dashboard</a></p>
</body>
</html>