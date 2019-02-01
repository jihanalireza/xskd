<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<style>
	@media only screen and (max-width: 600px) {
		.inner-body {
			width: 100% !important;
		}

		.footer {
			width: 100% !important;
		}
	}

	@media only screen and (max-width: 500px) {
		.button {
			width: 100% !important;
		}
	}
	/* Base */

	body, body *:not(html):not(style):not(br):not(tr):not(code) {
		font-family: Avenir, Helvetica, sans-serif;
		box-sizing: border-box;
	}

	body {
		background-color: #f5f8fa;
		color: #74787E;
		height: 100%;
		hyphens: auto;
		line-height: 1.4;
		margin: 0;
		-moz-hyphens: auto;
		-ms-word-break: break-all;
		width: 100% !important;
		-webkit-hyphens: auto;
		-webkit-text-size-adjust: none;
		word-break: break-all;
		word-break: break-word;
	}

	p,
	ul,
	ol,
	blockquote {
		line-height: 1.4;
		text-align: left;
	}

	a {
		color: #3869D4;
	}

	a img {
		border: none;
	}

	/* Typography */

	h1 {
		color: #2F3133;
		font-size: 19px;
		font-weight: bold;
		margin-top: 0;
		text-align: left;
	}

	h2 {
		color: #2F3133;
		font-size: 16px;
		font-weight: bold;
		margin-top: 0;
		text-align: left;
	}

	h3 {
		color: #2F3133;
		font-size: 14px;
		font-weight: bold;
		margin-top: 0;
		text-align: left;
	}

	p {
		color: #74787E;
		font-size: 16px;
		line-height: 1.5em;
		margin-top: 0;
		text-align: left;
	}

	p.sub {
		font-size: 12px;
	}

	img {
		max-width: 100%;
	}

	/* Layout */

	.wrapper {
		background-color: #f5f8fa;
		margin: 0;
		padding: 0;
		width: 100%;
		-premailer-cellpadding: 0;
		-premailer-cellspacing: 0;
		-premailer-width: 100%;
	}

	.content {
		margin: 0;
		padding: 0;
		width: 100%;
		-premailer-cellpadding: 0;
		-premailer-cellspacing: 0;
		-premailer-width: 100%;
	}

	/* Header */

	.header {
		padding: 25px 0;
		text-align: center;
	}

	.header a {
		color: #bbbfc3;
		background-color: 
		font-size: 19px;
		font-weight: bold;
		text-decoration: none;
		text-shadow: 0 1px 0 white;
	}

	/* Body */

	.body {
		background-color: #FFFFFF;
		border-bottom: 1px solid #EDEFF2;
		border-top: 1px solid #EDEFF2;
		margin: 0;
		padding: 0;
		width: 100%;
		-premailer-cellpadding: 0;
		-premailer-cellspacing: 0;
		-premailer-width: 100%;
	}

	.inner-body {
		background-color: #FFFFFF;
		margin: 0 auto;
		padding: 0;
		width: 570px;
		-premailer-cellpadding: 0;
		-premailer-cellspacing: 0;
		-premailer-width: 570px;
	}

	/* Footer */

	.footer {
		margin: 0 auto;
		padding: 0;
		text-align: center;
		width: 570px;
		-premailer-cellpadding: 0;
		-premailer-cellspacing: 0;
		-premailer-width: 570px;
	}

	.footer p {
		color: #AEAEAE;
		font-size: 12px;
		text-align: center;
	}

	/* Tables */

	.table table {
		margin: 30px auto;
		width: 100%;
		-premailer-cellpadding: 0;
		-premailer-cellspacing: 0;
		-premailer-width: 100%;
	}

	.table th {
		border-bottom: 1px solid #EDEFF2;
		padding-bottom: 8px;
		margin: 0;
	}

	.table td {
		color: #74787E;
		font-size: 15px;
		line-height: 18px;
		padding: 10px 0;
		margin: 0;
	}

	.content-cell {
		padding: 35px;
	}

	/* Panels */

	.panel {
		margin: 0 0 21px;
	}

	.panel-content {
		background-color: #EDEFF2;
		padding: 16px;
	}

	.panel-item {
		padding: 0;
	}

	.panel-item p:last-of-type {
		margin-bottom: 0;
		padding-bottom: 0;
	}

	.headbar-right {
		border-bottom: 80px solid #3e9fd9;
		border-left: 40px solid transparent;
		height: 0;
		position: relative;
		float: right;
		width: 400px;
		line-height: 80px;
		text-align: center;
	}
	.headbar-right-title {
		color: white;
		font-size: 25px;
	}

	.headbar-left {
		border-bottom: 80px solid white;
		border-left: 40px solid transparent;
		height: 0;
		position: relative;
		float: left;
		width: 400px;
		line-height: 80px;
		text-align: center;
	}
	.headbar-left-title {
		font-size: 25px;
	}

	.tabledetail {
		border-collapse: collapse;
		width: 100%;
	}

	.tabledetail th, .tabledetail td {
		text-align: left;
		padding: 8px;
	}

	.tabledetail tr:nth-child(even){background-color: #f2f2f2}

	.tabledetail th {
		background-color: #3e9fd9;
		color: white;
	}

	.linebar {
		border: 0.6px solid #3e9fd9;
	}

	.noticebottom {
		color: #a05900;
	}
</style>
</head>
<body>
	<?php
	$overdate = date("j F Y", strtotime($dataSpp->keterlambatan));
	$explodedate = explode(" ", $overdate);
	$nominalTagihan = $dataOpsiSpp->sum('total_dibayarkan');
	$noinvoice = $dataOpsiSpp->last()->no_invoice;
	?>
	<table class="wrapper" width="100%" cellpadding="0" cellspacing="0">
		<tr>
			<td align="center">
				<table class="content" width="100%" cellpadding="0" cellspacing="0">
					<!-- Email Body -->
					<tr>
						<td class="body" width="100%" cellpadding="0" cellspacing="0">
							<div class="headbar-left">
								<h2 class="headbar-left-title">INVOICE #{{ $noinvoice }}</h2>
							</div>
							<div class="headbar-right">
								<div class="headbar-right-title">Smkn 4 Malang</div>
							</div>
						</td>
					</tr>

					<tr>
						<td class="body" width="100%" cellpadding="0" cellspacing="0">
							<table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0">
								<!-- Body content -->
								<tr>
									<td class="content-cell">
										{{ $dataSpp->sekolah->nama_sekolah }}<br>
										{{ $dataSpp->sekolah->alamat }} <br>
										Telp. {{ $dataSpp->sekolah->nomor_tlp }}
										<hr class="linebar">
										<table width="80%" cellpadding="0" cellspacing="0">
											<tr>
												<td>NIS</td>
												<td>: {{ $dataSpp->siswa->nisn }}</td>
											</tr>
											<tr>
												<td>NAMA SISWA</td>
												<td>: {{ $dataSpp->siswa->nama_siswa }}</td>
											</tr>
										</table>
										<br>
										<hr class="linebar">
										<small>
											Mempunyai tanggungan sebagai berikut:
											<table width="100%" cellpadding="0" cellspacing="0">
												<tr>
													<td>Tanggal</td>
													<td>:  {{ date('Y-m-d') }}</td>
												</tr>
												<tr>
													<td>Jam</td>
													<td>:  {{ date('h:i:s') }}</td>
												</tr>
												<tr>
													<td>Jenis Tagihan</td>
													<td>:  Tagihan Spp Sekolah</td>
												</tr>
												<tr>
													<td>No.Invoice</td>
													<td>:  {{ $noinvoice }}</td>
												</tr>
												<tr>
													<td>Keterangan</td>
													<td>:  Spp Bulanan</td>
												</tr>
												<tr>
													<td>Total Tagihan</td>
													<td>:  {{ "Rp " . number_format($nominalTagihan,2,',','.') }}</td>
												</tr>
												<tr>
													<td>Batas Akhir</td>
													<td>:  {{ $dataSpp->keterlambatan }} </td>
												</tr>
											</table>
										</small>
										<br>
										<hr class="linebar">
										<table class="panel" width="100%" cellpadding="0" cellspacing="0">
											<tr>
												<td class="panel-content">
													<table width="100%" cellpadding="0" cellspacing="0">
														<tr>
															<td class="panel-item">
																DETAIL TAGIHAN
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</table>

										<table class="tabledetail" width="100%">
											<tr>
												<th width="10%">No.</th>
												<th>Tagihan</th>
												<th>Nominal</th>
											</tr>
											@php
											$no = 1;
											@endphp
											@foreach($dataOpsiSpp as $itemSpp)
											<tr>
												<td>{{ $no++ }}</td>
												<td>Spp {{ date("j F Y", strtotime($itemSpp->batas_akhir)) }}</td>
												<td>{{ "Rp " . number_format($itemSpp->total_dibayarkan,2,',','.') }}</td>
											</tr>
											@endforeach
											<tr>
												<th colspan="2" style="text-align: right;">
													Total Tagihan
												</th>
												<td>
													{{ "Rp " . number_format($nominalTagihan,2,',','.') }}
												</td>
											</tr>
										</table>
										<br>
										<small class="noticebottom"> 
											*Mohon segera membayar tanggungan tersebut
											sampai batas akhir pada : <br> {{ $overdate }} 
										</small> 
									</td>
								</tr>
							</table>
						</td>
					</tr>

					<tr>
						<td>
							<table class="footer" align="center" width="570" cellpadding="0" cellspacing="0">
								<tr>
									<td class="content-cell" align="center">
										© {{ date('Y') }} {{ env('APP_NAME') }}. @lang('All rights reserved.')
									</td>
								</tr>
							</table>
						</td>
					</tr>

				</table>
			</td>
		</tr>
	</table>
</body>
</html>
