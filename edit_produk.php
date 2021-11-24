<?php
  // memanggil file koneksi.php untuk membuat koneksi
include 'config.php';

include('config.php'); //agar index terhubung dengan database, maka koneksi sebagai penghubung harus di include
  session_start();

  if (!isset($_SESSION['id_produk'])) {
}

  // mengecek apakah di url ada nilai GET id
  if (isset($_GET['id_produk'])) {
    // ambil nilai id dari url dan disimpan dalam variabel $id
    $id_produk = ($_GET["id_produk"]);

    // menampilkan data dari database yang mempunyai id=$id
    $query = "SELECT * FROM produk WHERE id_produk='$id_produk'";
    $result = mysqli_query($conn, $query);
    // jika data gagal diambil maka akan tampil error berikut
    if(!$result){
      die ("Query Error: ".mysqli_errno($conn).
         " - ".mysqli_error($conn));
    }
    // mengambil data dari database
    $data = mysqli_fetch_assoc($result);
      // apabila data tidak ada pada database maka akan dijalankan perintah ini
       if (!count($data)) {
          echo "<script>alert('Data tidak ditemukan pada database');window.location='home.php';</script>";
       }
  } else {
    // apabila tidak ada data GET id pada akan di redirect ke home.php
    echo "<script>alert('Masukkan data id.');window.location='home.php';</script>";
  }         
  ?>
<!DOCTYPE html>
<html>
  <head>
    <title>EDIT PRODUK</title>
    <style type="text/css">
      * {
        font-family: "Trebuchet MS";
      }
      h1 {
        text-transform: uppercase;
        color: salmon;
      }
    body {
    width: 100%;
    min-height: 100vh;
    background-image: linear-gradient(rgba(0,0,0,.5), rgba(0,0,0,.5)), url(images/a1.png);
    background-position: center;
    background-size: cover;
    justify-content: center;
    align-items: center;
    }
    button {
          background-color: salmon;
          color: #fff;
          padding: 10px;
          text-decoration: none;
          font-size: 12px;
          border: 0px;
          margin-top: 20px;
    }
    label {
      margin-top: 10px;
      float: left;
      text-align: left;
      width: 100%;
    }
    input {
      padding: 6px;
      width: 100%;
      box-sizing: border-box;
      background: #f8f8f8;
      border: 2px solid #ccc;
      outline-color: salmon;
    }
    div {
      width: 100%;
      height: auto;
    }
    .base {
      width: 400px;
      height: auto;
      padding: 20px;
      margin-left: auto;
      margin-right: auto;
      background: #ededed;
    }
    </style>
  </head>
  <body>
      <center>
        <h1>Edit Produk <?php echo $data['nama_produk']; ?></h1>
      <center>
      <form method="POST" action="proses_edit.php" enctype="multipart/form-data" >
      <section class="base">
        <!-- menampung nilai id produk yang akan di edit -->
        <input name="id_produk" value="<?php echo $data['id_produk']; ?>"  hidden />
        <div>
          <label>Nama Produk</label>
          <input type="text" name="nama_produk" value="<?php echo $data['nama_produk']; ?>" autofocus="" required="" />
        </div>
        <div>
          <label>Deskripsi</label>
         <input type="text" name="deskripsi" value="<?php echo $data['deskripsi']; ?>" />
        </div>
        <div>
          <label>Harga Beli</label>
         <input type="text" name="harga_beli" required=""value="<?php echo $data['harga_beli']; ?>" />
        </div>
        <div>
          <label>Harga Jual</label>
         <input type="text" name="harga_jual" required="" value="<?php echo $data['harga_jual']; ?>"/>
        </div>
        <div>
          <label>Gambar Produk</label>
          <img src="gambar/<?php echo $data['gambar']; ?>" style="width: 120px;float: left;margin-bottom: 5px;">
          <input type="file" name="gambar" />
          <i style="float: left;font-size: 11px;color: red">Abaikan jika tidak merubah gambar produk</i>
        </div>
        <div>
         <button type="submit">Simpan Perubahan</button>
        </div>
        </section>
      </form>
  </body>
</html>