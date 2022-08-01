<?php
 
namespace App\Models;
 
use CodeIgniter\Model;

date_default_timezone_set("Asia/Jakarta");
 
class Employee_model extends Model
{
    protected $table = 'employees';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_karyawan', 'usia', 'status_vaksin_1', 'status_vaksin_2'];

    protected $useSoftDeletes = TRUE;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
 
    // public function getKaryawan($id = false, $user_id = true)
    // {
    //     if ($id === false) {
    //         return $this->getWhere(['user_id' => $user_id]);
    //     } else {
    //         return $this->getWhere(['id' => $id]);
    //     }
    // }
 
    // public function saveKaryawan($data)
    // {
    //     $builder = $this->db->table($this->table);
    //     return $builder->insert($data);
    // }

    // public function editKaryawan($data, $id)
    // {
    //     $builder = $this->db->table($this->table);
    //     $builder->where('id', $id);
    //     return $builder->update($data);
    // }

    // public function hapusKaryawan($id)
    // {
    //     $builder = $this->db->table($this->table);
    //     return $builder->delete(['id' => $id]);
    // }
}