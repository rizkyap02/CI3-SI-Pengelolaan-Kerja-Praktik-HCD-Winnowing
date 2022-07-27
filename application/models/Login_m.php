<?php

class Login_m extends CI_Model
{

    public function cek_login($username, $password)
    {
        $this->db->where("username", $username);
        $this->db->where("password", $password);
        return $this->db->get('tb_login');
    }
    public function getLoginData($user, $pass)
    {
        $u = $user;
        $p = md5($pass);

        $query_cekLogin = $this->db->get_where('tb_login', array('username' => $u, 'password' => $p));

        if (count($query_cekLogin->result()) > 0) {
            foreach ($query_cekLogin->result() as $qck) {
                foreach ($query_cekLogin->result() as $ck) {
                    $sess_data['logged_in'] = TRUE;
                    $sess_data['username'] = $ck->username;
                    $sess_data['password'] = $ck->password;
                    $sess_data['level'] = $ck->level;
                    $this->session->set_userdata($sess_data);
                }
                if ($ck->level == '1') {
                    redirect('koordinator/beranda');
                } else if ($ck->level == '2') {
                    redirect('dosen/beranda');
                } else {
                    redirect('mahasiswa/beranda');
                }

                # code...
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Username atau Password salah !!
             </div>');
            redirect('templates/login');
        }
    }

    public function logout($date, $id)
    {
        $this->db->where('tb_login.id_user', $id);
        $this->db->update('tb_login', $date);
    }
}
