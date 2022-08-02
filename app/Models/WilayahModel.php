<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class WilayahModel extends Model{
    // protected $table = 'wilayah_2022';
    // protected $allowedFields = ['kode', 'nama'];
    public function __construct() {
        parent::__construct();
        $db = \Config\Database::connect();
    }

    public function getprovinsi() {
 
        $query = $this->db->query('SELECT * FROM provinces');
        return $query->getResult();
    }
    
    public function getkota($postData) {
        $sql = 'SELECT * FROM regencies where province_id ='.$postData['prov'] ;
        $query =  $this->db->query($sql);
         
        return $query->getResult();
    }    

    public function getkecamatan($postData) {
        $sql = 'SELECT * FROM districts where regency_id ='.$postData['kota'] ;
        $query =  $this->db->query($sql);
         
        return $query->getResult();
    }   
    
    public function getdesa($postData) {
        $sql = 'SELECT * FROM villages where district_id ='.$postData['kec'] ;
        $query =  $this->db->query($sql);
         
        return $query->getResult();
    }   

    public function getnamaprov($postData) {
        $sql = 'SELECT name FROM provinces where id ='.$postData['prov'] ;
        $query =  $this->db->query($sql);
         
        return $query->getResult();
    } 
    
    public function getnamakota($postData) {
        $sql = 'SELECT name FROM regencies where id ='.$postData['kota'] ;
        $query =  $this->db->query($sql);
         
        return $query->getResult();
    }

    public function getnamakec($postData) {
        $sql = 'SELECT name FROM districts where id ='.$postData['kec'] ;
        $query =  $this->db->query($sql);
         
        return $query->getResult();
    }

    public function getnamadesa($postData) {
        $sql = 'SELECT name FROM villages where id ='.$postData['desa'] ;
        $query =  $this->db->query($sql);
         
        return $query->getResult();
    }
}