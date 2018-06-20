 
<div class="container">
      <!-- Main component for a primary marketing message or call to action -->
      <?php echo validation_errors(); ?>
<div class="panel panel-default">
  <div class="panel-heading"><b>Form Upload Foto/Dokumen</b></div>
  <div class="panel-body">
  <?=$this->session->flashdata('pesan')?>
     <form action="<?=base_url()?>standar/insert/<?= $no_standar?>/<?= $no_substandar?>" method="post" enctype="multipart/form-data">
     <?if($this->session->flashdata('error')){echo $this->session->flashdata('error');}
?>
       <table class="table table-striped">
         <tr>
          <td style="width:15%;">File Foto/Dokumen</td>
          <td>
            <div class="col-sm-6">
                <input type="file" name="filefoto" class="form-control">
            </div>
            </td>
         </tr>
         <tr>
          <td style="width:15%;">Keterangan Foto/Dokumen</td>
          <td>
            <div class="col-sm-10">
                <textarea name="textket" class="form-control"></textarea>
            </div>
            </td>
         </tr>
         <tr>
          <td colspan="2">
            <input type="submit" class="btn btn-success" value="Simpan">
            <button type="reset" class="btn btn-default" onclick="location.href='<?php echo site_url('standar/lihat_semua_bukti/'.$no_standar.'/'.$no_substandar); ?>'">Batal</button>
          </td>
         </tr>
       </table>
     </form>
    </div>
   </div>    <!-- /panel -->
 </div> <!-- /container -->

   