
    <div class="container">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="panel panel-default">
  <div class="panel-heading" style="font-size:36px; text-align:center"><b>Daftar Standar Utama</b></div>
  <div class="panel-body">
     <p class="inner"><a href="<?php echo site_url('standar/buat_standar_baru')?>" class="btn btn-info btn-sm">Tambah Standar Utama</a></p>
    <p><div style="display: none" name="successMessage" id="successMessage" class="col-md-12"><div class="alert alert-success" id="alert">Tambah Standar Baru Sukses</div></div></p>
    <p><div style="display: none" name="deleteMessage" id="deleteMessage" class="col-md-12"><div class="alert alert-success" id="alert">Hapus Standar Sukses</div></div></p>
    <p><div style="display: none" name="editMessage" id="editMessage" class="col-md-12"><div class="alert alert-success" id="alert">Edit Standar Sukses</div></div></p>
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
       <table  id=myTable class="table table-striped" style="width:100%">
        <thead>
         <tr>
         <th style="width:6%">No</th>
         <th style="width:54%">Nama Standar</th>
         <th style="width:40%">Action</th>
         </tr>
        </thead>
        <tbody>
       <?  foreach($query as $row){ ;?>
         <tr>
           <td style="width:6%" ><?php echo $row->no_standar; ?></td>
          <td style="width:54%" ><?php echo $row->nama_standar; ?></td>
          <td style="width:40%" >
           <a href="<?php echo site_url('standar/index_sub_standar/'.$row->no_standar); ?>" class="btn btn-info btn-sm">Lihat Sub Standar 1</a>
           <a href="<?php echo site_url('standar/edit_standar/'.$row->id.'/'.$row->no_standar); ?>" class="btn btn-warning btn-sm">Edit Standar</a>
           <a href="<?php echo site_url('standar/hapus_standar/'.$row->id.'/'.$row->no_standar); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda Yakin menghapus data ini?')">Hapus Standar</a>
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

