<?php
class Standar extends CI_Controller {
 
var $tamp;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('standar_model');
        $this->load->helper('url_helper');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
    }
 
    public function index()
    {
        $data['query'] = $this->standar_model->tampil_semua_standar();
 
        $this->load->view('templates/header', $data);
        $this->load->view('standar/index', $data);
        $this->load->view('templates/footer');
    }

    public function index_sub_standar()
    {

        $no_standar = $this->uri->segment(3);
        $data['query'] = $this->standar_model->tampil_semua_sub_standar($no_standar);
        $data['no_standar'] = $no_standar;
 
        $this->load->view('templates/header');
        $this->load->view('standar/index_sub_standar', $data);
        $this->load->view('templates/footer');
    }

    public function index_sub_standar_1()
    {
        $no_standar = $this->uri->segment(3);
        $no_sub_standar = $this->uri->segment(4);
        $data['query'] = $this->standar_model->tampil_semua_sub_standar1($no_standar, $no_sub_standar);
        $data['no_standar'] = $no_standar;
        $data['no_sub_standar'] = $no_sub_standar;
 
        $this->load->view('templates/header');
        $this->load->view('standar/index_sub_standar_1', $data);
        $this->load->view('templates/footer');
    }



 
    public function lihat_semua_bukti($slug = NULL)
    {
        $no_standar = $this->uri->segment(3);
        $no_sub_standar = $this->uri->segment(4);
        //$no_sub_standar_1 = $this->uri->segment(5);
       

        $data['no_standar'] = $no_standar;
        $data['no_substandar'] = $no_sub_standar;
        //$data['no_substandar_1'] = $no_sub_standar_1;

        $data['news_item'] = $this->standar_model->sub_standar_details($no_standar,$no_sub_standar);
        $data['query'] = $this->standar_model->tampilkan_semua_bukti($no_standar,$no_sub_standar);
        
        /*if (empty($data['news_item']))
        {
            show_404();
        }*/
 
        /*$data['title'] = $data['news_item']['title'];*/
 
        $this->load->view('templates/header');
        $this->load->view('standar/lihat_semua_bukti', $data);
        $this->load->view('templates/footer');
    }
    
    public function buat_standar_baru()
    {
        $this->form_validation->set_rules('no_standar', 'No_Standar', 'required|numeric');
        $this->form_validation->set_rules('nama_standar', 'Nama_Standar', 'required');
 
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header');
            $this->load->view('standar/buat_standar_baru');
            $this->load->view('templates/footer');
 
        }
        else
        {
            $this->standar_model->tambah_standar();
            $js = "1";
            $this->session->set_flashdata('js',$js);
            //$this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Tambah Standar Baru Sukses</div></div>");
           redirect( base_url() . 'standar');
        }
    }

    public function buat_sub_standar_baru()
    {
        $no_standar = $this->uri->segment(3);
        $data['query'] = $this->standar_model->tampil_semua_standar();
        $data['no_standar'] = $no_standar;
        $this->form_validation->set_rules('no_substandar', 'No_Sub_Standar', 'required|numeric');
        $this->form_validation->set_rules('nama_substandar', 'Nama_Sub_Standar', 'required');
        
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header');
            $this->load->view('standar/buat_sub_standar_baru',$data);
            $this->load->view('templates/footer');
 
        }
        else
        {
            $js = "1";
            $this->session->set_flashdata('js',$js);
            $this->standar_model->tambah_sub_standar($no_standar);
            redirect( base_url() . 'standar/index_sub_standar/'.$no_standar);  
        }
    }

     public function buat_sub_standar_baru1()
    {
        $no_standar = $this->uri->segment(3);
        $no_substandar = $this->uri->segment(4);
        $data['query'] = $this->standar_model->tampil_semua_standar();
        $data['no_standar'] = $no_standar;
        $data['no_substandar'] = $no_substandar;

        $this->form_validation->set_rules('no_substandar', 'No_Sub_Standar', 'required|numeric');
        $this->form_validation->set_rules('nama_substandar', 'Nama_Sub_Standar', 'required');
        
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header');
            $this->load->view('standar/buat_sub_standar_baru1',$data);
            $this->load->view('templates/footer');
 
        }
        else
        {
            $js = "1";
            $this->session->set_flashdata('js',$js);
            $this->standar_model->tambah_sub_standar1($no_standar,$no_substandar);
            redirect( base_url() . 'standar/index_sub_standar_1/'.$no_standar.'/'.$no_substandar);  
        }
    }
    
    public function edit_standar()
    {
        $id = $this->uri->segment(3);
        
        if (empty($id))
        {
            show_404();
        }
        
                
        $data['query'] = $this->standar_model->lihat_standar_per_id($id);
        
        $this->form_validation->set_rules('no_standar', 'No_Standar', 'required|numeric');
        $this->form_validation->set_rules('nama_standar', 'Nama_Standar', 'required');
 
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header');
            $this->load->view('standar/edit_standar', $data);
            $this->load->view('templates/footer');
 
        }
        else
        {
            $js = "2";
           $this->session->set_flashdata('js',$js);
            $this->standar_model->tambah_standar($id);
            //$this->load->view('news/success');
            redirect( base_url() . 'standar');
        }
    }

    public function edit_sub_standar()
    {
        $id = $this->uri->segment(3);
        $no_standar = $this->uri->segment(4);

        
        if (empty($id))
        {
            show_404();
        }
               
        $data['query'] = $this->standar_model->lihat_sub_standar_per_id($id);
         $data['query_2'] = $this->standar_model->tampil_semua_standar();
        
        $this->form_validation->set_rules('no_substandar', 'No_Substandar', 'required');
        $this->form_validation->set_rules('nama_substandar', 'Nama_Substandar', 'required');
 
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('standar/edit_sub_standar', $data);
            $this->load->view('templates/footer');
 
        }
        else
        {
             $js = "2";
           $this->session->set_flashdata('js',$js);
            $this->standar_model->edit_sub_standar($id,$no_standar);
            redirect( base_url() . 'standar/index_sub_standar/'.$no_standar);
        }
    }

    public function edit_sub_standar1()
    {
        $id = $this->uri->segment(3);
        $no_standar = $this->uri->segment(4);
        $no_substandar = $this->uri->segment(5);

        
        if (empty($id))
        {
            show_404();
        }
               
        $data['query'] = $this->standar_model->lihat_sub_standar_per_id1($id);
         //$data['query_2'] = $this->standar_model->tampil_semua_standar1();
        
        $this->form_validation->set_rules('no_substandar', 'No_Substandar', 'required');
        $this->form_validation->set_rules('nama_substandar', 'Nama_Substandar', 'required');
 
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('standar/edit_sub_standar1', $data);
            $this->load->view('templates/footer');
 
        }
        else
        {
             $js = "2";
           $this->session->set_flashdata('js',$js);
            $this->standar_model->edit_sub_standar1($id,$no_standar,$no_substandar);
            redirect( base_url() . 'standar/index_sub_standar_1/'.$no_standar.'/'.$no_substandar);
        }
    }
    
    public function hapus_standar()
    {
        $id = $this->uri->segment(3);
        $no_standar = $this->uri->segment(4);

        if (empty($id))
        {
            show_404();
        }
                
        $js = "3";
        $this->session->set_flashdata('js',$js);
        //$this->standar_model->hapus_standar($id);  
        $this->standar_model->hapus_all($no_standar);      
        redirect( base_url() . 'standar');  
    }

    public function hapus_sub_standar()
    {
        
        $id = $this->uri->segment(3);
        $no_standar = $this->uri->segment(4);
        
        if (empty($id))
        {
            show_404();
        }
             $js = "3";
             $this->session->set_flashdata('js',$js);
             $this->standar_model->hapus_sub_standar($id); 
             $this->standar_model->hapus_substandar_image($no_standar);       
             redirect( base_url() . 'standar/index_sub_standar/'.$no_standar);   
    }

    public function hapus_sub_standar1()
    {
        
        $id = $this->uri->segment(3);
        $no_standar = $this->uri->segment(4);
        $no_substandar = $this->uri->segment(5);
        
        if (empty($id))
        {
            show_404();
        }
             $js = "3";
             $this->session->set_flashdata('js',$js);
             $this->standar_model->hapus_sub_standar($id);        
             redirect( base_url() . 'standar/index_sub_standar_1/'.$no_standar.'/'.$no_substandar);   
    }

    public function upload_dokumen(){
        
        $no_standar = $this->uri->segment(3);
        $no_substandar = $this->uri->segment(4);
        //$no_substandar_1 = $this->uri->segment(5);
       // $data['id'] = $id;
        $data['no_standar'] = $no_standar;
        $data['no_substandar'] = $no_substandar;
        //$data['no_substandar_1'] = $no_substandar_1;
        

         $this->form_validation->set_rules('filefoto', 'File_Foto', 'required');
        $this->form_validation->set_rules('textket', 'Textket', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header');
            $this->load->view('standar/upload_dokumen',$data);
            $this->load->view('templates/footer');

        }
    }

    public function insert(){
        $no_standar = $this->uri->segment(3);
        $no_substandar = $this->uri->segment(4);
        //$no_substandar_1 = $this->uri->segment(5);
        $this->load->library('upload');
        $nmfile = "file_".time(); //nama file saya beri nama langsung dan diikuti fungsi time
        $config['upload_path'] = './assets/uploads/'; //path folder
        $config['allowed_types'] = 'jpg|gif|jpeg|png|bmp|pdf'; //type yang dapat diakses bisa anda sesuaikan
        $config['max_size'] = '20048'; //maksimum besar file 2M
        $config['max_width']  = '4048'; //lebar maksimum 1288 px
        $config['max_height']  = '4048'; //tinggi maksimu 768 px
        $config['file_name'] = $nmfile; //nama yang terupload nantinya
 
        $this->upload->initialize($config);
         
        if($_FILES['filefoto']['name'])
        {
            if ($this->upload->do_upload('filefoto'))
            {
                $gbr = $this->upload->data();
                $data = array(
                  'no_standar_gbr' => $no_standar,
                  'no_substandar_gbr' => $no_substandar,
                  //'no_substandar1_gbr'=> $no_substandar_1,
                  'nm_gbr' =>$gbr['file_name'],
                  'tipe_gbr' =>$gbr['file_type'],
                  'ket_gbr' =>$this->input->post('textket')
                   
                );
 
                $this->standar_model->masukkan_dokumen_database($data); //akses model untuk menyimpan ke database
                //pesan yang muncul jika berhasil diupload pada session flashdata*/
                //$this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Upload gambar berhasil !!</div></div>");
                 $js = "1";
                 $this->session->set_flashdata('js',$js);
                redirect(base_url() . 'standar/lihat_semua_bukti/'.$no_standar.'/'.$no_substandar.'/'.$no_substandar_1); //jika berhasil maka akan ditampilkan view vupload
            }else{
                //pesan yang muncul jika terdapat error dimasukkan pada session flashdata
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('error',$error['error']);
                $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Gagal upload gambar !!</div></div>");
                redirect(base_url() . 'standar/upload_dokumen/'.$no_standar.'/'.$no_substandar.'/'.$no_substandar_1); //jika gagal maka akan ditampilkan form upload
            }
        }
    }

    public function edit_dokumen(){
       $id = $this->uri->segment(3);
        $no_standar = $this->uri->segment(4);
        $no_sub_standar = $this->uri->segment(5);
        //$no_sub_standar_1 = $this->uri->segment(6);
       $where=array('id'=>$id); //array where query untuk menampilkan gambar per id
       $data['row'] = $this->standar_model->lihat_dokumen_per_id($where);   //query dari model ambil per id
       $data['id'] = $id;
       $data['no_standar'] = $no_standar;
       $data['no_sub_standar'] = $no_sub_standar;
       //$data['no_sub_standar_1'] = $no_sub_standar_1;
 
       //utk form edit nya, saya tambahkan sebuah view bernama feupload.php
       $this->load->view('templates/header');
       $this->load->view('standar/edit_dokumen',$data);
       $this->load->view('templates/footer');
   }

   public function update_gambar(){
        $idgbr = $this->uri->segment(3);
        $no_standar = $this->uri->segment(4);
        $no_sub_standar = $this->uri->segment(5);
        //$no_sub_standar_1 = $this->uri->segment(6);
       $this->load->library('upload');// library dapat di load di fungsi , di autoload atau di construc nya tinggal pilih salah satunya
       $nmfile = "file_".time(); //nama file saya beri nama langsung dan diikuti fungsi time
       $path   = './assets/uploads/'; //path folder
       $config['upload_path'] = $path; //variabel path untuk config upload
       $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|pdf'; //type yang dapat diakses bisa anda sesuaikan
       $config['max_size'] = '5048'; //maksimum besar file 2M
       $config['max_width']  = '4048'; //lebar maksimum 1288 px
       $config['max_height']  = '4048'; //tinggi maksimu 768 px
       $config['file_name'] = $nmfile; //nama yang terupload nantinya
 
       $this->upload->initialize($config);
 
       $idgbr      = $this->input->post('kode'); /* variabel id gambar */
       $filelama   = $this->input->post('filelama'); /* variabel file gambar lama */
 
       if($_FILES['filefoto']['name'])
       {
           if ($this->upload->do_upload('filefoto'))
           {
               $gbr = $this->upload->data();
               $data = array(
                 'nm_gbr' =>$gbr['file_name'],
                 'tipe_gbr' =>$gbr['file_type'],
                 'ket_gbr' =>$this->input->post('textket')
 
               );
 
               @unlink($path.$filelama);//menghapus gambar lama, variabel dibawa dari form
 
               $where =array('id'=>$idgbr); //array where query sebagai identitas pada saat query dijalankan
               $this->standar_model->get_update($data,$where); //akses model untuk menyimpan ke database
 
               //$this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Edit dan Upload dokumen berhasil !!</div></div>"); //pesan yang muncul jika berhasil diupload pada session flashdata
                 $js = "2";
                 $this->session->set_flashdata('js',$js);
               redirect(base_url() .'standar/lihat_semua_bukti/'.$no_standar.'/'.$no_sub_standar.'/'.$no_sub_standar_1); //jika berhasil maka akan ditampilkan view vupload
 
           }else{  /* jika upload gambar gagal maka akan menjalankan skrip ini */
               $er_upload=$this->upload->display_errors(); /* untuk melihat error uploadnya apa */
               //pesan yang muncul jika terdapat error dimasukkan pada session flashdata
               //$this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Gagal edit dan upload dokumen !! ".$er_upload."</div></div>");
               redirect(base_url().'standar/edit_dokumen/'.$id.'/'.$no_standar.'/'.$no_sub_standar.'/'.$no_sub_standar_1); //jika gagal maka akan ditampilkan form upload
           }
       }else{ /* jika file foto tidak ada maka query yg dijalankan adalah skrip ini  */
 
           $data = array(
               'ket_gbr' =>$this->input->post('textket')
           );
 
           $where =array('id'=>$idgbr); //array where query sebagai identitas pada saat query dijalankan
           $this->standar_model->get_update($data,$where); //akses model untuk menyimpan ke database
 
           //$this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Berhasil edit, dokumen tidak ada diupload !!</div></div>");
            $js = "2";
            $this->session->set_flashdata('js',$js);
           redirect(base_url() .'standar/lihat_semua_bukti/'.$no_standar.'/'.$no_sub_standar.'/'.$no_sub_standar_1); /* jika berhasil maka akan kembali ke home upload */
       }
   }

    

   public function delete_image(){
        $idgbr = $this->uri->segment(3);
        $no_standar = $this->uri->segment(4);
        $no_sub_standar = $this->uri->segment(5);
        $no_sub_standar_1 = $this->uri->segment(6);
       /* variabel di deklarasikan */
        /* variabel id gambar */
 
       /* query menampilkan gambar dibuat dulu agar gambarnya dihapus sebelum dihapus dari database */
       $path= './assets/uploads/';
       $ardel  = array('id'=>$idgbr);
       $rowdel = $this->standar_model->lihat_dokumen_per_id($ardel);
 
       /* file gambar dihapus dari folder */
       @unlink($path.$rowdel->nm_gbr);
 
       /* query hapus dilanjutkan ke model get_delete */
       $this->standar_model->get_delete($ardel); //karna array where querynya sama, maka saya langsung include saja $ardel
 
       //$this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Berhasil hapus data dokumen dan file dokumen dari folder !!</div></div>");
        $js = "3";
        $this->session->set_flashdata('js',$js);
       redirect(base_url() .'standar/lihat_semua_bukti/'.$no_standar.'/'.$no_sub_standar.'/'.$no_sub_standar_1 );/* jika berhasil maka akan kembali ke home upload */
   }

