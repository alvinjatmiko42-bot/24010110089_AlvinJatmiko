<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fakultas extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Cek session login berpatokan pada objek 'user' dari model Anda
        if (!$this->session->userdata('user')) {
            redirect('auth');
        }
        $this->load->model('FakultasModel');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Daftar Fakultas';
        $data['fakultas'] = $this->FakultasModel->getAll();

        $this->load->view('templates/header', $data);
        $this->load->view('fakultas/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Fakultas';
        $data['button'] = 'Simpan';
        $data['action'] = base_url('fakultas/tambah');
        $data['fakultas'] = null;

        // Validasi ID Manual + is_unique agar tidak terjadi duplikasi PK di database
        $this->form_validation->set_rules('fakultas_id', 'ID Fakultas', 'required|numeric|is_unique[fakultas.fakultas_id]');
        $this->form_validation->set_rules('fakultas_name', 'Nama Fakultas', 'required|min_length[3]|max_length[100]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('fakultas/form', $data);
            $this->load->view('templates/footer');
        } else {
            $insert_data = [
                'fakultas_id'   => $this->input->post('fakultas_id'),
                'fakultas_name' => $this->input->post('fakultas_name')
            ];
            $this->FakultasModel->insert($insert_data);
            
            $this->session->set_flashdata('swal', [
                'icon'  => 'success',
                'title' => 'Berhasil!',
                'text'  => 'Data fakultas berhasil ditambahkan.'
            ]);
            redirect('fakultas');
        }
    }

    public function ubah($id)
    {
        $data['fakultas'] = $this->FakultasModel->getById($id);
        if (!$data['fakultas']) {
            $this->session->set_flashdata('swal', [
                'icon'  => 'warning',
                'title' => 'Tidak Ditemukan!',
                'text'  => 'Data tidak ditemukan.'
            ]);
            redirect('fakultas');
        }

        $data['title'] = 'Ubah Fakultas';
        $data['button'] = 'Update';
        $data['action'] = base_url('fakultas/ubah/' . $id);

        $this->form_validation->set_rules('fakultas_name', 'Nama Fakultas', 'required|min_length[3]|max_length[100]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('fakultas/form', $data);
            $this->load->view('templates/footer');
        } else {
            $update_data = [
                'fakultas_name' => $this->input->post('fakultas_name')
            ];
            $this->FakultasModel->update($id, $update_data);

            $this->session->set_flashdata('swal', [
                'icon'  => 'success',
                'title' => 'Berhasil!',
                'text'  => 'Data fakultas berhasil diperbarui.'
            ]);
            redirect('fakultas');
        }
    }

    public function hapus($id)
    {
        $data = $this->FakultasModel->getById($id);
        if (!$data) {
            $this->session->set_flashdata('swal', [
                'icon'  => 'warning',
                'title' => 'Tidak Ditemukan!',
                'text'  => 'Data tidak ditemukan.'
            ]);
            redirect('fakultas');
        }

        $this->FakultasModel->delete($id);
        $this->session->set_flashdata('swal', [
            'icon'  => 'warning',
            'title' => 'Dihapus!',
            'text'  => 'Data fakultas telah dihapus.'
        ]);
        redirect('fakultas');
    }
}