<?php
class Kp_m extends CI_Model
{
    public $table = 'tb_login';
    public $id = 'id_user';
    public function tampil_data_d()
    {
        return $this->db->get('tb_dosen')->result();
    }
    public function ambil_data_m($id)
    {
        $this->db->where('username', $id);
        $this->db->join('tb_mahasiswa', 'tb_mahasiswa.id_user = tb_login.id_user');
        return $this->db->get('tb_login')->row();
    }
    public function ambil_data_d($id)
    {
        $this->db->where('username', $id);
        $this->db->join('tb_dosen', 'tb_dosen.id_user = tb_login.id_user');
        return $this->db->get('tb_login')->row();
    }
    function random($kp)
    {
        $this->db->join('tb_login', 'tb_login.username = tb_mahasiswa.npm');
        $this->db->order_by("rand()");
        $this->db->where('status', 2);
        $this->db->where('periode_kp', $kp);
        return $this->db->get('tb_mahasiswa');
    }
    function randomd($limit)
    {
        $this->db->join('tb_login', 'tb_login.id_user = tb_dosen.id_user');
        $this->db->limit($limit, 0);
        $this->db->order_by("rand()");
        $where = "tb_login.status='2'";
        $this->db->where($where);
        return $this->db->get('tb_dosen');
    }
    public function input_data($data)
    {
        $this->db->insert('tb_pembimbing', $data);
    }
    public function tampil_data($kp)
    {
        $this->db->join('tb_mahasiswa', 'tb_mahasiswa.npm = tb_pembimbing.npm');
        $this->db->join('tb_dosen', 'tb_dosen.nip = tb_pembimbing.nip');
        $this->db->join('tb_login', 'tb_login.username = tb_pembimbing.npm');
        $this->db->order_by('rand()');
        $this->db->where('status', 2);
        $this->db->where('periode_kp', $kp);
        return $this->db->get('tb_pembimbing');
    }
    public function tampil_data_penguji($npm)
    {
        $this->db->join('tb_mahasiswa', 'tb_mahasiswa.npm = tb_penguji.npm');
        $where = "tb_mahasiswa.periode_kp = '$npm'";
        $this->db->where($where);
        return $this->db->get('tb_penguji');
    }

    public function tampil_data_jadwal_k($kp)
    {
        $this->db->join('tb_mahasiswa', 'tb_mahasiswa.npm = tb_kerjapraktik.npm');
        $this->db->join('tb_seminar', 'tb_seminar.id_kp = tb_kerjapraktik.id_kp');
        $where = "status_sem='Disetujui Koordinator'";
        $this->db->where($where);
        $this->db->where('periode_kp', $kp);

        return $this->db->get('tb_kerjapraktik');
    }
    public function tampil_data_jadwal_d($nip, $kp)
    {
        $this->db->join('tb_pembimbing', 'tb_pembimbing.npm = tb_kerjapraktik.npm');
        $this->db->join('tb_mahasiswa', 'tb_mahasiswa.npm = tb_kerjapraktik.npm');
        $this->db->join('tb_seminar', 'tb_seminar.id_kp = tb_kerjapraktik.id_kp');
        $this->db->join('tb_penguji', 'tb_penguji.npm = tb_kerjapraktik.npm');
        $where = "tb_mahasiswa.periode_kp = '$kp' AND tb_penguji.peng1 = '$nip' AND tb_seminar.status_sem='Disetujui Koordinator' OR tb_mahasiswa.periode_kp = '$kp' AND tb_penguji.peng2 ='$nip' AND tb_seminar.status_sem='Disetujui Koordinator' OR tb_mahasiswa.periode_kp = '$kp' AND tb_pembimbing.nip ='$nip' AND tb_seminar.status_sem='Disetujui Koordinator' ";
        $this->db->where($where);
        // $this->db->where('periode_kp', $kp);

        return $this->db->get('tb_kerjapraktik');
    }

