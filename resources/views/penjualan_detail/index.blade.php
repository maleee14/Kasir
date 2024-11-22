@extends('layouts.master')

@section('title')
    Transaksi penjualan
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Transaksi penjualan</li>
@endsection

@push('css')
    <style>
        .tampil-bayar {
            margin-top: 10px;
            font-size: 4.1em;
            text-align: center;
            height: 100px;
        }

        .tampil-terbilang {
            padding: 10px;
            text-align: center;
            background: #f0f0f0;
        }

        .proses-bayar {
            margin-top: 15px;
        }

        @media(max-width: 768px) {
            .tampil-bayar {
                font-size: 3em;
                height: 70px;
                padding-top: 5px;
            }
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <div class="box-body">

                    <form class="form-produk">
                        @csrf
                        <div class="form-group row">
                            <label for="kode_produk" class="col-lg-2">Kode Produk</label>
                            <div class="col-lg-5">
                                <div class="input-group">
                                    <input type="hidden" name="sale_id" id="sale_id" value="{{ $sale_id }}">
                                    <input type="hidden" name="product_id" id="product_id">
                                    <input type="text" class="form-control" name="kode" id="kode">
                                    <span class="input-group-btn">
                                        <button onclick="tampilProduk()" class="btn btn-info btn-flat" type="button"><i
                                                class="fa fa-arrow-right"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </form>

                    <table class="table table-stiped table-bordered table-pembelian">
                        <thead>
                            <th width="5%">No</th>
                            <th>Kode Produk</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th width="15%">Jumlah</th>
                            <th>Subtotal</th>
                            <th width="15%">Action</th>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item['kode'] }}</td>
                                    <td>{{ $item['nama'] }}</td>
                                    <td>Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
                                    <td><input type="number" class="form-control input-sm quantity"
                                            data-id="{{ $item['id'] }}" value="{{ $item['jumlah'] }}"></td>
                                    <td>Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</td>
                                    <td>
                                        <form action="{{ route('transaksi.destroy', $item['id']) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" id="delete"><i
                                                    class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="row">
                        <div class="col-lg-8">
                            <input type="text" class="tampil-bayar bg-primary" id="tampil_bayar"
                                value="Rp {{ number_format($total, 0, ',', '.') }}" disabled>
                            <div class="tampil-terbilang"></div>
                        </div>
                        <div class="col-lg-4">
                            <form action="{{ route('penjualan.store') }}" class="form-pembelian" method="post">
                                @csrf
                                <input type="hidden" name="sale_id" value="{{ $sale_id }}">
                                <input type="hidden" name="total_harga" value="{{ $total }}">
                                <input type="hidden" name="total_item" value="{{ $total_item }}">
                                <input type="hidden" name="member_id" id="member_id">
                                <div class="proses-bayar">
                                    <div class="form-group row">
                                        <label for="totalrp" class="col-lg-2 control-label">Total</label>
                                        <div class="col-lg-8">
                                            <input type="text" id="total" class="form-control"
                                                value="Rp {{ number_format($total, 0, ',', '.') }}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="totalrp" class="col-lg-2 control-label">Member</label>
                                        <div class="col-lg-8">
                                            <div class="input-group">
                                                <input type="text" id="kode_member" class="form-control">
                                                <span class="input-group-btn">
                                                    <button onclick="tampilMember()" class="btn btn-info btn-flat"
                                                        type="button"><i class="fa fa-arrow-right"></i></button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="diskon" class="col-lg-2 control-label">Diskon</label>
                                        <div class="col-lg-8">
                                            <input type="number" name="diskon" id="diskon" class="form-control"
                                                value="{{ !empty($memberSelected->id) ? $diskon : 0 }}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="bayar" class="col-lg-2 control-label">Bayar</label>
                                        <div class="col-lg-8">
                                            <input type="hidden" id="bayar" name="bayar" class="form-control"
                                                value="Rp {{ number_format($total, 0, ',', '.') }}">
                                            <input type="text" id="bayar_display" class="form-control"
                                                value="Rp {{ number_format($total, 0, ',', '.') }}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="diterima" class="col-lg-2 control-label">Diterima</label>
                                        <div class="col-lg-8">
                                            <input type="number" name="diterima" id="diterima" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="kembali" class="col-lg-2 control-label">Kembali</label>
                                        <div class="col-lg-8">
                                            <input type="hidden" name="kembali" id="kembali" class="form-control"
                                                value="0" readonly>
                                            <input type="text" id="kembali_display" class="form-control"
                                                value="0" readonly>
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary btn-sm pull-right btn-simpan"><i
                                                class="fa fa-floppy-o"></i> Simpan Transaksi</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @includeIf('penjualan_detail.produk')
    @includeIf('penjualan_detail.member')
@endsection

@push('script')
    <script>
        function tampilProduk() {
            $('#modal-produk').modal('show');

        }

        function hideProduk() {
            $('#modal-produk').modal('hide');

        }

        function pilihProduk(id, kode) {
            $('#product_id').val(id);
            $('#kode').val(kode);
            hideProduk();
            tambahProduk();
        }

        function tambahProduk() {
            $.post('{{ route('transaksi.store') }}', $('.form-produk').serialize())
                .done((response) => {
                    $('#kode').focus();
                    location.reload();
                })
                .fail((errors) => {
                    alert('Tidak Dapat Menyimpan Data');
                    return;
                })
        }

        $(document).on('input', '.quantity', function() {
            let id = $(this).data('id');
            let jumlah = parseInt($(this).val());

            if (jumlah < 1) {
                $(this).val(1);
                alert('Jumlah Minimal 1');
                return;
            }

            if (jumlah > 10000) {
                $(this).val(10000);
                alert('Jumlah Tidak Boleh Lebih Dari 10.000');
                return;
            }

            $.post(`{{ url('/transaksi') }}/${id}`, {
                    '_token': $('[name=csrf-token]').attr('content'),
                    '_method': 'put',
                    'jumlah': jumlah
                })
                .done((response) => {
                    $(this).on('mouseleave', function() {
                        location.reload();
                    })
                })
                .fail((errors) => {
                    alert('Tidak Dapat Menyimpan Data');
                    return;
                })
        });

        function tampilMember() {
            $('#modal-member').modal('show');

        }

        function hideMember() {
            $('#modal-member').modal('hide');

        }

        function updateValues() {
            const total = {{ $total }};
            const diskon = parseFloat($('#diskon').val()) || 0;
            const bayar = total - (diskon / 100 * total);
            const diterima = parseFloat($('#diterima').val()) || 0;
            const kembali = diterima - bayar;

            $('#bayar').val(bayar);
            $('#bayar_display').val('Rp ' + bayar.toLocaleString('id-ID'));
            $('#kembali').val(kembali);
            $('#kembali_display').val('Rp ' + kembali.toLocaleString('id-ID'));
        }

        function pilihMember(id, kode) {
            $('#member_id').val(id);
            $('#kode_member').val(kode);
            $('#diskon').val(parseFloat('{{ $diskon }}') || 0);
            updateValues();
            hideMember();
        }

        $(document).ready(function() {
            $('#diskon, #diterima').on('input', updateValues);
        });
    </script>
@endpush
