<?php
 
namespace App\Controllers;
 
use CodeIgniter\Controller;
 
class Bla_controll extends Controller
{
    public function index()
    {
        $data['title']  = 'CodeIgniter 4';
        $data['msg1']    = 'Selamat datang BLABLABLA';
        $data['msg2']    = 'Membuat aplikasi CRUD sederhana dengan CodeIgniter 4';
        echo view('test_view_bla', $data);
    }
}