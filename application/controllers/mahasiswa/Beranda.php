<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Beranda extends CI_Controller
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
        // if ($this->session->userdata('level') == 1) {
        //     redirect('koordinator/beranda');
        // } elseif ($this->session->userdata('level') == 2) {
        //     redirect('dosen/beranda');
        // } elseif ($this->session->userdata('level') == 3) {
        //     redirect('mahasiswa/beranda');
        // } else {


        //     //$this->load->view('template_administrator/header');
        //     $this->session->set_flashdata('pesan', '<div class="alert alert-danger">
        //     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        //     Anda belum melakukan login
        //   </div>');
        //     redirect('login');
        // }
    }
    public function index()
    {

        $data = $this->user_m->ambil_data_m($this->session->userdata['username']);

        $data = array(
            'nama' => $data->nama_mhs,
            'username' => $data->username,
            'level' => $data->level,
        );
        $data['pengumuman'] = $this->db->query("SELECT * FROM tb_pengumuman ORDER BY id_pengumuman DESC LIMIT 1;")->result();
        $this->load->view('templates/mahasiswa/header', $data);
        $this->load->view('templates/mahasiswa/beranda', $data);
        $this->load->view('templates/mahasiswa/sidebar');
        $this->load->view('templates/mahasiswa/footer');
    }
}
