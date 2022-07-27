<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kp_model extends CI_Model
{
    public const STATUS_SELESAI = 'Selesai';
    public const STATUS_APPROVED_BY_COORDINATOR = 'Disetujui Koordinator';
    public const STATUS_APPROVED_BY_LECTURER = 'Disetujui Dosen';

    public function __construct()
    {
        parent::__construct();
    }

    public function get($id)
    {
        $data = $this->db
            ->join('tb_mahasiswa tm', 'tm.npm = tk.npm')
            ->join('tb_lokasi tl', 'tl.id_lks = tk.id_lks')
            ->where('id_kp', $id)
            ->get('tb_kerjapraktik tk');

        return $data->row();
    }

    public function get_all_kp($npm)
    {

        $data = $this->db->query("SELECT * FROM `tb_kerjapraktik` `tk` JOIN `tb_mahasiswa` `tm` ON `tm`.`npm` = `tk`.`npm` JOIN `tb_lokasi` `tl` ON `tl`.`id_lks` = `tk`.`id_lks` WHERE (`status` = 'Selesai' OR `status` = 'Disetujui Koordinator' OR `status` = 'Disetujui Dosen') AND `tk`.`npm` != '" . $npm . "'");

        // ->order_by('tk.judul', 'ASC')

        return $data->result();
    }

    public function get_student_kp($npm)
    {
        $data = $this->db
            ->select(
                'tk.nip, tk.judul, tm.nama_mhs, tl.username as npm, tlk.nama_lks, tk.nama_pl, tk.semester_ta, tm.alamat_mhs,
                tm.telp_mhs, tm.email_mhs, td.nama_dsn, td.telp_dsn, td.email_dsn, tk.uraian, tk.jangka_waktu_s, tk.jangka_waktu_e,
                tlk.alamat_lks, tlk.fax_email_lks, tlk.telp_lks'
            )
            ->join('tb_mahasiswa tm', 'tm.npm = tk.npm')
            ->join('tb_login tl', 'tl.id_user = tm.id_user')
            ->join('tb_lokasi tlk', 'tlk.id_lks = tk.id_lks')
            ->join('tb_dosen td', 'td.nip = tk.nip')
            ->where('tk.npm', $npm)
            ->get('tb_kerjapraktik tk');

        return $data->row();
    }

    public function get_kegiatan($npm)
    {
        return $this->db
            ->where('npm', $npm)
            ->order_by('keg_s', 'ASC')
            ->get('tb_kegiatan')
            ->result();
    }
}
