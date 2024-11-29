<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Barcode</title>

    <style>
        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
    <table width="100%">
        <tr>
            @foreach ($produk as $item)
                <td class="text-center">
                    <p>{{ $item->nama }} - Rp. {{ $item->harga_jual }}</p>
                    <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($item->kode, 'C39') }}"
                        alt="{{ $item->kode }}" width="155" height="50">
                    {{ $item->kode }}
                </td>
                @if ($no++ % 4 == 0)
        <tr>

        </tr>
        @endif
        @endforeach
        </tr>
    </table>
</body>

</html>
