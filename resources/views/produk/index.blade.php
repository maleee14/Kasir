@extends('layouts.master')

@section('title')
    Produk
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Produk</li>
@endsection

@section('content')
    <!-- Main content -->
    <div class="row">
        <div class="col-xs-12">

            <div class="box">
                <div class="box-header">
                    <a href="{{ route('produk.create') }}" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i>
                        Tambah</a>
                    {{-- <a href="#" class="btn btn-info btn-sm"><i class="fa fa-barcode"></i>
                        Cetak Barcode</a> --}}
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="product" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Produk</th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Harga Beli</th>
                                <th>Harga Jual</th>
                                <th>Stock</th>
                                <th>Diskon</th>
                                <th width="15%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produk as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><span class="label label-success">{{ $item->kode }}</span></td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->category->nama }}</td>
                                    <td>{{ $item->harga_beli }}</td>
                                    <td>{{ $item->harga_jual }}</td>
                                    <td>{{ $item->stock }}</td>
                                    <td>{{ $item->diskon }}</td>
                                    <td>
                                        <div class="btn-group" style="display: flex;">
                                            <a href="{{ route('produk.edit', $item->id) }}" type="button"
                                                class="btn btn-info btn-sm"><i class="fa fa-pencil"></i>
                                                Edit</a>
                                            <form action="{{ route('produk.destroy', $item->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Yakin Hapus Produk?')"><i
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
    <!-- /.row -->
    <!-- /.content -->
    @push('script')
        <script>
            $(function() {
                $('#product').DataTable({
                    processing: true,
                    autoWidth: false,
                    columnDefs: [{
                        searchable: false,
                        sortable: false,
                        targets: [0, 1, 6, 7, 8]
                    }]
                })
            })
        </script>
    @endpush
@endsection
