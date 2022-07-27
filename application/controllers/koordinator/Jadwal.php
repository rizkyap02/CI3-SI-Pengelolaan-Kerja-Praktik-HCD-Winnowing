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
    if ($this->session->userdata('level') != 1) {
      redirect('login');
    }
    if (!isset($this->session->userdata['username'])) {
      $this->session->set_flashdata('pesan', '<div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Anda belum melakukan login
            </div>');
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
    $data['mahasiswa'] = $this->kp_m->tampil_data_jadwal_k($periode->kp)->result();
    $data['jadwal'] = $this->db->get('tb_jadwal')->row();
    $this->load->view('templates/koordinator/header', $data);
    $this->load->view('templates/koordinator/jadwal', $data);
    $this->load->view('templates/koordinator/sidebar');
    $this->load->view('templates/koordinator/footer');
  }
  public function jadwal_df()
  {
    $data = array(
      'id_jadwal' => '',
      'periode_kp' => $this->input->post('periode_kp'),
      'jd_akun_s' => $this->input->post('jd_akun_s'),
      'jd_akun_e' => $this->input->post('jd_akun_e'),
      'jd_kp_s' => $this->input->post('jd_kp_s'),
      'jd_kp_e' => $this->input->post('jd_kp_e'),
      'jd_seminar_s' => $this->input->post('jd_seminar_s'),
      'jd_seminar_e' => $this->input->post('jd_seminar_e'),
      'jd_seminar_m_s' => $this->input->post('jd_seminar_m_s'),
      'jd_seminar_m_e' => $this->input->post('jd_seminar_m_e'),
    );

    if ($this->db->get('tb_jadwal')->num_rows() == 0) {
      $this->db->insert('tb_jadwal', $data);
      $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Jadwal berhasil diperbaharui.
          </div>');
    } else {
      $this->db->update('tb_jadwal', $data);
      $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Jadwal berhasil diperbaharui.
          </div>');
    }
    redirect('koordinator/Jadwal');
  }
  public function tambah($npm)
  {
    $data = $this->user_m->ambil_data($this->session->userdata['username']);

    $data = array(
      'nama' => $data->nama,
      'username' => $data->username,
      'level' => $data->level,
    );
    $data['mahasiswa'] = $this->kp_m->jadwal_ubah($npm)->row();
    $this->load->view('templates/koordinator/header', $data);
    $this->load->view('templates/koordinator/jadwal_tambah', $data);
    $this->load->view('templates/koordinator/sidebar');
    $this->load->view('templates/koordinator/footer');
  }
  public function update($id_kp)
  {
    $data = array(
      'tgl_seminar' => $this->input->post('tgl_seminar'),
      'wkt_seminar' => $this->input->post('wkt_seminar'),
      'r_seminar' => $this->input->post('r_seminar')
    );
    $where = array('id_kp' => $id_kp);
    $this->db->update('tb_seminar', $data, $where);
    $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
        Jadwal berhasil diubah.
      </div>');
    redirect('koordinator/Jadwal');
  }

  // public function jadwall_acak()
  // {
  //   $data = $this->db->query("UPDATE tb_seminar SET r_seminar = '', tgl_seminar = '0000-00-00', wkt_seminar = '00:00:00' ,status_sem='Disetujui Koordinator' WHERE tb_seminar.id_seminar != 0
  //   ");
  //   $jam = 9;
  //   $ruangan = 1;
  //   $tanggal = $this->db->query("SELECT jd_seminar_m_s as jadwal from tb_jadwal")->row();
  //   $jadwal = $tanggal->jadwal;
  //   $data = $this->db->query('SELECT * FROM `tb_mahasiswa` a join tb_penguji b on a.npm=b.npm join tb_kerjapraktik c on a.npm = c.npm join tb_seminar d on c.id_kp=d.id_kp where status_sem="Disetujui Koordinator"')->result();
  //   foreach ($data as $seminar) {
  //     $data2 = $this->db->query('SELECT * FROM `tb_mahasiswa` a join tb_penguji b on a.npm=b.npm join tb_kerjapraktik c on a.npm = c.npm join tb_seminar d on c.id_kp=d.id_kp where status_sem="Disetujui Koordinator" AND peng1!=' . $seminar->peng1 . ' AND peng2!=' . $seminar->peng1 . ' AND peng1!=' . $seminar->peng2 . ' AND peng2!=' . $seminar->peng2 . ' limit 2')->result();
  //     foreach ($data2 as $mahasiswa) {
  //       $data = array(
  //         'tgl_seminar' => $jadwal,
  //         'r_seminar' => "RK-0" . $ruangan,
  //         'wkt_seminar' => '0' . $jam . ":00:00",
  //         'status_sem' => 'Dijadwalkan Seminar'
  //       );
  //       $where = array(
  //         'id_seminar' => $mahasiswa->id_seminar
  //       );
  //       $this->db->where('id_seminar', $seminar->id_seminar);
  //       $this->db->update('tb_seminar', $data);
  //       $ruangan++;
  //     }
  //     $data = array(
  //       'tgl_seminar' => $jadwal,
  //       'r_seminar' => "RK-0" . $ruangan,
  //       'wkt_seminar' => '0' . $jam . ":00:00",
  //       'status_sem' => 'Dijadwalkan Seminar'
  //     );
  //     $where = array(
  //       'id_seminar' => $seminar->id_seminar
  //     );
  //     $this->db->where('id_seminar', $seminar->id_seminar);
  //     $this->db->update('tb_seminar', $data);
  //     print_r($data);
  //     echo "<br>";
  //     print_r($where);
  //     $jam++;
  //     if ($ruangan == 3) {
  //       $ruangan = 1;

  //       if ($jam > 11) {
  //         $date = date_create($jadwal);
  //         date_add($date, date_interval_create_from_date_string("1 days"));
  //         $jadwal = date_format($date, "Y-m-d");
  //         $jam = 9;
  //       }
  //     }
  //   }
  // }

  // public function acak_jd()
  // {
  //   $data = $this->db->query("UPDATE tb_seminar SET r_seminar = '', tgl_seminar = '0000-00-00', wkt_seminar = '00:00:00' WHERE tb_seminar.id_seminar != 0
  //   ");
  //   $jadwaln   = $this->Kp_m->seminar()->result();
  //   $jadwal_penguji = [];
  //   $jam = 9;
  //   $id = 0;
  //   $ruangan = 1;
  //   $tanggal = $this->db->query("SELECT jd_seminar_m_s as jadwal from tb_jadwal")->row();
  //   $jadwal = $tanggal->jadwal;

  //   foreach ($jadwaln as $jadd) {
  //     $penguji1 = $jadd->peng1;
  //     $penguji2 = $jadd->peng2;


  //     do {
  //       $dosenacak = $this->db->query("SELECT * FROM tb_dosen order by rand() limit 1")->result();
  //       foreach ($dosenacak as $acak) {
  //         $jumlah1 = 0;
  //         $jumlah2 = 0;

  //         $dosen1 = $this->db->query("SELECT * FROM tb_seminar JOIN tb_kerjapraktik ON tb_seminar.id_kp = tb_kerjapraktik.id_kp
  //                   JOIN tb_penguji ON tb_kerjapraktik.npm = tb_penguji.npm where wkt_seminar='0$jam:00:00' AND tb_penguji.peng1='$penguji1' AND tgl_seminar='$jadwal'")->result();

  //         foreach ($dosen1 as $dos) {
  //           $jumlah1++;
  //         }
  //         $dosen2 = $this->db->query("SELECT * FROM tb_seminar JOIN tb_kerjapraktik ON tb_seminar.id_kp = tb_kerjapraktik.id_kp
  //                   JOIN tb_penguji ON tb_kerjapraktik.npm = tb_penguji.npm where wkt_seminar='0$jam:00:00' AND tb_penguji.peng2='$penguji1' AND tgl_seminar='$jadwal'")->result();
  //         foreach ($dosen2 as $dos) {
  //           $jumlah2++;
  //         }
  //       }
  //     } while ($jumlah1 > 0 || $jumlah2 > 0);

  //     do {
  //       $dosenacak2 = $this->db->query("SELECT * FROM tb_dosen order by rand() limit 1")->result();
  //       foreach ($dosenacak2 as $acak2) {
  //         $jumlah1 = 0;
  //         $jumlah2 = 0;

  //         $dosen1 = $this->db->query("SELECT * FROM tb_seminar JOIN tb_kerjapraktik ON tb_seminar.id_kp = tb_kerjapraktik.id_kp
  //                   JOIN tb_penguji ON tb_kerjapraktik.npm = tb_penguji.npm where wkt_seminar='0$jam:00:00' AND tb_penguji.peng1='$penguji2' AND tgl_seminar='$jadwal'")->result();
  //         foreach ($dosen1 as $dos) {
  //           $jumlah1++;
  //         }
  //         $dosen1 = $this->db->query("SELECT * FROM tb_seminar JOIN tb_kerjapraktik ON tb_seminar.id_kp = tb_kerjapraktik.id_kp
  //                   JOIN tb_penguji ON tb_kerjapraktik.npm = tb_penguji.npm where wkt_seminar='0$jam:00:00' AND tb_penguji.peng2='$penguji2' AND tgl_seminar='$jadwal'")->result();
  //         foreach ($dosen2 as $dos2) {
  //           $jumlah2++;
  //         }
  //       }
  //     } while ($jumlah1 > 0   || $jumlah2 > 0);

  //     $cek = array(
  //       'id_seminar' => $jadd->id_seminar,
  //       'npm' => $jadd->npm,
  //       'nama_penguji1' => $jadd->peng1,
  //       'nama_penguji2' => $jadd->peng2,
  //       'tgl_seminar' => $jadwal,
  //       'r_seminar' => "RK-0" . $ruangan,
  //       'wkt_seminar' => '0' . $jam . ":00:00",
  //     );
  //     $data = array(
  //       'id_seminar' => $jadd->id_seminar,
  //       'tgl_seminar' => $jadwal,
  //       'r_seminar' => "RK-0" . $ruangan,
  //       'wkt_seminar' => '0' . $jam . ":00:00",
  //     );
  //     array_push($jadwal_penguji, $data);
  //     // $where = array(
  //     //   'id_seminar' => $jadd->id_seminar
  //     // );
  //     print_r($cek);
  //     echo "<br>";
  //     // print_r($where);
  //     // $this->db->update('tb_seminar', $data, $where);

  //     $ruangan++;
  //     if ($ruangan > 3) {
  //       $jam++;
  //       $ruangan = 1;
  //     }


  //     if ($jam > 11) {
  //       $date = date_create($jadwal);
  //       date_add($date, date_interval_create_from_date_string("1 days"));
  //       $jadwal = date_format($date, "Y-m-d");
  //       $jam = 9;
  //     }
  //   }
  //   $this->db->update_batch('tb_seminar', $jadwal_penguji, 'id_seminar');
  //   die();
  //   redirect('koordinator/Jadwal');
  // }

  public function acak_jd()
  {
    $periode = $this->db->query("SELECT periode_kp as kp from tb_jadwal")->row();
    $data = $this->db->query("UPDATE tb_seminar t1 INNER JOIN tb_kerjapraktik t2 ON t1.id_kp = t2.id_kp JOIN tb_mahasiswa t3 ON t2.npm = t3.npm SET r_seminar = '', tgl_seminar = '0000-00-00', wkt_seminar = '00:00:00' WHERE t3.periode_kp = '$periode->kp' AND t1.id_seminar != 0
    ");
    $jadwaln   = $this->kp_m->acak_jadwal($periode->kp)->result();
    // print_r($jadwaln);
    // die();
    $jadwal_penguji = [];
    $check_array = [];
    $jam = 9;
    $id = 0;
    $ruangan = 1;
    $tanggal = $this->db->query("SELECT jd_seminar_m_s as jadwal from tb_jadwal")->row();
    $jadwal = $tanggal->jadwal;
    $check_number = 1;
    $posisi = 1;
    $jumlah_total = count($jadwaln);
    $i = 0;
    // die();
    do {
      if ($i > $jumlah_total) {
        $jumlah_total = count($jadwaln);

        $i = 0;
        // $posisi++;

        // $date = date_create($jadwal);
        // date_add($date, date_interval_create_from_date_string("1 days"));
        // $jadwal = date_format($date, "Y-m-d");
        // $jam = 9;
        // $ruangan = 1;

        $check_number = $posisi;
        while ($posisi % 3 != 1) {
          $check_number = $posisi;
          $posisi++;
          $kosong = array(
            'id_seminar' => 0,
            'npm' => 0,
            'nama_penguji1' => '0',
            'nama_penguji2' => '0',
            'tgl_seminar' => '0',
            'r_seminar' => "RK-0" . '0',
            'wkt_seminar' => '0' . '0' . ":00:00",
          );
          array_push($check_array, $kosong);
        }
        $jam++;
        $ruangan = 1;
        // print_r($check_array);

        if ($jam > 11) {
          $date = date_create($jadwal);
          if ($date->format('D') == 'Fri') {
            date_add($date, date_interval_create_from_date_string("3 days"));
            $jadwal = date_format($date, "Y-m-d");
            $jam = 9;
          } else {
            date_add($date, date_interval_create_from_date_string("1 days"));
            $jadwal = date_format($date, "Y-m-d");
            $jam = 9;
          }
        }
        // array_push($check_array, $kosong);
        // print_r("<br>");
        // foreach ($check_array as $itu) {
        //   print_r($itu);
        //   print_r("<br>");
        // }
        // foreach ($jadwaln as $ini) {
        //   print_r($ini);
        //   print_r("<br>");
        // }
        // die();
      }
      $jadwal_x = array_shift($jadwaln);
      // print_r($jadwal_x);
      // array_push($jadwaln, $jadwal_x);
      // print_r($jadwaln);
      // die();
      $penguji1 = $jadwal_x->peng1;
      $penguji2 = $jadwal_x->peng2;
      $cek = array(
        'id_seminar' => $jadwal_x->id_seminar,
        'npm' => $jadwal_x->npm,
        'nama_penguji1' => $jadwal_x->peng1,
        'nama_penguji2' => $jadwal_x->peng2,
        'tgl_seminar' => $jadwal,
        'r_seminar' => "RK-0" . $ruangan,
        'wkt_seminar' => '0' . $jam . ":00:00",
      );
      $data = array(
        'id_seminar' => $jadwal_x->id_seminar,
        'tgl_seminar' => $jadwal,
        'r_seminar' => "RK-0" . $ruangan,
        'wkt_seminar' => '0' . $jam . ":00:00",
      );
      if (!empty($check_array)) {
        // print_r($posisi - $check_number);
        if ($posisi % 3 != 1) {
          if ($posisi - $check_number >= 2) {
            // print_r($check_array);
            // die();

            if (
              $penguji1 == $check_array[$posisi - 3]['nama_penguji1'] || $penguji1 == $check_array[$posisi - 3]['nama_penguji2'] || $penguji2 == $check_array[$posisi - 3]['nama_penguji1'] || $penguji2 == $check_array[$posisi - 3]['nama_penguji2']
              || $penguji1 == $check_array[$posisi - 2]['nama_penguji1'] || $penguji1 == $check_array[$posisi - 2]['nama_penguji2'] || $penguji2 == $check_array[$posisi - 2]['nama_penguji1'] || $penguji2 == $check_array[$posisi - 2]['nama_penguji2']
            ) {
              // print_r('hallo1');
              array_push($jadwaln, $jadwal_x);
              // die();
            } else {
              array_push($check_array, $cek);
              array_push($jadwal_penguji, $data);
              $posisi++;
              $ruangan++;
            }
          } elseif ($posisi - $check_number >= 1) {
            if ($penguji1 == $check_array[$posisi - 2]['nama_penguji1'] || $penguji1 == $check_array[$posisi - 2]['nama_penguji2'] || $penguji2 == $check_array[$posisi - 2]['nama_penguji1'] || $penguji2 == $check_array[$posisi - 2]['nama_penguji2']) {
              // if()
              // print_r("hallo2");
              // die();
              array_push($jadwaln, $jadwal_x);
            } else {

              array_push($check_array, $cek);
              array_push($jadwal_penguji, $data);
              // print_r("hallo2");
              // die();
              $posisi++;
              $ruangan++;
            }
          }
        } else {
          array_push($check_array, $cek);
          array_push($jadwal_penguji, $data);
          $check_number = $posisi;
          // print_r($check_array);
          // die();
          $posisi++;
          $ruangan++;
        }
      } else {
        array_push($check_array, $cek);
        array_push($jadwal_penguji, $data);
        // print_r("hallo2");
        // die();
        $ruangan++;
        $posisi++;
      }

      // array_push($jadwal_penguji, $data);
      // $where = array(
      //   'id_seminar' => $jadd->id_seminar
      // );
      // print_r($cek);
      // array_shift($jadwaln);
      // echo "<br>";
      // print_r($where);
      // $this->db->update('tb_seminar', $data, $where);


      if ($ruangan > 3) {
        $jam++;
        $ruangan = 1;
      }
      // print_r($check_array);

      if ($jam > 11) {
        $date = date_create($jadwal);
        if ($date->format('D') == 'Fri') {
          date_add($date, date_interval_create_from_date_string("3 days"));
          $jadwal = date_format($date, "Y-m-d");
          $jam = 9;
        } else {
          date_add($date, date_interval_create_from_date_string("1 days"));
          $jadwal = date_format($date, "Y-m-d");
          $jam = 9;
        }
      }
      // print_r("hallo2");
      // die();
      $i++;
    } while (!empty($jadwaln));
    // foreach ($check_array as $apa) {
    //   print_r("<br>");
    //   print_r($apa);
    // }
    // die();

    $this->db->update_batch('tb_seminar', $jadwal_penguji, 'id_seminar');
    // die();
    $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Jadwal seminar berhasil diperbaharui.
          </div>');
    redirect('koordinator/Jadwal');
  }

  //baru
  // public function jadwal_acak()
  // {
  //   $data = $this->db->query("UPDATE tb_seminar SET r_seminar = '', tgl_seminar = '0000-00-00', wkt_seminar = '00:00:00' WHERE tb_seminar.id_seminar != 0
  //   ");
  //   $jadwaln   = $this->Kp_m->seminar()->result();
  //   $jadwal_penguji = [];
  //   $jam = 9;
  //   $id = 0;
  //   $ruangan = 1;
  //   $tanggal = $this->db->query("SELECT jd_seminar_m_s as jadwal from tb_jadwal")->row();
  //   $jadwal = $tanggal->jadwal;

  //   foreach ($jadwaln as $jadd) {
  //     $penguji1 = $jadd->peng1;
  //     $penguji2 = $jadd->peng2;

  //     $cek = array(
  //       'id_seminar' => $jadd->id_seminar,
  //       'npm' => $jadd->npm,
  //       'nama_penguji1' => $jadd->peng1,
  //       'nama_penguji2' => $jadd->peng2,
  //       'tgl_seminar' => $jadwal,
  //       'r_seminar' => "RK-0" . $ruangan,
  //       'wkt_seminar' => '0' . $jam . ":00:00",
  //     );
  //     $data = array(
  //       'id_seminar' => $jadd->id_seminar,
  //       'tgl_seminar' => $jadwal,
  //       'r_seminar' => "RK-0" . $ruangan,
  //       'wkt_seminar' => '0' . $jam . ":00:00",
  //     );
  //     array_push($jadwal_penguji, $data);
  //     // $where = array(
  //     //   'id_seminar' => $jadd->id_seminar
  //     // );
  //     print_r($cek);
  //     echo "<br>";
  //     // print_r($where);
  //     // $this->db->update('tb_seminar', $data, $where);

  //     $ruangan++;
  //     if ($ruangan > 3) {
  //       $jam++;
  //       $ruangan = 1;
  //     }


  //     if ($jam > 11) \
  //       $date = date_create($jadwal);
  //       date_add($date, date_interval_create_from_date_string("1 days"));
  //       $jadwal = date_format($date, "Y-m-d");
  //       $jam = 9;
  //     }
  //   }
  //   print_r($jadwal_penguji);
  //   // $this->db->update_batch('tb_seminar', $jadwal_penguji, 'id_seminar');
  //   die();
  //   redirect('koordinator/Jadwal');
  // }
  // public function check_data($data1, $data2)
  // {
  // }
}
