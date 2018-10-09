<?php

include 'database.php';

$komentar = mysqli_real_escape_string($link, $_POST['isi_komen']);
$query = "INSERT INTO komentar (user_id, komentar) VALUES (1, '$komentar')";

if (mysqli_query($link, $query)) {
  echo "true";
} else {
  echo "false";
}