public function cek_nomor_standar()  
    {  
                header('Content-Type: application/json');
                 if(!is_numeric($_POST['no_standar'])){
                    $data['status'] ='hide';
                    $data['html'] = '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> input harus angka</label>';
                          echo json_encode($data); 

                }else{

                  if($this->standar_model->cek_nomor_standar($_POST['no_standar']))  
                  {  
                       //echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> Number already register</label>'; 
                        $data['status'] ='hide';
                        $data['html'] = '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span>No Standar sudah dipakai</label>';
                        echo json_encode($data); 
                        
                  }  
                  else  
                  {  
                       //echo '<label class="text-success"><span class="glyphicon glyphicon-ok"></span> Number Available</label>';
                        $data['status'] ='show';
                        $data['html'] = '<label class="text-success"><span class="glyphicon glyphicon-ok"></span> No Standar bisa dipakai</label>';
                        echo json_encode($data);  
                  }
                }   
    }

public function cek_nomor_substandar()  
    { 
                $nomor_standar = $this->uri->segment(3) ;
                header('Content-Type: application/json'); 

                if(!is_numeric($_POST['no_substandar'])){
                    $data['status'] ='hide';
                    $data['html'] = '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> input harus angka</label>';
                          echo json_encode($data); 

                }else{

                if($this->standar_model->cek_nomor_substandar($_POST['no_substandar'],$nomor_standar))  
                    {  
                         //echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> Number already register</label>'; 
                          $data['status'] ='hide';
                          $data['html'] = '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> No Sub Standar sudah dipakai</label>';
                          echo json_encode($data); 
                    }  
                    else  
                    {  
                         //echo '<label class="text-success"><span class="glyphicon glyphicon-ok"></span> Number Available</label>';
                          $data['status'] ='show';
                          $data['html'] = '<label class="text-success"><span class="glyphicon glyphicon-ok"></span> No Sub Standar bisa dipakai<label>';
                          echo json_encode($data);  
                    }
                }   
                
    }
    public function cek_nomor_substandar1()  
    { 
                $nomor_standar = $this->uri->segment(3) ;
                $no_sub_standar = $this->uri->segment(4) ;
                header('Content-Type: application/json'); 
                if($this->standar_model->cek_nomor_substandar1($_POST['no_substandar'],$nomor_standar,$no_sub_standar))  
                {  
                     //echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> Number already register</label>'; 
                      $data['status'] ='hide';
                      $data['html'] = '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> No Sub Standar sudah dipakai</label>';
                      echo json_encode($data); 
                }  
                else  
                {  
                     //echo '<label class="text-success"><span class="glyphicon glyphicon-ok"></span> Number Available</label>';
                      $data['status'] ='show';
                      $data['html'] = '<label class="text-success"><span class="glyphicon glyphicon-ok"></span> No Sub Standar bisa dipakai<label>';
                      echo json_encode($data);  
                }   
    }
