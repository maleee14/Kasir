@extends('layouts.master')

@section('title')
    Edit Pengeluaran
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Edit Pengeluaran</li>
@endsection

@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary" style="margin-top: 20px">
                <!-- form start -->
                <form action="{{ route('pengeluaran.update', $pengeluaran->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="box-body">
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <input type="text" name="deskripsi" class="form-control" id="deskripsi"
                                value="{{ $pengeluaran->deskripsi }}">
                            @error('deskripsi')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nominal">Nominal</label>
                            <input type="text" name="nominal" class="form-control" id="nominal"
                                value="{{ $pengeluaran->nominal }}">
                            @error('nominal')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            <!-- /.box -->

        </div>
    </div>
@endsection
