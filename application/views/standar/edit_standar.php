
 
<?php echo validation_errors(); ?>
 
<?php echo form_open('standar/edit_standar/'.$query['id']); ?>
<div class="container">
<div class="panel panel-default">
<div class="panel-heading"><b>Edit Standar</b></div>

  <div class="panel-body">
    <table class="table table-striped">

        <tr>
            <td><label for="title">No Standar</label></td>
            <td><input type="input" name="no_standar" id="no_standar" size="50" value="<?php echo $query['no_standar'] ?>" /> <span id="number_result"></span></td>
        </tr>
        <tr>
            <td><label for="text">Nama Standar</label></td>
            <td><textarea name="nama_standar" rows="10" cols="40"><?php echo $query['nama_standar'] ?></textarea></td>
        </tr>
        <tr>
            <td><input type="submit" name="submit" id="submit" value="Edit Standar" /></td>
        </tr>
    </table>

</div>
</div>
</div>

<script>  
 $(document).ready(function(){ 
      $('#no_standar').change(function(){  
           var no_standar = $('#no_standar').val();
           var nomor_standar = <?php echo $query['no_standar'] ?>;   
           if(no_standar != '')  
           {  
                $.ajax({  
                     url:"<?php echo base_url(); ?>standar/cek_edit_nomor_standar/"+nomor_standar,  
                     method:"POST",  
                     data:{no_standar:no_standar},
                     datatype:'json',  
                     success:function(data){ 
                      console.log(data);
                          if(data.edit == 'no'){
                             $('#number_result').hide();
                            $("#submit").show();      
                          }
                          else{

                          if(data.status == 'show'){
                                $("#submit").show();           
                             }
                             else if(data.status == 'hide'){
                                $("#submit").hide();
                             }
                               $('#number_result').show(); 
                              $('#number_result').html(data.html);
                         }  
                     }  
                });  
           }  
      });  
 });  
 </script>  