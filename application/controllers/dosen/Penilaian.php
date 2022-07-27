<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penilaian extends CI_Controller
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
        $data['kerjapraktik'] = $this->kp_m->tampil_nilai_pemb($this->session->userdata('username'), $periode->kp)->result();
        $data['kerjapraktikk'] = $this->kp_m->tampil_nilai_peng($this->session->userdata('username'), $periode->kp)->result();
        $this->load->view('templates/dosen/header', $data);
        $this->load->view('templates/dosen/penilaian', $data);
        $this->load->view('templates/dosen/sidebar');
        $this->load->view('templates/dosen/footer');
    }

    public function tambah_nilai($npm)
    {
        $sama = $this->db->query("SELECT tb_penguji.peng1, tb_penguji.peng2 FROM tb_penguji where tb_penguji.npm ='$npm'")->result();
        foreach ($sama as $sm) {
            if ($sm->peng1 != $sm->peng2) {
                if ($this->input->post('nilai') != NULL) {
                    $nilai = $this->input->post('nilai');
                    $cek = $this->db->query("SELECT npm as npm from tb_nilai where npm='$npm'")->num_rows();
                    if ($cek > 0) {
                        $data = array(
                            'npm' => $npm,
                            'nilai_peng1' => $nilai
                        );
                        $where = array('npm' => $npm);
                        $this->db->update('tb_nilai', $data, $where);
                    } else if ($cek == 0) {
                        $data = array(
                            'npm' => $npm,
                            'nilai_peng1' => $nilai
                        );
                        $this->db->insert('tb_nilai', $data);
                    }
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
                    Data berhasil diperbaharui.
                  </div>');
                    redirect('dosen/Penilaian');
                } else if ($this->input->post('nilai2') != NULL) {
                    $nilai = $this->input->post('nilai2');
                    $cek = $this->db->query("SELECT npm as npm from tb_nilai where npm='$npm'")->num_rows();
                    if ($cek > 0) {
                        $data = array(
                            'npm' => $npm,
                            'nilai_peng2' => $nilai
                        );
                        $where = array('npm' => $npm);
                        $this->db->update('tb_nilai', $data, $where);
                    } else if ($cek == 0) {
                        $data = array(
                            'npm' => $npm,
                            'nilai_peng2' => $nilai
                        );
                        $this->db->insert('tb_nilai', $data);
                    }
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
                    Data berhasil diperbaharui.
                  </div>');
                    redirect('dosen/Penilaian');
                } else {
                    $nilai = $this->input->post('nilai3');
                    $cek = $this->db->query("SELECT npm as npm from tb_nilai where npm='$npm'")->num_rows();
                    if ($cek > 0) {
                        $data = array(
                            'npm' => $npm,
                            'nilai_pemb' => $nilai
                        );
                        $where = array('npm' => $npm);
                        $this->db->update('tb_nilai', $data, $where);
                    } else if ($cek == 0) {
                        $data = array(
                            'npm' => $npm,
                            'nilai_pemb' => $nilai
                        );
                        $this->db->insert('tb_nilai', $data);
                    }
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
                    Data berhasil diperbaharui.
                  </div>');
                    redirect('dosen/Penilaian');
                }
            } else {
                if ($this->input->post('nilai') != NULL) {
                    $nilai = $this->input->post('nilai');
                    $cek = $this->db->query("SELECT npm as npm from tb_nilai where npm='$npm'")->num_rows();
                    if ($cek > 0) {
                        $data = array(
                            'npm' => $npm,
                            'nilai_peng1' => $nilai,
                            'nilai_peng2' => $nilai
                        );
                        $where = array('npm' => $npm);
                        $this->db->update('tb_nilai', $data, $where);
                    } else if ($cek == 0) {
                        $data = array(
                            'npm' => $npm,
                            'nilai_peng1' => $nilai,
                            'nilai_peng2' => $nilai
                        );
                        $this->db->insert('tb_nilai', $data);
                    }
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
                    Data berhasil diperbaharui.
                  </div>');
                    redirect('dosen/Penilaian');
                } else if ($this->input->post('nilai2') != NULL) {
                    $nilai = $this->input->post('nilai2');
                    $cek = $this->db->query("SELECT npm as npm from tb_nilai where npm='$npm'")->num_rows();
                    if ($cek > 0) {
                        $data = array(
                            'npm' => $npm,
                            'nilai_peng1' => $nilai,
                            'nilai_peng2' => $nilai
                        );
                        $where = array('npm' => $npm);
                        $this->db->update('tb_nilai', $data, $where);
                    } else if ($cek == 0) {
                        $data = array(
                            'npm' => $npm,
                            'nilai_peng1' => $nilai,
                            'nilai_peng2' => $nilai
                        );
                        $this->db->insert('tb_nilai', $data);
                    }
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
                    Data berhasil diperbaharui.
                  </div>');
                    redirect('dosen/Penilaian');
                }
            }
        }
    }
}