public function cek_edit_nomor_standar()  
    {  
                header('Content-Type: application/json');
                $nomor_standar = $this->uri->segment(3) ;

                 if(!is_numeric($_POST['no_standar'])){
                    $data['status'] ='hide';
                    $data['html'] = '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> input harus angka</label>';
                          echo json_encode($data); 

                }else{

                    if($_POST['no_standar'] == $nomor_standar){
                         $data['edit'] ='no';
                         echo json_encode($data); 
                    }
                    else{
                    if($this->standar_model->cek_nomor_standar($_POST['no_standar']))  
                    {  
                         //echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> Number already register</label>'; 
                          $data['status'] ='hide';
                          $data['edit'] ='yes';
                          $data['html'] = '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span>No Standar sudah dipakai</label>';
                          echo json_encode($data); 
                          
                    }  
                    else  
                    {  
                         //echo '<label class="text-success"><span class="glyphicon glyphicon-ok"></span> Number Available</label>';
                          $data['status'] ='show';
                          $data['edit'] ='yes';
                          $data['html'] = '<label class="text-success"><span class="glyphicon glyphicon-ok"></span> No Standar bisa dipakai</label>';
                          echo json_encode($data);  
                    }
                    }
                }   
    }

public function cek_edit_nomor_substandar()  
    { 
                header('Content-Type: application/json');

                $no_standar = $this->uri->segment(3) ;
                $nomor_sub_standar = $this->uri->segment(4) ;

                if(!is_numeric($_POST['no_substandar'])){
                    $data['status'] ='hide';
                    $data['html'] = '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> input harus angka</label>';
                          echo json_encode($data); 

                }else{

                    if($_POST['no_substandar'] == $nomor_sub_standar){
                         $data['edit'] ='no';
                         echo json_encode($data); 
                    }
                    else{
                    if($this->standar_model->cek_nomor_substandar($_POST['no_substandar'],$no_standar))  
                    {  
                         //echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> Number already register</label>'; 
                          $data['status'] ='hide';
                          $data['edit'] ='yes';
                          $data['html'] = '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> No Sub Standar sudah dipakai</label>';
                          echo json_encode($data); 
                    }  
                    else  
                    {  
                         //echo '<label class="text-success"><span class="glyphicon glyphicon-ok"></span> Number Available</label>';
                          $data['status'] ='show';
                          $data['edit'] ='yes';
                          $data['html'] = '<label class="text-success"><span class="glyphicon glyphicon-ok"></span> No Sub Standar bisa dipakai<label>';
                          echo json_encode($data);  
                    }
                    }
               }   
    }
    public function cek_edit_nomor_substandar1()  
    { 
                header('Content-Type: application/json');

                $no_standar = $this->uri->segment(3) ;
                $nomor_sub_standar = $this->uri->segment(4) ;
                if($_POST['no_substandar'] == $nomor_sub_standar){
                     $data['edit'] ='no';
                     echo json_encode($data); 
                }
                else{
                if($this->standar_model->cek_nomor_substandar1($_POST['no_substandar'],$no_standar,$nomor_sub_standar))  
                {  
                     //echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> Number already register</label>'; 
                      $data['status'] ='hide';
                      $data['edit'] ='yes';
                      $data['html'] = '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> No Sub Standar sudah dipakai</label>';
                      echo json_encode($data); 
                }  
                else  
                {  
                     //echo '<label class="text-success"><span class="glyphicon glyphicon-ok"></span> Number Available</label>';
                      $data['status'] ='show';
                      $data['edit'] ='yes';
                      $data['html'] = '<label class="text-success"><span class="glyphicon glyphicon-ok"></span> No Sub Standar bisa dipakai<label>';
                      echo json_encode($data);  
                }
                }   
    }







    

}