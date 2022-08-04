<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Employee_model;
use App\Models\WilayahModel;
use App\Models\View_model;

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
        $uname['role'] = $session->get('role');
        $model = new WilayahModel();
        $wil['prov'] = $model->getprovinsi();

        // $model = new Employee_model;
        // $data['title']     = 'Data Vaksin Karyawan';
        // $data['getKaryawan'] = $model->getKaryawan();

        echo view('header', $uname);
        echo view('employee_view', $wil);
        echo view('footer');
    }

    public function addEmployee()
    {
        $employeeModel = new \App\Models\Employee_model();
        $wilayahModel = new \App\Models\WilayahModel();
        $db      = \Config\Database::connect();
        $builder = $db->table('employees');

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
            $session = session();
            //$user_id['user_id'] = $session->get('user_id');
            $user_id = $_SESSION['user_id'];
            //$user_id = $_SESSION['user_id'];
            //$autoload['libraries'] = array('session');

            //Insert data into db

            $array = [
                'user_id'   => $user_id,
            ];

            //Insert data into db
            $data = [
                'nama_karyawan'     => $this->request->getPost('nama_karyawan'),
                'usia'              => $this->request->getPost('usia'),
                'status_vaksin_1'   => $this->request->getPost('status_vaksin_1'),
                'status_vaksin_2'   => $this->request->getPost('status_vaksin_2'),
                'alamat'              => $this->request->getPost('desa')
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
    
    public function getKota() {
 
        $model = new WilayahModel();
 
        $postData = array(
            'prov' => $this->request->getPost('prov'),
        );
 
        $data = $model->getkota($postData);
        
        // var_dump($data);
        echo json_encode($data);
    }

    public function getKecamatan() {
 
        $model = new WilayahModel();
 
        $postData = array(
            'kota' => $this->request->getPost('kota'),
        );
 
        $data = $model->getkecamatan($postData);
        
        // var_dump($data);
        echo json_encode($data);
    }    

    public function getDesa() {
 
        $model = new WilayahModel();
 
        $postData = array(
            'kec' => $this->request->getPost('kec'),
        );
 
        $data = $model->getdesa($postData);
        
        // var_dump($data);
        echo json_encode($data);
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

        // $table = "employees"; //langsung dr tabel employees
        $table = <<<EOT
        (
            SELECT
            employees.id,
            employees.nama_karyawan,
            employees.usia,
            employees.user_id,
            employees.status_vaksin_1,
            employees.status_vaksin_2,
            villages.desa,
            districts.kec,
            regencies.kota,
            provinces.prov,
            employees.deleted_at,
            employees.alamat
            FROM employees
            LEFT JOIN villages ON villages.id_desa = employees.alamat 
            LEFT JOIN districts ON districts.id_kec = villages.district_id
            LEFT JOIN regencies ON regencies.id_kota = districts.regency_id
            LEFT JOIN provinces ON provinces.id_prov = regencies.province_id
        ) temp
        EOT; //dari tabel view tp data tidak otomatis update
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
                "db" => "desa",
                "dt" => 5,
            ),
            array(
                "db" => "kec",
                "dt" => 6,
            ),
            array(
                "db" => "kota",
                "dt" => 7,
            ),
            array(
                "db" => "prov",
                "dt" => 8,
            ),
            array(
                "db" => "alamat",
                "dt" => 9,
            ),
            array(
                "db" => "id",
                "dt" => 10,
                "formatter" => function ($d, $row) {
                    return "<div class='btn-group'>
                                  <a class='btn btn-success btn-edit kota' data-id='" . $row['id'] . "' data-bs-toggle='modal' data-bs-target='#editModal' id='updateBtn' style='margin-right: 10px'><i class='ti ti-edit'></i></a>
                                  <button class='btn btn btn-danger' data-id='" . $row['id'] . "' id='deleteEmployeeBtn'> <i class='ti ti-trash'></i></button>
                             </div>";
                }
            ),
        );

        $session = session();
        //$user_id['user_id'] = $session->get('user_id');
        $user_id = $_SESSION['user_id'];
        $role = $_SESSION['role'];

        if($role === 'Admin') {
            echo json_encode(
                \SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns, null, "deleted_at IS NULL")
            );
        } else {
            echo json_encode(
                \SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns, null, "user_id='$user_id' AND deleted_at IS NULL")
            );
        }
    }

    //menampilkan data ke modal edit berdasarkan id 
    // public function getEmployeeInfo()
    // {
    //     $employeeModel = new \App\Models\Employee_model();
    //     $employeeId = $this->request->getPost('id');
    //     $info = $employeeModel->find($employeeId);
    //     if ($info) {
    //         echo json_encode(['code' => 1, 'msg' => '', 'results' => $info]);
    //     } else {
    //         echo json_encode(['code' => 0, 'msg' => 'No results found', 'results' => null]);
    //     }
    // }

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

        $data['employee'] = $model->getKaryawan($id);
        // echo json_encode($data);
        // $data['employee'] = $model->getEmployee($id)->getResult();
        return $this->response->setJSON($data);
        // var_dump($data);
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
                'alamat'              => $this->request->getPost('desa')
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
            'file' => 'uploaded[file]|max_size[file,8024]|ext_in[file,csv],'
        ]);
        if (!$input) {
            $data['validation'] = $this->validator;
            return view('index', $data); 
        }else{
            if($file = $this->request->getFile('file')) {
            if ($file->isValid() && ! $file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move('../public/csvfile', $newName);
                $file = fopen("../public/csvfile/".$newName,"r");
                $i = 0;
                $numberOfFields = 6;
                $csvArr = array();
                
                while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                    $num = count($filedata);
                    if($i > 0 && $num == $numberOfFields){ 
                        
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
                    }
                    $i++;
                }
                fclose($file);
                $count = 0;
                foreach($csvArr as $userdata){
                    $employee = new Employee_model();
                    $findRecord = $employee->where('id', $userdata['id'])->countAllResults();
                    if($findRecord == 0){
                        if($employee->insert($userdata)){
                            $count++;
                        }
                    }
                }
                session()->setFlashdata('message', $count.' rows successfully added.');
                session()->setFlashdata('alert-class', 'alert-success');
            }
            else{
                session()->setFlashdata('message', 'CSV file coud not be imported.');
                session()->setFlashdata('alert-class', 'alert-danger');
            }
            }else{
            session()->setFlashdata('message', 'CSV file coud not be imported.');
            session()->setFlashdata('alert-class', 'alert-danger');
            }
        }
        return redirect()->route('/');         
    }

    public function uploadEmployee()
    {
        $session = session();
        //$user_id['user_id'] = $session->get('user_id');
        $user_id = $_SESSION['user_id'];

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
                            "alamat" => $data[9],
                            "user_id" => $user_id,
                        );
                    }
                    $index++;
                }

                $builder = $this->db->table('employees');
                $builder->insertBatch($employee);
                // $session = session();
                // $session->setFlashdata("success", "Data saved successfully");
                return redirect()->to(base_url('/'));
            }
        }
    return redirect()->route('/');    }
}