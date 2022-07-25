<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class Profile extends Controller
{
    public function index()
    {
        $session = session();
        $data['user_name'] = $session->get('user_name');
        $data['user_email'] = $session->get('user_email');

        echo view('header', $data);
        echo view('profile_view');
        echo view('footer');
    }

    public function edit()
    {
        $model = new UserModel();
        $id = $this->request->getPost("user_id");
        $data['employee'] = $model->find($id);
        return $this->response->setJSON($data);
    }

    public function update()
    {
        $validation = \Config\Services::validation();
        $model = new UserModel();

        $this->validate([
            'user_name' => [
                'rules' => 'required|max_length[50]',
                'errors' => [
                    'required' => 'Nama tidak boleh kosong'
                ]
            ],
           
            'user_password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password tidak boleh kosong'
                ]
            ]
        ]);

        if ($validation->run() == FALSE) {
            $errors = $validation->getErrors();
            echo json_encode(['code' => 0, 'error' => $errors]);
        } else {
            // $id = $this->request->getPost("edit_prof");
            $id = session()->get('user_id');
            $data = [
                'user_name' => $this->request->getPost('user_name'),
                'user_password' => password_hash($this->input->getVar('password'), PASSWORD_DEFAULT)
            ];
            $update = $model->update($id, $data);

            if ($update) {
                $output = ['status' => 'Data berhasil diupdate'];
                return $this->response->setJSON($output);
            } else {
                $output = ['status' => 'Data gagal diupdate'];
                return $this->response->setJSON($output);
            }
        }
    }
}
