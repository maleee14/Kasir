<div class="modal fade" id="modal-produk" tabindex="-1" role="dialog" aria-labelledby="modal-produk">
    <div class="modal-dialog modal-lg" role="document">


        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Pilih Produk</h4>
            </div>
            <div class="modal-body">
                <table class="table table-striper table-bordered table-produk">
                    <thead>
                        <th width="5%">No</th>
                        <th>Kode Produk</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($produk as $item)
                            <tr>
                                <td width="5%">{{ $loop->iteration }}</td>
                                <td><span class="label label-success">{{ $item->kode }}</span></td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->harga_beli }}</td>
                                <td>
                                    <a href="#" class="btn btn-primary btn-xs"
                                        onclick="pilihProduk('{{ $item->id }}', '{{ $item->kode }}')">
                                        <i class="fa
                                        fa-check-circle"></i>
                                        Pilih
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
