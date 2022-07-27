<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_dosen extends CI_Controller
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
        $data['dosen'] = $this->user_m->tampil_data_d(2)->result();
        $this->load->view('templates/koordinator/header', $data);
        $this->load->view('templates/koordinator/data_dosen', $data);
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
        $this->form_validation->set_rules('nama', 'Nama', 'required', ['required' => 'Nama wajib diisi!']);
        $this->form_validation->set_rules('nip', 'NIP', 'required|max_length[18]|min_length[18]|is_unique[tb_login.username]', ['required' => 'NIP wajib diisi!', 'max_length' => 'NIP wajib 18 karakter', 'min_length' => 'NIP wajib 18 karakter', 'is_unique' => 'NIP sudah terdaftar']);
        $this->form_validation->set_rules('email', 'Email', 'required|is_unique[tb_login.email]', ['required' => 'Email wajib diisi!', 'is_unique' => 'Email sudah terdaftar']);
        $this->form_validation->set_rules('telp_dsn', 'Telepon Dosen', 'required', ['required' => 'Telepon wajib diisi!']);
        $this->form_validation->set_rules('password_1', 'Password', 'required|min_length[8]',  ['required' => 'Kata sandi wajib diisi!', 'min_length' => 'Email 8 karakter']);
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/koordinator/header', $data);
            $this->load->view('templates/koordinator/data_dosen_tambah', $data);
            $this->load->view('templates/koordinator/sidebar');
            $this->load->view('templates/koordinator/footer');
        } else {
            $data = array(
                'id_user' => '',
                'username' => $this->input->post('nip'),
                'password' => md5($this->input->post('password_1')),
                'level' => 2,
                'status' => 2
            );
            $this->db->insert('tb_login', $data);
            $id = $this->db->query("SELECT MAX(id_user) as id from tb_login")->row();
            $data2 = array(
                'id_user' => $id->id,
                'nama_dsn' => $this->input->post('nama'),
                'email_dsn' => $this->input->post('email'),
                'nip' => $this->input->post('nip'),
                'telp_dsn' => $this->input->post('telp_dsn'),
            );
            $this->db->insert('tb_dosen ', $data2);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
        Data berhasil ditambahkan.
      </div>');
            redirect('koordinator/data_dosen');
        }
    }

    public function edit($id)
    {
        $data = $this->user_m->ambil_data($this->session->userdata['username']);

        $data = array(
            'nama' => $data->nama,
            'username' => $data->username,
            'level' => $data->level,
        );

        $data['dsn'] = $this->user_m->edit_data_d($id)->row();
        $this->load->view('templates/koordinator/header', $data);
        $this->load->view('templates/koordinator/data_dosen_edit', $data);
        $this->load->view('templates/koordinator/sidebar');
        $this->load->view('templates/koordinator/footer');
    }
    public function update()
    {
        $id_user = $this->input->post('id_user');
        $nip = $this->input->post('nip');
        $password = md5($this->input->post('password'));
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');
        $telp_dsn = $this->input->post('telp_dsn');
        $data2 = array(
            'nama_dsn' => $nama,
            'nip' => $nip,
            'email_dsn' => $email,
            'telp_dsn' => $telp_dsn,
        );

        if ($this->input->post('password') == '') {
            $data = array(
                'username' => $nip,
            );
        } else {
            $data = array(
                'username' => $nip,
                'password' => $password

            );
        }

        $where = array(
            'id_user' => $id_user
        );
        $this->user_m->update_data($where, $data, 'tb_login');
        $this->user_m->update_data($where, $data2, 'tb_dosen');
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
        Data berhasil diubah.
      </div>');
        redirect('koordinator/Data_dosen');
    }
    public function hapus($id)
    {
        $where  = array('id_user' => $id);
        $this->user_m->hapus_data($where, 'tb_login');
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
        Data berhasil dihapus.
      </div>');
        redirect('koordinator/data_dosen');
    }
}
