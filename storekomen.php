<?php

include 'database.php';

if ($_POST['type'] == 'create') {
  $komentar = mysqli_real_escape_string($link, $_POST['isi_komen']);
  $query = "INSERT INTO komentar (user_id, komentar) VALUES (1, '$komentar')";

  if (!empty($_POST['isi_komen'])) {
    if (mysqli_query($link, $query)) {
      $last_id = mysqli_insert_id($link);
      echo "<div id='contain_".$last_id."'>
              <p id='komen_".$last_id."'>$komentar</p>
              <button type='button' class='hapus_komen' data-id='".$last_id."'>Hapus</button>
              <button type='button' class='edit_komen' data-id='".$last_id."'>Edit</button>
            </div>";
    }
  } else {
    echo "<script>alert('komenmu kosong')</script>";
  }
}

if ($_POST['type'] == 'delete') {
  $query = "DELETE FROM komentar WHERE id =". $_POST['id_komen'];

  if (mysqli_query($link, $query)) {
    echo 1;
  } else {
    echo "<script>alert('tidak bisa')</script>";
  }
}

if ($_POST['type'] == 'update') {
  $query = "UPDATE komentar SET komentar='".$_POST['komenbr']."' WHERE id =". $_POST['id_komen'];
  // die($query);
  if (mysqli_query($link, $query)) {
    echo 1;
  } else {
    echo "<script>alert('tidak bisa')</script>";
  }
}
