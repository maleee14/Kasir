@extends('layouts.master')

@section('title')
    Kategori
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Kategori</li>
@endsection

@section('content')
    <!-- Main content -->
    <div class="row">
        <div class="col-xs-12">

            <div class="box">
                <div class="box-header">
                    <a href="{{ route('kategori.create') }}" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i>
                        Tambah</a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="category" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th width="25%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kategori as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama }}
                                    </td>
                                    <td>
                                        <div class="btn-group" style="display: flex;">
                                            <a href="{{ route('kategori.edit', $item->id) }}" type="button"
                                                class="btn btn-info btn-sm"><i class="fa fa-pencil"></i>
                                                Edit</a>
                                            <form action="{{ route('kategori.destroy', $item->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" id="delete">
                                                    <i class="fa fa-trash"></i>
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
                $('#category').DataTable({
                    processing: true,
                    autoWidth: false,
                    columnDefs: [{
                        searchable: false,
                        sortable: false,
                        targets: [0, 2]
                    }]
                })
            })
        </script>
    @endpush
@endsection
