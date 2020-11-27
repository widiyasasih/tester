<?php 
  include 'db_connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Insert</title>

    <link rel="icon" href="assets/dist/pictures/cal_icon.svg" type="image/svg" sizes="16x16">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    
    <style>
     
    </style>
</head>
<body>
  <form method="post" action="insert.php">
    <div class="form-group">
      <label class="col-sm-2 control-label">Jenis Pegawai</label>
      <div class="col-sm-10">
        <select class="form-control" name="jns_pegawai" id="jns_pegawai">
          <option value="guru">Guru</option>
          <option value="karyawan">Karyawan</option>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Status Pegawai</label>
      <div class="col-sm-10">
        <select class="form-control" name="status_pgw" id="status_pgw">
          <option value="guru_pilih" disabled>Pilih</option>
          <option value="guru_P">PNS</option>
          <option value="guru_T1">Tetap</option>
          <option value="guru_T0">Tidak Tetap</option>
          <option value="karyawan_pilih" disabled >Pilih</option> 
          <option value="karyawan_T1">Tetap</option>
          <option value="karyawan_T0">Tidak Tetap</option>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Honorium</label>

      <div class="col-sm-10">
        <div class="input-group">
          <span class="input-group-addon">Rp.</span>
          <input type="number" id="honor" class="form-control" name="honor" placeholder="0" value="">
          <span class="input-group-addon">.00</span>
        </div>
        <span class="text-red" id='info_honor'><small>* Honorium untuk status pegawai <b>tetap</b></small></span>
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

  <script>
    var honor = $('#honor').val();
    function honorEnabled(){
      $('#info_honor').hide();
      $('#honor').val(honor);
      $('#honor').prop('disabled', false);
    }
    function honorDisabled(){
      $('#info_honor').show();
      $('#honor').val('');
      $('#honor').prop('disabled', true);
    }

    if (($('#status_pgw').prop('value') == 'guru_T1') || ($('#status_pgw').prop('value') == 'karyawan_T1')) {
      honorEnabled();
      var status_load = 'tetap';
    } else {
      honorDisabled();
      var status_load = 'pns_tdktetap';
    }

    switch ($("#jns_pegawai").val()) {
      case 'guru':
        var jenis_load = 'guru';
        break;
      case 'karyawan':
        var jenis_load = 'karyawan';
        break;
    }

    $(document).ready(function() {
      var optarray = $('#status_pgw').children('option').map(function() {
        var disabled = '';
        var selected = '';
        if ($(this).prop('disabled') === true) {
          disabled = 'disabled';
        }
        if ($(this).prop('selected') === true) {
          selected = 'selected';
        }
        return {
          'value': this.value,
          'option': '<option value="' + this.value + '"'+ disabled + selected +'>' + this.text + '</option>'
        }
      });

      $("#jns_pegawai").change(function() {
        $("#status_pgw").children('option').remove();
        var addoptarr = [];
        for (i = 0; i < optarray.length; i++) {
          if (optarray[i].value.indexOf($(this).val()) > -1) {
            addoptarr.push(optarray[i].option);
          }
        }

        $('#status_pgw').on('change', function(){
          
          if (($('#status_pgw').prop('value') == 'guru_T1') || ($('#status_pgw').prop('value') == 'karyawan_T1')) {
            honorEnabled();
          } else {
            honorDisabled();
          }
        });   
              
        $("#jns_pegawai").on('change', function() {
          if (status_load == 'pns_tdktetap') {
            if ($("#jns_pegawai").val() == 'karyawan') {
              switch (jenis_load) {
                case 'guru':
                  honorEnabled();
                  break;
                case 'karyawan':
                  honorDisabled();
                  break;
              }
            } else {
              honorDisabled();
            }
          } else if (status_load == 'tetap') {
            if ($("#jns_pegawai").val() == 'guru') {
              switch (jenis_load) {
                case 'karyawan':
                  honorDisabled();
                  break;
                case 'guru':
                  honorEnabled();
                  break;
              }
            } else {
              honorEnabled();
            }
          }
        });
        $("#status_pgw").html(addoptarr.join(''))
      }).change();
    });   
    </script>
</body>
</html> 