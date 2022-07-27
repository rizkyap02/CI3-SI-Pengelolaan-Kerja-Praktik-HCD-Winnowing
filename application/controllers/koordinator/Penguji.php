<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penguji extends CI_Controller
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
        $this->load->model('kp_m');
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
        $data['mahasiswa'] = $this->kp_m->tampil_data_penguji($periode->kp)->result();
        $data['jadwal'] = $this->db->get('tb_jadwal')->row();
        $this->load->view('templates/koordinator/header', $data);
        $this->load->view('templates/koordinator/penguji', $data);
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
        $data1 = $this->kp_m->tampil_data_peng($npm)->row();
        if (!$data1 == null) {
            $data['mahasiswa'] = $data1;
            $data['judul'] = $data1->judul;
        } else {
            $data['mahasiswa'] = $this->kp_m->tampil_data_p($npm)->row();
            $data['judul'] = '';
        }
        $this->load->view('templates/koordinator/header', $data);
        $this->load->view('templates/koordinator/penguji_edit', $data);
        $this->load->view('templates/koordinator/sidebar');
        $this->load->view('templates/koordinator/footer');
    }

    public function update($npm)
    {
        $data = array(
            'peng1' => $this->input->post('peng1'),
            'peng2' => $this->input->post('peng2'),
        );
        $where = array('npm' => $npm);
        $this->db->update('tb_penguji', $data, $where);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
        Data berhasil diubah.
      </div>');
        redirect('koordinator/Penguji');
    }

    public function acak()
    {
        $periode = $this->db->query("SELECT periode_kp as kp from tb_jadwal")->row();
        $data = $this->db->query("DELETE t1
        FROM tb_penguji AS t1 INNER JOIN tb_mahasiswa AS t2
        ON t1.npm = t2.npm
        WHERE t2.periode_kp = '$periode->kp'");
        // $no = 1;
        // $kel = 1;
        // $tot = ceil($no / 3);
        $jadwaln   = $this->kp_m->acak_penguji()->result();

        // $jam = 8;
        // $id = 0;
        // $ruangan = 1;
        // $tanggal = 23;

        foreach ($jadwaln as $jadd) {
            $penguji1 = "-";
            $penguji2 = "-";
            $pembimbing = $jadd->nip;

            do { /* mencari penguji 1*/
                $dosenacak = $this->db->query("SELECT * FROM tb_dosen JOIN tb_login ON tb_dosen.id_user = tb_login.id_user where tb_login.status='2' order by rand() limit 1 ")->result();
                foreach ($dosenacak as $acak) {
                    $jumlah1 = 0;
                    $jumlah2 = 0;

                    $penguji1 = $acak->nip;
                    // $dosen1 = $this->db->query("SELECT * FROM tb_jadwal where jam_ujian='0$jam:00:00' AND dosen_penguji1='$penguji1' AND tanggal_ujian='2019-12-$tanggal'")->result();

                    // foreach($dosen1 as $dos){
                    //   $jumlah1++;
                    // }
                    // $dosen2 = $this->db->query("SELECT * FROM tb_jadwal where jam_ujian='0$jam:00:00' AND dosen_penguji2='$penguji1' AND tanggal_ujian='2019-12-$tanggal'")->result();

                    // foreach($dosen2 as $dos){
                    //   $jumlah2++;
                    // }

                }
            } while ($penguji1 == $pembimbing || $jumlah1 > 0 || $jumlah2 > 0);

            do {  /*mencari peguji 2 */
                $dosenacak2 = $this->db->query("SELECT * FROM tb_dosen JOIN tb_login ON tb_dosen.id_user = tb_login.id_user where tb_login.status='2' order by rand() limit 1 ")->result();
                foreach ($dosenacak2 as $acak2) {
                    $jumlah1 = 0;
                    $jumlah2 = 0;
                    $penguji2 = $acak2->nip;
                    // $dosen1 = $this->db->query("SELECT * FROM tb_jadwal where jam_ujian='0$jam:00:00' AND dosen_penguji1='$penguji2'  AND tanggal_ujian='2019-12-$tanggal'")->result();

                    // foreach($dosen1 as $dos){
                    //   $jumlah1++;
                    // }
                    // $dosen2 = $this->db->query("SELECT * FROM tb_jadwal where jam_ujian='0$jam:00:00' AND dosen_penguji2='$penguji2' AND tanggal_ujian='2019-12-$tanggal'")->result();

                    // foreach($dosen2 as $dos2){
                    //   $jumlah2++;
                    // }

                }
            } while ($penguji2 == $pembimbing || $penguji2 == $penguji1 || $jumlah1 > 0   || $jumlah2 > 0);

            $data_in = array(
                'npm' => $jadd->npm,
                'peng1' => $penguji1,
                'peng2' => $penguji2
            );
            // print_r($data);
            // $where = array(
            //     'id_jadwal' => $jadd->id_jadwal
            // );
            $this->db->insert('tb_penguji', $data_in);

            // $ruangan++;
            // if($ruangan>3){
            //   $jam++;
            //   $ruangan = 1;
            // }

            // if($jam>11){
            //   $tanggal++;
            //   $jam = 8;
            // }

        }
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
        Data berhasil diperbaharui.
        </div>');
        redirect('koordinator/Penguji');
    }
}
