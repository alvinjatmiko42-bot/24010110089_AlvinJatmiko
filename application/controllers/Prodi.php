<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prodi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('user')) {
            redirect('auth');
        }
        $this->load->model('ProdiModel');
        $this->load->model('FakultasModel');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Daftar Program Studi';
        $data['prodi'] = $this->ProdiModel->getAll();

        $this->load->view('templates/header', $data);
        $this->load->view('prodi/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Program Studi';
        $data['button'] = 'Simpan';
        $data['action'] = base_url('prodi/tambah');
        $data['fakultas'] = $this->FakultasModel->getAll();
        $data['prodi'] = null;

        $this->form_validation->set_rules('prodi_id', 'ID Prodi', 'required|numeric|is_unique[prodi.prodi_id]');
        $this->form_validation->set_rules('fakultas_id', 'Fakultas', 'required|numeric');
        $this->form_validation->set_rules('prodi_name', 'Nama Program Studi', 'required|min_length[3]|max_length[100]');
        $this->form_validation->set_rules('prodi_strata', 'Strata', 'required|in_list[D3,S1,S2]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('prodi/form', $data);
            $this->load->view('templates/footer');
        } else {
            $insert_data = [
                'prodi_id'     => $this->input->post('prodi_id'),
                'fakultas_id'  => $this->input->post('fakultas_id'),
                'prodi_name'   => $this->input->post('prodi_name'),
                'prodi_strata' => $this->input->post('prodi_strata')
            ];
            $this->ProdiModel->insert($insert_data);
            
            $this->session->set_flashdata('swal', [
                'icon'  => 'success',
                'title' => 'Berhasil!',
                'text'  => 'Data program studi berhasil ditambahkan.'
            ]);
            redirect('prodi');
        }
    }

    public function ubah($id)
    {
        $data['prodi'] = $this->ProdiModel->getById($id);
        if (!$data['prodi']) {
            $this->session->set_flashdata('swal', [
                'icon'  => 'warning',
                'title' => 'Tidak Ditemukan!',
                'text'  => 'Data tidak ditemukan.'
            ]);
            redirect('prodi');
        }

        $data['title'] = 'Ubah Program Studi';
        $data['button'] = 'Update';
        $data['action'] = base_url('prodi/ubah/' . $id);
        $data['fakultas'] = $this->FakultasModel->getAll();

        $this->form_validation->set_rules('fakultas_id', 'Fakultas', 'required|numeric');
        $this->form_validation->set_rules('prodi_name', 'Nama Program Studi', 'required|min_length[3]|max_length[100]');
        $this->form_validation->set_rules('prodi_strata', 'Strata', 'required|in_list[D3,S1,S2]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('prodi/form', $data);
            $this->load->view('templates/footer');
        } else {
            $update_data = [
                'fakultas_id'  => $this->input->post('fakultas_id'),
                'prodi_name'   => $this->input->post('prodi_name'),
                'prodi_strata' => $this->input->post('prodi_strata')
            ];
            $this->ProdiModel->update($id, $update_data);

            $this->session->set_flashdata('swal', [
                'icon'  => 'success',
                'title' => 'Berhasil!',
                'text'  => 'Data program studi berhasil diperbarui.'
            ]);
            redirect('prodi');
        }
    }

    public function hapus($id)
    {
        $data = $this->ProdiModel->getById($id);
        if (!$data) {
            $this->session->set_flashdata('swal', [
                'icon'  => 'warning',
                'title' => 'Tidak Ditemukan!',
                'text'  => 'Data tidak ditemukan.'
            ]);
            redirect('prodi');
        }

        $this->ProdiModel->delete($id);
        $this->session->set_flashdata('swal', [
            'icon'  => 'warning',
            'title' => 'Dihapus!',
            'text'  => 'Data program studi telah dihapus.'
        ]);
        redirect('prodi');
    }
}