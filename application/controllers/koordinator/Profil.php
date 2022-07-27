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
            'id_user' => $data->id_user,
            'nama' => $data->nama,
            'username' => $data->username,
            'email' => $data->email,
            'password' => $data->password,
            'level' => $data->level,
        );
        $this->load->view('templates/koordinator/header', $data);
        $this->load->view('templates/koordinator/profil', $data);
        $this->load->view('templates/koordinator/sidebar');
        $this->load->view('templates/koordinator/footer');
    }
    public function update()
    {
        $id         = $this->input->post('id_user');
        $nama         = $this->input->post('nama');
        $email         = $this->input->post('email');
        $password     = $this->input->post('password');

        if ($this->input->post('password') == '') {
            $data = array(
                'nama' => $nama,
                'email' => $email,

            );
        } else {
            $data = array(
                'nama' => $nama,
                'email' => $email,
                'password' => md5($password),

            );
        }

        $where = array(

            'id_user' => $id,
        );

        $this->user_m->update_data($where, $data, 'tb_login');
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
        Data berhasil diubah
      </div>');
        redirect('koordinator/Profil');
    }
}
