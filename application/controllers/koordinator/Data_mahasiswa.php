<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_mahasiswa extends CI_Controller
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

        $data['mahasiswa'] = $this->user_m->tampil_data_m(3)->result();
        $this->load->view('templates/koordinator/header', $data);
        $this->load->view('templates/koordinator/data_mahasiswa', $data);
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
        $this->form_validation->set_rules('npm', 'NPM', 'required|max_length[9]|min_length[9]|is_unique[tb_login.username]', ['required' => 'NPM wajib diisi!', 'max_length' => 'NPM wajib 9 karakter', 'min_length' => 'NPM wajib 9 karakter', 'is_unique' => 'NPM sudah terdaftar']);
        $this->form_validation->set_rules('email', 'Email', 'required|is_unique[tb_login.email]', ['required' => 'Email wajib diisi!', 'is_unique' => 'Email sudah terdaftar']);
        $this->form_validation->set_rules('password_1', 'Password', 'required|min_length[8]',  ['required' => 'Kata sandi wajib diisi!', 'min_length' => 'Kata sandi minimal 8 karakter']);
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/koordinator/header', $data);
            $this->load->view('templates/koordinator/data_mahasiswa_tambah');
            $this->load->view('templates/koordinator/sidebar');
            $this->load->view('templates/koordinator/footer');
        } else {
            $data = array(
                'id_user' => '',
                'username' => $this->input->post('npm'),
                'password' => md5($this->input->post('password_1')),
                'level' => 3,
                'status' => 2
            );
            $this->db->insert('tb_login', $data);
            $id = $this->db->query("SELECT MAX(id_user) as id from tb_login")->row();
            $data2 = array(
                'id_user' => $id->id,
                'nama_mhs' => $this->input->post('nama'),
                'email_mhs' => $this->input->post('email'),
                'npm' => $this->input->post('npm'),
            );
            $this->db->insert('tb_mahasiswa ', $data2);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Data berhasil ditambahkan.
          </div>');
            redirect('koordinator/data_mahasiswa');
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

        $data['mhs'] = $this->user_m->edit_data($id)->row();
        $this->load->view('templates/koordinator/header', $data);
        $this->load->view('templates/koordinator/data_mahasiswa_edit', $data);
        $this->load->view('templates/koordinator/sidebar');
        $this->load->view('templates/koordinator/footer');
    }
    public function update()
    {
        $id_user = $this->input->post('id_user');
        $npm = $this->input->post('npm');
        $password = md5($this->input->post('password'));
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');
        $data2 = array(
            'nama_mhs' => $nama,
            'email_mhs' => $email,
        );

        if ($this->input->post('password') == '') {
            $data = array(
                'username' => $npm,
            );
        } else {
            $data = array(
                'username' => $npm,
                'password' => $password

            );
        }

        $where = array(
            'id_user' => $id_user
        );
        $this->user_m->update_data($where, $data, 'tb_login');
        $this->user_m->update_data($where, $data2, 'tb_mahasiswa');
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
        Data berhasil diubah.
      </div>');
        redirect('koordinator/Data_mahasiswa');
    }
    public function hapus($id)
    {
        $where  = array('id_user' => $id);
        $npm = $this->db->query("SELECT username as npm from tb_login where id_user ='$id'")->row();
        $idlks = $this->db->query("SELECT id_lks as id_lks from tb_kerjapraktik where npm ='$npm->npm'")->row();
        $id_kp = $this->db->query("SELECT id_kp as id_kp from tb_kerjapraktik where npm ='$npm->npm'")->row();
        $tdp = $this->db->query("SELECT tdp_siup as tdp from tb_lokasi where id_lks ='$npm->npm'")->row();
        $where_npm = array('npm' => $npm->npm);
        $where_kp = array('id_kp' => $id_kp->id_kp);
        $where_idlks = array('id_lks' => $idlks->id_lks);
        $del = "./uploads/tdp-siup/$tdp->tdp";
        // $del = "./uploads/tdp-siup/'TDP-SIUP-'" . $npm->npm . "'";
        $del1 = './uploads/' . $npm->npm;
        delete_files($del);
        delete_files($del1);
        $this->user_m->hapus_data($where_kp, 'tb_seminar');
        $this->user_m->hapus_data($where_npm, 'tb_kerjapraktik');
        $this->user_m->hapus_data($where_npm, 'tb_pembimbing');
        $this->user_m->hapus_data($where_npm, 'tb_penguji');
        $this->user_m->hapus_data($where_idlks, 'tb_lokasi');
        $this->user_m->hapus_data($where_npm, 'tb_mahasiswa');
        $this->user_m->hapus_data($where_npm, 'tb_kegiatan');
        $this->user_m->hapus_data($where_npm, 'tb_nilai');
        $this->user_m->hapus_data($where, 'tb_login');
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
        Data berhasil dihapus.
      </div>');
        redirect('koordinator/data_mahasiswa');
    }
}
