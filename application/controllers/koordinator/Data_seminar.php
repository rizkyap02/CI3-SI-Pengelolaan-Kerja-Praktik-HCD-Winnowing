<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_seminar extends CI_Controller
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

        $data = array(
            'nama' => $data->nama,
            'username' => $data->username,
            'level' => $data->level,
        );
        $data['kerjapraktik'] = $this->kp_m->tampil_data_sem_endd($this->session->userdata('username'))->result();
        $this->load->view('templates/koordinator/header', $data);
        $this->load->view('templates/koordinator/data_seminar', $data);
        $this->load->view('templates/koordinator/sidebar');
        $this->load->view('templates/koordinator/footer');
    }
    public function info($npm)
    {
        $data = $this->user_m->ambil_data($this->session->userdata['username']);

        $data = array(
            'nama' => $data->nama,
            'username' => $data->username,
            'level' => $data->level,
        );
        $data['kerjapraktik'] = $this->kp_m->tampil_data_sem_info($npm)->row();
        $this->load->view('templates/koordinator/header', $data);
        $this->load->view('templates/koordinator/data_seminar_info', $data);
        $this->load->view('templates/koordinator/sidebar');
        $this->load->view('templates/koordinator/footer');
    }
    public function hapus($id)
    {
        $id_kp = $this->db->query("SELECT npm as npm from tb_kerjapraktik where id_kp ='$id'")->row();
        $where_npm = array('npm' => $id_kp->npm);
        $where_kp = array('id_kp' => $id);
        $del = './uploads/' . $id_kp->npm;
        delete_files($del);
        $this->user_m->hapus_data($where_kp, 'tb_seminar');
        $this->user_m->hapus_data($where_npm, 'tb_penguji');
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
        Data berhasil dihapus.
      </div>');
        redirect('koordinator/data_seminar');
    }
}
