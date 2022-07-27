<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Lupa_katasandi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        require APPPATH . 'libraries/phpmailer/src/Exception.php';
        require APPPATH . 'libraries/phpmailer/src/PHPMailer.php';
        require APPPATH . 'libraries/phpmailer/src/SMTP.php';
    }
    private function _sendEmail($token, $type, $email)
    {
        try {

            $message = 'Klik link ini untuk mereset kata sandi akun anda : <a href="' . base_url() . 'lupa_katasandi/reset?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Kata Sandi</a>';

            $response = false;
            $mail = new PHPMailer();
            try {
                //Server settings
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'test@gmail.com';
                $mail->Password = 'test123';
                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;

                $mail->setFrom('test@gmail.com');

                //Recipients
                $mail->addAddress($email);
                $mail->addReplyTo('test@gmail.com');

                //Content
                if ($type == 'forgot') {
                    $mail->isHTML(true);
                    $mail->Subject = 'Reset Kata Sandi';
                    $mail->Body    = $message;
                }

                if ($mail->send()) {
                    $this->session->set_flashdata('successps', 'Link Reset Kata Sandi Telah di kirim di Email Anda');

                    return true;
                } else {
                    echo $this->email->print_debugger();
                    die;
                }
                redirect('login');
            } catch (Exception $e) {
                $this->session->set_flashdata('errorps', 'Pesan Gagal terkirim, silakan coba lagi!');
                redirect('login');
            }
        } catch (PDOException $e) {
            $this->session->set_flashdata('errorps', $e->getMessage());
            redirect('login');
        }
    }

    public function index()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', ['required' => 'Email Wajib Diisi !', 'valid_email' => 'Email Tidak Valid']);
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/lupa');
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('tb_login', ['email' => $email, 'status' => 2])->row_array();
            $user2 = $this->db->get_where('tb_mahasiswa', ['email_mhs' => $email])->row_array();
            $user3 = $this->db->get_where('tb_dosen', ['email_dsn' => $email])->row_array();
            // $user = $this->db->get_where('tb_mahasiswa', ['email_mhs' => $email])->row_array();


            if ($user || $user2 || $user3) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token
                ];

                $this->db->insert('tb_user_token', $user_token);
                $this->_sendEmail($token, 'forgot', $email);
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

    public function reset()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('tb_login', ['email' => $email])->row_array();
        $user2 = $this->db->get_where('tb_mahasiswa', ['email_mhs' => $email])->row_array();
        $user3 = $this->db->get_where('tb_dosen', ['email_dsn' => $email])->row_array();

        if ($user || $user2 || $user3) {
            $user_token = $this->db->get_where('tb_user_token', ['token' => $token])->row_array();
            if ($user_token) {
                $this->session->set_userdata('reset_email', $email);
                $this->gantiKatasandi();
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Reset kata sandi gagal! Token salah.
            </div>');
                redirect('login');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Reset kata sandi gagal! Email salah.
            </div>');
            redirect('login');
        }
    }

    public function gantiKatasandi()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('login');
        }

        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[8]|matches[password2]',  ['required' => 'Kata sandi wajib diisi!', 'matches' => 'Kata sandi tidak cocok', 'min_length' => 'Kata Sandi minimal 8 karakter']);
        $this->form_validation->set_rules('password2', 'Password', 'trim|required|min_length[8]|matches[password1]',  ['required' => 'Masukkan Ulang Kata sandi wajib diisi!', 'matches' => 'Kata sandi tidak cocok', 'min_length' => 'Kata Sandi minimal 8 karakter']);
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/gantikatasandi');
        } else {
            $password = md5($this->input->post('password1'));
            $email = $this->session->userdata('reset_email');
            $cek = $this->db->get_where('tb_login', ['email' => $email])->row_array();
            $cek1 = $this->db->get_where('tb_mahasiswa', ['email_mhs' => $email])->row_array();
            $cek2 = $this->db->get_where('tb_dosen', ['email_dsn' => $email])->row_array();

            if ($cek) {
                $this->db->set('password', $password);
                $this->db->where('email', $email);
                $this->db->update('tb_login');
            } else if ($cek1) {
                $npm = $this->db->query("select npm as npm from tb_mahasiswa where email_mhs ='$email'")->row();
                $this->db->set('password', $password);
                $this->db->where('username', $npm->npm);
                $this->db->update('tb_login');
            } else if ($cek2) {
                $nip = $this->db->query("select nip as nip from tb_dosen where email_dsn ='$email'")->row();
                $this->db->set('password', $password);
                $this->db->where('username', $nip->nip);
                $this->db->update('tb_login');
            }

            $this->session->unset_userdata('reset_email');
            $this->session->set_flashdata('pesan', '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Kata sandi berhasil diganti! Silahkan login.
            </div>');
            redirect('login');
        }
    }
}
