<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Data Barang</h3>

            <div class="card-tools">
                <a href="<?= base_url('barang/add') ?>" type="button" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add</a>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <?php
            if ($this->session->flashdata('pesan')) {
                echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon fas fa-check"></i> Success';
                echo $this->session->flashdata('pesan');
                echo '</div>';
            }

            ?>
            <table class="table table-bordered text-center" id="example1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($barang as $key => $value) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $value->id_barang ?></td>
                            <td>
                                <?= $value->nama_barang ?><br>
                                Berat : <?= $value->berat ?> Gr
                            </td>
                            <td><?= $value->nama_kategori ?></td>
                            <td>Rp.<?= number_format($value->harga, 0) ?></td>
                            <td><img src="<?= base_url('assets/gambar/') . $value->gambar ?>" width="100px"></td>
                            <td>
                                <a href="<?= base_url('barang/edit/' . $value->id_barang) ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?= $value->id_barang ?>"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- modal delete -->
<?php foreach ($barang as $key => $value) { ?>
    <div class="modal fade" id="delete<?= $value->id_barang ?>">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete <?= $value->nama_barang ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-body modal-sm">
                        Apakah Anda Yakin Ingin Menghapus Data Ini !!
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a href="<?= base_url('barang/delete/' . $value->id_barang) ?>" class="btn btn-danger btn-sm">Delete</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php } ?>