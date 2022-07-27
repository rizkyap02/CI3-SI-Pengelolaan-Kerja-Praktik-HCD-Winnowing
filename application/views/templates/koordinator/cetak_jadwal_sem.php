<html>
<?php $this->load->helper('tgl_indo'); ?>
<p style='margin:0cm;font-size:16px;font-family:"Calibri",sans-serif;text-align:center;'><strong><span style='font-size:19px;font-family:"Times New Roman",serif;'>JADWAL SEMINAR KERJA PRAKTIK</span></strong></p>
<p style='margin:0cm;font-size:16px;font-family:"Calibri",sans-serif;text-align:center;'><strong><span style='font-size:19px;font-family:"Times New Roman",serif;'>&nbsp;</span></strong></p>
<table style="border-collapse:collapse;border:none;width:100%;">
    <tbody>
        <tr>
            <th style="text-align: center;border:solid windowtext 1.0pt;">Tanggal</th>
            <th style="text-align: center;border:solid windowtext 1.0pt;">Jam</th>
            <th style="text-align: center;border:solid windowtext 1.0pt;">Ruang</th>
            <th style="text-align: center;border:solid windowtext 1.0pt;">Nama</th>
            <th style="text-align: center;border:solid windowtext 1.0pt;">NPM</th>
            <th style="text-align: center;border:solid windowtext 1.0pt;">P1</th>
            <th style="text-align: center;border:solid windowtext 1.0pt;">P2</th>
        </tr>
        <?php foreach ($data as $data) { ?>
            <tr>
                <td style="width:63.55pt;border:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;">
                    <p style='margin:0cm;font-size:16px;font-family:"Calibri",sans-serif;text-align:center;'><span style='font-family:"Times New Roman",serif;'><?php echo longdate_indo($data->tgl_seminar) ?></span></p>
                </td>
                <td style="width:42.5pt;border:solid windowtext 1.0pt;border-left:  none;padding:0cm 5.4pt 0cm 5.4pt;">
                    <p style='margin:0cm;font-size:16px;font-family:"Calibri",sans-serif;text-align:center;'><span style='font-family:"Times New Roman",serif;'><?php $date_s = date_create($data->wkt_seminar);
                                                                                                                                                                echo date_format($date_s, 'H:i'); ?></span></p>
                </td>
                <td style="width:42.55pt;border:solid windowtext 1.0pt;border-left:  none;padding:0cm 5.4pt 0cm 5.4pt;">
                    <p style='margin:0cm;font-size:16px;font-family:"Calibri",sans-serif;text-align:center;'><span style='font-family:"Times New Roman",serif;'><?= $data->r_seminar; ?></span></p>
                </td>
                <td style="width:163.0pt;border:solid windowtext 1.0pt;border-left:  none;padding:0cm 5.4pt 0cm 5.4pt;">
                    <p style='margin:0cm;font-size:16px;font-family:"Calibri",sans-serif;'><span style='font-family:"Times New Roman",serif;'><?= $data->nama_mhs; ?></span></p>
                </td>
                <td style="width:70.9pt;border:solid windowtext 1.0pt;border-left:  none;padding:0cm 5.4pt 0cm 5.4pt;">
                    <p style='margin:0cm;font-size:16px;font-family:"Calibri",sans-serif;text-align:center;'><span style='font-family:"Times New Roman",serif;'><?= $data->npm; ?></span></p>
                </td>
                <?php if ($data->peng1 == '198112222008011011') {
                    $peng = 'AE';
                } else if ($data->peng1 == '199201312019031010') {
                    $peng = 'AW';
                } else if ($data->peng1 == '198502042008122002') {
                    $peng = 'AV';
                } else if ($data->peng1 == '197812072005012001') {
                    $peng = 'DA';
                } else if ($data->peng1 == '197610052005012002') {
                    $peng = 'DP';
                } else if ($data->peng1 == '195803051986031007') {
                    $peng = 'AJ';
                } else if ($data->peng1 == '195904241986021002') {
                    $peng = 'BS';
                } else if ($data->peng1 == '198701272012122001') {
                    $peng = 'EPP';
                } else if ($data->peng1 == '197308142006042001') {
                    $peng = 'EW';
                } else if ($data->peng1 == '198906232018031001') {
                    $peng = 'FPU';
                } else if ($data->peng1 == '198205172008121004') {
                    $peng = 'FFC';
                } else if ($data->peng1 == '199007092019032025') {
                    $peng = 'JPS';
                } else if ($data->peng1 == '198901182015042004') {
                    $peng = 'KA';
                } else if ($data->peng1 == '199201042019031015') {
                    $peng = 'MY';
                } else if ($data->peng1 == '199411232020122000') {
                    $peng = 'NR';
                } else if ($data->peng1 == '198101122005011002') {
                    $peng = 'RE';
                } else if ($data->peng1 == '198411292008122000') {
                    $peng = 'RV';
                } else if ($data->peng1 == '199010182020122012') {
                    $peng = 'WOK';
                } else if ($data->peng1 == '198909032015041004') {
                    $peng = 'YS';
                } else if ($data->peng1 == '198310302009031002') {
                    $peng = 'NL';
                } ?>
                <?php if ($data->peng2 == '198112222008011011') {
                    $peng2 = 'AE';
                } else if ($data->peng2 == '199201312019031010') {
                    $peng2 = 'AW';
                } else if ($data->peng2 == '198502042008122002') {
                    $peng2 = 'AV';
                } else if ($data->peng2 == '197812072005012001') {
                    $peng2 = 'DA';
                } else if ($data->peng2 == '197610052005012002') {
                    $peng2 = 'DP';
                } else if ($data->peng2 == '195803051986031007') {
                    $peng2 = 'AJ';
                } else if ($data->peng2 == '195904241986021002') {
                    $peng2 = 'BS';
                } else if ($data->peng2 == '198701272012122001') {
                    $peng2 = 'EPP';
                } else if ($data->peng2 == '197308142006042001') {
                    $peng2 = 'EW';
                } else if ($data->peng2 == '198906232018031001') {
                    $peng2 = 'FPU';
                } else if ($data->peng2 == '198205172008121004') {
                    $peng2 = 'FFC';
                } else if ($data->peng2 == '199007092019032025') {
                    $peng2 = 'JPS';
                } else if ($data->peng2 == '198901182015042004') {
                    $peng2 = 'KA';
                } else if ($data->peng2 == '199201042019031015') {
                    $peng2 = 'MY';
                } else if ($data->peng2 == '199411232020122000') {
                    $peng2 = 'NR';
                } else if ($data->peng2 == '198101122005011002') {
                    $peng2 = 'RE';
                } else if ($data->peng2 == '198411292008122000') {
                    $peng2 = 'RV';
                } else if ($data->peng2 == '199010182020122012') {
                    $peng2 = 'WOK';
                } else if ($data->peng2 == '198909032015041004') {
                    $peng2 = 'YS';
                } else if ($data->peng2 == '198310302009031002') {
                    $peng2 = 'NL';
                } ?>
                <td style="width:35.45pt;border:solid windowtext 1.0pt;border-left:  none;padding:0cm 5.4pt 0cm 5.4pt;">
                    <p style='margin:0cm;font-size:16px;font-family:"Calibri",sans-serif;text-align:center;'><span style='font-family:"Times New Roman",serif;'><?= $peng; ?></span></p>
                </td>
                <td style="width:32.55pt;border:solid windowtext 1.0pt;border-left:  none;padding:0cm 5.4pt 0cm 5.4pt; text-align:center;">
                    <?php if ($data->peng2 == null) { ?>
                        - <?php } else { ?>
                        <p style='margin:0cm;font-size:16px;font-family:"Calibri",sans-serif;text-align:center;'><span style='font-family:"Times New Roman",serif;'><?= $peng2; ?></span></p>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<p style='margin:0cm;font-size:16px;font-family:"Calibri",sans-serif;text-align:center;'><span style='font-family:"Times New Roman",serif;'>&nbsp;</span></p>


<script type="text/javascript">
    window.print();
</script>

</html>