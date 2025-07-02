<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/admin/bootstrap5/css/bootstrap.css" rel="stylesheet">
</head>
<body>
    <div class="container">
            <a href="/restauran/laporan"><img src="/admin/icon/restaurant.png" alt="" style="width: 10rem; height: 10rem; margin-bottom: 2rem; margin-top: 2rem; " class="rounded mx-auto d-block"></a>
        <table style="font-family: 'Courier New', Courier, monospace; width: 500px;" class="mx-auto" >
            <thead>
                <tr>
                    <td style="padding-left: 200px" class="" align="center">
                        Restaurant <br>
                        Jl. Punten <br>
                        Sejati
                    </td>
                </tr>
            </thead>
            <tbody>
            <tr>
                <td colspan="4" >
                    <span style="width: inherit">---------------------------------------------------</span>
                </td>
            </tr>
            <tr>
                <td>
                    Nomor Meja : {{ $no }}
                    <br>
                    Pesanan : {{ $detail->count() }}
                     <br>
                    Kasir : {{ $name }}
                </td>
                <td style="text-align: right">
                    <span style="margin-left: -10px">Tanggal :  </span>{{{ $tgl }}}
                    <br>
                    <span style="margin-right: 30px">Jam :</span>{{ $jam }}
                </td>
            </tr>
            <tr>
                <td colspan="4" >
                    <span style="width: inherit">---------------------------------------------------</span>
                </td>
            </tr>
            @foreach ($detail as $item)
                <tr>
                    <td>
                        {{ $item->sum }} x {{ $item->nama_menu }}
                    </td>
                    <td style="text-align: right">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="4" >
                    <span style="width: inherit">---------------------------------------------------</span>
                </td>
            </tr>
            <tr>
                <td>
                    Subtotal : 
                </td>
                <td style="text-align: right">
                    Rp {{ number_format($subtotal, 2, ',', '.') }}
                </td>
            </tr>
            <tr>
                <td>
                    Diskon : 
                </td>
                <td style="text-align: right">
                    {{ $diskon }}
                </td>
            </tr>
            <tr>
                <td>
                    Total : 
                </td>
                <td style="text-align: right">
                   Rp {{ number_format($total, 2, ',', '.') }}
                </td>
            </tr>
            <tr>
                <td>
                    Tunai : 
                </td>
                <td style="text-align: right">
                    Rp {{ number_format($tunai, 2, ',', '.') }}
                </td>
            </tr>
            <tr>
                <td>
                    Kembalian : 
                </td>
                <td style="text-align: right">
                    Rp {{ number_format($kembali, 2, ',', '.') }}
                </td>
            </tr>
            <tr>
                <td style="padding-top: 20px; padding-bottom: 50px" colspan="4" class="text-center">Terima Kasih - Silahkan datang lagi!</td>
            </tr>
        </tbody>
        </table>
    </div>
</body>
</html>