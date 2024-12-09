@extends('layouts.master')

@section('title')
    Detail Pembelian {{ $pembelian->created_at->format('d F Y') }}
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Detail Pembelian</li>
@endsection

@push('css')
    <style>
        th,
        #detail {
            text-align: center
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header with-border">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="col-lg-4">
                                <table>
                                    <tr>
                                        <td>Supplier</td>
                                        <td>: {{ $pembelian->supplier->nama }}</td>
                                    </tr>
                                    <tr>
                                        <td>Telepon</td>
                                        <td>: {{ $pembelian->supplier->telepon }}</td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>: {{ $pembelian->supplier->alamat }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-lg-4">
                                <table>
                                    <tr>
                                        <td>Total Harga </td>
                                        <td>: Rp {{ number_format($pembelian->total_harga, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Diskon </td>
                                        <td>: {{ $pembelian->diskon }}%</td>
                                    </tr>
                                    <tr>
                                        <td>Bayar </td>
                                        <td>: Rp {{ number_format($pembelian->bayar, 0, ',', '.') }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <table id="detail" class="table table-striper table-bordered">
                        <thead>
                            <th width="5%">No</th>
                            <th>Kode Produk</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </thead>
                        <tbody>
                            @foreach ($detail as $item)
                                <tr>
                                    <td width="5%">{{ $loop->iteration }}</td>
                                    <td><span class="label label-success">{{ $item->product->kode }}</span></td>
                                    <td>{{ $item->product->nama }}</td>
                                    <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                    <td>{{ $item->jumlah }}</td>
                                    <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div style="padding-left: 10px; padding-bottom: 10px;">
                    <a href="{{ route('pembelian.index') }}" class="btn btn-info btn-sm"><i class="fa fa-arrow-left"></i>
                        Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection
