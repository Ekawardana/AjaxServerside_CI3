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
            $row[] = $result->email;
            $row[] = $result->no_hp;
            $row[] = '
            <a href="#" class="btn btn-success btn-sm" onclick="byid(' . "'" . $result->id . "','edit'" . ')">Edit</a>
            <a href="#" class="btn btn-danger btn-sm" onclick="byid(' . "'" . $result->id . "','delete'" . ')">Hapus</a>
            ';

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

    // Insert Data
    public function add()
    {
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama')),
            'alamat' => htmlspecialchars($this->input->post('alamat')),
            'email' => htmlspecialchars($this->input->post('email')),
            'no_hp' => htmlspecialchars($this->input->post('no_hp'))
        ];

        if ($this->mahasiswa->create($data) > 0) {
            $message['status'] = 'Success';
        } else {
            $message['status'] = 'Failed';
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($message));
    }

    // Ambil data berdasarkan id
    public function byid($id)
    {
        $data = $this->mahasiswa->getDataById($id);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    // Update Data
    public function update()
    {
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama')),
            'alamat' => htmlspecialchars($this->input->post('alamat')),
            'email' => htmlspecialchars($this->input->post('email')),
            'no_hp' => htmlspecialchars($this->input->post('no_hp'))
        ];

        if ($this->mahasiswa->update(array('id' => $this->input->post('id')), $data) > 0) {
            $message['status'] = 'Success';
        } else {
            $message['status'] = 'Failed';
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($message));
    }

    // Delete Data
    public function delete($id)
    {
        if ($this->mahasiswa->delete($id) > 0) {
            $message['status'] = 'Success';
        } else {
            $message['status'] = 'Failed';
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($message));
    }
}
