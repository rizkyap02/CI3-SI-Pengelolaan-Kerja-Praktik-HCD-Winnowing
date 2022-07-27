<?php
class User_m extends CI_Model
{
    public $table = 'tb_login';
    public $id = 'id_user';

    public function ambil_data($id)
    {
        $this->db->where('username', $id);
        return $this->db->get('tb_login')->row();
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
    public function tampil_data($level)
    {
        $this->db->where('level', $level);
        $this->db->join('tb_mahasiswa', 'tb_mahasiswa.id_user = tb_login.id_user');
        return $this->db->get('tb_login');
    }
    public function tampil_dataa($npm)
    {
        // $this->db->where('level', $level);
        $this->db->join('tb_mahasiswa', 'tb_mahasiswa.id_user = tb_login.id_user');
        $where = "tb_mahasiswa.periode_kp = '$npm' AND tb_login .level = 3";
        $this->db->where($where);
        $this->db->order_by('tb_login.status','asc');
        return $this->db->get('tb_login');
    }
    public function tampil_data_m($level)
    {
        $this->db->where('level', $level);
        $this->db->where('status', 2);
        $this->db->join('tb_mahasiswa', 'tb_mahasiswa.id_user = tb_login.id_user');
        return $this->db->get('tb_login');
    }
    public function tampil_data_d($level)
    {
        $this->db->where('level', $level);
        $this->db->join('tb_dosen', 'tb_dosen.id_user = tb_login.id_user');
        return $this->db->get('tb_login');
    }
    public function hapus_data($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
    public function edit_data($id)
    {
        $this->db->join('tb_mahasiswa', 'tb_mahasiswa.id_user = tb_login.id_user');
        $this->db->where('tb_login.id_user', $id);
        return $this->db->get('tb_login');
    }
    public function edit_data_d($id)
    {
        $this->db->join('tb_dosen', 'tb_dosen.id_user = tb_login.id_user');
        $this->db->where('tb_login.id_user', $id);
        return $this->db->get('tb_login');
    }
    public function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    function update($table, $where, $wherenya, array $data)
    {
        return $this->db->where($where, $wherenya)->update($table, $data);
    }
}
