@extends('layouts.master')

@section('title')
    Pengeluaran
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Pengeluaran</li>
@endsection

@section('content')
    <!-- Main content -->
    <div class="row">
        <div class="col-xs-12">

            <div class="box">
                <div class="box-header">
                    <a href="{{ route('pengeluaran.create') }}" class="btn btn-success btn-sm"><i
                            class="fa fa-plus-circle"></i>
                        Tambah</a>
                    {{-- <a href="#" class="btn btn-info btn-sm"><i class="fa fa-id-card-o"></i>
                        Cetak Kartu Member</a> --}}
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <input type="hidden" value="{{ $total_pendapatan }}">
                    <table id="pengeluaran" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Pengeluaran</th>
                                <th>Pembelian</th>
                                <th>Penjualan</th>
                                <th>Pendapatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item['tanggal'] }}</td>
                                    <td>Rp {{ number_format($item['pengeluaran'], 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($item['pembelian'], 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($item['penjualan'], 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($item['pendapatan'], 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <!-- /.content -->
    @push('script')
        <script>
            $(function() {
                $('#pengeluaran').DataTable({
                    processing: true,
                    autoWidth: false,
                    columnDefs: [{
                        searchable: false,
                        sortable: false,
                        targets: [0, 3]
                    }]
                })
            })
        </script>
    @endpush
@endsection
