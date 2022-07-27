<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cetak extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('kp_m');
        if ($this->session->userdata('level') != 1) {
            redirect('login');
        }

        if (!isset($this->session->userdata['username'])) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Anda belum melakukan login
            </div>');
            redirect('login');
        }
    }

    public function jadwal()
    {
        $periode = $this->db->query("SELECT periode_kp as kp from tb_jadwal")->row();

        $data['data'] = $this->kp_m->cetak_jadwal($periode->kp)->result();
        $this->load->view('templates/Koordinator/cetak_jadwal_sem', $data);
    }

    public function nilai()
    {
        $periode = $this->db->query("SELECT periode_kp as kp from tb_jadwal")->row();

        $data['data'] = $this->kp_m->cetak_nilai($periode->kp)->result();
        $this->load->view('templates/Koordinator/cetak_nilai', $data);
    }
}
