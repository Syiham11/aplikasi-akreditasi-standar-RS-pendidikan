<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Standar_model extends CI_Model {

	public function __construct()
    {
        $this->load->database();
         $this->load->helper('url');
 
    }
    
    public function tampil_semua_standar($slug = FALSE)
    {
        if ($slug === FALSE)
        {
            /*$query = $this->db->get('news');
            return $query->result_array();*/
            $this->db->select("*");
            $this->db->from("standar");
            $this->db->order_by("no_standar", "asc");
            $query = $this->db->get();
            return $query->result();   
        }
 
        $query = $this->db->get_where('news', array('slug' => $slug));
        return $query->row_array();
    }
    
    public function lihat_standar_per_id($id = 0)
    {
        if ($id === 0)
        {
            $query = $this->db->get('standar');
            return $query->result_array();
        }
 
        $query = $this->db->get_where('standar', array('id' => $id));
        return $query->row_array();
    }

    public function lihat_sub_standar_per_id($id = 0)
    {
        if ($id === 0)
        {
            $query = $this->db->get('substandar');
            return $query->result_array();
        }
 
        $query = $this->db->get_where('substandar', array('id' => $id));
        return $query->row_array();
    }

    public function lihat_sub_standar_per_id1($id = 0)
    {
        if ($id === 0)
        {
            $query = $this->db->get('substandar_1');
            return $query->result_array();
        }
 
        $query = $this->db->get_where('substandar_1', array('id' => $id));
        return $query->row_array();
    }

    
    public function tambah_standar($id = 0)
    {
        $this->load->helper('url');
 
        /*$slug = url_title($this->input->post('title'), 'dash', TRUE);*/
 
        $data = array(
            'no_standar' => $this->input->post('no_standar'),
            /*'slug' => $slug,*/
            'nama_standar' => $this->input->post('nama_standar')
        );
        
        if ($id == 0) {
            return $this->db->insert('standar', $data);
        } else {
            $this->db->where('id', $id);
            return $this->db->update('standar', $data);
        }
    }

    public function edit_sub_standar($id, $no_Standar)
    {
       
        /*$slug = url_title($this->input->post('title'), 'dash', TRUE);*/
 
       
        
        if ($id != 0) { 
             $data = array(
            'no_substandar' => $this->input->post('no_substandar'),
            /*'slug' => $slug,*/
            'nama_substandar' => $this->input->post('nama_substandar'),
            'no_standar' => $no_Standar

            );

            $this->db->where('id', $id);
            return $this->db->update('substandar', $data);
        } 
           
        
    }

    public function edit_sub_standar1($id, $no_Standar, $no_substandar)
    {
       
        /*$slug = url_title($this->input->post('title'), 'dash', TRUE);*/
 
       
        
        if ($id != 0) { 
             $data = array(
            'no_substandar_1' => $this->input->post('no_substandar'),
            /*'slug' => $slug,*/
            'nama_substandar_1' => $this->input->post('nama_substandar'),
            'no_substandar' => $no_substandar,
            'no_standar' => $no_Standar

            );

            $this->db->where('id', $id);
            return $this->db->update('substandar_1', $data);
        } 
           
        
    }



    public function tambah_sub_standar($no_Standar)
    {
 
        /*$slug = url_title($this->input->post('title'), 'dash', TRUE);*/
 
        $data = array(
            'no_substandar' => $this->input->post('no_substandar'),
            /*'slug' => $slug,*/
            'nama_substandar' => $this->input->post('nama_substandar'),
            'no_standar' => $no_Standar,
            'no_substandar_ditampilkan' => $no_standar.'.'.$this->input->post('no_substandar')


            );
            return $this->db->insert('substandar', $data);
           
        
    }

    public function tambah_sub_standar1($no_Standar,$no_substandar)
    {
 
        /*$slug = url_title($this->input->post('title'), 'dash', TRUE);*/
 
        $data = array(
            'no_substandar_1' => $this->input->post('no_substandar'),
            /*'slug' => $slug,*/
            'nama_substandar_1' => $this->input->post('nama_substandar'),
            'no_substandar' => $no_substandar,
            'no_standar' => $no_Standar,
            );
            return $this->db->insert('substandar_1', $data);
           
        
    }

    
    public function hapus_standar($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('standar');
    }
    public function hapus_sub_standar($id){
        $this->db->where('id', $id);
        return $this->db->delete('substandar');
     }
      public function hapus_sub_standar1($id){
        $this->db->where('id', $id);
        return $this->db->delete('substandar_1');
     }

     public function hapus_all($no_standar){
         $this->db->delete('standar', array('no_standar' => $no_standar)); 
        $this->db->delete('substandar', array('no_standar' => $no_standar));
        $this->db->delete('tb_uploadimage', array('no_standar_gbr' => $no_standar));
     }

     public function hapus_substandar_image($no_standar){
        $this->db->delete('substandar', array('no_standar' => $no_standar));
        $this->db->delete('tb_uploadimage', array('no_standar_gbr' => $no_standar));
     }
    public function tampil_semua_sub_standar($no_standar)
    {    
  
            $this->db->select("*");
            $this->db->from("substandar");
            $this->db->where_in('no_standar', $no_standar );
            $this->db->order_by("no_substandar", "asc");
            $query = $this->db->get();
            return $query->result();  
    }

    public function sub_standar_details($no_standar,$no_sub_standar)
    {
        $query = $this->db->get_where('substandar', array('no_standar'=>$no_standar,'no_substandar' => $no_sub_standar));
        return $query->row_array();
    }



     

    public function masukkan_dokumen_database($data){
       $this->db->insert('tb_uploadimage', $data);
       return TRUE;
    }

    public function tampilkan_semua_bukti($no_standar,$no_substandar) {
    $query = $this->db->get_where('tb_uploadimage', array('no_standar_gbr' => $no_standar, 'no_substandar_gbr' => $no_substandar));
 
        //cek apakah ada data
            return $query->result();
        
    } 

     function lihat_dokumen_per_id($where) {
        $this->db->from('tb_uploadimage');
        $this->db->where($where);
        $query = $this->db->get();
 
        //cek apakah ada data
        if ($query->num_rows() == 1) {
            return $query->row();
        }
    }

function get_update($data,$where){
       $this->db->where($where);
       $this->db->update('tb_uploadimage', $data);
       return TRUE;
    }

function get_delete($where){
       $this->db->where($where);
       $this->db->delete('tb_uploadimage');
       return TRUE;
    }


function cek_nomor_standar($number)  
      {  
           $this->db->where('no_standar', $number);  
           $query = $this->db->get("standar");  
           if($query->num_rows() > 0)  
           {  
                return true;  
           }  
           else  
           {  
                return false;  
           }  
      }
function cek_nomor_substandar($number,$number2)  
      {  
           $this->db->where('no_substandar', $number);
           $this->db->where('no_standar',$number2);  
           $query = $this->db->get("substandar");  
           if($query->num_rows() > 0)  
           {  
                return true;  
           }  
           else  
           {  
                return false;  
           }  
      }
  function cek_nomor_substandar1($number,$number2,$number3)  
      {  
           $this->db->where('no_substandar_1', $number);
           $this->db->where('no_standar',$number2); 
           $this->db->where('no_substandar',$number3); 
           $query = $this->db->get("substandar_1");  
           if($query->num_rows() > 0)  
           {  
                return true;  
           }  
           else  
           {  
                return false;  
           }  
      }
    public function tampil_semua_sub_standar1($no_standar, $no_sub_standar)
    {    
            $this->db->select("*");
            $this->db->from("substandar_1");
            $this->db->order_by("no_substandar_1", "asc");
            $this->db->where_in('no_standar', $no_standar );
            $this->db->where_in('no_substandar', $no_sub_standar);
            $query = $this->db->get();
            return $query->result();   
    }



	
}