<?php

class Registrasi extends CI_Controller
{
    public function index()
    {
        $jadwal = $this->db->query("SELECT jd_akun_s as akun_s from tb_jadwal")->row();
        $jadwall = $this->db->query("SELECT jd_akun_e as akun_e from tb_jadwal")->row();
        if (strtotime(date('Y/m/d')) <= strtotime(date($jadwal->akun_s)) || strtotime(date('Y/m/d')) >= strtotime(date($jadwall->akun_e))) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Pendaftaran akun belum dibuka. Silahkan menunggu pendaftaran akun dibuka ! 
              </div>');
            redirect('login/index');
        } else {
            $this->form_validation->set_rules('nama', 'Nama', 'required', ['required' => 'Nama wajib diisi!']);
            $this->form_validation->set_rules('npm', 'NPM', 'required|max_length[9]|min_length[9]|is_unique[tb_login.username]', ['required' => 'NPM wajib diisi!', 'max_length' => 'NPM wajib 9 karakter', 'min_length' => 'NPM wajib 9 karakter', 'is_unique' => 'NPM sudah terdaftar']);
            $this->form_validation->set_rules('email', 'Email', 'required|is_unique[tb_login.email]', ['required' => 'Email wajib diisi!', 'is_unique' => 'Email sudah terdaftar']);
            $this->form_validation->set_rules('password_1', 'Password', 'required|matches[password_2]',  ['required' => 'Kata sandi wajib diisi!', 'matches' => 'Kata sandi tidak cocok']);
            $this->form_validation->set_rules('password_2', 'Password', 'required|matches[password_1]');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('templates/registrasi');
            } else {
                $data = array(
                    'id_user' => '',
                    'username' => strtoupper($this->input->post('npm')),
                    'password' => md5($this->input->post('password_1')),
                    'level' => 3,
                    'status' => 1,
                );
                $this->db->insert('tb_login', $data);
                $id = $this->db->query("SELECT MAX(id_user) as id from tb_login")->row();
                $periode = $this->db->query("SELECT periode_kp as kp from tb_jadwal")->row();
                $data2 = array(
                    'id_user' => $id->id,
                    'nama_mhs' => ucwords($this->input->post('nama')),
                    'email_mhs' => $this->input->post('email'),
                    'npm' => strtoupper($this->input->post('npm')),
                    'periode_kp' => $periode->kp,
                );
                $this->db->insert('tb_mahasiswa ', $data2);
                $this->session->set_flashdata('pesan', '<div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Pendaftaran akun berhasil silahkan tunggu verifikasi koordinator untuk dapat melakukan login !
              </div>');
                redirect('login/index');
            }
        }
    }
}
