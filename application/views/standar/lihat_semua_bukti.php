<style type="text/css">
.inner
{
    display: inline-block;
}
</style>
 
<div class="container">
      <!-- Main component for a primary marketing message or call to action -->

 
<div class="panel panel-default">
  <div class="panel-heading" style="font-size:36px; text-align:center"><b> Daftar File Dokumen</b><br><b> Parameter <?php echo $news_item['nama_substandar'];?> Standar <?php echo $news_item['no_standar']?></b></div>
  <div class="panel-body">
  <p class="inner"><a href="<?php echo site_url('standar/index_sub_standar/'.$no_standar.'/'.$no_substandar)?>" class="btn btn-default btn-sm">Kembali ke Sub Standar</a></p>
  <p class="inner"><a href="<?=base_url()?>standar/upload_dokumen/<?= $no_standar?>/<?= $no_substandar?>" class="btn btn-info btn-sm">upload dokumen</a></p>
  <p><div style="display: none" name="successMessage" id="successMessage" class="col-md-12"><div class="alert alert-success" id="alert">Upload Dokumen baru sukses</div></div></p>
    <p><div style="display: none" name="deleteMessage" id="deleteMessage" class="col-md-12"><div class="alert alert-success" id="alert">Hapus Dokumen Sukses</div></div></p>
    <p><div style="display: none" name="editMessage" id="editMessage" class="col-md-12"><div class="alert alert-success" id="alert">Edit Dokumen Sukses</div></div></p>
    <?php 
    if($this->session->flashdata('js')=="1"){
    ?>
       <script>$(document).ready(function(){
        setTimeout(function() {
          $('#successMessage').css('display','inline');
          $('#successMessage').fadeOut(5000);
        }); // <-- time in milliseconds
        });
    </script>
    <?php }else if($this->session->flashdata('js')=="2"){ ?>
      <script>$(document).ready(function(){
        setTimeout(function() {
          $('#editMessage').css('display','inline');
          $('#editMessage').fadeOut(5000);
        }); // <-- time in milliseconds
        });
    </script>
     <?php }else if($this->session->flashdata('js')=="3"){ ?>
      <script>$(document).ready(function(){
        setTimeout(function() {
          $('#deleteMessage').css('display','inline');
          $('#deleteMessage').fadeOut(5000);
        }); // <-- time in milliseconds
        });
    </script>

    <?php } ?>
  <?php $i=0 ;?>
  <table  id="myTable" class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>No</th>
      <th>Keterangan File</th>
      <th>Tipe File</th>
      <th>Gambar File</th>
      <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?foreach($query as $rowdata){ ;?> <!-- menampilkan data dari query dengan looping -->
    <tr>
   <?php  $i++;?>
      <td><?php echo $i ?></td>
      <td><?=$rowdata->ket_gbr?></td>
      <td><?=$rowdata->tipe_gbr?></td>
      <td>
        <a href="<?=base_url()?>standar/edit_dokumen/<?=$rowdata->id?>/<?=$rowdata->no_standar_gbr?>/<?=$rowdata->no_substandar_gbr?>/<?=$rowdata->no_substandar1_gbr?>" class="btn btn-info"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
        <a href="<?=base_url()?>standar/delete_image/<?=$rowdata->id?>/<?=$rowdata->no_standar_gbr?>/<?=$rowdata->no_substandar_gbr?>/<?=$rowdata->no_substandar1_gbr?>" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
      </td>
       <td><a class="btn btn-info btn-sm" href="<?php echo base_url('assets/uploads/' . $rowdata->nm_gbr);?>" target="_blank">view file</a></td>
    </tr>
    <? }?>
   </tbody>
  </table>
 
</div>
</div>
</div>

<script>
    $(document).ready(function(){
        $('#myTable').DataTable({
          "aLengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
           "iDisplayLength": 25
        });
    });
</script>
