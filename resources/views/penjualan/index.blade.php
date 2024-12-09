@extends('layouts.master')

@section('title')
    Penjualan
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Penjualan</li>
@endsection

@section('content')
    <!-- Main content -->
    <div class="row">
        <div class="col-xs-12">

            <div class="box">
                {{-- <div class="box-header">
                    <button onclick="addForm()" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i>
                        Tambah</button>
                </div> --}}
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="product" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Kode Member</th>
                                <th>Total Item</th>
                                <th>Total Harga</th>
                                <th>Diskon</th>
                                <th>Bayar</th>
                                <th width="15%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penjualan as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->created_at->format('d F Y') }}</td>
                                    <td><span class="label label-success">{{ $item->member->kode ?? '' }}</span></td>
                                    <td>{{ $item->total_item }}</td>
                                    <td>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                    <td>{{ $item->diskon }}%</td>
                                    <td>Rp {{ number_format($item->bayar, 0, ',', '.') }}</td>
                                    <td>
                                        <div class="btn-group" style="display: flex;">
                                            <a href="{{ route('penjualan.show', $item->id) }}"
                                                class="btn btn-info btn-sm"><i class="fa fa-eye"></i>
                                                Detail</a>
                                            <form action="{{ route('penjualan.destroy', $item->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" id="delete"><i
                                                        class="fa fa-trash"></i>
                                                    Delete</button>
                                            </form>
                                        </div>
                                    </td>
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
    @push('script')
        <script>
            $(function() {
                $('#product').DataTable({
                    processing: true,
                    autoWidth: false,
                    columnDefs: [{
                        searchable: false,
                        sortable: false,
                        targets: [0, 2, 7]
                    }, {
                        searchable: false,
                        targets: [3, 4, 5, 6]
                    }]
                })
            })
        </script>
    @endpush
@endsection
