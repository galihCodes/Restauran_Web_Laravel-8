<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/admin/bootstrap5/css/bootstrap.css" rel="stylesheet">
    <title>Laporan</title>
</head>
<body>
    <div class="container">
        <h5 class="d-flex justify-content-center mt-4"><strong>Laporan Penjualan Restaurant</strong></h5>
        <br>
        <h6 class="d-flex justify-content-start">Di cetak pada : {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</h6>
        <br>
        <h6 class="d-flex justify-content-start mt-1 mb-4">
            Laporan Penjualan pada : {{ $awal == $akhir ?  $awal :  $awal." - ".$akhir }}</h6>
        <table style="font-family: 'arial'; width:100%;" class="mx-auto table table-bordered">
            <thead>
                <tr align="center">
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Id Transaksi</th>
                    <th>Nama Kasir</th>
                    <th>Jam</th>
                    <th>Total Harga</th>
                </tr>
            </thead>
            @foreach ($tes as $item)
                <tbody>
                    <tr align="center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->tanggal }}</td>
                        <td>{{ $item->id_transaksi }}</td>
                        <td>{{ $name }}</td>
                        <td>{{ $item->jam }}</td>
                        <td>Rp {{ number_format($item->total_bayar, 2, ',', '.') }}</td>
                    </tr>
                </tbody>
            @endforeach
                <tr align="center">
                    <th colspan="5">Total Pendapatan</th>
                    <th>Rp {{ number_format($total, 2, ',', '.') }}</th>
                </tr>
        </table>
    </div>
</body>
</html>