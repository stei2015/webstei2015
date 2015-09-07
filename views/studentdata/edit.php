<?php 
  $pageTitle = 'Data Diri';
  include(__DIR__.'/../parts/top.php');
?>

<div class="container">

  <form class="form-register callout" method="POST">
    <h1>Data Diri</h1>
    <p>Data bertanda <span class="text-muted glyphicon glyphicon-lock"></span> tidak akan dipublikasikan</p>
    <br>

    <div class="form-group">
      <label for="nim">NIM</label>
      <input type="text" id="nim" name="nim" class="form-control" value="<?php echo $nim; ?>" required readonly >
    </div>

    <div class="form-group">
      <label for="namalengkap">Nama lengkap</label>
      <input type="text" name="namalengkap" class="form-control" value="<?php if($numRows>0) echo htmlspecialchars($oldData[0]['namalengkap']); ?>" required>
    </div>

    <div class="form-group">
      <label for="namapanggilan">Nama panggilan</label>
      <input type="text" name="namapanggilan" class="form-control" value="<?php if($numRows>0) echo htmlspecialchars($oldData[0]['namapanggilan']); ?>" required>
    </div>

    <div class="form-group">
      <label for="noreg">Nomor registrasi <span class="text-muted glyphicon glyphicon-lock"></span></label>
      <input type="text" name="noreg" class="form-control" value="<?php if($numRows>0) echo htmlspecialchars($oldData[0]['noreg']); ?>" required>
    </div>

    <div class="form-group">
      <label for="tempatlahir">Tempat lahir <span class="text-muted glyphicon glyphicon-lock"></span></label>
      <input type="text" name="tempatlahir" class="form-control" value="<?php if($numRows>0) echo htmlspecialchars($oldData[0]['tempatlahir']); ?>" required>
    </div>

    <div class="form-group">
      <label for="tanggallahir">Tanggal lahir <span class="text-muted glyphicon glyphicon-lock"></span></label>
      <input id="tanggallahir" type="text" name="tanggallahir" class="form-control" placeholder="yyyy-mm-dd" value="<?php if($numRows>0) echo htmlspecialchars($oldData[0]['tanggallahir']); ?>" required>
    </div>

    <div class="form-group">
      <label for="sma">SMA asal</label>
      <input type="text" name="sma" class="form-control" value="<?php if($numRows>0) echo htmlspecialchars($oldData[0]['sma']); ?>" required>
    </div>

    <div class="form-group">
      <label for="alamatasal">Alamat asal <span class="text-muted glyphicon glyphicon-lock"></span></label>
      <textarea rows="4" name="alamatasal" class="form-control" required><?php if($numRows>0) echo htmlspecialchars($oldData[0]['alamatasal']); ?></textarea>
    </div>

    <div class="form-group">
      <label for="kotaasal">Kota asal</label>
      <input type="text" name="kotaasal" class="form-control" value="<?php if($numRows>0) echo htmlspecialchars($oldData[0]['kotaasal']); ?>">
    </div>

    <div class="form-group">
      <label for="provinsiasal">Provinsi asal</label>
      <select name="provinsiasal" class="form-control">
        <?php
          $options = [
            '',
            'Aceh',
            'Bali',
            'Banten',
            'Bengkulu',
            'Gorontalo',
            'Jakarta',
            'Jambi',
            'Jawa Barat',
            'Jawa Tengah',
            'Jawa Timur',
            'Kalimantan Barat',
            'Kalimantan Selatan',
            'Kalimantan Tengah',
            'Kalimantan Timur',
            'Kalimantan Utara',
            'Kepulauan Bangka Belitung',
            'Kepulauan Riau',
            'Lampung',
            'Maluku',
            'Maluku Utara',
            'Nusa Tenggara Barat',
            'Nusa Tenggara Timur',
            'Papua',
            'Papua Barat',
            'Riau',
            'Sulawesi Barat',
            'Sulawesi Selatan',
            'Sulawesi Tengah',
            'Sulawesi Tenggara',
            'Sulawesi Utara',
            'Sumatera Barat',
            'Sumatera Selatan',
            'Sumatera Utara',
            'Yogyakarta'
          ];
          $select = $numRows>0 ? $oldData[0]['provinsiasal'] : '';
          foreach($options as $val){
            if($select == $val) echo '<option selected>'.$val.'</option>'; else echo '<option>'.$val.'</option>';
          }
        ?>"
      </select>
    </div>

    <div class="form-group">
      <label for="kodeposasal">Kode pos asal <span class="text-muted glyphicon glyphicon-lock"></span></label>
      <input type="text" name="kodeposasal" class="form-control" value="<?php if($numRows>0) echo htmlspecialchars($oldData[0]['kodeposasal']); ?>">
    </div>

    <div class="form-group">
      <label for="alamatstudi">Alamat di Bandung <span class="text-muted glyphicon glyphicon-lock"></span></label>
      <textarea rows="4" name="alamatstudi" class="form-control" required><?php if($numRows>0) echo htmlspecialchars($oldData[0]['alamatstudi']); ?></textarea>
    </div>

    <div class="form-group">
      <label for="kodeposstudi">Kode pos di Bandung <span class="text-muted glyphicon glyphicon-lock"></span></label>
      <input type="text" name="kodeposstudi" class="form-control" value="<?php if($numRows>0) echo htmlspecialchars($oldData[0]['kodeposstudi']); ?>">
    </div>

    <div class="form-group">
      <label for="hp">Nomor HP <span class="text-muted glyphicon glyphicon-lock"></span></label>
      <input type="text" name="hp" class="form-control" value="<?php if($numRows>0) echo htmlspecialchars($oldData[0]['hp']); ?>" required>
    </div>

    <div class="form-group">
      <label for="telepondarurat">Nomor telepon darurat <span class="text-muted glyphicon glyphicon-lock"></span></label>
      <input type="text" name="telepondarurat" class="form-control" value="<?php if($numRows>0) echo htmlspecialchars($oldData[0]['telepondarurat']); ?>" required>
    </div>

    <div class="form-group">
      <label for="email">Email <span class="text-muted glyphicon glyphicon-lock"></span></label>
      <input type="email" name="email" class="form-control" value="<?php if($numRows>0) echo htmlspecialchars($oldData[0]['email']); ?>" required>
    </div>

    <div class="form-group">
      <label for="emailstudents">Email students.itb.ac.id</label>
      <input type="email" name="emailstudents" class="form-control" value="<?php if($numRows>0) echo htmlspecialchars($oldData[0]['emailstudents']); ?>" required>
    </div>

    <div class="form-group">
      <label for="line">LINE</label>
      <input type="text" name="line" class="form-control" value="<?php if($numRows>0) echo htmlspecialchars($oldData[0]['line']); ?>">
    </div>

    <div class="form-group">
      <label for="twitter">Twitter</label>
      <input type="text" name="twitter" class="form-control" value="<?php if($numRows>0) echo htmlspecialchars($oldData[0]['twitter']); ?>">
    </div>

    <div class="form-group">
      <label for="facebook">Facebook</label>
      <input type="text" name="facebook" class="form-control" value="<?php if($numRows>0) echo htmlspecialchars($oldData[0]['facebook']); ?>">
    </div>

    <div class="form-group">
      <label for="golongandarah">Golongan darah <span class="text-muted glyphicon glyphicon-lock"></span></label>
      <select name="golongandarah" class="form-control">
        <?php
          $options = ['', 'A', 'B', 'AB', 'O'];
          $select = $numRows>0 ? $oldData[0]['golongandarah'] : '';
          foreach($options as $val){
            if($select == $val) echo '<option selected>'.$val.'</option>'; else echo '<option>'.$val.'</option>';
          }
        ?>"
      </select>
    </div>

    <div class="form-group">
      <label for="riwayatpenyakit">Riwayat penyakit <span class="text-muted glyphicon glyphicon-lock"></span></label>
      <textarea rows="4" name="riwayatpenyakit" class="form-control"><?php if($numRows>0) echo htmlspecialchars($oldData[0]['riwayatpenyakit']); ?></textarea>
    </div>

    <div class="form-group">
      <label for="bio">Bio/deskripsi diri</label>
      <textarea rows="4" name="bio" class="form-control"><?php if($numRows>0) echo htmlspecialchars($oldData[0]['bio']); ?></textarea>
    </div>

    <div class="form-group">
      <label for="catatan">Catatan/keterangan lainnya <span class="text-muted glyphicon glyphicon-lock"></span></label>
      <textarea rows="4" name="catatan" class="form-control"><?php if($numRows>0) echo htmlspecialchars($oldData[0]['catatan']); ?></textarea>
    </div>

    <br>
    <button class="btn btn-primary">Simpan <span class="glyphicon glyphicon-check"></span></button>
    
  </form>
  <br><br>

</div>

<script>
  window.onload = function(){
    $('#tanggallahir').datetimepicker({
      format: "yyyy-mm-dd",
      language: "id",
      startView: 4,
      minView: 2,
      initialDate: new Date('1997'),
      autoclose: true
    });
  };
</script>

<?php include(__DIR__.'/../parts/bottom.php'); ?>
