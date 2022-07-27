<?php

class Login extends CI_Controller
{
	public function index()
	{
		if ($this->session->userdata('level') == 1) {
			redirect('koordinator/beranda');
		} elseif ($this->session->userdata('level') == 2) {
			redirect('dosen/beranda');
		} elseif ($this->session->userdata('level') == 3) {
			redirect('mahasiswa/beranda');
		} else {


			//$this->load->view('template_administrator/header');
			$this->load->view('templates/login');
		}
		//$this->load->view('template_administrator/footer');
	}



	public function proses_login()
	{
		$this->form_validation->set_rules('username', 'username', 'required', ['required' => 'Username wajib di isi!']);
		$this->form_validation->set_rules('password', 'password', 'required', ['required' => 'Kata sandi wajib di isi!']);
		if ($this->form_validation->run() == FALSE) {

			$this->load->view('templates/login');
		} else {
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$user = $username;
			$pass = md5($password);

			$cek = $this->login_m->cek_login($user, $pass);
			if ($cek->num_rows() > 0) {
				foreach ($cek->result() as $ck) {
					$sess_data['username'] = $ck->username;
					$sess_data['nama'] = $ck->nama;
					$sess_data['email'] = $ck->email;
					$sess_data['level'] = $ck->level;
					$sess_data['status'] = $ck->status;

					$this->session->set_userdata($sess_data);
				}
				if ($sess_data['level'] == '1') {
					$_SESSION['level'] = '1';
					redirect('koordinator/beranda');
				} elseif ($sess_data['level'] == '2' and $sess_data['status'] == '2') {

					redirect('dosen/beranda');
				} elseif ($sess_data['level'] == '3' and $sess_data['status'] == '2') {
					$period = $this->db->query("select periode_kp as kp from tb_jadwal")->row();
					$npm = $sess_data['username'];
					$mhs = $this->db->query("select periode_kp as periode from tb_mahasiswa where npm = '$npm'")->row();
					$statuskp = $this->db->query("select status as statuskp from tb_kerjapraktik where npm = '$npm'")->row();
					$id = array('npm' => $npm);

					if ($mhs->periode == $period->kp - 1  && $statuskp->statuskp != 'Selesai' && $mhs->periode % 2 != 0) {
						$data = array('periode_kp' => $period->kp);
						$dataa = array('keterangan' => 'Mengulang');
						$this->db->update('tb_mahasiswa', $data, $id);
						$this->db->update('tb_kerjapraktik', $dataa, $id);
						redirect('mahasiswa/beranda');
					} else if ($mhs->periode < $period->kp  && $statuskp->statuskp != 'Selesai') {
						$idlks = $this->db->query("SELECT id_lks as idlks from tb_kerjapraktik where npm ='$npm'")->row();
						$idkp = $this->db->query("SELECT id_kp as idkp from tb_kerjapraktik where npm ='$npm'")->row();
						$data2 = $this->db->query("DELETE from tb_lokasi where id_lks ='$idlks->idlks'");
						$data3 = $this->db->query("DELETE from tb_seminar where id_kp ='$idkp->idkp'");
						$data4 = $this->db->query("DELETE from tb_kegiatan where npm ='$npm'");
						$data5 = $this->db->query("DELETE from tb_nilai where npm ='$npm'");
						$data6 = $this->db->query("DELETE from tb_pembimbing where npm ='$npm'");
						$data7 = $this->db->query("DELETE from tb_penguji where npm ='$npm'");
						$data8 = $this->db->query("DELETE from tb_kerjapraktik where npm ='$npm'");

						$data = array('periode_kp' => $period->kp);
						$this->db->update('tb_mahasiswa', $data, $id);
						redirect('mahasiswa/beranda');
					} else {
						redirect('mahasiswa/beranda');
					}
				} else {
					$this->session->set_flashdata('pesan', '<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					Username atau Kata Sandi salah !!
				  </div>');
					redirect('login');
				}

				# code...
			} else {
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Username atau Kata Sandi salah !!
              </div>');
				redirect('login');
			}
		}
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}
}
