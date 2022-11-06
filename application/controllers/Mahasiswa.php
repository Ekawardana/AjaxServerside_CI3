<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_mahasiswa', 'mahasiswa');
    }
    public function index()
    {
        $data["title"] = "Mahasiswa";
        $this->load->view('data-mahasiswa', $data);
    }

    public function getData()
    {
        $results = $this->mahasiswa->getDataTable();
        $data = [];
        $no = $_POST['start'];

        foreach ($results as $result) {
            $row = array();
            $row[] = ++$no;
            $row[] = $result->nama;
            $row[] = $result->alamat;
            $row[] = $result->no_hp;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->mahasiswa->count_all_data(),
            "recordsFiltered" => $this->mahasiswa->count_filtered_data(),
            "data" => $data
        );

        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }
}
