<!-- application/views/transaksi/detail_pesanan.php -->

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Pesanan</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <!-- Tampilkan detail pesanan di sini -->
            <p>ID Transaksi: <?= $detail->id_transaksi; ?></p>
            <p>Nama Pelanggan: <?= $detail->nama_pelanggan; ?></p>
            <!-- Tambahkan field lain sesuai kebutuhan -->

            <!-- Tampilkan barang yang terkait dengan transaksi -->
            <h2>Barang dalam Pesanan</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <!-- Tambahkan kolom lain jika diperlukan -->
                    </tr>
                </thead>
                <tbody>
                    <!-- Loop untuk menampilkan barang -->
                    <?php foreach ($detail_pesanan as $key => $value) : ?>
                        <tr>
                            <td><?= $value['name']; ?></td>
                            <td><?= $value['qty']; ?></td>
                            <!-- Tambahkan kolom lain jika diperlukan -->
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
</div>
