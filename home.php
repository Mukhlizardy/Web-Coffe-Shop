<?php
  include('config.php'); //agar index terhubung dengan database, maka koneksi sebagai penghubung harus di include
  session_start();

  if (!isset($_SESSION['id_produk'])) {
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>PRODUK KOPI</title>
    <style type="text/css">
      * {
        font-family: "Trebuchet MS";
      }
      h1 {
        text-transform: uppercase;
        color: salmon;
        text-shadow: 1px 1px 1px #DDEFEF;
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
    table {
      border: solid 1px #fff;
      border-collapse: collapse;
      border-spacing: 0;
      width: 70%;
      margin: 10px auto 10px auto;
    }
    table thead th {
        background-color: #DDEFEF;
        border: solid 1px #fff;
        color: #black;
        padding: 10px;
        text-align: left;
        text-shadow: 1px 1px 1px #fff;
        text-decoration: none;
    }
    table tbody td {
        border: solid 1px #fff;
        color: #fff;
        padding: 10px;
    }
    a {

    width: 20%;
    padding: 10px;
    text-align: center;
    border: none;
    background: #a29bfe;
    outline: none;
    border-radius: 30px;
    font-size: 15px;
    color: #FFF;
    cursor: pointer;
    transition: .3s;
    }

    </style>
  </head>
  <body>
    <center><h1>Data Produk</h1><center>
    <center><a href="tambah_produk.php">+ &nbsp; Tambah Produk</a><center>
    <br/>
    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>Produk</th>
          <th>Dekripsi</th>
          <th>Harga Beli</th>
          <th>Harga Jual</th>
          <th>Gambar</th>
          <th>Action</th>
        </tr>
    </thead>
    <tbody>
      <?php
      // jalankan query untuk menampilkan semua data diurutkan berdasarkan nim
      $query = "SELECT * FROM produk ORDER BY id_produk ASC";
      $result = mysqli_query($conn, $query);
      //mengecek apakah ada error ketika menjalankan query
      if(!$result){
        die ("Query Error: ".mysqli_errno($conn).
           " - ".mysqli_error($conn));
      }

      //buat perulangan untuk element tabel dari data mahasiswa
      $no = 1; //variabel untuk membuat nomor urut
      // hasil query akan disimpan dalam variabel $data dalam bentuk array
      // kemudian dicetak dengan perulangan while
      while($row = mysqli_fetch_assoc($result))
      {
      ?>
       <tr>
          <td><?php echo $no; ?></td>
          <td><?php echo $row['nama_produk']; ?></td>
          <td><?php echo substr($row['deskripsi'], 0, 20); ?>...</td>
          <td>Rp <?php echo number_format($row['harga_beli'],0,',','.'); ?></td>
          <td>Rp <?php echo $row['harga_jual']; ?></td>
          <td style="text-align: center;"><img src="gambar/<?php echo $row['gambar']; ?>" style="width: 120px;"></td>
          <td>
              <a href="edit_produk.php?id_produk=<?php echo $row['id_produk']; ?>">Edit</a> |
              <a href="proses_hapus.php?id_produk=<?php echo $row['id_produk']; ?>" onclick="return confirm('Anda yakin akan menghapus data ini?')">Hapus</a>
            </td>
      </tr>
         
      <?php
        $no++; //untuk nomor urut terus bertambah 1
      }
      ?>
    </tbody>
    </table>
    <br>
    <a href="logout.php" class="btn">Logout</a>
  </body>
</html>