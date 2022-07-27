<html>
<p style='margin:0cm;font-size:16px;font-family:"Calibri",sans-serif;text-align:center;'><strong><span style='font-size:19px;font-family:"Times New Roman",serif;'>DAFTAR NILAI KERJA PRAKTIK</span></strong></p>
<p style='margin:0cm;font-size:16px;font-family:"Calibri",sans-serif;text-align:center;'><strong><span style='font-size:19px;font-family:"Times New Roman",serif;'>&nbsp;</span></strong></p>
<table style="border-collapse:collapse;border:none;width:100%">
    <tbody>
        <tr>
            <td style="width:233.65pt;border:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">
                <p style='margin:0cm;font-size:16px;font-family:"Calibri",sans-serif;text-align:center;'><span style='font-family:"Times New Roman",serif;'>No.</span></p>
            </td>
            <td style="width:233.65pt;border:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">
                <p style='margin:0cm;font-size:16px;font-family:"Calibri",sans-serif;text-align:center;'><span style='font-family:"Times New Roman",serif;'>Nama</span></p>
            </td>
            <td style="width:76.8pt;border:solid windowtext 1.0pt;border-left:  none;padding:0cm 5.4pt 0cm 5.4pt;">
                <p style='margin:0cm;font-size:16px;font-family:"Calibri",sans-serif;text-align:center;'><span style='font-family:"Times New Roman",serif;'>NPM</span></p>
            </td>
            <!-- <td style="width:12.15pt;border:solid windowtext 1.0pt;border-left:  none;padding:0cm 5.4pt 0cm 5.4pt;">
                <p style='margin:0cm;font-size:16px;font-family:"Calibri",sans-serif;text-align:center;'><span style='font-family:"Times New Roman",serif;'>N.Pembimbing</span></p>
            </td>
            <td style="width:43.2pt;border:solid windowtext 1.0pt;border-left:  none;padding:0cm 5.4pt 0cm 5.4pt;">
                <p style='margin:0cm;font-size:16px;font-family:"Calibri",sans-serif;text-align:center;'><span style='font-family:"Times New Roman",serif;'>N.Penguji 1</span></p>
            </td>
            <td style="width:42.15pt;border:solid windowtext 1.0pt;border-left:  none;padding:0cm 5.4pt 0cm 5.4pt;">
                <p style='margin:0cm;font-size:16px;font-family:"Calibri",sans-serif;text-align:center;'><span style='font-family:"Times New Roman",serif;'>N.Penguji 2</span></p>
            </td>
            <td style="width:29.0pt;border:solid windowtext 1.0pt;border-left:  none;padding:0cm 5.4pt 0cm 5.4pt;">
                <p style='margin:0cm;font-size:16px;font-family:"Calibri",sans-serif;text-align:center;'><span style='font-family:"Times New Roman",serif;'>N.PL</span></p>
            </td> -->
            <td style="width:29.0pt;border:solid windowtext 1.0pt;border-left:  none;padding:0cm 5.4pt 0cm 5.4pt;">
                <p style='margin:0cm;font-size:16px;font-family:"Calibri",sans-serif;text-align:center;'><span style='font-family:"Times New Roman",serif;'>Nilai</span></p>
            </td>
        </tr>
        <?php $no = 1;
        foreach ($data as $data) { ?>
            <tr>
                <td style="width: 1%;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0cm 5.4pt;vertical-align: top;">
                    <p style='margin:0cm;font-size:16px;font-family:"Calibri",sans-serif;text-align:center;'><span style='font-family:"Times New Roman",serif;'><?= $no++; ?></span></p>
                </td>
                <td style="width: 233.65pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0cm 5.4pt;vertical-align: top;">
                    <p style='margin:0cm;font-size:16px;font-family:"Calibri",sans-serif;'><span style='font-family:"Times New Roman",serif;'><?= $data->nama_mhs; ?></span></p>
                </td>
                <td style="width: 76.8pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;vertical-align: top;">
                    <p style='margin:0cm;font-size:16px;font-family:"Calibri",sans-serif;text-align:center;'><span style='font-family:"Times New Roman",serif;'><?= $data->npm; ?></span></p>
                </td>
                <!-- <td style="width: 12.15pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;vertical-align: top;">
                    <p style='margin:0cm;font-size:16px;font-family:"Calibri",sans-serif;text-align:center;'><span style='font-family:"Times New Roman",serif;'><?= $data->nilai_pemb; ?></span></p>
                </td>
                <td style="width: 43.2pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;vertical-align: top;">
                    <p style='margin:0cm;font-size:16px;font-family:"Calibri",sans-serif;text-align:center;'><span style='font-family:"Times New Roman",serif;'><?= $data->nilai_peng1; ?></span></p>
                </td>
                <td style="width: 42.15pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;vertical-align: top;">
                    <p style='margin:0cm;font-size:16px;font-family:"Calibri",sans-serif;text-align:center;'><span style='font-family:"Times New Roman",serif;'><?= $data->nilai_peng2; ?></span></p>
                </td>
                <td style="width: 29pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;vertical-align: top;">
                    <p style='margin:0cm;font-size:16px;font-family:"Calibri",sans-serif;text-align:center;'><span style='font-family:"Times New Roman",serif;'><?= $data->nilai_pl; ?></span></p>
                </td> -->
                <td style="width: 29pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;vertical-align: top;">
                    <p style='margin:0cm;font-size:16px;font-family:"Calibri",sans-serif;text-align:center;'><span style='font-family:"Times New Roman",serif;'><?php
                                                                                                                                                                $total = ($data->nilai_pemb * 0.5) + ($data->nilai_peng1 * 0.15) + ($data->nilai_peng2 * 0.15) + ($data->nilai_pl * 0.2);
                                                                                                                                                                $cekn = $this->db->query("SELECT keterangan from tb_kerjapraktik where npm = '$data->npm'")->row();

                                                                                                                                                                if ($data->nilai_pemb == 0 || $data->nilai_peng1 == 0 || $data->nilai_peng2 == 0) {
                                                                                                                                                                    echo " ";
                                                                                                                                                                } else {
                                                                                                                                                                    if ($cekn->keterangan == 'Mengulang') {
                                                                                                                                                                        if ($total >= 70) {
                                                                                                                                                                            echo "B";
                                                                                                                                                                        }
                                                                                                                                                                        if ($total >= 65 & $total < 70) {
                                                                                                                                                                            echo "B-";
                                                                                                                                                                        }
                                                                                                                                                                        if ($total >= 60 & $total < 65) {
                                                                                                                                                                            echo "C+";
                                                                                                                                                                        }
                                                                                                                                                                        if ($total >= 55 & $total < 60) {
                                                                                                                                                                            echo "C";
                                                                                                                                                                        }
                                                                                                                                                                        if ($total >= 45 & $total < 55) {
                                                                                                                                                                            echo "D";
                                                                                                                                                                        }
                                                                                                                                                                        if ($total >= 0 & $total < 45) {
                                                                                                                                                                            echo "E";
                                                                                                                                                                        }
                                                                                                                                                                    } else {
                                                                                                                                                                        if ($total >= 85 & $total <= 100) {
                                                                                                                                                                            echo "A";
                                                                                                                                                                        }
                                                                                                                                                                        if ($total >= 80 & $total < 85) {
                                                                                                                                                                            echo "A-";
                                                                                                                                                                        }
                                                                                                                                                                        if ($total >= 75 & $total < 80) {
                                                                                                                                                                            echo "B+";
                                                                                                                                                                        }
                                                                                                                                                                        if ($total >= 70 & $total < 75) {
                                                                                                                                                                            echo "B";
                                                                                                                                                                        }
                                                                                                                                                                        if ($total >= 65 & $total < 70) {
                                                                                                                                                                            echo "B-";
                                                                                                                                                                        }
                                                                                                                                                                        if ($total >= 60 & $total < 65) {
                                                                                                                                                                            echo "C+";
                                                                                                                                                                        }
                                                                                                                                                                        if ($total >= 55 & $total < 60) {
                                                                                                                                                                            echo "C";
                                                                                                                                                                        }
                                                                                                                                                                        if ($total >= 45 & $total < 55) {
                                                                                                                                                                            echo "D";
                                                                                                                                                                        }
                                                                                                                                                                        if ($total >= 0 & $total < 45) {
                                                                                                                                                                            echo "E";
                                                                                                                                                                        }
                                                                                                                                                                    }
                                                                                                                                                                }
                                                                                                                                                                ?></span></p>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<br>
<table style="margin-left: 65%;">
    <tr>
        <td>Bengkulu,&nbsp;<?php echo date_indo(date('Y-m-d')); ?></td>
    </tr>
    <tr>
        <td>Mengetahui</td>
    </tr>
    <tr>
        <td><br><br><br><br><br></td>
    </tr>
    <tr>
        <td><?php echo $this->session->userdata['nama'] ?></td>
    </tr>
</table>
<p style='margin:0cm;font-size:16px;font-family:"Calibri",sans-serif;text-align:center;'><span style='font-family:"Times New Roman",serif;'>&nbsp;</span></p>

</html>
<script type="text/javascript">
    window.print();
</script>`