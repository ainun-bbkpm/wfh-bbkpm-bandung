<link href="<?php echo base_url('assets/css/mpdfstyletables.css'); ?>" rel="stylesheet">
<table border="1" style="font-family: arial; width: 1100px;" class="tallcells">
	<tr>
		<td colspan="2" style="text-align: center; border-right: none; border-bottom: none; border-left: none; border-top: none;">
			<img src='<?php echo base_url("assets/images/BBKPM LOGO.png"); ?>' style="width: 100px; height: 100px;">
		</td>
		<td colspan="6" style="text-align: center; vertical-align: middle; font-size: 26pt; font-weight: bold; border-right: none; border-top: none; border-left: none; border-bottom: none; padding-right: 50px">
			KEMENTERIAN KESEHATAN RI<br />
			BALAI BESAR KESEHATAN PARU MASYARAKAT (BBKPM) BANDUNG
		</td>
	</tr>
	<tr>
		<td colspan="8" style="text-align: center; font-size: 14pt; border-top: none; border-left: none; border-right: none;">
			Jl. Cibadak No.214 Bandung 40241 Telp / Fax. (022) 6011523, Website : bbkpm-bandung.org / email : webmaster@bbkpm-bandung.org
		</td>
	</tr>
	<?php if (count($data) != 0) { ?>
		<tr>
			<td colspan="8" style="border-top: none; border-bottom: none; border-left: none; border-right: none; text-align: center;">
				<br /><br /><b style="font-size: 20pt;"><u>LAPORAN REKAP PEGAWAI </u></b><br /><i style="font-size: 18pt;">WORK FROM HOME</i><br /><br />
			</td>
		</tr>
		<tr>
			<td colspan="8" style="border-top: none; border-bottom: none; border-left: none; border-right: none; text-align: center;">
				&nbsp;
			</td>
		</tr>
		<tr>
			<td colspan="8" style="border-top: none; border-bottom: none; border-left: none; border-right: none; text-align: center;">
				&nbsp;
			</td>
		</tr>
		<tr>
			<td colspan="8" style="border-top: none; border-bottom: none; border-left: none; border-right: none; text-align: left; font-size: 18pt;"><?php echo "Tanggal : $date"; ?></td>
		</tr>
		<tr>
			<td colspan="8" style="border-top: none; border-bottom: none; border-left: none; border-right: none; text-align: center;">
				&nbsp;
			</td>
		</tr>
		<tr>
			<th align="center" style="width: 17.5px; font-size: 18pt; vertical-align: middle;">NO</th>
			<th style="width: 137.5px; font-size: 18pt; vertical-align: middle;">NIP / NIK</th>
			<th style="width: 457.5px; font-size: 18pt; vertical-align: middle;">NAMA PEGAWAI WFH</th>
			<th align="center" style="width: 97.5px; font-size: 18pt; vertical-align: middle;">TANGGAL WFH</th>
			<th align="center" style="width: 97.5px; font-size: 18pt; vertical-align: middle;">JAM ABSEN MASUK</th>
			<th align="center" style="width: 97.5px; font-size: 18pt; vertical-align: middle;">JAM ABSEN SIANG</th>
			<th align="center" style="width: 97.5px; font-size: 18pt; vertical-align: middle;">JAM ABSEN PULANG</th>
			<?php
			if ($this->session->nip != "320") {
			?>
				<th align="center" style="width: 97.5px; font-size: 18pt; vertical-align: middle;">NILAI KINERJA</th>
			<?php
			}
			?>
		</tr>
		<?php $no = 1;
		foreach ($data as $key => $value) { ?>
			<tr>
				<td style="width: 17.5px; font-size: 18pt; vertical-align: middle;" align="center"><?php echo $no; ?></td>
				<td style="width: 137.5px; font-size: 18pt; vertical-align: middle;"><?php echo $value['id']; ?></td>
				<td style="width: 457.5px; font-size: 18pt; vertical-align: middle;"><?php echo $value['nama_pegawai']; ?></td>
				<td style="width: 97.5px; font-size: 18pt; vertical-align: middle;" align="center"><?php echo $value['tgl_absen']; ?></td>
				<td style="width: 97.5px; font-size: 18pt; vertical-align: middle;" align="center"><?php echo $value['jam_absen_hadir']; ?></td>
				<td style="width: 97.5px; font-size: 18pt; vertical-align: middle;" align="center"><?php echo $value['jam_absen_pertengahan']; ?></td>
				<td style="width: 97.5px; font-size: 18pt; vertical-align: middle;" align="center"><?php echo $value['jam_absen_pulang']; ?></td>
				<?php
				if ($this->session->nip != "320") {
				?>
					<td style="width: 97.5px; font-size: 18pt; vertical-align: middle;" align="center"><?php echo $value['nilai_kinerja']; ?></td>
				<?php
				}
				?>
			</tr>
	<?php $no++;
		}
	} ?>
	<tr>
		<td colspan="4" style="height: 50px; border-style: none;" align="center"><br />&nbsp;<br />&nbsp;<br />&nbsp;<br />&nbsp;<br /></td>
		<td colspan="4" style="height: 50px; border-style: none;" align="center"><br />&nbsp;<br />&nbsp;<br />&nbsp;<br />&nbsp;<br /></td>
	</tr>
	<?php
	if ($this->session->nip != "320") {
	?>
		<tr>
			<td colspan="4" style="border-bottom: none;" class="header"></td>
			<td colspan="4" align="center" style="border-bottom: none;" class="header">TTD,</td>
		</tr>
		<tr>
			<td colspan="4" style="border-bottom: none;" class="header"></td>
			<td colspan="4" align="center" style="border-bottom: none;" class="header">Penilai,</td>
		</tr>
		<tr>
			<td colspan="4" style="border-bottom: none;" class="header"></td>
			<td colspan="4" align="center" style="border-bottom: none;" class="header"><br />&nbsp;<br />&nbsp;<br />&nbsp;<br />&nbsp;<br /></td>
		</tr>
		<tr>
			<td colspan="4" style="border-bottom: none;" class="header"></td>
			<td colspan="4" align="center" style="border-bottom: none;" class="header"><u><?php echo $data[0]['penilai']; ?></u></td>
		</tr>
		<tr>
			<td colspan="4" style="border-bottom: none;" class="header"></td>
			<td colspan="4" align="center" style="border-bottom: none;" class="header">NIP. <?php echo $data[0]['nip']; ?></td>
		</tr>
	<?php
	}
	?>
</table>