    public function tampil_data_ps($npm)
    {
        $this->db->join('tb_mahasiswa', 'tb_mahasiswa.npm = tb_pembimbing.npm');
        $this->db->join('tb_dosen', 'tb_dosen.nip = tb_pembimbing.nip');
        $this->db->join('tb_kerjapraktik', 'tb_kerjapraktik.npm = tb_pembimbing.npm');
        $this->db->join('tb_lokasi', 'tb_lokasi.id_lks = tb_kerjapraktik.id_lks');
        $this->db->where('tb_mahasiswa.npm', $npm);
        return $this->db->get('tb_pembimbing');
    }
    public function tampil_data_p($npm)
    {
        $this->db->join('tb_mahasiswa', 'tb_mahasiswa.npm = tb_pembimbing.npm');
        $this->db->join('tb_dosen', 'tb_dosen.nip = tb_pembimbing.nip');
        $this->db->where('tb_mahasiswa.npm', $npm);
        return $this->db->get('tb_pembimbing');
    }
    public function tampil_data_peng($npm)
    {
        $this->db->join('tb_mahasiswa', 'tb_mahasiswa.npm = tb_penguji.npm');
        $this->db->join('tb_dosen', 'tb_dosen.nip = tb_penguji.peng1');
        // $this->db->join('tb_dosen', 'tb_dosen.nip = tb_penguji.peng2');
        $this->db->join('tb_kerjapraktik', 'tb_kerjapraktik.npm = tb_penguji.npm');
        $this->db->where('tb_mahasiswa.npm', $npm);
        return $this->db->get('tb_penguji');
    }
    public function tampil_data_kp_d($npm, $id)
    {
        // $this->db->where('tb_kerjapraktik.nip', $npm);
        $this->db->join('tb_lokasi', 'tb_lokasi.id_lks = tb_kerjapraktik.id_lks');
        $this->db->join('tb_mahasiswa', 'tb_mahasiswa.npm = tb_kerjapraktik.npm');
        $this->db->join('tb_dosen', 'tb_dosen.nip = tb_kerjapraktik.nip');
        $where = "tb_kerjapraktik.nip=$npm AND tb_mahasiswa.periode_kp = '$id' AND tb_kerjapraktik.status != 'Selesai'";
        $this->db->where($where);
        return $this->db->get('tb_kerjapraktik');
    }
    public function tampil_nilai_koor($npm)
    {

        $this->db->join('tb_mahasiswa', 'tb_mahasiswa.npm = tb_kerjapraktik.npm');
        $this->db->join('tb_dosen', 'tb_dosen.nip = tb_kerjapraktik.nip');
        $this->db->join('tb_seminar', 'tb_seminar.id_kp = tb_kerjapraktik.id_kp', 'left');
        $this->db->join('tb_pembimbing', 'tb_pembimbing.npm = tb_kerjapraktik.npm');
        $this->db->join('tb_penguji', 'tb_penguji.npm = tb_kerjapraktik.npm');
        $this->db->join('tb_nilai', 'tb_nilai.npm = tb_kerjapraktik.npm');
        $where = "tb_mahasiswa.periode_kp = '$npm'";
        $this->db->where($where);
        return $this->db->get('tb_kerjapraktik');
    }
    public function tampil_nilai_pemb($npm, $id)
    {
        $this->db->join('tb_mahasiswa', 'tb_mahasiswa.npm = tb_kerjapraktik.npm');
        $this->db->join('tb_seminar', 'tb_seminar.id_kp = tb_kerjapraktik.id_kp');
        $this->db->join('tb_penguji', 'tb_penguji.npm = tb_kerjapraktik.npm');
        $where = "tb_kerjapraktik.nip='$npm' AND tb_mahasiswa.periode_kp = '$id'";
        $this->db->where($where);
        return $this->db->get('tb_kerjapraktik');
    }
    public function tampil_nilai_peng($npm, $id)
    {
        $this->db->join('tb_kerjapraktik', 'tb_kerjapraktik.npm = tb_penguji.npm');
        $this->db->join('tb_mahasiswa', 'tb_mahasiswa.npm = tb_kerjapraktik.npm');
        $this->db->join('tb_seminar', 'tb_seminar.id_kp = tb_kerjapraktik.id_kp');
        $where = "tb_penguji.peng1='$npm' AND tb_mahasiswa.periode_kp = '$id' OR tb_penguji.peng2='$npm' AND tb_mahasiswa.periode_kp = '$id'";
        $this->db->where($where);
        return $this->db->get('tb_penguji');
    }
    public function tampil_data_kp_k($npm)
    {
        $this->db->join('tb_lokasi', 'tb_lokasi.id_lks = tb_kerjapraktik.id_lks');
        $this->db->join('tb_mahasiswa', 'tb_mahasiswa.npm = tb_kerjapraktik.npm');
        $this->db->join('tb_dosen', 'tb_dosen.nip = tb_kerjapraktik.nip');
        $where = "tb_mahasiswa.periode_kp = '$npm' AND tb_kerjapraktik.status = 'Disetujui Koordinator' OR tb_kerjapraktik.status = 'Disetujui Pembimbing' OR tb_kerjapraktik.status = 'Ditolak'";
        $this->db->where($where);
        return $this->db->get('tb_kerjapraktik');
    }
    public function tampil_data_kp_end($npm)
    {
        $this->db->join('tb_lokasi', 'tb_lokasi.id_lks = tb_kerjapraktik.id_lks', 'left');
        $this->db->join('tb_mahasiswa', 'tb_mahasiswa.npm = tb_kerjapraktik.npm', 'left');
        $this->db->join('tb_dosen', 'tb_dosen.nip = tb_kerjapraktik.nip', 'left');
        $where = "status='Selesai'";
        $this->db->where($where);
        return $this->db->get('tb_kerjapraktik');
    }
    public function tampil_data_sem_endd($npm)
    {
        $this->db->join('tb_lokasi', 'tb_lokasi.id_lks = tb_kerjapraktik.id_lks');
        $this->db->join('tb_mahasiswa', 'tb_mahasiswa.npm = tb_kerjapraktik.npm');
        $this->db->join('tb_dosen', 'tb_dosen.nip = tb_kerjapraktik.nip');
        $this->db->join('tb_seminar', 'tb_seminar.id_kp = tb_kerjapraktik.id_kp');
        $this->db->join('tb_penguji', 'tb_penguji.npm = tb_kerjapraktik.npm', 'right');
        $where = "status_sem='Selesai'";
        $this->db->where($where);
        return $this->db->get('tb_kerjapraktik');
    }
    public function tampil_data_sem_end($npm)
    {
        $this->db->join('tb_lokasi', 'tb_lokasi.id_lks = tb_kerjapraktik.id_lks');
        $this->db->join('tb_mahasiswa', 'tb_mahasiswa.npm = tb_kerjapraktik.npm');
        $this->db->join('tb_dosen', 'tb_dosen.nip = tb_kerjapraktik.nip');
        $this->db->join('tb_seminar', 'tb_seminar.id_kp = tb_kerjapraktik.id_kp');
        $where = "status_sem='Selesai'";
        $this->db->where($where);
        return $this->db->get('tb_kerjapraktik');
    }
    public function tampil_data_kp_s($npm)
    {
        $this->db->join('tb_lokasi', 'tb_lokasi.id_lks = tb_kerjapraktik.id_lks');
        $this->db->join('tb_mahasiswa', 'tb_mahasiswa.npm = tb_kerjapraktik.npm');
        $this->db->join('tb_dosen', 'tb_dosen.nip = tb_kerjapraktik.nip');
        $this->db->join('tb_seminar', 'tb_seminar.id_kp = tb_kerjapraktik.id_kp');
        $where = "status='Disetujui Pembimbing' OR status='Disetujui Koordinator' OR status='Ditolak'";
        $this->db->where($where);
        return $this->db->get('tb_kerjapraktik');
    }
    public function tampil_data_kp($npm)
    {
        $this->db->where('tb_kerjapraktik.npm', $npm);
        $this->db->join('tb_lokasi', 'tb_lokasi.id_lks = tb_kerjapraktik.id_lks');
        $this->db->join('tb_mahasiswa', 'tb_mahasiswa.npm = tb_kerjapraktik.npm');
        $this->db->join('tb_dosen', 'tb_dosen.nip = tb_kerjapraktik.nip');
        return $this->db->get('tb_kerjapraktik');
    }
    public function tampil_data_keg_k($npm)
    {
        $this->db->where('tb_kerjapraktik.npm', $npm);
        $this->db->join('tb_lokasi', 'tb_lokasi.id_lks = tb_kerjapraktik.id_lks');
        $this->db->join('tb_mahasiswa', 'tb_mahasiswa.npm = tb_kerjapraktik.npm');
        $this->db->join('tb_kegiatan', 'tb_kegiatan.npm = tb_mahasiswa.npm');
        $this->db->join('tb_dosen', 'tb_dosen.nip = tb_kerjapraktik.nip');
        return $this->db->get('tb_kerjapraktik');
    }
    public function keg($npm)
    {
        $this->db->where('tb_mahasiswa.npm', $npm);
        $this->db->join('tb_kegiatan', 'tb_kegiatan.npm = tb_mahasiswa.npm');
        return $this->db->get('tb_mahasiswa');
    }
    public function tampil_data_sem_m($npm)
    {
        $this->db->where('tb_kerjapraktik.npm', $npm);
        $this->db->join('tb_lokasi', 'tb_lokasi.id_lks = tb_kerjapraktik.id_lks');
        $this->db->join('tb_mahasiswa', 'tb_mahasiswa.npm = tb_kerjapraktik.npm');
        $this->db->join('tb_dosen', 'tb_dosen.nip = tb_kerjapraktik.nip');
        $this->db->join('tb_seminar', 'tb_seminar.id_kp = tb_kerjapraktik.id_kp');
        return $this->db->get('tb_kerjapraktik');
    }
    public function tampil_data_sem($npm, $id)
    {
        $this->db->where('tb_kerjapraktik.nip', $npm);
        $this->db->join('tb_lokasi', 'tb_lokasi.id_lks = tb_kerjapraktik.id_lks');
        $this->db->join('tb_mahasiswa', 'tb_mahasiswa.npm = tb_kerjapraktik.npm');
        $this->db->join('tb_dosen', 'tb_dosen.nip = tb_kerjapraktik.nip');
        $this->db->join('tb_seminar', 'tb_seminar.id_kp = tb_kerjapraktik.id_kp');
        $where = "tb_kerjapraktik.nip = '$npm' AND tb_mahasiswa.periode_kp = '$id' AND tb_seminar.status_sem != 'Selesai'";
        $this->db->where($where);
        return $this->db->get('tb_kerjapraktik');
    }
    public function tampil_data_sem_k($npm)
    {
        $this->db->join('tb_lokasi', 'tb_lokasi.id_lks = tb_kerjapraktik.id_lks', 'left');
        $this->db->join('tb_mahasiswa', 'tb_mahasiswa.npm = tb_kerjapraktik.npm', 'left');
        $this->db->join('tb_dosen', 'tb_dosen.nip = tb_kerjapraktik.nip', 'left');
        $this->db->join('tb_seminar', 'tb_seminar.id_kp = tb_kerjapraktik.id_kp', 'left');
        $where = "tb_mahasiswa.periode_kp = '$npm' AND tb_seminar.status_sem = 'Disetujui' OR tb_mahasiswa.periode_kp = '$npm' AND tb_seminar.status_sem = 'Menunggu' OR tb_mahasiswa.periode_kp = '$npm' AND tb_seminar.status_sem = 'Ditolak' ";
        // $where = "status_sem='Disetujui Pembimbing' OR status_sem='Disetujui Koordinator' OR status_sem='Ditolak'";
        $this->db->where($where);
        return $this->db->get('tb_kerjapraktik');
    }
    public function tampil_data_sem_info($id_kp)
    {
        $this->db->where('tb_seminar.id_kp', $id_kp);
        $this->db->join('tb_kerjapraktik', 'tb_kerjapraktik.id_kp = tb_seminar.id_kp');
        $this->db->join('tb_mahasiswa', 'tb_mahasiswa.npm = tb_kerjapraktik.npm');
        $this->db->join('tb_lokasi', 'tb_lokasi.id_lks = tb_kerjapraktik.id_lks');
        $this->db->join('tb_dosen', 'tb_dosen.nip = tb_kerjapraktik.nip');
        return $this->db->get('tb_seminar');
    }
    public function acak_penguji()
    {
        $a = $this->db->query("select periode_kp as periode from tb_jadwal")->row();
        $where = "tb_seminar.status_sem = 'Disetujui Koordinator' AND tb_mahasiswa.periode_kp ='$a->periode'";
        $this->db->join('tb_kerjapraktik', 'tb_kerjapraktik.id_kp = tb_seminar.id_kp');
        $this->db->join('tb_pembimbing', 'tb_pembimbing.npm = tb_kerjapraktik.npm');
        $this->db->join('tb_mahasiswa', 'tb_mahasiswa.npm = tb_kerjapraktik.npm');
        $this->db->where($where);
        return $this->db->get('tb_seminar');
    }
    public function seminar()
    {
        // $this->db->order_by("rand()");
        $this->db->join('tb_kerjapraktik', 'tb_kerjapraktik.id_kp = tb_seminar.id_kp');
        $this->db->join('tb_pembimbing', 'tb_pembimbing.npm = tb_kerjapraktik.npm');
        $this->db->join('tb_penguji', 'tb_penguji.npm = tb_kerjapraktik.npm');
        return $this->db->get('tb_seminar');
    }

