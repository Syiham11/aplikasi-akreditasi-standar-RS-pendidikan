<style type="text/css">
.inner
{
    display: inline-block;
}

</style>

<div class="container">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="panel panel-default">
  <div class="panel-heading" style="font-size:36px; text-align:center"><b>Daftar Sub Standar <?php echo $no_standar?></b></div>
  <div class="panel-body">
  <p class="inner"><a href="<?php echo site_url('standar')?>" class="btn btn-default btn-sm">Kembali Standar Utama</a></p>
  <p class="inner"><a href="<?php echo site_url('standar/buat_sub_standar_baru/'.$no_standar)?>" class="btn btn-info btn-sm">Tambah Sub Standar</a></p>
     <p><div style="display: none" name="successMessage" id="successMessage" class="col-md-12"><div class="alert alert-success" id="alert">Tambah Sub Standar Baru Sukses</div></div></p>
    <p><div style="display: none" name="deleteMessage" id="deleteMessage" class="col-md-12"><div class="alert alert-success" id="alert">Hapus Sub Standar Sukses</div></div></p>
    <p><div style="display: none" name="editMessage" id="editMessage" class="col-md-12"><div class="alert alert-success" id="alert">Edit Sub Standar Sukses</div></div></p>
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
       <table id="myTable" class="table table-striped" style="width:100%">
        <thead>
         <tr>
         <th style="width:6%">No</th>
         <th style="width:47%">Nama Sub Standar</th>
         <th style="width:47%">Action</th>
         </tr>
        </thead>
        <tbody>
        <? foreach($query as $row){ ;?>
         <tr>
            <td><? echo $row->no_standar .'-'. $row->no_substandar ?></td>
            <td><?php echo $row->nama_substandar; ?></td>
          <td>
           <a href="<?php echo site_url('standar/lihat_semua_bukti/'.$row->no_standar.'/'.$row->no_substandar); ?>" class="btn btn-info btn-sm">lihat dokumen/foto bukti</a>
           <a href="<?php echo site_url('standar/edit_sub_standar/'.$row->id.'/'.$row->no_standar.'/'.$row->no_substandar); ?>" class="btn btn-warning btn-sm">edit sub standar 1</a>
           <a href="<?php echo site_url('standar/hapus_sub_standar/'.$row->id.'/'.$row->no_standar.'/'.$row->no_substandar); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda Yakin menghapus data ini?')">hapus sub standar 1</a>
          </td>
         </tr>
        <? }?>
        </tbody>
       </table>
        </div>
    </div>    <!-- /panel -->

    </div> <!-- /container -->
     <script>
    $(document).ready(function(){
        $('#myTable').DataTable({
          "aLengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
           "iDisplayLength": 25
        });
    });
  </script>

