@component('mail::message')

# {{ $dataSpp->sekolah->nama_sekolah }}
{{ $dataSpp->sekolah->alamat }} <br>
Telp. {{ $dataSpp->sekolah->nomor_tlp }}
<hr>
NIS		   : {{ $dataSpp->siswa->nisn }}<br>
NAMA SISWA : {{ $dataSpp->siswa->nama_siswa }}<br>
	{{-- $addmonth = date('Y-m-'.$dataSpp->parameter,strtotime("+1 month")); --}}
<?php
	$overdate = date("j F Y", strtotime($dataSpp->keterlambatan));
	$explodedate = explode(" ", $overdate);
	$nominalTagihan = $dataOpsiSpp->sum('total_dibayarkan');
?>
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
		<td>:  {{ $dataOpsiSpp->last()->no_invoice }}</td>
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

<table width="100%" cellspacing="0" border="1" style="border-collapse: collapse;">
	<thead>
		<tr>
			<td>No.</td>
			<td>Tagihan</td>
			<td>Nominal</td>
		</tr>
	</thead>
	<tbody>
		@php
			$no = 1;
		@endphp
		@foreach($dataOpsiSpp as $itemSpp)
		<tr>
			<td>{{ $no++ }}</td>
			<td>Spp {{ date("j F Y", strtotime($itemSpp->batas_akhir)) }}</td>
			<td> {{ "Rp " . number_format($itemSpp->total_dibayarkan,2,',','.') }} </td>
		</tr>
		@endforeach
	</tbody>
	<tfoot>
		<tr>
			<td style="text-align: right;" colspan="2" > <b>Total Tagihan</b> &nbsp;</td>
			<td> {{ "Rp " . number_format($nominalTagihan,2,',','.') }} </td>
		</tr>
	</tfoot>
</table>

<small class="noticebottom"> 
	*Mohon segera membayar tanggungan tersebut
	 sampai batas akhir pada : <br> {{ $overdate }} 
</small> 

@endcomponent
