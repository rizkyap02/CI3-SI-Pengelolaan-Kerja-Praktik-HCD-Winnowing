<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pendaftaran_kp extends CI_Controller
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
        $cek = $this->db->query("select npm as cek from tb_kerjapraktik where npm ='$npm'")->num_rows();
        if ($cek == 1) {
            $data = $this->user_m->ambil_data_m($this->session->userdata['username']);
            $data = array(
                'nama' => $data->nama_mhs,
                'username' => $data->username,
                'level' => $data->level,
            );

            $data['data'] = $this->kp_m->tampil_data_kp($npm)->row();
            $data['jadwal'] = $this->db->get('tb_jadwal')->row();
            $data['keg'] = $this->kp_m->keg($npm)->result();
            $this->load->view('templates/mahasiswa/header', $data);
            $this->load->view('templates/mahasiswa/pendaftaran_kp_menunggu', $data);
            $this->load->view('templates/mahasiswa/sidebar');
            $this->load->view('templates/mahasiswa/footer');
        } else {
            $data = $this->user_m->ambil_data_m($this->session->userdata['username']);
            $data_dosen = $this->kp_m->tampil_data_p($data->username)->row();
            $data = array(
                'nama' => $data->nama_mhs,
                'email' => $data->email_mhs,
                'username' => $data->username,
                'level' => $data->level,
                'dosen' => $data_dosen,
            );
            $data['jadwal'] = $this->db->get('tb_jadwal')->row();
            $this->load->view('templates/mahasiswa/header', $data);
            $this->load->view('templates/mahasiswa/pendaftaran_kp');
            $this->load->view('templates/mahasiswa/sidebar');
            $this->load->view('templates/mahasiswa/footer');
        }
    }
    public function perubahan_kp()
    {
        $npm = $this->session->userdata('username');
        $data = $this->user_m->ambil_data_m($this->session->userdata['username']);
        $data_dosen = $this->kp_m->tampil_data_p($data->username)->row();
        $data = array(
            'nama' => $data->nama_mhs,
            'email' => $data->email_mhs,
            'username' => $data->username,
            'level' => $data->level,
            'dosen' => $data_dosen,
        );
        $data['data'] = $this->kp_m->tampil_data_kp($npm)->row();
        $data['jadwal'] = $this->db->get('tb_jadwal')->row();
        $this->load->view('templates/mahasiswa/header', $data);
        $this->load->view('templates/mahasiswa/perubahan_kp', $data);
        $this->load->view('templates/mahasiswa/sidebar');
        $this->load->view('templates/mahasiswa/footer');
    }
    public function tambah_kp()
    {
        $data = $this->user_m->ambil_data_m($this->session->userdata['username']);
        $this->form_validation->set_rules('nama_lks', 'Nama Lokasi', 'required', ['required' => 'Lembaga/Perusahaan/Tempat KP wajib diisi!']);
        $this->form_validation->set_rules('alamat_lks', 'Alamat Lokasi', 'required', ['required' => 'Alamat Lembaga/Perusahaan/Tempat KP wajib diisi!']);
        $this->form_validation->set_rules('nama_pl', 'Nama Pembimbing Lapangan', 'required', ['required' => 'Nama Pembimbing Lapangan wajib diisi!']);
        $this->form_validation->set_rules('telp_lks', 'Telepon Lokasi', 'required', ['required' => 'Telepon Lembaga/Perusahaan/Tempat KP wajib diisi!']);
        $this->form_validation->set_rules('fax_email_lks', 'Fax Email Lokasi', 'required', ['required' => 'Fax/Email Lembaga/Perusahaan/Tempat KP wajib diisi!']);
        $this->form_validation->set_rules('semester_ta', 'Semester Tahun Akademik', 'required', ['required' => 'Semester/Tahun Akademik wajib diisi!']);
        $this->form_validation->set_rules('alamat_mhs', 'Alamat Mahasiswa', 'required', ['required' => 'Alamat Mahasiswa wajib diisi!']);
        $this->form_validation->set_rules('telp_mhs', 'Telepon Mahasiswa', 'required', ['required' => 'Telepon Mahasiswa wajib diisi!']);
        $this->form_validation->set_rules('judul', 'Judul', 'required', ['required' => 'Judul wajib diisi!']);
        $this->form_validation->set_rules('jangka_waktu_s', 'Jangka Waktu', 'required', ['required' => 'Jangka waktu wajib diisi!']);
        $this->form_validation->set_rules('jangka_waktu_e', 'Jangka Waktu', 'required', ['required' => 'Jangka waktu wajib diisi!']);
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                    Pendaftaran Kerja Praktik Gagal, silahkan periksa kembali data pendaftaran kerja praktik anda !
                  </div>');
            redirect('Mahasiswa/pendaftaran_kp');
        } else {

            $file_name                      = "TDP-SIUP-'" . $this->input->post('npm') . "'";
            $config['upload_path']          = './uploads/tdp-siup/';
            $config['allowed_types']        = 'pdf';
            $config['max_size']             = 15360;
            $config['file_name']            = $file_name;
            $config['overwrite']            = true;


            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('tdp_siup')) {
                $data = array(
                    'nama_lks' => $this->input->post('nama_lks'),
                    'alamat_lks' => $this->input->post('alamat_lks'),
                    'telp_lks' => $this->input->post('telp_lks'),
                    'fax_email_lks' => $this->input->post('fax_email_lks'),
                    'tdp_siup' => '-',
                );
                $this->db->insert('tb_lokasi', $data);
                $id_lks = $this->db->query("SELECT MAX(id_lks) as id from tb_lokasi")->row();
                $data2 = array(
                    'nama_pl' => $this->input->post('nama_pl'),
                    'id_lks' => $id_lks->id,
                    'npm' => $this->input->post('npm'),
                    'nip' => $this->input->post('nip'),
                    'semester_ta' => $this->input->post('semester_ta'),
                    'judul' => $this->input->post('judul'),
                    'uraian' => $this->input->post('uraian'),
                    'jangka_waktu_s' => $this->input->post('jangka_waktu_s'),
                    'jangka_waktu_e' => $this->input->post('jangka_waktu_e'),
                    'status'    =>  'Menunggu',
                    'tgl_pengajuan' => date("Y-m-d")
                );
                $this->db->insert('tb_kerjapraktik', $data2);
                $data3 = array(
                    'alamat_mhs' => $this->input->post('alamat_mhs'),
                    'telp_mhs' => $this->input->post('telp_mhs'),
                );
                $npm = array('npm' => $this->input->post('npm'));
                $this->db->update('tb_mahasiswa', $data3, $npm);
                $kegs = $this->input->post('keg_s');
                $kege = $this->input->post('keg_e');
                $ket = $this->input->post('ket');
                $total = count($kegs);

                for ($i = 0; $i < $total - 1; $i++) {
                    $data4 = array(
                        'npm' => $this->input->post('npm'),
                        'keg_s' => $kegs[$i],
                        'keg_e' => $kege[$i],
                        'ket' => $ket[$i]
                    );
                    $this->db->insert('tb_kegiatan', $data4);
                }


                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
                    Pendaftaran Kerja Praktik berhasil, silahkan menunggu verifikasi Dosen Pembimbing dan Koordinator KP.
                  </div>');
                redirect('mahasiswa/Pendaftaran_kp');
            } else {

                $upload = $this->upload->data();
                $data = array(
                    'nama_lks' => $this->input->post('nama_lks'),
                    'alamat_lks' => $this->input->post('alamat_lks'),
                    'telp_lks' => $this->input->post('telp_lks'),
                    'fax_email_lks' => $this->input->post('fax_email_lks'),
                    'tdp_siup' => $upload['file_name'],
                );
                $this->db->insert('tb_lokasi', $data);
                $id_lks = $this->db->query("SELECT MAX(id_lks) as id from tb_lokasi")->row();
                $data2 = array(
                    'nama_pl' => $this->input->post('nama_pl'),
                    'id_lks' => $id_lks->id,
                    'npm' => $this->input->post('npm'),
                    'nip' => $this->input->post('nip'),
                    'semester_ta' => $this->input->post('semester_ta'),
                    'judul' => $this->input->post('judul'),
                    'uraian' => $this->input->post('uraian'),
                    'jangka_waktu_s' => $this->input->post('jangka_waktu_s'),
                    'jangka_waktu_e' => $this->input->post('jangka_waktu_e'),
                    'status'    =>  'Menunggu',
                    'tgl_pengajuan' => date("Y-m-d")
                );
                $this->db->insert('tb_kerjapraktik', $data2);
                $data3 = array(
                    'alamat_mhs' => $this->input->post('alamat_mhs'),
                    'telp_mhs' => $this->input->post('telp_mhs'),
                );
                $npm = array('npm' => $this->input->post('npm'));
                $this->db->update('tb_mahasiswa', $data3, $npm);
                $kegs = $this->input->post('keg_s');
                $kege = $this->input->post('keg_e');
                $ket = $this->input->post('ket');
                $total = count($kegs);

                for ($i = 0; $i < $total - 1; $i++) {
                    $data4 = array(
                        'npm' => $this->input->post('npm'),
                        'keg_s' => $kegs[$i],
                        'keg_e' => $kege[$i],
                        'ket' => $ket[$i]
                    );
                    $this->db->insert('tb_kegiatan', $data4);
                }


                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
                    Pendaftaran Kerja Praktik berhasil, silahkan menunggu verifikasi Dosen Pembimbing dan Koordinator KP.
                  </div>');
                redirect('mahasiswa/Pendaftaran_kp');
            }
        }
    }
    public function ubah_kp($id)
    {
        $data = $this->user_m->ambil_data_m($this->session->userdata['username']);
        $this->form_validation->set_rules('nama_lks', 'Nama Lokasi', 'required', ['required' => 'Lembaga/Perusahaan/Tempat KP wajib diisi!']);
        $this->form_validation->set_rules('alamat_lks', 'Alamat Lokasi', 'required', ['required' => 'Alamat Lembaga/Perusahaan/Tempat KP wajib diisi!']);
        $this->form_validation->set_rules('nama_pl', 'Nama Pembimbing Lapangan', 'required', ['required' => 'Nama Pembimbing Lapangan wajib diisi!']);
        $this->form_validation->set_rules('telp_lks', 'Telepon Lokasi', 'required', ['required' => 'Telepon Lembaga/Perusahaan/Tempat KP wajib diisi!']);
        $this->form_validation->set_rules('fax_email_lks', 'Fax Email Lokasi', 'required', ['required' => 'Fax/Email Lembaga/Perusahaan/Tempat KP wajib diisi!']);
        $this->form_validation->set_rules('semester_ta', 'Semester Tahun Akademik', 'required', ['required' => 'Semester/Tahun Akademik wajib diisi!']);
        $this->form_validation->set_rules('alamat_mhs', 'Alamat Mahasiswa', 'required', ['required' => 'Alamat Mahasiswa wajib diisi!']);
        $this->form_validation->set_rules('telp_mhs', 'Telepon Mahasiswa', 'required', ['required' => 'Telepon Mahasiswa wajib diisi!']);
        $this->form_validation->set_rules('judul', 'Judul', 'required', ['required' => 'Judul wajib diisi!']);
        $this->form_validation->set_rules('jangka_waktu_s', 'Jangka Waktu', 'required', ['required' => 'Jangka waktu wajib diisi!']);
        $this->form_validation->set_rules('jangka_waktu_e', 'Jangka Waktu', 'required', ['required' => 'Jangka waktu wajib diisi!']);
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                    Pendaftaran Kerja Praktik Gagal, silahkan periksa kembali data pendaftaran kerja praktik anda !
                  </div>');
            redirect('Mahasiswa/pendaftaran_kp');
        } else {

            $file_name                      = "TDP-SIUP-'" . $this->input->post('npm') . "'";
            $config['upload_path']          = './uploads/tdp-siup/';
            $config['allowed_types']        = 'pdf';
            $config['max_size']             = 15360;
            $config['file_name']            = $file_name;
            $config['overwrite']            = true;
            $del = "./uploads/tdp-siup/'TDP-SIUP-'" . $this->input->post('npm') . "'";

            $this->load->library('upload', $config);
            delete_files($del);
            $i = $this->db->query("SELECT id_lks as id_lks from tb_kerjapraktik where npm = '$id'")->row();
            $id_lks = $i->id_lks;

            if (!$this->upload->do_upload('tdp_siup')) {
                $upload = $this->upload->data();
                $data = array(
                    'nama_lks' => $this->input->post('nama_lks'),
                    'alamat_lks' => $this->input->post('alamat_lks'),
                    'telp_lks' => $this->input->post('telp_lks'),
                    'fax_email_lks' => $this->input->post('fax_email_lks'),
                    'tdp_siup' => '-',
                );
                $this->db->update('tb_lokasi', $data, 'id_lks =' . $id_lks);
                // $id_lks = $this->db->query("SELECT MAX(id_lks) as id from tb_lokasi")->row();
                $data2 = array(
                    'nama_pl' => $this->input->post('nama_pl'),
                    'id_lks' => $id_lks,
                    'npm' => $this->input->post('npm'),
                    'nip' => $this->input->post('nip'),
                    'semester_ta' => $this->input->post('semester_ta'),
                    'judul' => $this->input->post('judul'),
                    'uraian' => $this->input->post('uraian'),
                    'jangka_waktu_s' => $this->input->post('jangka_waktu_s'),
                    'jangka_waktu_e' => $this->input->post('jangka_waktu_e'),
                    'status'    =>  'Perubahan Judul',
                );
                $npm = array('npm' => $this->input->post('npm'));
                $this->db->update('tb_kerjapraktik', $data2, $npm);
                $data3 = array(
                    'alamat_mhs' => $this->input->post('alamat_mhs'),
                    'telp_mhs' => $this->input->post('telp_mhs'),
                );
                $npmm = $this->input->post('npm');
                $this->db->update('tb_mahasiswa', $data3, $npm);

                $this->db->where('npm', $npmm);
                $this->db->delete('tb_kegiatan');
                $kegs = $this->input->post('keg_s');
                $kege = $this->input->post('keg_e');
                $ket = $this->input->post('ket');
                $total = count($kegs);

                for ($i = 0; $i < $total - 1; $i++) {
                    $data4 = array(
                        'npm' => $this->input->post('npm'),
                        'keg_s' => $kegs[$i],
                        'keg_e' => $kege[$i],
                        'ket' => $ket[$i]
                    );
                    $this->db->insert('tb_kegiatan', $data4);
                }
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
                    Pengajuan Perubahan Kerja Praktik berhasil, silahkan menunggu verifikasi Dosen Pembimbing dan Koordinator KP.
                  </div>');
                redirect('mahasiswa/Pendaftaran_kp');
            } else {

                $upload = $this->upload->data();
                $data = array(
                    'nama_lks' => $this->input->post('nama_lks'),
                    'alamat_lks' => $this->input->post('alamat_lks'),
                    'telp_lks' => $this->input->post('telp_lks'),
                    'fax_email_lks' => $this->input->post('fax_email_lks'),
                    'tdp_siup' => $upload['file_name'],
                );
                $this->db->update('tb_lokasi', $data, 'id_lks =' . $id_lks);
                // $id_lks = $this->db->query("SELECT MAX(id_lks) as id from tb_lokasi")->row();
                $data2 = array(
                    'nama_pl' => $this->input->post('nama_pl'),
                    'id_lks' => $id_lks,
                    'npm' => $this->input->post('npm'),
                    'nip' => $this->input->post('nip'),
                    'semester_ta' => $this->input->post('semester_ta'),
                    'judul' => $this->input->post('judul'),
                    'uraian' => $this->input->post('uraian'),
                    'jangka_waktu_s' => $this->input->post('jangka_waktu_s'),
                    'jangka_waktu_e' => $this->input->post('jangka_waktu_e'),
                    'status'    =>  'Perubahan Judul',
                );
                $npm = array('npm' => $this->input->post('npm'));
                $this->db->update('tb_kerjapraktik', $data2, $npm);
                $data3 = array(
                    'alamat_mhs' => $this->input->post('alamat_mhs'),
                    'telp_mhs' => $this->input->post('telp_mhs'),
                );
                $npmm = $this->input->post('npm');
                $this->db->update('tb_mahasiswa', $data3, $npm);

                $this->db->where('npm', $npmm);
                $this->db->delete('tb_kegiatan');
                $kegs = $this->input->post('keg_s');
                $kege = $this->input->post('keg_e');
                $ket = $this->input->post('ket');
                $total = count($kegs);

                for ($i = 0; $i < $total - 1; $i++) {
                    $data4 = array(
                        'npm' => $this->input->post('npm'),
                        'keg_s' => $kegs[$i],
                        'keg_e' => $kege[$i],
                        'ket' => $ket[$i]
                    );
                    $this->db->insert('tb_kegiatan', $data4);
                }
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
                    Pengajuan Perubahan Kerja Praktik berhasil, silahkan menunggu verifikasi Dosen Pembimbing dan Koordinator KP.
                  </div>');
                redirect('mahasiswa/Pendaftaran_kp');
            }
        }
    }
}
