<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Crud Ajax</title>
  <style>
    *:not(h1) {
      font-size: 15px; font-family: sans-serif;
    }
    body {
      width : 80%; margin: 10% auto
    }
    button {
      background-color: red; color: white; border: none
    }
  </style>
</head>
<body>
  <h1>Crud Ajax Komentar</h1>
  <p>ini artikel</p>

  <textarea name="textarea_komen" id="textarea_komen" cols="30" rows="10"></textarea><br>
  <input type="submit" name="submit_komen" id="submit_komen" value="Submit">

  <div id="komen_wrapper">
    <?php
      include 'database.php';
      $query = "SELECT * FROM komentar";
      $komens = mysqli_query($link, $query);
    ?>

    <?php foreach ($komens as $komen): ?>
      <div id="contain_<?=$komen['id']?>">
        <p id="komen_<?=$komen['id']?>"><?=$komen['komentar']?></p>
        <button type="button" class="hapus_komen" data-id="<?=$komen['id']?>">Hapus</button>
        <button type="button" class="edit_komen" data-id="<?=$komen['id']?>">Edit</button>
      </div>
    <?php endforeach; ?>
  </div>

  <script src="jquery.min.js"></script>
  <script>
    $('#submit_komen').click(function() {
      var isi = $('#textarea_komen').val()

      $.ajax({
        method: "POST",
        url: "storekomen.php",
        data: { isi_komen: isi, type: 'create' },
        success: function(data) {
          $('#textarea_komen').val('')
          $('#komen_wrapper').append(data)
        }
      })
    });
    $(document).on('click', '.hapus_komen', function() {
      var id = $(this).attr('data-id')

      $.ajax({
        method: "POST",
        url: "storekomen.php",
        data: { id_komen: id, type: 'delete' },
        success: function(data) {
          if (data == 1) {
            $('#contain_'+id).fadeOut()
          }
        }
      })
    });
    $(document).on('click', '.edit_komen', function() {
      var id = $(this).attr('data-id')
      var txtKomen = $('#komen_'+id).text()
      $('#komen_'+id).replaceWith("<textarea id='tr_"+id+"'>"+ txtKomen +"</textarea>")
      $(this).replaceWith("<button id='save_"+id+"'>Save</button>")

        $(document).on('click', '#save_'+id, function() {
          var komenbr = $('#tr_'+id).val()
          $.ajax({
            method: "POST",
            url: "storekomen.php",
            data: { id_komen: id, type: 'update', komenbr: komenbr },
            success: function(data) {
            console.log(data);
              if (data == 1) {
                $('#tr_'+id).replaceWith("<p id='komen_"+id+"'>"+komenbr+"</p>")
                $('#save_'+id).replaceWith("<button class='edit_komen' data-id='"+id+"'>Edit</button>")
              }
            }
          })
        })
    });
  </script>
</body>
</html>
