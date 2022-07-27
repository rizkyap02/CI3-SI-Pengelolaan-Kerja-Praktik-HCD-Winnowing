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
        $periode = $this->db->query("SELECT periode_kp as kp from tb_jadwal")->row();
        $data = array(
            'nama' => $data->nama,
            'username' => $data->username,
            'level' => $data->level,
        );
        $data['mahasiswa'] = $this->kp_m->tampil_nilai_koor($periode->kp)->result();
        $this->load->view('templates/koordinator/header', $data);
        $this->load->view('templates/koordinator/penilaian', $data);
        $this->load->view('templates/koordinator/sidebar');
        $this->load->view('templates/koordinator/footer');
    }

    public function tambah_nilai($npm)
    {
        $cek = $this->db->query("SELECT npm as npm from tb_nilai where npm='$npm'")->num_rows();
        if ($cek > 0) {
            $data = array(
                'npm' => $npm,
                'nilai_pl' => $this->input->post('nilai4'),
                'nilai_pemb' => $this->input->post('nilai3'),
                'nilai_peng2' => $this->input->post('nilai2'),
                'nilai_peng1' => $this->input->post('nilai'),
            );
            $where = array('npm' => $npm);
            $this->db->update('tb_nilai', $data, $where);
        } else if ($cek == 0) {
            $data = array(
                'npm' => $npm,
                'nilai_pl' => $this->input->post('nilai4'),
                'nilai_pemb' => $this->input->post('nilai3'),
                'nilai_peng2' => $this->input->post('nilai2'),
                'nilai_peng1' => $this->input->post('nilai'),
            );
            $this->db->insert('tb_nilai', $data);
        }
        $cekk = $this->db->query("SELECT * from tb_nilai where npm='$npm'")->row();
        $id_kp = $this->db->query("SELECT id_kp as id_kp from tb_kerjapraktik where npm='$npm'")->row();
        if ($cekk->nilai_pl != 0 && $cekk->nilai_pemb != 0 && $cekk->nilai_peng1 != 0 && $cekk->nilai_peng2 != 0) {
            $data = array(
                // 'npm' => $npm,
                'status' => 'Selesai'
            );
            $data1 = array(
                // 'id_kp' => $id_kp->id_kp,
                'status_sem' => 'Selesai'
            );
            $where1 = array('npm' => $npm);
            $where2 = array('id_kp' => $id_kp->id_kp);
            $this->db->update('tb_kerjapraktik', $data, $where1);
            $this->db->update('tb_seminar', $data1, $where2);
        }
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Data berhasil diperbaharui.
          </div>');
        redirect('koordinator/Penilaian');
    }
}
