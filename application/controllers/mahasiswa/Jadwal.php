<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal extends CI_Controller
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
        $npm = $this->session->userdata('username');
        $data = $this->user_m->ambil_data_m($this->session->userdata['username']);
        $data_dosen = $this->kp_m->tampil_data_p($data->username)->row();

        $data = array(
            'nama' => $data->nama_mhs,
            'username' => $data->username,
            'level' => $data->level,
            'dosen' => $data_dosen,

        );
        $cek = $this->db->query("select * from tb_kerjapraktik join tb_seminar on tb_kerjapraktik.id_kp = tb_seminar.id_kp where tb_kerjapraktik.npm ='$npm'")->num_rows();
        $cekk = $this->db->query("select * from tb_pembimbing where npm = '$npm'")->num_rows();
        $cekkk = $this->db->query("select * from tb_penguji where npm = '$npm'")->num_rows();
        $data['data'] = $this->kp_m->jadwal_m($npm)->row();
        $data['cek'] = $cek;
        $data['cekk'] = $cekk;
        $data['cekkk'] = $cekkk;
        $this->load->view('templates/mahasiswa/header', $data);
        $this->load->view('templates/mahasiswa/jadwal', $data);
        $this->load->view('templates/mahasiswa/sidebar');
        $this->load->view('templates/mahasiswa/footer');
    }
}
