<?php namespace App\Controllers;
 
use CodeIgniter\Controller;
use App\Models\UserModel;
 
class Login extends Controller
{
    public function index()
    {
        helper(['form']);
        echo view('login');
    } 
 
    public function auth()
    {
        $session = session();
        $model = new UserModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $data = $model->where('user_email', $email)->first();
        if($data){
            $pass = $data['user_password'];
            $verify_pass = password_verify($password, $pass);
            if($verify_pass){
                $ses_data = [
                    'user_id'       => $data['user_id'],
                    'user_name'     => $data['user_name'],
                    'user_email'    => $data['user_email'],
                    'logged_in'     => TRUE,
                    'role'          => $data['role']
                ];
                $session->set($ses_data);
                // redirect()->to('/employee');
                $output = ['status' => 'Berhasil'];
                return $this->response->setJSON($output);
            }else{
                // $session->setFlashdata('msg', 'Wrong Password');
                // redirect()->to('/login');
                $output = ['status' => 'Password Salah'];
                return $this->response->setJSON($output);
            }
        }else{
            // $session->setFlashdata('msg', 'Email not Found');
            // redirect()->to('/login');
            $output = ['status' => 'Email Belum Terdaftar'];
            return $this->response->setJSON($output);
        }
    }
 
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}
