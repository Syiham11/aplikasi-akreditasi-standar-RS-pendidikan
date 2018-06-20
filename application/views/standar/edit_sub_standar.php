
 
<?php echo validation_errors(); ?>
 
<?php echo form_open('standar/edit_sub_standar/'.$query['id'].'/'.$query['no_standar']); ?>
<div class="container">
<div class="panel panel-default">
<div class="panel-heading"><b>Edit Sub Standar</b></div>

  <div class="panel-body">
    <table class="table table-striped">
        <tr>
            <td><label for="title">No Sub standar</label></td>
            <td><input type="input" name="no_substandar" id="no_substandar" size="50" value="<?php echo $query['no_substandar'] ?>" /><span id="cek_hasil"></span></td>
            <td></td>
        </tr>
        <tr>
            <td><label for="text">Nama Sub standar</label></td>
            <td><textarea name="nama_substandar" rows="10" cols="40"><?php echo $query['nama_substandar'] ?></textarea></td>
        </tr>
        <tr>
            <td><input type="submit" name="submit" id="submit" value="Edit Sub Standar 1" /></td>
        </tr>
    </table>

</div>
</div>
</div>

<script>  
 $(document).ready(function(){
      $('#no_substandar').change(function(){  
           var no_substandar = $('#no_substandar').val();
           //var no_standar_terpilih = $('#no_standar_terpilih').val();
           var no_sub_standar = <?php echo $query['no_substandar'] ?>;
           var no_standar =<?php echo $query['no_standar']?>;

           if(no_substandar != '')  
           {  
                $.ajax({  
                     url:"<?php echo base_url(); ?>standar/cek_edit_nomor_substandar/"+no_standar+"/"+no_sub_standar,  
                     method:"POST",  
                     data:{no_substandar:no_substandar},
                     datatype:'json',  
                     success:function(data){
                          console.log(data);
                         if(data.edit == 'no'){
                            $('#cek_hasil').hide();
                            $("#submit").show(); 
                         }
                        else{
                        if(data.status == 'show'){
                            $("#submit").show();           
                         }
                         else if(data.status == 'hide'){
                            $("#submit").hide();
                         }
                          $('#cek_hasil').show();  
                         $('#cek_hasil').html(data.html);
                        }   
                     }
                       
                });  
           }  
      }); 
 });
 
 </script> 
