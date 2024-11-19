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
                    <table id="pengeluaran" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Deskripsi</th>
                                <th>Nominal</th>
                                <th width="15%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengeluaran as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->deskripsi }}</td>
                                    <td>Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                                    <td>
                                        <div class="btn-group" style="display: flex;">
                                            <a href="{{ route('pengeluaran.edit', $item->id) }}" type="button"
                                                class="btn btn-info btn-sm"><i class="fa fa-pencil"></i>
                                                Edit</a>
                                            <form action="{{ route('pengeluaran.destroy', $item->id) }}" method="post">
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
