<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Daftar_judul extends CI_Controller
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

        if ($this->session->userdata('level') != 3) {
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
        $data = $this->user_m->ambil_data_m($this->session->userdata['username']);

        $data = array(
            'nama' => $data->nama_mhs,
            'username' => $data->username,
            'level' => $data->level,
        );
        $data['kerjapraktik'] = $this->kp_m->tampil_data_kp_end($this->session->userdata('username'))->result();
        $this->load->view('templates/mahasiswa/header', $data);
        $this->load->view('templates/mahasiswa/daftar_judul', $data);
        $this->load->view('templates/mahasiswa/sidebar');
        $this->load->view('templates/mahasiswa/footer');
    }
}
