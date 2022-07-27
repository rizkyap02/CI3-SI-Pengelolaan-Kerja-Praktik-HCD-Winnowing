<?php

class Lupa_katasandi extends CI_Controller
{
    private function _sendEmail($token, $type)
    {
        $config = [
            'protocol'      => 'smtp',
            'smptp_host'    => 'smtp.gmail.com',
            'smtp_user'     => 'test@gmail.com',
            'smtp_pass'     => 'test123',
            'smtp_port'     => 465,
            'mailtype'      => 'html',
            'charset'       => 'utf-8',
            'set_newline'       => "\r\n"
        ];
        $this->load->library('email', $config);
        $this->email->initialize($config);

        $this->email->from('test@gmail.com', 'Koordinator KP ');
        $this->email->to($this->input->post('email'));

        if ($type == 'forgot') {
            $this->email->subject('Reset Kata Sandi');
            $this->email->message('Klik link ini untuk mereset kata sandi akun anda : <a href="' . base_url() . 'lupa_katasandi/reset?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Kata Sandi</a>');
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function index()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', ['required' => 'Email Wajib Diisi !', 'valid_email' => 'Email Tidak Valid']);
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/lupa');
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('tb_login', ['status' => 2])->row_array();
            $user = $this->db->get_where('tb_mahasiswa', ['email_mhs' => $email])->row_array();


            if ($user) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => '$email',
                    'token' => '$token'
                ];

                $this->db->insert('tb_user_token', $user_token);
                $this->_sendEmail($token, 'forgot');
                $this->session->set_flashdata('pesan', '<div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Silahkan periksa email anda untuk melakukan reset kata sandi .
                </div>');
                redirect('login');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Email tidak terdaftar atau belum aktif !
                </div>');
                redirect('lupa_katasandi');
            }
        }
    }
}
