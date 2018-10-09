<?php

include 'database.php';

if ($_POST['type'] == 'create') {
  $komentar = mysqli_real_escape_string($link, $_POST['isi_komen']);
  $query = "INSERT INTO komentar (user_id, komentar) VALUES (1, '$komentar')";

  if (!empty($_POST['isi_komen'])) {
    if (mysqli_query($link, $query)) {
      echo "<p>$komentar</p>";
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
