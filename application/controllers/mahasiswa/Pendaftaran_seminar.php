<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pendaftaran_seminar extends CI_Controller
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

        if ($this->session->userdata('level') != 3) {
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
        $npm = $this->session->userdata('username');
        $sem = $this->db->query("select id_kp as id_kp from tb_kerjapraktik where npm ='$npm'")->row();
        $semm = $this->db->query("select id_kp as id_kp from tb_kerjapraktik where npm ='$npm'")->num_rows();
        if ($semm != null) {
            $cek = $this->db->query("select id_kp as cek from tb_seminar where id_kp ='$sem->id_kp'")->num_rows();
        } else {
            $cek = 0;
        }
        if ($cek == 1) {
            $data = $this->user_m->ambil_data_m($this->session->userdata['username']);
            $data = array(
                'nama' => $data->nama_mhs,
                'username' => $data->username,
                'level' => $data->level,
            );
            $data['cek'] = $this->db->query("select id_kp as cek from tb_kerjapraktik where id_kp ='$sem->id_kp'")->num_rows();
            $data['jadwal'] = $this->db->get('tb_jadwal')->row();
            $data['data'] = $this->kp_m->tampil_data_sem_m($npm)->row();
            $this->load->view('templates/mahasiswa/header', $data);
            $this->load->view('templates/mahasiswa/pendaftaran_seminar_menunggu', $data);
            $this->load->view('templates/mahasiswa/sidebar');
            $this->load->view('templates/mahasiswa/footer');
        } else {
            $data = $this->user_m->ambil_data_m($this->session->userdata['username']);
            $data_dosen = $this->kp_m->tampil_data_ps($data->username)->row();
            $data = array(
                'nama' => $data->nama_mhs,
                'email' => $data->email_mhs,
                'username' => $data->username,
                'level' => $data->level,

            );
            $data['data'] = $data_dosen;
            $data['cek'] = $cek = $this->db->query("select npm as cek from tb_kerjapraktik where npm ='$npm'")->num_rows();
            $data['jadwal'] = $this->db->get('tb_jadwal')->row();
            $this->load->view('templates/mahasiswa/header', $data);
            $this->load->view('templates/mahasiswa/pendaftaran_seminar', $data);
            $this->load->view('templates/mahasiswa/sidebar');
            $this->load->view('templates/mahasiswa/footer');
        }
    }
    public function tambah_seminar($id_kp)
    {
        // $npm = $this->session->userdata('username');
        // $this->form_validation->set_rules('ktm', 'KTM', 'required', ['required' => 'KTM wajib diisi!']);
        // // $this->form_validation->set_rules('transkrip', 'Transkrip', 'required', ['required' => 'Transkrip wajib diisi!']);
        // // $this->form_validation->set_rules('krs', 'KRS', 'required', ['required' => 'KRS wajib diisi!']);
        // // $this->form_validation->set_rules('kerangka_acuan', 'Kerangka Acuan', 'required', ['required' => 'Kerangka Acuan wajib diisi!']);
        // // $this->form_validation->set_rules('lbr_persetujuan', 'Lembar Persetujuan', 'required', ['required' => 'Lembar Persetujuan wajib diisi!']);
        // // $this->form_validation->set_rules('bukti_hadir', 'Bukti Menghadiri Seminar', 'required', ['required' => 'Bukti Menghadiri Seminar wajib diisi!']);
        // // $this->form_validation->set_rules('lbr_bimbingan', 'Lembar Bimbingan', 'required', ['required' => 'Lembar Bimbingan wajib diisi!']);
        // // $this->form_validation->set_rules('lbr_penilaian', 'Lembar Penilaian Pembimbing Lapangan', 'required', ['required' => 'Lembar Penilaian Pembimbing Lapangan wajib diisi!']);
        // // $this->form_validation->set_rules('lap_kp', 'File Laporan KP', 'required', ['required' => 'File Laporan KP wajib diisi!']);
        // if ($this->form_validation->run() == FALSE) {
        //     $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
        //             Pendaftaran Seminar Gagal, silahkan periksa kembali data pendaftaran seminar kerja praktik anda !
        //           </div>');
        //     redirect('Mahasiswa/pendaftaran_seminar');
        // } else {
        $npm = $this->session->userdata('username');
        // mkdir('./Uploads/'.$npm , 0777, TRUE);
        $folder = ["TRANSKRIP", "KRS", "KERANGKA-ACUAN", "LPS", "BMS", "LEMBAR-BIMBINGAN", "LEMBAR-NILAI", "LAPORAN-KP"];
        $name = ["ktm", "transkrip", "krs", "kerangka_acuan", "lbr_persetujuan", "bukti_hadir", "lbr_bimbingan", "lbr_nilai", "lap_kp"];
        if (!is_dir('uploads/' . $npm)) {
            mkdir('./uploads/' . $npm, 0777, TRUE);
        }

        for ($i = 0; $i < 9; $i++) {

            if (!empty($_FILES['berkas']['name'][$i])) {

                $_FILES['file']['name'] = $_FILES['berkas']['name'][$i];
                $_FILES['file']['type'] = $_FILES['berkas']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['berkas']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['berkas']['error'][$i];
                $_FILES['file']['size'] = $_FILES['berkas']['size'][$i];

                $config['upload_path']          = './uploads/' . $npm;
                $config['allowed_types']        = 'pdf';
                $config['max_size']             = 15360;
                $config['file_name']            = "berkas";

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('file')) {

                    $uploadData = $this->upload->data();
                    $filename = $uploadData['file_name'];

                    $data['totalFiles'][] = $filename;
                }
            }
        }
        // $kp = $this->input->post('id_kp');
        // echo $kp;
        $data1['id_kp'] = $id_kp;
        // $data1['ktm'] = "berkas.pdf";
        $data1['transkrip'] = "berkas1.pdf";
        $data1['krs'] = "berkas2.pdf";
        $data1['kerangka_acuan'] = "berkas3.pdf";
        $data1['lbr_persetujuan'] = "berkas4.pdf";
        $data1['bukti_hadir'] = "berkas5.pdf";
        $data1['lbr_bimbingan'] = "berkas6.pdf";
        $data1['lbr_nilai'] = "berkas7.pdf";
        $data1['lap_kp'] = "berkas8.pdf";
        $data1['status_sem'] = 'Menunggu';
        $this->db->insert('tb_seminar', $data1);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
                    Pendaftaran Seminar berhasil, silahkan menunggu verifikasi Dosen Pembimbing dan Koordinator KP.
                  </div>');
        redirect('mahasiswa/Pendaftaran_seminar');
    }
    // }
}
