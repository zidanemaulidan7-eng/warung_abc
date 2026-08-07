<?php
// hapus_barang.php
session_start();
include 'includes/cek_session.php';
include 'config/koneksi.php';

$id = $_GET['id'];

$cek = mysqli_query($koneksi, "SELECT nama_barang FROM tbl_barang WHERE id_barang = '$id'");
$data = mysqli_fetch_assoc($cek)