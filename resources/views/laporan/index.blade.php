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
                    <form action="" method="get">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="min-date">Tanggal Awal:</label>
                                <input type="date" id="min-date" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="max-date">Tanggal Akhir:</label>
                                <input type="date" id="max-date" class="form-control">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-info btn-sm" style="margin-top: 26px"><i class="fa fa-filter">
                                Filter</i>
                        </button>
                    </form>
                    <a href="#" class="btn btn-success btn-sm" style="margin-top: -51px; margin-left: 70px;">
                        <i class="fa fa-file-pdf-o"></i> Import
                    </a>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
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
                                    <td>{{ date('d F Y', strtotime($item['tanggal'])) }}</td>
                                    <td>Rp {{ number_format($item['pengeluaran'], 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($item['pembelian'], 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($item['penjualan'], 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($item['pendapatan'], 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4"></td>
                                <td>Total Pendapatan :</td>
                                <td>Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
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
            // $(function() {
            //     $('#pengeluaran').DataTable({
            //         processing: true,
            //         autoWidth: false,
            //         columnDefs: [{
            //             searchable: false,
            //             sortable: false,
            //             targets: [0, 3]
            //         }]
            //     })
            // })
        </script>
    @endpush
@endsection
