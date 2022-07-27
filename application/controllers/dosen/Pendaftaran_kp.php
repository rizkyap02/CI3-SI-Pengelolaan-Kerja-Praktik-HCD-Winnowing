<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pendaftaran_kp extends CI_Controller
{

    protected const N_GRAM = 5;
    protected const WINDOW = 4;
    protected const PRIME_NUMBER = 2;

    function __construct()
    {
        parent::__construct();
        $this->load->model('kp_m');
        $this->load->model('kp_model');

        if ($this->session->userdata('level') != 2) {
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
        $data = $this->user_m->ambil_data_d($this->session->userdata['username']);
        $periode = $this->db->query("SELECT periode_kp as kp from tb_jadwal")->row();

        $data = array(
            'nama' => $data->nama_dsn,
            'username' => $data->username,
            'level' => $data->level,
            'nip' => $data->nip,
        );
        $data['kerjapraktik'] = $this->kp_m->tampil_data_kp_d($this->session->userdata['username'], $periode->kp)->result();
        $this->load->view('templates/dosen/header', $data);
        $this->load->view('templates/dosen/pendaftaran_kp', $data);
        $this->load->view('templates/dosen/sidebar');
        $this->load->view('templates/dosen/footer');
    }
    public function info($npm)
    {
        $data = $this->user_m->ambil_data_d($this->session->userdata['username']);

        $data = array(
            'nama' => $data->nama_dsn,
            'username' => $data->username,
            'level' => $data->level,
        );
        $data['keg'] = $this->kp_m->tampil_data_keg_k($npm)->result();
        $data['kerjapraktik'] = $this->kp_m->tampil_data_kp($npm)->row();
        $this->load->view('templates/dosen/header', $data);
        $this->load->view('templates/dosen/pendaftaran_kp_info', $data);
        $this->load->view('templates/dosen/sidebar');
        $this->load->view('templates/dosen/footer');
    }

    public function cek($id)
    {
        $data = $this->user_m->ambil_data_d($this->session->userdata['username']);

        $data_kp = $this->kp_model->get($id);
        $all_kp = $this->kp_model->get_all_kp($data_kp->npm);


        $data = array(
            'nama' => $data->nama_dsn,
            'username' => $data->username,
            'level' => $data->level,
        );

        $this->benchmark->mark('winnowing_start');
        $results = $this->_winnowing($data_kp, $all_kp);
        $this->benchmark->mark('winnowing_end');

        $time = $this->benchmark->elapsed_time('winnowing_start', 'winnowing_end');

        $this->load->view('templates/dosen/header', $data);
        $this->load->view('templates/dosen/pendaftaran_kp_cek', ['data' => $data_kp, 'results' => $results, 'time' => $time]);
        $this->load->view('templates/dosen/sidebar');
        $this->load->view('templates/dosen/footer');
    }

    public function status_acc($id)
    {
        $data = array(
            'status'        => 'Disetujui Pembimbing'
        );
        $this->kp_m->update("tb_kerjapraktik", 'id_kp', $id, $data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
        Data berhasil diperbaharui.
      </div>');
        redirect('dosen/pendaftaran_kp');
    }
    public function status_dc($id)
    { {
            $data = array(
                'status'        => 'Ditolak'
            );
            $this->kp_m->update("tb_kerjapraktik", 'id_kp', $id, $data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Data berhasil diperbaharui.
          </div>');
            redirect('dosen/pendaftaran_kp');
        }
    }
    protected function _winnowing($data_kp, $all_kp)
    {
        $this->load->library('Winnowing');

        $results = [];

        foreach ($all_kp as $kp) {
            $results[$kp->id_kp]['data'] = $kp;
            $results[$kp->id_kp]['judul'] = $this->_calculateWinnowing($data_kp, $kp->judul, 'judul');
            $results[$kp->id_kp]['lokasi'] = $this->_calculateWinnowing($data_kp, $kp->nama_lks, 'nama_lks');
            $results[$kp->id_kp]['uraian'] = $this->_calculateWinnowing($data_kp, $kp->uraian, 'uraian');
        }

        return $results;
    }

    protected function _calculateWinnowing($data_kp, $value2, $field)
    {
        $value2 = empty($value2) || is_null($value2) ? ' ' : $value2;
        $this->winnowing->setJudul($data_kp->$field, $value2);
        $this->winnowing->SetPrimeNumber(self::PRIME_NUMBER);
        $this->winnowing->SetNGramValue(self::N_GRAM);
        $this->winnowing->SetNWindowValue(self::WINDOW);

        $this->winnowing->process();

        $n_gram_judul1 = '';
        foreach ($this->winnowing->GetNGramFirst() as $ng) {
            $n_gram_judul1 .= $ng . ' ';
        }
        $n_gram_judul2 = '';
        foreach ($this->winnowing->GetNGramSecond() as $ng) {
            $n_gram_judul2 .= $ng . ' ';
        }

        $rolling_hash_judul1 = '';
        foreach ($this->winnowing->GetRollingHashFirst() as $rl) {
            $rolling_hash_judul1 .= $rl . ' ';
        }
        $rolling_hash_judul2 = '';
        foreach ($this->winnowing->GetRollingHashSecond() as $rl) {
            $rolling_hash_judul2 .= $rl . ' ';
        }

        $wd = $this->winnowing->GetWindowFirst();
        $window_judul1 = '';
        for ($i = 0; $i < count($wd); $i++) {
            $s = '';
            for ($j = 0; $j < self::WINDOW; $j++) {
                $s .= $wd[$i][$j] . ' ';
            }
            $window_judul1 .= "W-" . ($i + 1) . " : {" . rtrim($s, ' ') . "} \n";
        }
        $wd = $this->winnowing->GetWindowSecond();
        $window_judul2 = '';
        for ($i = 0; $i < count($wd); $i++) {
            $s = '';
            for ($j = 0; $j < self::WINDOW; $j++) {
                $s .= $wd[$i][$j] . ' ';
            }
            $window_judul2 .= "W-" . ($i + 1) . " : {" . rtrim($s, ' ') . "} \n";
        }

        $fp_judul1 = '';
        foreach ($this->winnowing->GetFingerprintsFirst() as $fp) {
            $fp_judul1 .= $fp . ' ';
        }
        $fp_judul2 = '';
        foreach ($this->winnowing->GetFingerprintsSecond() as $fp) {
            $fp_judul2 .= $fp . ' ';
        }

        $count_fingers1 = count($this->winnowing->GetFingerprintsFirst());
        $count_fingers2 = count($this->winnowing->GetFingerprintsSecond());

        $count_union_fingers = count(array_merge($this->winnowing->GetFingerprintsFirst(), $this->winnowing->GetFingerprintsSecond()));
        $count_intersect_fingers = count(array_intersect($this->winnowing->GetFingerprintsFirst(), $this->winnowing->GetFingerprintsSecond()));

        $result = [
            'status' => true,
            'data' => [
                'judul1' => [
                    'field1' => $data_kp->$field,
                    'n_gram' => rtrim($n_gram_judul1, ' '),
                    'rolling_hash' => rtrim($rolling_hash_judul1, ' '),
                    // 'window' => $window_judul1,
                    'finger_print' => rtrim($fp_judul1, ' '),
                    'count_finger' => $count_fingers1,
                ],
                'judul2' => [
                    // 'data' => $kp,
                    'field2' => $value2,
                    'n_gram' => rtrim($n_gram_judul2, ' '),
                    'rolling_hash' => rtrim($rolling_hash_judul2, ' '),
                    // 'window' => $window_judul2,
                    'finger_print' => rtrim($fp_judul1, ' '),
                    'count_finger' => $count_fingers2
                ],
                'count_union' => $count_union_fingers,
                'count_intersect' => $count_intersect_fingers,
                'jaccard' => $this->winnowing->GetJaccardCoefficient()
            ]
        ];

        return $result;
    }

    protected static function _dd($var)
    {
        echo '<pre>';
        print_r($var);
        echo '</pre>';
        exit;
    }
}
