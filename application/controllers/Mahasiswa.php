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

    // Menampilkan Data Dari Serverside
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
            $row[] = '<a href="#" class="btn btn-success btn-sm" onclick="byid(' . "'" . $result->id . "','edit'" . ')">Edit</a>';
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

    public function add()
    {
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama')),
            'alamat' => htmlspecialchars($this->input->post('alamat')),
            'no_hp' => htmlspecialchars($this->input->post('no_hp')),
        ];

        if ($this->mahasiswa->create($data) > 0) {
            $message['status'] = 'Success';
        } else {
            $message['status'] = 'Failed';
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($message));
    }

    public function byid($id)
    {
        $data = $this->mahasiswa->getDataById($id);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function update()
    {
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama')),
            'alamat' => htmlspecialchars($this->input->post('alamat')),
            'no_hp' => htmlspecialchars($this->input->post('no_hp')),
        ];

        if ($this->mahasiswa->update(array('id' => $this->input->post('id')), $data) > 0) {
            $message['status'] = 'Success';
        } else {
            $message['status'] = 'Failed';
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($message));
    }
}
