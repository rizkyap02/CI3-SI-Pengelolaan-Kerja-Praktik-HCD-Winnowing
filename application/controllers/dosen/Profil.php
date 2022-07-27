<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller
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

        $data = array(
            'id_user' => $data->id_user,
            'nama' => $data->nama_dsn,
            'username' => $data->username,
            'email' => $data->email_dsn,
            'telp_dsn' => $data->telp_dsn,
            'password' => $data->password,
            'level' => $data->level,
        );
        $this->load->view('templates/dosen/header', $data);
        $this->load->view('templates/dosen/profil', $data);
        $this->load->view('templates/dosen/sidebar');
        $this->load->view('templates/dosen/footer');
    }
    public function update()
    {
        $id         = $this->input->post('id_user');
        $nama         = $this->input->post('nama');
        $username        = $this->input->post('nip');
        $email         = $this->input->post('email');
        $telp        = $this->input->post('telp_dsn');
        $password     = md5($this->input->post('password'));

        $data2 = array(
            'nama_dsn'         => $nama,
            'nip'         => $username,
            'email_dsn'         => $email,
            'telp_dsn'         => $telp

        );

        if ($this->input->post('password') == '') {
            $data = array(
                'username' => $username,
            );
        } else {
            $data = array(
                'username' => $username,
                'password' => $password

            );
        }

        $where = array(
            'id_user' => $id
        );

        $this->user_m->update_data($where, $data, 'tb_login');
        $this->user_m->update_data($where, $data2, 'tb_dosen');
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
        Data berhasil diubah
      </div>');
        redirect('dosen/Profil');
    }
}
