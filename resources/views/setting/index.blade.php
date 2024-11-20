@extends('layouts.master')

@section('title')
    Setting Toko
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Setting Toko</li>
@endsection

@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary" style="margin-top: 20px">
                <!-- form start -->
                <form action="{{ route('setting.update', $setting->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="box-body">
                        <div class="form-group">
                            <label for="nama_toko">Nama Toko</label>
                            <input type="text" name="nama_toko" class="form-control" id="nama_toko"
                                value="{{ $setting->nama_toko }}">
                            @error('nama_toko')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat Toko</label>
                            <textarea name="alamat" class="form-control" id="alamat" rows="3">{{ $setting->alamat }}</textarea>
                            @error('alamat')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="telepon">No Telepon</label>
                            <input type="text" name="telepon" class="form-control" id="telepon"
                                value="{{ $setting->telepon }}">
                            @error('telepon')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="path_logo">Logo Toko</label>
                            <input type="file" name="path_logo" class="form-control" id="path_logo">
                            @error('path_logo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="path_kartu_member">Kartu Member</label>
                            <input type="file" name="path_kartu_member" class="form-control" id="path_kartu_member">
                            @error('path_kartu_member')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="diskon">Diskon</label>
                            <input type="number" name="diskon" class="form-control" id="diskon"
                                value="{{ $setting->diskon }}">
                            @error('diskon')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tipe_nota">Tipe Nota</label>
                            <select name="tipe_nota" id="tipe_nota">
                                <option value="1" {{ $setting->tipe_nota == 1 ? 'selected' : '' }}>Nota Besar</option>
                                <option value="2" {{ $setting->tipe_nota == 2 ? 'selected' : '' }}>Nota Kecil</option>
                            </select>
                            @error('tipe_nota')
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
