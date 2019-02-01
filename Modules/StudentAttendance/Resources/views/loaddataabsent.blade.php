@foreach($absent as $itemabsent)
@if ($itemabsent->masuk == '1')
  @php $information ='masuk'; @endphp
@elseif ($itemabsent->ijin == '1')
  @php $information ='izin'; @endphp
@elseif ($itemabsent->sakit == '1')
  @php $information ='sakit'; @endphp
@elseif ($itemabsent->alfa == '1')
  @php $information ='alfa'; @endphp
@endif
<tr>
  <td>{{ $itemabsent->siswa->nisn }}</td>
    <td>{{ $itemabsent->siswa->nama_siswa }}</td>
    <td>{{ $information }}</td>
  </tr>
@endforeach
