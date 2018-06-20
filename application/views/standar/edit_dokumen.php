<div class="container">
      <!-- Main component for a primary marketing message or call to action -->
<div class="panel panel-default">
  <div class="panel-heading"><b>Edit Dokumen</b></div>
  <div class="panel-body">
  <?=$this->session->flashdata('pesan')?>
     <form action="<?=base_url()?>standar/update_gambar/<?=$id?>/<?= $no_standar?>/<?= $no_sub_standar?>" method="post" enctype="multipart/form-data"><!-- form action mengarah ke fungsi update pada controller -->
       <table class="table table-striped">
         <tr>
          <td style="width:15%;">File Foto/Dokumen</td>
          <td>
            <div class="col-sm-6">
                <input type="file" name="filefoto" class="form-control">
                <!-- file gambar kita buat pada field hidden -->
                <input type="hidden" name="filelama" class="form-control" value="<?php echo $row->nm_gbr;?>">
                <!-- Id gambar kita hidden pada input field dimana berfungsi sebagai identitas yang dibawa untuk update -->
                <input type="hidden" name="kode" class="form-control" value="<?php echo $row->id;?>">
            </div>
            <?php if($row->tipe_gbr == 'image/jpeg'){?>
            <div class="col-sm-6 align-right">
                <img src="<?=base_url()?>assets/uploads/<?=$row->nm_gbr?>" alt="" style="width:50%"></div>
            <?php }else{?>
              <div class="col-sm-6 align-right">
                <p><?=$row->ket_gbr.'.pdf'?></p><a class="btn btn-info btn-sm" href="<?php echo base_url('assets/uploads/' . $row->nm_gbr);?>" target="_blank">view file</a>
            <?php }?>
            </td>
         </tr>
         <tr>
          <td style="width:15%;">Keterangan Foto/Dokumen</td>
          <td>
            <div class="col-sm-10">
                <textarea name="textket" class="form-control"><?=$row->ket_gbr?></textarea>
            </div>
            </td>
         </tr>
         <tr>
          <td colspan="2">
            <input type="submit" class="btn btn-success" value="Update">
            <button type="reset" class="btn btn-default" onclick="history.back()">Batal</button>
          </td>
         </tr>
       </table>
     </form>
        </div>
    </div>    <!-- /panel -->
    </div> <!-- /container -->