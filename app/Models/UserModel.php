<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class UserModel extends Model{
    protected $table = 'users';
    protected $allowedFields = ['user_id','user_name','user_email','user_password','user_created_at'];

    public function editUser($data, $id)
    {
        $builder = $this->db->table($this->table);
        $builder->where('user_id', $id);
        return $builder->update($data);
    }
}