    public function acak_jadwal($periode)
    {
        // $this->db->order_by("rand()");
        $this->db->join('tb_kerjapraktik', 'tb_kerjapraktik.id_kp = tb_seminar.id_kp');
        $this->db->join('tb_pembimbing', 'tb_pembimbing.npm = tb_kerjapraktik.npm');
        $this->db->join('tb_penguji', 'tb_penguji.npm = tb_kerjapraktik.npm');
        $this->db->join('tb_mahasiswa', 'tb_mahasiswa.npm = tb_kerjapraktik.npm');
        // $this->db->where('tb_seminar.status_sem =', 'Disetujui Koordinator');
        $where = "tb_mahasiswa.periode_kp = '$periode' AND tb_seminar.status_sem = 'Disetujui Koordinator'";
        $this->db->where($where);
        return $this->db->get('tb_seminar');
    }
    public function cetak_jadwal($npm)
    {
        // $this->db->order_by("rand()");
        $this->db->join('tb_seminar', 'tb_seminar.id_kp = tb_kerjapraktik.id_kp');
        $this->db->join('tb_pembimbing', 'tb_pembimbing.npm = tb_kerjapraktik.npm');
        $this->db->join('tb_mahasiswa', 'tb_mahasiswa.npm = tb_kerjapraktik.npm');
        $this->db->join('tb_penguji', 'tb_penguji.npm = tb_kerjapraktik.npm');
        $where = "tb_mahasiswa.periode_kp = '$npm' AND tb_seminar.status_sem = 'Disetujui Koordinator'";
        $this->db->where($where);
        $order = "tgl_seminar ASC, wkt_seminar, r_seminar";
        $this->db->order_by($order);

        return $this->db->get('tb_kerjapraktik');
    }
    public function cetak_nilai($npm)
    {
        $this->db->join('tb_seminar', 'tb_seminar.id_kp = tb_kerjapraktik.id_kp');
        $this->db->join('tb_mahasiswa', 'tb_mahasiswa.npm = tb_kerjapraktik.npm');
        $this->db->join('tb_nilai', 'tb_nilai.npm = tb_mahasiswa.npm');
        $where = "tb_mahasiswa.periode_kp = '$npm' AND tb_seminar.status_sem = 'Selesai'";
        $this->db->where($where);
        $this->db->order_by('tb_nilai.npm', 'ASC');
        // $this->db->where('tb_seminar.status_sem =', 'Disetujui Koordinator');
        return $this->db->get('tb_kerjapraktik');
    }

