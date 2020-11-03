<?php 
  include '../db_connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Insert</title>

    <link rel="icon" href="../assets/dist/pictures/cal_icon.svg" type="image/svg" sizes="16x16">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    
    <style>
     
    </style>
</head>
<body>
  <form method="post" action="insert.php">
    <div class="form-group">
      <label class="col-sm-2 control-label">ID</label>
      <div class="col-sm-12">
        <input type="number" value="" class="form-control" name="id_borrower" placeholder="ID Peminjam">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Nama</label>
      <div class="col-sm-12">
        <input type="text" value="" class="form-control" name="name" placeholder="Nama Peminjam">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Jumlah Angsuran</label>
      <div class="col-sm-12">
        <input type="var" value="" class="form-control" id="jumlahAng" name="jml_angsuran" disabled placeholder="">
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-12">
        <table class="table tableAngsuran table-bordered text-center">
          <thead>
            <tr> 
              <th>No</th>
              <th>Tanggal Kembali</th>
              <th>Nominal Angsuran</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody id="angsuranTable">
            <tr></tr>
            <!-- <tr>  -->
              <!-- <td>1</td>
              <td><input type="date" class="form-control" name="tgl_kembali" placeholder="Tanggal Kembali"></td>
              <td>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Rp.</span>
                  </div>
                  <input type="text" class="form-control" name="nom_angsuran" placeholder="Nilai Angsuran">
                  <div class="input-group-append">
                    <span class="input-group-text">.00</span>
                  </div>
                </div>
              </td>
              <td>
                <div class="remove btn-group">
                  <a href="#" class='btn btn-danger' >
                    <i class="fa fa-close"></i></a>
                </div>
              </td> -->
            <!-- </tr> -->
          </tbody>
          <tfoot>
            <tr>
              <td colspan="4">
                <div id="btnAdd" class="btn-group">
                  <a href="#" class='btn btn-primary' >Tambah Angsuran</a>
                </div>
              </td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
    <br><br>
    <div class="form-group pull-right">
      <div class="col-sm-12">
        <button class="btn btn-primary" type="submit">Simpan</button>
      </div>
    </div>
  </form>


  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  <script type="text/javascript">
    var rowCount = 0;
    var j = 0;
    document.getElementById('jumlahAng').value = rowCount;
    $(function () {
      $('body').on('click', '.remove', function () {
        $(this).closest('tr').remove();

        // count
        $('.tableAngsuran tbody .num').each(function(i){
          $($(this).find('td')[0]).html(i+1);
        });
        var rowCount = $('.tableAngsuran tbody .num').length;
        document.getElementById('jumlahAng').value = rowCount;
      });
      $('#btnAdd').bind('click', function () {
        // var j = 0; j++;
        var div = $('<tr class="num" />');
        div.html(GetDynamicTextBox(''));
        $('#angsuranTable').append(div);

        // count
        $('.tableAngsuran tbody .num').each(function(i){
          $($(this).find('td')[0]).html(i+1);
        });   
        var rowCount = $('.tableAngsuran tbody .num').length;
        document.getElementById('jumlahAng').value = rowCount;     
      });
    });
    function GetDynamicTextBox(value) {
      j = j + 1;
      return '<td></td>' + '<td><input type="hidden" name="ids[' + j + ']" value= "' + j + '"><input type="date" class="form-control" name="tgl_kembali[' + j + ']" placeholder="Tanggal Kembali" value= "' + value + '">' + '</td>' + '</td>' + '<td> <div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text">Rp.</span></div><input type="text" class="form-control" name="nom_angsuran[' + j + ']" placeholder="Nilai Angsuran" value="' + value + '"><div class="input-group-append"><span class="input-group-text">.00</span></div></div></td>' + '<td><div class="remove btn-group"><a href="#" class="btn btn-danger" ><i class="fa fa-close"></i></a></div></td>'; }
  </script>
</body>
</html> 