@foreach($student as $itemStudent)
<?php
  $check = $absent->where('id_siswa',$itemStudent->id_siswa)->isEmpty();
?>
  @if($check)
    <tr>
      <td>{{ $itemStudent->nisn }}</td>
      <td>{{ $itemStudent->nama_siswa }}</td>
        <td><a href="#" class="btn btn-success absen" classid="{{ $itemStudent->kela->id_kelas }}" idStudent="{{ $itemStudent->id_siswa }}" name="{{ $itemStudent->nama_siswa }}">Absen</a>
        </td>
      </tr>
    @endif
@endforeach
