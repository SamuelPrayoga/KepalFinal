<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Confirmation</title>
</head>
<body>

    <p>Your Order has been Successfully placed.</p>
    <br>

    <table>
        <tr>
            <td>No Invoice</td>
            <td>:</td>
            <td  class="p-2">{{ $orderbaru->invoice }}</td>
        </tr>
        <tr>
            <td>Metode Pembayaran</td>
            <td>:</td>
            <td  class="p-2">{{ $orderbaru->metode_pembayaran }}</td>
        </tr>
        @if($order->metode_pembayaran == 'cod')
        <tr>
            <td>Biaya Cod</td>
            <td>:</td>
            <td  class="p-2">{{ $orderbaru->biaya_cod }}</td>
        </tr>
        @endif
        <tr>
            <td>Status Pesanan</td>
            <td>:</td>
            <td  class="p-2">{{ $orderbaru->status }}</td>
        </tr>
        <tr>
            <td>Total</td>
            <td>:</td>
            <td  class="p-2">Rp. {{ number_format($orderbaru->subtotal,2,',','.') }} ( Sudah Termasuk Ongkir )</td>
        </tr>
        <tr>
            <td>Biaya Ongkir</td>
            <td>:</td>
            <td  class="p-2">Rp. {{ number_format($orderbaru->ongkir,2,',','.') }}</td>
        </tr>
        <tr>
            <td>Kurir</td>
            <td>:</td>
            <td  class="p-2">JNE Service OKE</td>
        </tr>
        @if($order->no_resi != null)
        <tr>
            <td>No Resi</td>
            <td>:</td>
            <td  class="p-2">{{ $orderbaru->no_resi }}</td>
        </tr>
        @endif
        <tr>
            <td>No Hp</td>
            <td>:</td>
            <td  class="p-2">{{ $orderbaru->no_hp }}</td>
        </tr>
        <tr>
            <td>Catatan Pelanggan</td>
            <td>:</td>
            <td  class="p-2">{{ $orderbaru->pesan }}</td>
        </tr>
        @if($order->bukti_pembayaran != null)
        <tr>
            <td>Bukti Pembayaran</td>
            <td>:</td>
            <td  class="p-2"><img src="{{ asset('storage/'.$orderbaru->bukti_pembayaran) }}" alt="" srcset="" class="img-fluid" width="300"></td>
        </tr>
    </table>
</body>
</html>
