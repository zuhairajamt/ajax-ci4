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
                'rules' => 'required|is_unique[employees.nama_karyawan]',
                'errors' => [
                    'required' => 'Nama Karyawan is required',
                    'is_unique' => 'This name is already exists',
                ]
            ],
            'usia' => [
                'rules' => 'required',
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

            //Insert data into db
            $data = [
                'nama_karyawan' => $this->request->getPost('nama_karyawan'),
                'usia'         => $this->request->getPost('usia'),
                'status_vaksin_1'  => $this->request->getPost('status_vaksin_1'),
                'status_vaksin_2'  => $this->request->getPost('status_vaksin_2')
            ];
            $query = $employeeModel->insert($data);
            if ($query) {
                echo json_encode(['code' => 1, 'msg' => 'New employee has been saved to database']);
            } else {
                echo json_encode(['code' => 0, 'msg' => 'Something went wrong']);
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
                                  <a href='#' class='btn btn-success' data-id='" . $row['id'] . "' data-bs-toggle='modal' data-bs-target='.editEmployee' id='updateEmployeeBtn' style='margin-right: 10px'>Update</a>
                                  <button class='btn btn btn-danger' data-id='" . $row['id'] . "' id='deleteEmployeeBtn'>Delete</button>
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

    public function updateEmployee()
    {
        $employeeModel = new \App\Models\Employee_model();
        $validation = \Config\Services::validation();
        $cid = $this->request->getPost('cid');

        $this->validate([
            'nama_karyawan' => [
                'rules' => 'required|is_unique[employees.nama_karyawan]',
                'errors' => [
                    'required' => 'Nama Karyawan is required',
                    'is_unique' => 'This name is already exists',
                ]
            ],
            'usia' => [
                'rules' => 'required',
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

            $data = [
                'nama_karyawan' => $this->request->getPost('nama_karyawan'),
                'usia'         => $this->request->getPost('usia'),
                'status_vaksin_1'  => $this->request->getPost('status_vaksin_1'),
                'status_vaksin_2'  => $this->request->getPost('status_vaksin_2')
            ];
            $query = $employeeModel->update($cid, $data);

            if ($query) {
                echo json_encode(['code' => 1, 'msg' => 'Employee info have been updated successfully']);
            } else {
                echo json_encode(['code' => 0, 'msg' => 'Something went wrong']);
            }
        }
    }

    public function deleteEmployee()
    {
        $employeeModel = new \App\Models\Employee_model();
        $employee_id = $this->request->getPost('employee_id');
        $query = $employeeModel->delete($employee_id);

        if ($query) {
            echo json_encode(['code' => 1, 'msg' => 'Employee deleted Successfully']);
        } else {
            echo json_encode(['code' => 0, 'msg' => 'Something went wrong']);
        }
    }
}
