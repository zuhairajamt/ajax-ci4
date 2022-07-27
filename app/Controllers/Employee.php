<?php

namespace App\Controllers;

use App\Models\Employee_model;
use CodeIgniter\Controller;

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
        //$data['title']     = 'Data Vaksin Karyawan';
        // $data['getKaryawan'] = $model->getKaryawan();

        echo view('header', $uname);
        echo view('employee_view');
        echo view('footer');
    }

    public function addEmployee()
    {
        $employeeModel = new \App\Models\Employee_model();
        $db      = \Config\Database::connect();
        $builder = $db->table('employees');

        $validation = \Config\Services::validation();
        $this->validate([
            'nama_karyawan' => [
                'rules' => 'required|max_length[50]',
                'errors' => [
                    'required' => 'Nama Karyawan is required',
                    'max_length' => 'Your name is too long',
                ],
            ],
            'usia' => [
                'rules' => 'required|integer|greater_than_equal_to[10]|less_than_equal_to[100]',
                'errors' => [
                    'required' => 'Usia is required',
                ],
            ],
            'status_vaksin_1' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Status Vaksin 1 is required',
                ],
            ],
            'status_vaksin_2' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Status Vaksin 2 is required',
                ],
            ],
        ]);

        if ($validation->run() == false) {
            $errors = $validation->getErrors();
            echo json_encode(['code' => 0, 'error' => $errors]);
        } else {
            $session = session();
            //$user_id['user_id'] = $session->get('user_id');
            $user_id = $_SESSION['user_id'];
            //$user_id = $_SESSION['user_id'];
            //$autoload['libraries'] = array('session');

            //Insert data into db

            $array = [
                'user_id'   => $user_id,
            ];
            

            $data = [
                'nama_karyawan' => $this->request->getPost('nama_karyawan'),
                'usia' => $this->request->getPost('usia'),
                'status_vaksin_1' => $this->request->getPost('status_vaksin_1'),
                'status_vaksin_2' => $this->request->getPost('status_vaksin_2'),
                //'user_id' => $user_id
            ];
            $builder->set($array);
            $builder->set($data);
            //$query = $employeeModel->insert($data);
            $query = $builder->insert();
            if ($query) {
                echo json_encode(['code' => 1, 'msg' => $user_id]);
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

        $table = 'employees';

        $primaryKey = "id";

        //$query = 'SELECT * FROM employee WHERE user_id = 1';

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
                },
            ),
        );

        $session = session();
        //$user_id['user_id'] = $session->get('user_id');
        $user_id = $_SESSION['user_id'];

        echo json_encode(
            \SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns, null, "user_id='$user_id'")
        );

        //https://www.gyrocode.com/articles/jquery-datatables-using-where-join-and-group-by-with-ssp-class-php/
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
                    'required' => 'Nama Karyawan is required',
                ],
            ],
            'usia' => [
                'rules' => 'required|integer|greater_than_equal_to[10]|less_than_equal_to[100]',
                'errors' => [
                    'required' => 'Usia is required',
                ],
            ],
            'status_vaksin_1' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Status Vaksin 1 is required',
                ],
            ],
            'status_vaksin_2' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Status Vaksin 2 is required',
                ],
            ],
        ]);

        if ($validation->run() == false) {
            $errors = $validation->getErrors();
            echo json_encode(['code' => 0, 'error' => $errors]);
        } else {
            $id = $this->request->getPost("edit_id");
            $data = [
                'nama_karyawan' => $this->request->getPost('nama_karyawan'),
                'usia' => $this->request->getPost('usia'),
                'status_vaksin_1' => $this->request->getPost('status_vaksin_1'),
                'status_vaksin_2' => $this->request->getPost('status_vaksin_2'),
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

    //----------------------- Import csv -----------------------//
    public function importCsvToDb()
    {
        $input = $this->validate([
            'file' => 'uploaded[file]|max_size[file,8024]|ext_in[file,csv],',
        ]);
        if (!$input) {
            $data['validation'] = $this->validator;
            return view('index', $data);
        } else {
            if ($file = $this->request->getFile('file')) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move('../public/csvfile', $newName);
                    $file = fopen("../public/csvfile/" . $newName, "r");
                    $i = 0;
                    $numberOfFields = 6;
                    $csvArr = array();

                    while (($filedata = fgetcsv($file, 1000, ",")) !== false) {
                        $num = count($filedata);
                        if ($i > 0 && $num == $numberOfFields) {

                            // $csvArr[$i]['No.'] = $filedata[0];
                            // $csvArr[$i]['Nama Kayawan'] = $filedata[1];
                            // $csvArr[$i]['Usia'] = $filedata[2];
                            // $csvArr[$i]['Status Vaksin 1'] = $filedata[3];
                            // $csvArr[$i]['Status Vaksin 2'] = $filedata[4];
                            // $csvArr[$i]['Aksi'] = $filedata[5];

                            // $csvArr[$i]['id' || 'No'] = $filedata[0];
                            // $csvArr[$i]['nama_karyawan' || 'Nama Karyawan'] = $filedata[1];
                            // $csvArr[$i]['usia' || 'Usia'] = $filedata[2];
                            // $csvArr[$i]['status_vaksin_1' || 'Status Vaksin 1'] = $filedata[3];
                            // $csvArr[$i]['status_vaksin_2' || 'Status Vaksin 2'] = $filedata[4];
                            // $csvArr[$i]['aksi' || 'Aksi'] = $filedata[5];

                            $csvArr[$i]['id'] = $filedata[0];
                            $csvArr[$i]['nama_karyawan'] = $filedata[1];
                            $csvArr[$i]['usia'] = $filedata[2];
                            $csvArr[$i]['status_vaksin_1'] = $filedata[3];
                            $csvArr[$i]['status_vaksin_2'] = $filedata[4];
                            $csvArr[$i]['aksi'] = $filedata[5];
                            $csvArr[$i]['user_id'] = $filedata[6];
                        }
                        $i++;
                    }
                    fclose($file);
                    $count = 0;
                    foreach ($csvArr as $userdata) {
                        $employee = new Employee_model();
                        $findRecord = $employee->where('id', $userdata['id'])->countAllResults();
                        if ($findRecord == 0) {
                            if ($employee->insert($userdata)) {
                                $count++;
                            }
                        }
                    }
                    session()->setFlashdata('message', $count . ' rows successfully added.');
                    session()->setFlashdata('alert-class', 'alert-success');
                } else {
                    session()->setFlashdata('message', 'CSV file coud not be imported.');
                    session()->setFlashdata('alert-class', 'alert-danger');
                }
            } else {
                session()->setFlashdata('message', 'CSV file coud not be imported.');
                session()->setFlashdata('alert-class', 'alert-danger');
            }
        }
        return redirect()->route('/');
    }

    public function uploadEmployee()
    {
        if ($this->request->getMethod() == "post") {
            $file = $this->request->getFile("file");
            $file_name = $file->getTempName();
            $employee = array();
            $csv_data = array_map('str_getcsv', file($file_name));

            if (count($csv_data) > 0) {
                $index = 0;

                foreach ($csv_data as $data) {
                    if ($index > 0) {
                        $employee[] = array(
                            "nama_karyawan" => $data[1],
                            "usia" => $data[2],
                            "status_vaksin_1" => $data[3],
                            "status_vaksin_2" => $data[4],
                            "user_id" => $data[6],
                        );
                    }
                    $index++;
                }

                $builder = $this->db->table('employees');
                $builder->insertBatch($employee);
                $session = session();
                $session->setFlashdata("success", "Data saved successfully");
                return redirect()->to(base_url('/'));
            }
        }
        return redirect()->route('/');
    }
}
