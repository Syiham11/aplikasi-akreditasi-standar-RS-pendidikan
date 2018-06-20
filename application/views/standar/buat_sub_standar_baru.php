
 
<?php echo form_open('standar/buat_sub_standar_baru/'.$no_standar); ?>

<div class="container">
<div class="panel panel-default">
<div class="panel-heading"><b>Membuat Sub Standar Baru</b></div>

  <div class="panel-body">
   <p><?php echo validation_errors(); ?></p>
    <table class="table table-striped"> 
        <tr>
            <td><label for="title">No Sub standar</label></td>
             <td><input type="text" name="no_substandar" id="no_substandar" size="50"><span id="cek_hasil"></span></td>
            <td></td>
        </tr>
        <tr>
            <td><label for="text">Nama Sub standar</label></td>
            <td><textarea name="nama_substandar" rows="10" cols="40"></textarea></td>
        </tr>
       
        <tr>
            <td><input type="submit" name="submit" id="submit" value="Tambah Sub Standar" /></td>
        </tr>
    </table> 

<script>  
 $(document).ready(function(){
      $('#no_substandar').change(function(){  
           var no_substandar = $('#no_substandar').val();
           var no_standar_terpilih = <?php echo $no_standar; ?>

           if(no_substandar != '')  
           {  
                $.ajax({  
                     url:"<?php echo base_url(); ?>standar/cek_nomor_substandar/"+no_standar_terpilih,  
                     method:"POST",  
                     data:{no_substandar:no_substandar},
                     datatype:'json',  
                     success:function(data){
                          console.log(data); 
                         if(data.status == 'show'){
                            $("#submit").show();           
                         }
                         else if(data.status == 'hide'){
                            $("#submit").hide();
                         }
                         $('#cek_hasil').html(data.html);   
                     }
                       
                });  
           }  
      }); 
 });
 
 </script> 
