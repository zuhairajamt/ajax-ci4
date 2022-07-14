<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Employee_model;

use \Hermawan\DataTables\DataTable;

class Employee extends Controller
{

    public function __construct()
    {
        require_once APPPATH . 'ThirdParty/ssp.php';
        $this->db = db_connect();
    }

    public function index()
    {
        $session = session();
        $uname['user_name'] = $session->get('user_name');

        $model = new Employee_model;
        $data['title']     = 'Data Vaksin Karyawan';
        $data['getKaryawan'] = $model->getKaryawan();

        echo view('header', $uname);
        echo view('employee_view', $data);
        echo view('footer', $data);
    }

    public function addEmployee()
    {
        $employeeModel = new \App\Models\Employee_model();

        $validation = \Config\Services::validation();
        $this->validate([
            'nama_karyawan' => [
                'rules' => 'required|max_length[50]',
                'errors' => [
                    'required' => 'Nama Karyawan is required',
                    'max_length' => 'Your name is too long'
                ]
            ],
            'usia' => [
                'rules' => 'required|integer|greater_than_equal_to[10]|less_than_equal_to[100]',
                'errors' => [
                    'required' => 'Usia is required',
                ]
            ],
            'status_vaksin_1' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Status Vaksin 1 is required'
                ]
            ],
            'status_vaksin_2' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Status Vaksin 2 is required'
                ]
            ]
        ]);

        if ($validation->run() == FALSE) {
            $errors = $validation->getErrors();
            echo json_encode(['code' => 0, 'error' => $errors]);
        } else {

            //Insert data into db
            $data = [
                'nama_karyawan' => $this->request->getPost('nama_karyawan'),
                'usia'         => $this->request->getPost('usia'),
                'status_vaksin_1'  => $this->request->getPost('status_vaksin_1'),
                'status_vaksin_2'  => $this->request->getPost('status_vaksin_2')
            ];
            $query = $employeeModel->insert($data);
            if ($query) {
                echo json_encode(['code' => 1, 'msg' => 'Data karyawan behasil ditambahkan']);
            } else {
                echo json_encode(['code' => 0, 'msg' => 'Data karyawan gagal ditambahkan']);
            }
        }
    }

    public function getAllEmployee()
    {
        //DB Details
        $dbDetails = array(
            "host" => $this->db->hostname,
            "user" => $this->db->username,
            "pass" => $this->db->password,
            "db" => $this->db->database,
        );

        $table = "employees";
        $primaryKey = "id";

        $columns = array(
            array(
                "db" => "id",
                "dt" => 0,
            ),
            array(
                "db" => "nama_karyawan",
                "dt" => 1,
            ),
            array(
                "db" => "usia",
                "dt" => 2,
            ),
            array(
                "db" => "status_vaksin_1",
                "dt" => 3,
            ),
            array(
                "db" => "status_vaksin_2",
                "dt" => 4,
            ),
            array(
                "db" => "id",
                "dt" => 5,
                "formatter" => function ($d, $row) {
                    return "<div class='btn-group'>
                                  <a class='btn btn-success btn-edit' data-id='" . $row['id'] . "' data-bs-toggle='modal' data-bs-target='#editModal' id='updateEmployeeBtn' style='margin-right: 10px'><i class='ti ti-edit'></i></a>
                                  <button class='btn btn btn-danger' data-id='" . $row['id'] . "' id='deleteEmployeeBtn'> <i class='ti ti-trash'></i></button>
                             </div>";
                }
            ),
        );

        echo json_encode(
            \SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns)
        );
    }

    public function getEmployeeInfo()
    {
        $employeeModel = new \App\Models\Employee_model();
        $employeeId = $this->request->getPost('id');
        $info = $employeeModel->find($employeeId);
        if ($info) {
            echo json_encode(['code' => 1, 'msg' => '', 'results' => $info]);
        } else {
            echo json_encode(['code' => 0, 'msg' => 'No results found', 'results' => null]);
        }
    }

    public function deleteEmployee()
    {
        $employeeModel = new \App\Models\Employee_model();
        $employee_id = $this->request->getPost('employee_id');
        $query = $employeeModel->delete($employee_id);

        if ($query) {
            echo json_encode(['code' => 1, 'msg' => 'Data karyawan behasil dihapus']);
        } else {
            echo json_encode(['code' => 0, 'msg' => 'Data karyawan gagal dihapus']);
        }
    }

    public function edit()
    {
        $model = new Employee_model();
        $id = $this->request->getPost("edit_id");
        $data['employee'] = $model->find($id);
        return $this->response->setJSON($data);
    }

    public function update()
    {
        $validation = \Config\Services::validation();
        $model = new Employee_model;

        $this->validate([
            'nama_karyawan' => [
                'rules' => 'required|max_length[50]',
                'errors' => [
                    'required' => 'Nama Karyawan is required'
                ]
            ],
            'usia' => [
                'rules' => 'required|integer|greater_than_equal_to[10]|less_than_equal_to[100]',
                'errors' => [
                    'required' => 'Usia is required'
                ]
            ],
            'status_vaksin_1' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Status Vaksin 1 is required'
                ]
            ],
            'status_vaksin_2' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Status Vaksin 2 is required'
                ]
            ]
        ]);

        if ($validation->run() == FALSE) {
            $errors = $validation->getErrors();
            echo json_encode(['code' => 0, 'error' => $errors]);
        } else {
            $id = $this->request->getPost("edit_id");
            $data = [
                'nama_karyawan' => $this->request->getPost('nama_karyawan'),
                'usia'         => $this->request->getPost('usia'),
                'status_vaksin_1'  => $this->request->getPost('status_vaksin_1'),
                'status_vaksin_2'  => $this->request->getPost('status_vaksin_2'),
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
