<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    function __construct()
    {
        parent::__construct();
        $this->load->model('kp_m');

        if ($this->session->userdata('level') != 2) {
            redirect('login');
        }
        if (!isset($this->session->userdata['username'])) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Anda belum melakukan login
            </div>');
            // redirect('administrator/auth');
            redirect('login');
        }
    }
    public function index()
    {
        $data = $this->user_m->ambil_data_d($this->session->userdata['username']);
        $periode = $this->db->query("SELECT periode_kp as kp from tb_jadwal")->row();

        $data = array(
            'nama' => $data->nama_dsn,
            'username' => $data->username,
            'level' => $data->level,
        );

        $data['mahasiswa'] = $this->kp_m->tampil_data_jadwal_d($this->session->userdata['username'], $periode->kp)->result();
        $this->load->view('templates/dosen/header', $data);
        $this->load->view('templates/dosen/jadwal', $data);
        $this->load->view('templates/dosen/sidebar');
        $this->load->view('templates/dosen/footer');
    }
}
