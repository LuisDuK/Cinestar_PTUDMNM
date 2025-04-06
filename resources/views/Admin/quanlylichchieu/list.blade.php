@foreach ($lichChieu as $lich)
<tr>
    <td>{{ $lich->maLichChieuPhim}}</td>
    <td>{{ $lich->ten }}</td>
    <td>{{ $lich->ngayChieu }}</td>
    <td>{{ $lich->tenPhongChieu }}</td>
    <td>{{ $lich->suatChieu }}</td>
    <td>{{ $lich->loaiChieu }}</td>
    <td>{{ $lich->giave}}</td>
    <td>{!! $lich->action !!}</td>
</tr>
@endforeach