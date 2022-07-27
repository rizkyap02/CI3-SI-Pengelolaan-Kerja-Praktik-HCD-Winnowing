<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembimbing extends CI_Controller
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
        $data['mahasiswa'] = $this->kp_m->tampil_data($periode->kp)->result();
        $data['jadwal'] = $this->db->get('tb_jadwal')->row();
        $this->load->view('templates/koordinator/header', $data);
        $this->load->view('templates/koordinator/pembimbing', $data);
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
        $data1 = $this->kp_m->tampil_data_kp($npm)->row();
        if (!$data1 == null) {
            $data['mahasiswa'] = $data1;
            $data['judul'] = $data1->judul;
        } else {
            $data['mahasiswa'] = $this->kp_m->tampil_data_p($npm)->row();
            $data['judul'] = '';
        }
        $this->load->view('templates/koordinator/header', $data);
        $this->load->view('templates/koordinator/pembimbing_edit', $data);
        $this->load->view('templates/koordinator/sidebar');
        $this->load->view('templates/koordinator/footer');
    }
    public function update($npm)
    {
        $data = array(
            'nip' => $this->input->post('nip'),
        );
        $where = array('npm' => $npm);
        $this->db->update('tb_kerjapraktik', $data, $where);
        $this->db->update('tb_pembimbing', $data, $where);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
        Data berhasil diubah.
      </div>');
        redirect('koordinator/Pembimbing');
    }

    public function acak_lagi()
    {
        /*menghapus/mengosongkan semua record database tb_jadwal*/
        $periode = $this->db->query("SELECT periode_kp as kp from tb_jadwal")->row();
        $data = $this->db->query("DELETE t1
        FROM tb_pembimbing AS t1 INNER JOIN tb_mahasiswa AS t2
        ON t1.npm = t2.npm
        WHERE t2.periode_kp = '$periode->kp'"); /*menghapus/mengosongkan semua record database tb_kelompok*/
        $data  = $this->kp_m->random($periode->kp)->result(); /*mengambil data mahasiswa secara acak*/
        $isi = array(); /*mengdeklarasikan vairabel isi sebagai array */
        $isi1 = array();
        $isi2 = array();
        $no = 1; /*mengdeklarasikan variabel no*/
        $no1 = 1;
        $kel = 1;
        foreach ($data as $dat) { /*digunakan untuk menentukan jumlah data pada tabel mahasiswa kemudian mengisikan nama mahasiswa dan npm kedalam array*/
            $isi[$no] = $dat->nama_mhs;

            $isi1[$no] = $dat->npm;

            $no++; /*menghitung jumlah mahasiswa*/
            "<br>";
        }
        $tot = $no; /*menghitung / mencari jumlah kelompok sesuai dari jumlah mahasiswa , jika koma maka dibulatkan dengan fungsi ceil*/
        "<br>";
        $datadosen  = $this->kp_m->randomd($tot)->result();

        foreach ($datadosen as $dos) { /*mengambi data dosen secara random dan diisikan kedalam array */
            $isi2[$no1] = $dos->nip;
            "<br>";
            $no1++; /*menghitung jumlah dosen*/
        }

        $ht = 1;
        for ($i = 1; $i < $no; $i++) { /*perulangan sesuai dengan jumlah mahasiswa*/

            if ($i == $no - 1 && ($no - 1) % 1 == 1) { /*jika mahasiswa berlebih maka mahasiswa tersebut masuk ke kelompok sebelumnya */
                echo $kel = $kel - 1;
                echo "<br>";
                echo $ht = $ht - 1;
            }
            echo "<br>";

            $data = array( /*masukkan data data tersebut menjadi array */
                'npm'    => $isi1[$i],
                'nip'    => $isi2[$ht],
            );
            $data2 = array( /*masukkan data data tersebut menjadi array */
                'nip'    => $isi2[$ht],
            );
            $cek = $this->db->query("SELECT judul from tb_kerjapraktik where npm ='" . $data['npm'] . "'")->num_rows();
            if ($cek == 0) {
            } else {
                $this->db->update('tb_kerjapraktik', $data2, "npm= '" . $data['npm'] . "'");
            }
            /*setiap perulangan 3 mahasiswa akan disetting menjadi 0 dan index array pada dosen yang telah diacak tadi ditambah 1 dan kelompok setiap 3 mahasiswa kembali ke 0 dan ditambah 1  */
            $this->kp_m->input_data($data); /*setiap perulangan 3 mahasiswa akan disetting menjadi 0 dan index array pada dosen yang telah diacak tadi ditambah 1 dan kelompok setiap 3 mahasiswa kembali ke 0 dan ditambah 1  */
            // $dsn = $this->db->query("select * from tb_pembimbing where nip = '$isi2[$ht]'")->num_rows();
            if ($i % 1 == 0) {
                $ht = $ht + 1;
                if ($ht == $no1) {
                    $ht = 1;
                }
            }
        }
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
        Data berhasil diperbaharui.
      </div>');
        redirect('koordinator/Pembimbing');
    }
}
