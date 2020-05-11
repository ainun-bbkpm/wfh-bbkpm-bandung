<link href="<?php echo base_url('assets/css/mpdfstyletables.css'); ?>" rel="stylesheet">
	<table border="0" style="font-family: arial; width: 1350px;" class="tallcells">
		<tr>
			<td style="text-align: center; border-right: none; border-bottom: none; border-left: none; border-top: none; width: 290px;">
				<img src='<?php echo base_url("assets/images/BBKPM LOGO.png"); ?>' style="width: 100px; height: 100px;">
			</td>
			<td colspan="3" style="text-align: center; vertical-align: middle; font-size: 26pt; font-weight: bold; border-right: none; border-top: none; border-left: none; border-bottom: none; padding-right: 50px">
				KEMENTERIAN KESEHATAN RI<br/>
				BALAI BESAR KESEHATAN PARU MASYARAKAT (BBKPM) BANDUNG
			</td>
		</tr>
		<tr>
			<td colspan="4" style="text-align: center; font-size: 14pt; border-top: none; border-left: none; border-right: none;">
				Jl. Cibadak No.214 Bandung 40241 Telp / Fax. (022) 6011523, Website : bbkpm-bandung.org / email : webmaster@bbkpm-bandung.org
			</td>
		</tr>
		<tr>
			<td colspan="4" style="border-top: none; border-bottom: none; border-left: none; border-right: none; text-align: center;">
				<hr><br/><br/><b style="font-size: 20pt;"><u>LAPORAN HARIAN WFH PEGAWAI</u></b><br/><i style="font-size: 18pt;"><?php echo $data[0]['nama_pegawai']; ?></i><br/><br/>
			</td>
		</tr>
		<tr>
			<td style="font-size: 20pt; height: 50px;" align="left">TANGGAL WFH</td>
			<td style="width: 5px; font-size: 20pt;" align="center">:</td>
			<td colspan="2" style="font-size: 20pt;" align="left"><?php echo $data[0]['tgl_absen']; ?></td>
		</tr>
		<tr>
			<td style="font-size: 20pt; height: 50px;" align="left">JAM ABSEN MASUK</td>
			<td style="font-size: 20pt;" align="center">:</td>
			<td colspan="2" style="font-size: 20pt;" align="left"><?php echo $data[0]['jam_absen_hadir']." WIB"; ?></td>
		</tr>
		<tr>
			<td style="font-size: 20pt; height: 50px;" align="left">JAM ABSEN SIANG</td>
			<td style="font-size: 20pt;" align="center">:</td>
			<td colspan="2" style="font-size: 20pt;" align="left"><?php echo $data[0]['jam_absen_pertengahan']." WIB"; ?></td>
		</tr>
		<tr>
			<td style="font-size: 20pt; height: 50px;" align="left">JAM ABSEN PULANG</td>
			<td style="font-size: 20pt;" align="center">:</td>
			<td colspan="2" style="font-size: 20pt;" align="left"><?php echo $data[0]['jam_absen_pulang']." WIB"; ?></td>
		</tr>
		<tr>
			<td colspan="4" style="font-size: 20pt; height: 50px;" align="left"><b>STATUS KESEHATAN</b></td>
		</tr>
		<tr>
			<td style="font-size: 20pt; height: 50px;" align="left">DEMAM</td>
			<td style="font-size: 20pt;" align="center">:</td>
			<td colspan="2" style="font-size: 20pt;" align="left"><?php echo $data[0]['demam'] == 'N' ? "TIDAK":"YA"; ?></td>
		</tr>
		<tr>
			<td style="font-size: 20pt; height: 50px;" align="left">SESAK</td>
			<td style="font-size: 20pt;" align="center">:</td>
			<td colspan="2" style="font-size: 20pt;" align="left"><?php echo $data[0]['sesak'] == 'N' ? "TIDAK":"YA"; ?></td>
		</tr>
		<tr>
			<td style="font-size: 20pt; height: 50px;" align="left">BATUK</td>
			<td style="font-size: 20pt;" align="center">:</td>
			<td colspan="2" style="font-size: 20pt;" align="left"><?php echo $data[0]['batuk'] == 'N' ? "TIDAK":"YA"; ?></td>
		</tr>
		<tr>
			<td style="font-size: 20pt; height: 50px;" align="left">NYERI MENELAN</td>
			<td style="font-size: 20pt;" align="center">:</td>
			<td colspan="2" style="font-size: 20pt;" align="left"><?php echo $data[0]['nyeri_nelan'] == 'N' ? "TIDAK":"YA"; ?></td>
		</tr>
		<?php $i = 1; foreach ($data as $key => $value) { ?>
		<tr>
			<td style="font-size: 20pt;" align="left"><b>URAIAN KEGIATAN <?php echo $i; ?></b></td>
			<td colspan="3" style="font-size: 20pt;" align="left">:</td>
		</tr>
		<tr>
			<td colspan="4" style="font-size: 20pt; height: 50px;" align="left"><?php echo $value['uraian_kegiatan']; ?></td>
		</tr>
		<?php $i++; } ?>
		<tr>
			<td style="font-size: 20pt; height: 50px;" align="left"><b>NILAI</b></td>
			<td style="font-size: 20pt;" align="center">:</td>
			<td colspan="2" style="font-size: 20pt;" align="left"><?php echo $data[0]['nilai_kinerja']."%"; ?></td>
		</tr>
		<tr>
			<td style="font-size: 20pt;" align="left"><b>CATATAN PENILAI</b></td>
			<td colspan="3" style="font-size: 20pt; font-size: 20pt;" align="left">:</td>
		</tr>
		<tr>
			<td colspan="4" style="font-size: 20pt; height: 50px;" align="left"><?php echo $data[0]['catatan']; ?></td>
		</tr>
		<tr>
			<td colspan="3" style="font-size: 20pt; height: 50px;" align="center">TTD,</td>
			<td style="font-size: 20pt; height: 50px;" align="center">TTD,</td>
		</tr>
		<tr>
			<td colspan="3" style="font-size: 20pt; height: 50px;" align="center">Pegawai WFH,</td>
			<td style="font-size: 20pt; height: 50px;" align="center">Penilai,</td>
		</tr>
		<tr>
			<td colspan="3" style="font-size: 20pt; height: 50px;" align="center"><br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/></td>
			<td style="font-size: 20pt; height: 50px;" align="center"><br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/></td>
		</tr>
		<tr>
			<td colspan="3" style="font-size: 20pt; height: 50px;" align="center"><u><?php echo $data[0]['nama_pegawai']; ?></u></td>
			<td style="font-size: 20pt; height: 50px;" align="center"><u><?php echo $data[0]['penilai']; ?></u></td>
		</tr>
		<tr>
			<td colspan="3" style="font-size: 20pt; height: 50px;" align="center">NIP. <?php echo $data[0]['nip2']; ?></td>
			<td style="font-size: 20pt; height: 50px;" align="center">NIP. <?php echo $data[0]['nip']; ?></td>
		</tr>
	</table>