<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-info">
        <div class="inner">
            <h3><?= $total_transaksi ?></h3>

            <p>Transaksi</p>
        </div>
        <div class="icon">
            <i class="ion ion-bag"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-success">
        <div class="inner">
            <h3><?= $total_barang ?></h3>

            <p>Barang</p>
        </div>
        <div class="icon">
            <i class="fas fa-database"></i>
        </div>
        <a href="<?= base_url('barang') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-warning">
        <div class="inner">
            <h3>150</h3>

            <p>Pelanggan</p>
        </div>
        <div class="icon">
            <i class="fas fa-user"></i>
        </div>
        <a href="<?= base_url('pelanggan') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-danger">
        <div class="inner">
            <h3><?= $total_kategori ?></h3>

            <p>Kategori</p>
        </div>
        <div class="icon">
            <i class="fas fa-list-ul"></i>
        </div>
        <a href="<?= base_url('kategori') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>