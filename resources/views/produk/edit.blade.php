@extends('layouts.master')

@section('title')
    Edit Produk
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Edit Produk</li>
@endsection

@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary" style="margin-top: 20px">
                <!-- form start -->
                <form action="{{ route('produk.update', $produk->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="box-body">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" class="form-control" id="nama"
                                value="{{ $produk->nama }}">
                            @error('nama')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nama">Kategori</label>
                            <select name="category_id" id="category_id" class="form-control">
                                <option value="{{ $produk->category->id }}">{{ $produk->category->nama }}</option>
                                @foreach ($kategori as $item)
                                    @if ($item->nama !== $produk->category->nama)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="harga_beli">Harga Beli</label>
                            <input type="text" name="harga_beli" class="form-control" id="harga_beli"
                                value="{{ $produk->harga_beli }}">
                            @error('harga_beli')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="harga_jual">Harga Jual</label>
                            <input type="text" name="harga_jual" class="form-control" id="harga_jual"
                                value="{{ $produk->harga_jual }}">
                            @error('harga_jual')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="stock">Stock</label>
                            <input type="number" name="stock" class="form-control" id="stock"
                                value="{{ $produk->stock }}">
                            @error('stock')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="diskon">Diskon</label>
                            <input type="number" name="diskon" class="form-control" id="diskon"
                                value="{{ $produk->diskon }}">
                            @error('diskon')
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
