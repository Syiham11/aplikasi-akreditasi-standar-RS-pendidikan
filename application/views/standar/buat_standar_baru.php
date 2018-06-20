

 
<?php echo form_open('standar/buat_standar_baru'); ?>
<div class="container">
<div class="panel panel-default">
<div class="panel-heading"><b>Membuat Standar Baru</b></div>

  <div class="panel-body">
    <p><?php echo validation_errors(); ?></p>
    <table class="table table-striped">
        <tr>
            <td><label for="title">No Standar</label></td>
            <td><input type="text" name="no_standar" id="no_standar" size="50"><span id="number_result"></span></td>
            <td></td>
        </tr>
        <tr>
            <td><label for="text">Nama standar</label></td>
            <td><textarea name="nama_standar" rows="10" cols="40"></textarea></td>
        </tr>
        <tr>
            <td><input  name="submit" id="submit" type="submit" value="Tambah Standar Baru" /></td>
        </tr>
    </table> 
    <br>
</div>
</div>
</div>

<script>  
 $(document).ready(function(){  
      $('#no_standar').change(function(){  
           var no_standar = $('#no_standar').val();  
           if(no_standar != '')  
           {  
                $.ajax({  
                     url:"<?php echo base_url(); ?>standar/cek_nomor_standar",  
                     method:"POST",  
                     data:{no_standar:no_standar},
                     datatype:'json',  
                     success:function(data){ 
                      console.log(data); 
                        if(data.status == 'show'){
                            $("#submit").show();           
                         }
                         else if(data.status == 'hide'){
                            $("#submit").hide();
                         }
                          $('#number_result').html(data.html);  
                     }  
                });  
           }  
      });  
 });  
 </script>  


 