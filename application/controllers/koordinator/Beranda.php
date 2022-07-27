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

        if ($this->session->userdata('level') != 1) {
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
        $data = $this->user_m->ambil_data($this->session->userdata['username']);

        $data = array(
            'nama' => $data->nama,
            'username' => $data->username,
            'level' => $data->level,
        );
        $data['pengumuman'] = $this->db->query("SELECT * FROM tb_pengumuman ORDER BY id_pengumuman DESC LIMIT 1;")->result();
        $this->load->view('templates/koordinator/header', $data);
        $this->load->view('templates/koordinator/beranda', $data);
        $this->load->view('templates/koordinator/sidebar');
        $this->load->view('templates/koordinator/footer');
    }
    public function tambah()
    {
        $data = $this->user_m->ambil_data($this->session->userdata['username']);

        $data = array(
            'nama' => $data->nama,
            'username' => $data->username,
            'level' => $data->level,
        );
        $this->form_validation->set_rules('isi', 'Isi', 'max_length[500]', ['max_length' => 'Pengumuman maksimal 500 karakter']);
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/koordinator/header', $data);
            $this->load->view('templates/koordinator/beranda', $data);
            $this->load->view('templates/koordinator/sidebar');
            $this->load->view('templates/koordinator/footer');
        } else {
            $data = array(
                'id_pengumuman' => '',
                'isi' => $this->input->post('isi'),
            );
            $this->db->insert('tb_pengumuman', $data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Pengumuman berhasi diperbaharui.
          </div>');
            redirect('koordinator/beranda');
        }
    }
}