    public function jadwal_m($npm)
    {
        $this->db->where('tb_kerjapraktik.npm', $npm);
        $this->db->join('tb_mahasiswa', 'tb_mahasiswa.npm = tb_kerjapraktik.npm');
        $this->db->join('tb_pembimbing', 'tb_pembimbing.npm = tb_kerjapraktik.npm');
        $this->db->join('tb_penguji', 'tb_penguji.npm = tb_kerjapraktik.npm');
        $this->db->join('tb_seminar', 'tb_seminar.id_kp = tb_kerjapraktik.id_kp');
        return $this->db->get('tb_kerjapraktik');
    }
    // public function jadwal_mm($npm)
    // {
    //     $this->db->where('tb_kerjapraktik.npm', $npm);
    //     $this->db->join('tb_mahasiswa', 'tb_mahasiswa.npm = tb_kerjapraktik.npm');
    //     $this->db->join('tb_pembimbing', 'tb_pembimbing.npm = tb_kerjapraktik.npm');
    //     // $this->db->join('tb_penguji', 'tb_penguji.npm = tb_kerjapraktik.npm');
    //     // $this->db->join('tb_seminar', 'tb_seminar.id_kp = tb_kerjapraktik.id_kp');
    //     return $this->db->get('tb_kerjapraktik');
    // }
    // public function jadwal_mmm($npm)
    // {
    //     return $this->db->get('tb_mahasiswa');
    // }

    public function update($table, $where, $wherenya, $data)
    {
        return $this->db->where($where, $wherenya)->update($table, $data);
    }
    public function jadwal_ubah($npm)
    {
        $this->db->where('tb_kerjapraktik.npm', $npm);
        $this->db->join('tb_mahasiswa', 'tb_mahasiswa.npm = tb_kerjapraktik.npm');
        $this->db->join('tb_seminar', 'tb_seminar.id_kp = tb_kerjapraktik.id_kp');
        return $this->db->get('tb_kerjapraktik');
    }
}
