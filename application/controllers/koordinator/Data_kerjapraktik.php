<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_kerjapraktik extends CI_Controller
{
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

        $data = array(
            'nama' => $data->nama,
            'username' => $data->username,
            'level' => $data->level,
        );
        $data['kerjapraktik'] = $this->kp_m->tampil_data_kp_end($this->session->userdata('username'))->result();
        $this->load->view('templates/koordinator/header', $data);
        $this->load->view('templates/koordinator/data_kerjapraktik', $data);
        $this->load->view('templates/koordinator/sidebar');
        $this->load->view('templates/koordinator/footer');
    }
    public function edit($npm)
    {
        $data = $this->user_m->ambil_data($this->session->userdata['username']);

        $data = array(
            'nama' => $data->nama,
            'username' => $data->username,
            'level' => $data->level,
        );
        $data['kerjapraktik'] = $this->kp_m->tampil_data_kp($npm)->row();
        $this->load->view('templates/koordinator/header', $data);
        $this->load->view('templates/koordinator/data_kerjapraktik_edit', $data);
        $this->load->view('templates/koordinator/sidebar');
        $this->load->view('templates/koordinator/footer');
    }
    public function update($npm, $id_lks)
    {
        $data = array(
            'nama_lks' => $this->input->post('nama_lks'),
            'alamat_lks' => $this->input->post('alamat_lks'),
            'telp_lks' => $this->input->post('telp_lks'),
            'fax_email_lks' => $this->input->post('fax_email_lks'),
        );
        $where_lks = array('id_lks' => $id_lks);
        $where = array('npm' => $npm);
        $this->db->update('tb_lokasi', $data, $where_lks);

        $data1 = array(

            'alamat_mhs' => $this->input->post('alamat_mhs'),
            'telp_mhs' => $this->input->post('telp_mhs'),
        );
        $this->db->update('tb_mahasiswa', $data1, $where);

        $data2 = array(
            'semester_ta' => $this->input->post('semester_ta'),
            'jangka_waktu_s' => $this->input->post('jangka_waktu_s'),
            'jangka_waktu_e' => $this->input->post('jangka_waktu_e'),
            'judul' => $this->input->post('judul'),
            'uraian' => $this->input->post('uraian'),
        );

        $this->db->update('tb_kerjapraktik', $data2, $where);

        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
        Data berhasil diubah.
      </div>');
        redirect('koordinator/Data_kerjapraktik');
    }

    public function hapus($id)
    {
        $id_kp = $this->db->query("SELECT id_kp as id_kp from tb_kerjapraktik where npm ='$id'")->row();
        $idlks = $this->db->query("SELECT id_lks as id_lks from tb_kerjapraktik where npm ='$id'")->row();
        $tdp = $this->db->query("SELECT tdp_siup as tdp from tb_lokasi where id_lks ='$idlks->id_lks'")->row();
        $where_npm = array('npm' => $id);
        $where_kp = array('id_kp' => $id_kp->id_kp);
        $where_idlks = array('id_lks' => $idlks->id_lks);
        $del = "./uploads/tdp-siup/$tdp->tdp";
        $del1 = './uploads/' . $id;
        // unlink($del);
        delete_files($del);
        delete_files($del1);

        $this->user_m->hapus_data($where_kp, 'tb_seminar');
        $this->user_m->hapus_data($where_npm, 'tb_kerjapraktik');
        $this->user_m->hapus_data($where_npm, 'tb_penguji');
        $this->user_m->hapus_data($where_npm, 'tb_pembimbing');
        $this->user_m->hapus_data($where_npm, 'tb_kegiatan');
        $this->user_m->hapus_data($where_npm, 'tb_nilai');
        $this->user_m->hapus_data($where_idlks, 'tb_lokasi');
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Data berhasil dihapus.
          </div>');
        redirect('koordinator/data_kerjapraktik');
    }
}
