<?php

use Carbon\Carbon;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Style\Font;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\ComplexType\TblWidth;

defined('BASEPATH') or exit('No direct script access allowed');

class Cetak extends CI_Controller
{
    private $data_kp;

    public function __construct()
    {
        parent::__construct();

        if (!isset($this->session->userdata['username'])) {
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Anda belum melakukan login
          </div>'
            );
            redirect('login');
        }

        $this->load->model('Kp_model', 'kp');

        $npm = $this->session->userdata('username');
        $this->data_kp = $this->kp->get_student_kp($npm);
        // print_r($this->kp->get_student_kp('G1A017038'));
        // die();
    }

    public function index()
    {
        $data = $this->user_m->ambil_data_m(
            $this->session->userdata['username']
        );

        $data = [
            'nama' => $data->nama_mhs,
            'username' => $data->username,
            'level' => $data->level,
        ];
        $this->load->view('templates/mahasiswa/header', $data);
        $this->load->view('templates/mahasiswa/cetak');
        $this->load->view('templates/mahasiswa/sidebar');
        $this->load->view('templates/mahasiswa/footer');
    }

    public static function dd($vars)
    {
        echo '<pre>';
        print_r($vars);
        echo '</pre>';
        die();
    }

    public function kerangka_acuan()
    {
        Settings::setOutputEscapingEnabled(true);
        $judul = $this->data_kp->judul;

        $nama = ucwords(strtolower($this->data_kp->nama_mhs));
        $npm = $this->data_kp->npm;
        $tahun = date('Y');

        $jangka_waktu = null;
        $jangka_waktu .= date_indo(
            date('Y-m-d', strtotime($this->data_kp->jangka_waktu_s))
        );
        $jangka_waktu .= ' s.d ';
        $jangka_waktu .= date_indo(
            date('Y-m-d', strtotime($this->data_kp->jangka_waktu_e))
        );

        $data_kegiatan = $this->kp->get_kegiatan($npm);

        $tanggal_disetujui = date_indo(date('Y-m-d'));

        $phpWord = new PhpWord();
        $phpWord->setDefaultFontName('Times New Roman');
        $phpWord->setDefaultFontSize(12);

        //start: cover
        $coverSection = $phpWord->addSection();

        $coverSection->addText(
            $judul,
            [
                'size' => 14,
                'bold' => true,
                'allCaps' => true,
            ],
            ['align' => 'center', 'spaceAfter' => 300]
        );
        $coverSection->addText(
            'KERANGKA ACUAN KERJA PRAKTIK',
            ['size' => 14, 'bold' => true],
            ['align' => 'center', 'spaceAfter' => 1200]
        );

        $coverSection->addImage('assets/images/unib.png', [
            'width' => 190,
            'height' => 190,
            'align' => 'center',
        ]);

        $coverSection->addText('diajukan oleh:', null, [
            'align' => 'center',
            'spaceBefore' => 2000,
        ]);

        $coverSection->addText($nama, ['bold' => true], ['align' => 'center']);
        $coverSection->addText(
            'NPM. ' . $npm,
            ['bold' => true],
            ['align' => 'center']
        );
        $coverSection->addText(
            'PROGRAM STUDI TEKNIK INFORMATIKA',
            ['size' => 14, 'bold' => true],
            ['align' => 'center', 'spaceBefore' => 1500]
        );
        $coverSection->addText(
            'FAKULTAS TEKNIK',
            ['size' => 14, 'bold' => true],
            ['align' => 'center']
        );
        $coverSection->addText(
            'UNIVERSITAS BENGKULU',
            ['size' => 14, 'bold' => true],
            ['align' => 'center']
        );
        $coverSection->addText(
            $tahun,
            ['size' => 14, 'bold' => true],
            ['align' => 'center']
        );
        //end: cover

        //start: tabel data kp
        $contentSection = $phpWord->addSection();
        $contentSection->addText(
            'KERANGKA ACUAN KERJA PRAKTIK',
            ['size' => 14, 'bold' => true],
            ['align' => 'center']
        );
        $contentSection->addText(
            'PROGRAM STUDI INFORMATIKA',
            ['size' => 14, 'bold' => true],
            ['align' => 'center']
        );
        $contentSection->addText(
            'UNIVERSITAS BENGKULU',
            ['size' => 14, 'bold' => true],
            ['align' => 'center', 'spaceAfter' => 1000]
        );

        $table = $contentSection->addTable([
            'cellMargin' => 50,
            'alignment' => Jc::START,
        ]);
        $table->addRow();
        $table->addCell(5000)->addText('Lembaga / Perusahaan / Tempat KP');
        $table->addCell(100)->addText(':');
        $table->addCell(5000)->addText($this->data_kp->nama_lks);

        $table->addRow();
        $table->addCell(5000)->addText('Nama Pembimbing Lapangan');
        $table->addCell(100)->addText(':');
        $table->addCell(5000)->addText($this->data_kp->nama_pl);

        $table->addRow();
        $table->addCell(5000)->addText('Alamat');
        $table->addCell(100)->addText(':');
        $table->addCell(5000)->addText($this->data_kp->alamat_lks);

        $table->addRow();
        $table->addCell(5000)->addText('Telp. / Fax / Email');
        $table->addCell(100)->addText(':');
        $table->addCell(5000)->addText($this->data_kp->telp_lks . ' / ' . $this->data_kp->fax_email_lks);

        $table->addRow();
        $table->addCell(5000)->addText('Nama Mahasiswa');
        $table->addCell(100)->addText(':');
        $table->addCell(5000)->addText($this->data_kp->nama_mhs);

        $table->addRow();
        $table->addCell(5000)->addText('Nomor Pokok Mahasiswa');
        $table->addCell(100)->addText(':');
        $table->addCell(5000)->addText($this->data_kp->npm);

        $table->addRow();
        $table->addCell(5000)->addText('Semester / Tahun Akademik');
        $table->addCell(100)->addText(':');
        $table->addCell(5000)->addText($this->data_kp->semester_ta);

        $table->addRow();
        $table->addCell(5000)->addText('Alamat');
        $table->addCell(100)->addText(':');
        $table->addCell(5000)->addText($this->data_kp->alamat_mhs);

        $table->addRow();
        $table->addCell(5000)->addText('Telp. / Email');
        $table->addCell(100)->addText(':');
        $table
            ->addCell(5000)
            ->addText(
                $this->data_kp->telp_mhs . ' / ' . $this->data_kp->email_mhs
            );

        $table->addRow();
        $table->addCell(5000)->addText('Nama Dosen Pembimbing');
        $table->addCell(100)->addText(':');
        $table->addCell(5000)->addText($this->data_kp->nama_dsn);

        $table->addRow();
        $table->addCell(5000)->addText('Program Studi / Fakultas');
        $table->addCell(100)->addText(':');
        $table->addCell(5000)->addText('Informatika / Teknik');

        $table->addRow();
        $table->addCell(5000)->addText('Telp. / Email');
        $table->addCell(100)->addText(':');
        $table
            ->addCell(5000)
            ->addText(
                $this->data_kp->telp_dsn . ' / ' . $this->data_kp->email_dsn
            );

        $table->addRow();
        $table->addCell(5000)->addText('Judul / Topik KP');
        $table->addCell(100)->addText(':');
        $table->addCell(5000)->addText(ucwords($this->data_kp->judul));

        $table->addRow();
        $table->addCell(5000)->addText('Uraian Singkat KP');
        $table->addCell(100)->addText(':');
        $table->addCell(5000)->addText($this->data_kp->uraian);

        $table->addRow();
        $table->addCell(5000)->addText('Perkiraan Jangka Waktu');
        $table->addCell(100)->addText(':');
        $table->addCell(5000)->addText($jangka_waktu);
        //end: tabel data kp

        //start: tabel waktu
        $timelineSection = $phpWord->addSection();
        $timelineSection->addText(
            'Tabel Garis Besar Rencana Kegiatan (Jadwal per dwi-minggu)',
            ['size' => 14],
            ['align' => 'center']
        );

        $table = $timelineSection->addTable([
            'borderSize' => 1,
            'borderColor' => '000000',
            'cellMargin' => 0,
        ]);
        $table->addRow();
        $table
            ->addCell(500)
            ->addText('No', ['bold' => true], ['align' => 'center']);
        $table
            ->addCell(5000)
            ->addText('Waktu', ['bold' => true], ['align' => 'center']);
        $table
            ->addCell(5000)
            ->addText(
                'Uraian Rencana Kegiatan',
                ['bold' => true],
                ['align' => 'center']
            );

        if (count($data_kegiatan) > 0) {
            $n = 1;
            foreach ($data_kegiatan as $kegiatan) {
                $waktu = null;
                $waktu .= $kegiatan->keg_s;
                $waktu .= ' s.d ';
                $waktu .= $kegiatan->keg_e;

                $table->addRow();
                $table
                    ->addCell(500)
                    ->addText(
                        $n++,
                        ['marginLeft' => 500],
                        ['align' => 'center']
                    );
                $table->addCell(5000)->addText($waktu);
                $table->addCell(5000)->addText($kegiatan->ket);
            }
        } else {
            $row = $table->addRow();
            $row
                ->addCell(1000, ['gridSpan' => 3, 'vMerge' => 'restart'])
                ->addText('Tidak Ada Data Kegiatan', [
                    'align' => 'center',
                ]);
        }
        //end: tabel waktu

        // start: ttd page
        $signatureSection = $phpWord->addSection();
        $signatureSection->addText(
            'Yang bertanda-tangan dibawah ini menyatakan telah membaca dan menyetujui isi Kerangka Acuan Kerja Praktik ini.',
            ['size' => 12]
        );

        $signatureSection->addText(
            'Disetujui tanggal ' . $tanggal_disetujui,
            ['size' => 12],
            ['align' => 'right', 'spaceBefore' => 800]
        );

        // Settings::setOutputEscapingEnabled(false);
        $table = $signatureSection->addTable();
        $table->addRow();
        $studentSignature = $table->addCell(12000);
        $studentSignature->addText('Mahasiswa');
        $studentSignature->addText(' ');
        $studentSignature->addText(' ');
        $studentSignature->addText(' ');
        $studentSignature->addText($this->data_kp->nama_mhs, [
            'underline' => 'single',
        ]);
        $studentSignature->addText('NPM. ' . $this->data_kp->npm);

        $plSignature = $table->addCell(7000);
        $plSignature->addText(
            'Pembimbing Lapangan',
            ['underline' => 'single']
        );
        $plSignature->addText(' ');
        $plSignature->addText(' ');
        $plSignature->addText(' ');
        $plSignature->addText($this->data_kp->nama_pl, [
            'underline' => 'single',
        ]);
        $plSignature->addText('NIP.');

        $table->addRow();
        $studentSignature = $table->addCell(12000);
        $studentSignature->addText(
            'Dosen Pembimbing',
            null,
            ['spaceBefore' => 200]
        );

        $studentSignature->addText(' ');
        $studentSignature->addText(' ');
        $studentSignature->addText(' ');

        $studentSignature->addText($this->data_kp->nama_dsn, [
            'underline' => 'single',
        ]);
        $studentSignature->addText('NIP. ' . $this->data_kp->nip);

        $plSignature = $table->addCell(7000);
        $plSignature->addText(
            'Kaprodi Informatika',
            null,
            ['spaceBefore' => 200]
        );
        $plSignature->addText(' ');
        $plSignature->addText(' ');
        $plSignature->addText(' ');
        $plSignature->addText('Arie Vatresia, S.T., M.TI., Ph.D.', [
            'underline' => 'single',
        ]);
        $plSignature->addText('NIP. 19850204 200812 2 002');

        // end: ttd page

        // save ke file
        // $objWriter = IOFactory::createWriter($phpWord, 'Word2007');

        // $file_name = 'assets/cetak/' . time() . '-kerangka-acuan.docx';
        // $objWriter->save($file_name);

        // save ke browser
        $file_name = $this->data_kp->npm . ' Kerangka Acuan KP.docx';
        header(
            'Content-Type: application/vnd.openxmlformats-officedocument.wordprocessing‌​ml.document'
        );
        header('Content-Disposition: attachment; filename=' . $file_name);

        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('php://output');
    }

    public function lembar_bimbingan()
    {
        Settings::setOutputEscapingEnabled(true);

        $phpWord = new PhpWord();
        $phpWord->setDefaultFontName('Times New Roman');
        $phpWord->setDefaultFontSize(12);

        $section = $phpWord->addSection();
        $section->addText(
            'LEMBAR KONSULTASI BIMBINGAN KERJA PRAKTIK',
            ['size' => 14, 'bold' => true],
            ['align' => 'center', 'spaceAfter' => 500]
        );

        $table = $section->addTable([
            'cellMargin' => 50,
        ]);
        $table->addRow();
        $table->addCell(9000)->addText('Nama Mahasiswa');
        $table->addCell(300)->addText(':');
        $table->addCell(10000)->addText($this->data_kp->nama_mhs);

        $table->addRow();
        $table->addCell(9000)->addText('Nomor Pokok Mahasiswa');
        $table->addCell(300)->addText(':');
        $table->addCell(10000)->addText($this->data_kp->npm);

        $table->addRow();
        $table->addCell(9000)->addText('Semester / Tahun Akademik');
        $table->addCell(300)->addText(':');
        $table->addCell(10000)->addText($this->data_kp->semester_ta);

        $table->addRow();
        $table->addCell(9000)->addText('Program Studi / Fakultas');
        $table->addCell(300)->addText(':');
        $table->addCell(10000)->addText('Informatika / Teknik');

        $table->addRow();
        $table->addCell(9000)->addText('Lembaga / Perusahaan / Tempat KP');
        $table->addCell(300)->addText(':');
        $table->addCell(10000)->addText($this->data_kp->nama_lks);

        $table->addRow();
        $table->addCell(9000)->addText('Judul / Topik KP');
        $table->addCell(300)->addText(':');
        $table->addCell(10000)->addText($this->data_kp->judul);

        // $section->addText('', null, ['spaceBefore' => 500]);
        $section->addTextBreak(2);

        $bimbinganTable = $section->addTable([
            'borderColor' => '#000000',
            'borderSize' => 1,
            'cellMargin' => 50,
        ]);
        $bimbinganTable->addRow();
        $bimbinganTable
            ->addCell(500)
            ->addText('No.', ['bold' => true], ['align' => 'center']);
        $bimbinganTable
            ->addCell(3000)
            ->addText('Tanggal', ['bold' => true], ['align' => 'center']);
        $bimbinganTable
            ->addCell(5000)
            ->addText(
                'Uraian Konsultasi',
                ['bold' => true],
                ['align' => 'center']
            );
        $bimbinganTable
            ->addCell(4000)
            ->addText(
                'Paraf Pembimbing',
                ['bold' => true],
                ['align' => 'center']
            );

        for ($i = 1; $i <= 14; $i++) {
            $bimbinganTable->addRow();
            $bimbinganTable
                ->addCell(500)
                ->addText($i . '.', ['align' => 'center']);
            $bimbinganTable->addCell(3000);
            $bimbinganTable->addCell(5000);
            $bimbinganTable->addCell(4000);
        }

        $file_name = $this->data_kp->npm . ' Lembar Bimbingan.docx';
        header(
            'Content-Type: application/vnd.openxmlformats-officedocument.wordprocessing‌​ml.document'
        );
        header('Content-Disposition: attachment; filename=' . $file_name);

        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('php://output');
    }

    //persetujuan_seminar function
    public function persetujuan_seminar()
    {
        Settings::setOutputEscapingEnabled(true);

        $tanggal_disetujui = date_indo(date('Y-m-d'));

        $phpWord = new PhpWord();
        $phpWord->setDefaultFontName('Times New Roman');
        $phpWord->setDefaultFontSize(12);

        $section = $phpWord->addSection();

        $section->addText(
            'LEMBAR PERSETUJUAN SEMINAR KERJA PRAKTIK',
            ['size' => 14, 'bold' => true],
            ['align' => 'center']
        );
        $section->addText(
            strtoupper($this->data_kp->judul),
            ['size' => 14, 'bold' => true],
            ['align' => 'center', 'spaceAfter' => 1500]
        );

        $section->addText('disusun oleh:', null, [
            'align' => 'center',
            'spaceAfter' => 500,
        ]);

        $table = $section->addTable([
            'cellMargin' => 50,
            'indent' => new TblWidth(3000),
        ]);
        $table->addRow();
        $table->addCell(1000)->addText('Nama');
        $table->addCell(400)->addText(':', null, ['align' => 'center']);
        $table->addCell(3000)->addText($this->data_kp->nama_mhs);

        $table->addRow();
        $table->addCell(1000)->addText('NPM');
        $table->addCell(400)->addText(':', null, ['align' => 'center']);
        $table->addCell(3000)->addText($this->data_kp->npm);

        $section->addText(
            'Telah disetujui untuk dapat mengikuti seminar Kerja Praktik yang bertempat di Dekanat Fakultas Teknik Universitas Bengkulu',
            null,
            ['align' => 'center', 'spaceBefore' => 800, 'spaceAfter' => 500]
        );

        $table = $section->addTable([
            'borderColor' => '#000000',
            'borderSize' => 1,
            'cellMargin' => 50,
            'indent' => new TblWidth(800),
        ]);
        $table->addRow();
        $studentSignature = $table->addCell(10000);
        $studentSignature->addText('Bengkulu, ' . $tanggal_disetujui);
        $studentSignature->addText('Dosen Pembimbing');
        $studentSignature->addText(' ');
        $studentSignature->addText(' ');
        $studentSignature->addText($this->data_kp->nama_dsn, [
            'underline' => 'single',
        ]);
        $studentSignature->addText('NIP. ' . $this->data_kp->nip);

        $plSignature = $table->addCell(12000);
        $plSignature->addText(' ');
        $plSignature->addText('Pembimbing Lapangan');
        $plSignature->addText(' ');
        $plSignature->addText(' ');
        $plSignature->addText($this->data_kp->nama_pl, [
            'underline' => 'single',
        ]);
        $plSignature->addText('NIP.');

        $file_name = $this->data_kp->npm . ' Persetujuan Seminar.docx';
        header(
            'Content-Type: application/vnd.openxmlformats-officedocument.wordprocessing‌​ml.document'
        );
        header('Content-Disposition: attachment; filename=' . $file_name);

        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('php://output');
    }

    //bukti_menghadiri_seminar function
    public function bukti_menghadiri_seminar()
    {
        Settings::setOutputEscapingEnabled(true);

        $phpWord = new PhpWord();
        $phpWord->setDefaultFontName('Times New Roman');
        $phpWord->setDefaultFontSize(12);

        $section = $phpWord->addSection();

        $table = $section->addTable();
        $table->addRow();
        $table->addCell(2000)->addImage('assets/images/unib.png', [
            'width' => 90,
            'height' => 90,
            'align' => 'center',
        ]);
        $kop = $table->addCell(8000);
        $kop->addText(
            '<w:r><w:t>KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN<w:br />UNIVERSITAS BENGKULU<w:br />FAKULTAS TEKNIK<w:br />PROGRAM STUDI INFORMATIKA<w:br />Jl. WR. Supratman Kandang Limun Bengkulu<w:br />Bengkulu 38371 A Telepon: (0736) 344087, 22105 - 227</w:t></w:r>',
            ['fontSize' => 14],
            ['align' => 'center', 'space' => ['line' => 0.1]]
        );
        $section->addLine(['weight' => 3, 'width' => 450, 'height' => 0.1]);

        $section->addText(
            'DAFTAR HADIR SEMINAR KERJA PRAKTIK',
            ['bold' => true, 'fontSize' => 14],
            ['align' => 'center']
        );

        $table = $section->addTable();
        $table->addRow();
        $table->addCell(3000)->addText('NPM');
        $table->addCell(1000)->addText(':', null, ['align' => 'center']);
        $table->addCell(6000)->addText($this->data_kp->npm);

        $table->addRow();
        $table->addCell(3000)->addText('NAMA MAHASISWA');
        $table->addCell(1000)->addText(':', null, ['align' => 'center']);
        $table->addCell(6000)->addText($this->data_kp->nama_mhs);

        $table->addRow();
        $table->addCell(3000)->addText('SEMESTER / TAHUN');
        $table->addCell(1000)->addText(':', null, ['align' => 'center']);
        $table->addCell(6000)->addText($this->data_kp->semester_ta);

        $section->addTextBreak(1);

        $table = $section->addTable([
            'cellMargin' => 50,
            'borderSize' => 1,
            'borderColor' => '#000000',
        ]);

        $table->addRow();
        $table
            ->addCell(400)
            ->addText('No.', ['bold' => true], ['align' => 'center']);
        $table
            ->addCell(2000)
            ->addText(
                'Hari / Tanggal',
                ['bold' => true],
                ['align' => 'center']
            );
        $table
            ->addCell(2000)
            ->addText('Judul', ['bold' => true], ['align' => 'center']);
        $table
            ->addCell(2000)
            ->addText('Presentator', ['bold' => true], ['align' => 'center']);
        $table
            ->addCell(2000)
            ->addText(
                'Dosen Pendamping',
                ['bold' => true],
                ['align' => 'center']
            );
        $table
            ->addCell(2000)
            ->addText('Tanda Tangan', ['bold' => true], ['align' => 'center']);

        for ($i = 1; $i <= 10; $i++) {
            $table->addRow();
            $table->addCell(400)->addText($i, null, ['align' => 'center']);
            $table->addCell(2000)->addText('', null, ['align' => 'center']);
            $table->addCell(2000)->addText('', null, ['align' => 'center']);
            $table->addCell(2000)->addText('', null, ['align' => 'center']);
            $table->addCell(2000)->addText('', null, ['align' => 'center']);
            $table->addCell(2000)->addText('', null, ['align' => 'center']);
        }

        $file_name = $this->data_kp->npm . ' Daftar Hadir Seminar KP.docx';
        header(
            'Content-Type: application/vnd.openxmlformats-officedocument.wordprocessing‌​ml.document'
        );
        header('Content-Disposition: attachment; filename=' . $file_name);

        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('php://output');
    }

    //function penilaian_pembimbing_lapangan
    public function penilaian_pembimbing_lapangan()
    {
        Settings::setOutputEscapingEnabled(true);

        $phpWord = new PhpWord();
        $phpWord->setDefaultFontName('Times New Roman');
        $phpWord->setDefaultFontSize(12);

        $section = $phpWord->addSection();
        $section->addText(
            'FORM PENILAIAN DOSEN PEMBIMBING LAPANGAN',
            ['bold' => true, 'fontSize' => 14, 'underline' => 'single'],
            ['align' => 'center', 'spaceAfter' => 300]
        );

        $section->addText('Saya yang bertanda tangan dibawah ini:', null, [
            'spaceAfter' => 300,
        ]);

        $table = $section->addTable();
        $table->addRow();
        $table->addCell(800)->addText('Nama');
        $table->addCell(1000)->addText(':', null, ['align' => 'center']);
        $table->addCell(6000)->addText($this->data_kp->nama_pl);

        $table->addRow();
        $table->addCell(800)->addText('NIP');
        $table->addCell(1000)->addText(':', null, ['align' => 'center']);
        $table->addCell(6000)->addText('');

        //add instansi, jabatan row
        $table->addRow();
        $table->addCell(800)->addText('Instansi');
        $table->addCell(1000)->addText(':', null, ['align' => 'center']);
        $table->addCell(6000)->addText('');

        $table->addRow();
        $table->addCell(800)->addText('Jabatan');
        $table->addCell(1000)->addText(':', null, ['align' => 'center']);
        $table->addCell(6000)->addText('');

        $section->addText(
            'Dengan ini memberikan nilai kepada mahasiswa Kerja Praktik (KP) Program Studi Informatika berikut:',
            null,
            ['spaceAfter' => 300, 'spaceBefore' => 300]
        );

        $table = $section->addTable([
            'cellMargin' => 50,
            'borderSize' => 1,
            'borderColor' => '#000000',
        ]);
        $table->addRow();
        $table
            ->addCell(4000)
            ->addText(
                'Nama Mahasiswa',
                ['bold' => true],
                ['align' => 'center']
            );
        $table
            ->addCell(2000)
            ->addText('NPM', ['bold' => true], ['align' => 'center']);
        $table
            ->addCell(8000)
            ->addText('Judul', ['bold' => true], ['align' => 'center']);
        $table
            ->addCell(2000)
            ->addText('Nilai', ['bold' => true], ['align' => 'center']);

        //add 1 row
        $table->addRow();
        $table->addCell(4000)->addText($this->data_kp->nama_mhs);
        $table->addCell(2000)->addText($this->data_kp->npm);
        $table->addCell(8000)->addText($this->data_kp->judul, null, ['align' => 'both']);
        $table->addCell(2000)->addText('', null, ['align' => 'center']);

        $section->addText('*Nilai diisi dengan angka dari 0-100', null, [
            'spaceBefore' => 200,
        ]);

        $section->addText('Bengkulu, ' . date_indo(date('Y-m-d')), null, [
            'spaceBefore' => 500,
            'align' => 'right',
        ]);

        $section->addTextBreak(3);

        $section->addText(
            $this->data_kp->nama_pl,
            ['underline' => 'single'],
            ['spaceBefore' => 200, 'align' => 'right']
        );
        $section->addText('NIP. ', null, [
            'spaceBefore' => 200,
            'align' => 'right',
        ]);

        $file_name = $this->data_kp->npm . ' Lembar Penilaiain DPL.docx';
        header(
            'Content-Type: application/vnd.openxmlformats-officedocument.wordprocessing‌​ml.document'
        );
        header('Content-Disposition: attachment; filename=' . $file_name);

        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('php://output');
    }
}
