<?php

include 'database.php';

$komentar = mysqli_real_escape_string($link, $_POST['isi_komen']);
$query = "INSERT INTO komentar (user_id, komentar) VALUES (1, '$komentar')";

if (!empty($_POST['isi_komen'])) {
  if (mysqli_query($link, $query)) {
    echo "<p>$komentar</p>";
  }
} else {
  echo "<script>alert('komenmu kosong')</script>";
}
