<!-- Main content -->
<div class="invoice p-4 mb-4" style="background-color:#E2F0FF; border-radius:12px;">
<form action="<?= base_url('belanja/proses_checkout') ?>" method="post">
    <!-- Title -->
    <div class="row mb-3">
        <div class="col-12">
            <h4 class="d-flex justify-content-between align-items-center">
                <span><i class="fas fa-shopping-cart mr-2"></i> Checkout</span>
                <small class="text-muted">Date: <?= date('d-m-Y') ?></small>
            </h4>
        </div>
    </div>

    <!-- Items list -->
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center">
                    <thead class="text-white" style="background-color:#17214B;">
                        <tr>
                            <th>Gambar</th>
                            <th>Barang</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Total Harga</th>
                            <th>Berat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        $tot_berat = 0; ?>
                        <?php foreach ($cart_items as $item):
                            $berat = $item->qty * $item->berat;
                            $tot_berat += $berat;
                        ?>
                            <tr>
                                <td>
                                    <img src="<?= base_url('assets/gambar/' . $item->gambar) ?>"
                                        class="img-fluid rounded"
                                        style="max-width:90px;">
                                </td>
                                <td><?= $item->nama_barang; ?></td>
                                <td><?= $item->qty; ?></td>
                                <td>Rp <?= number_format($item->harga, 0); ?></td>
                                <td>Rp <?= number_format($item->subtotal, 0); ?></td>
                                <td><?= $berat ?> Gr</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Checkout form -->
    <?php echo form_open('belanja/checkout');
    $no_order = date('Ymd') . strtoupper(random_string('alnum', 8));
    ?>

    <div class="row mt-4">

        <!-- Left Form -->
        <div class="col-md-8">
            <h5 class="font-weight-bold mb-3">Tujuan Pengiriman</h5>

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label>Provinsi</label>
                    <select name="provinsi" class="form-control"></select>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Kota/Kabupaten</label>
                    <select name="kota" class="form-control"></select>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Ekspedisi</label>
                    <select name="ekspedisi" class="form-control"></select>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Paket</label>
                    <select name="paket" class="form-control"></select>
                </div>

                <div class="col-md-8 mb-3">
                    <label>Alamat</label>
                    <input name="alamat" class="form-control" required>
                </div>

                <div class="col-md-4 mb-3">
                    <label>Kode Pos</label>
                    <input name="kode_pos" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Nama Penerima</label>
                    <input name="nama_penerima" value="<?= $this->session->userdata('nama_pelanggan') ?>" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>No Telepon</label>
                    <input name="hp_penerima" class="form-control" required>
                </div>

            </div>
        </div>

        <!-- Right Summary Card -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">

                    <h5 class="font-weight-bold mb-3">Ringkasan</h5>

                    <table class="table table-sm">
                        <tr>
                            <td>Subtotal</td>
                            <td class="text-right">Rp Rp <?= number_format($grand_total, 0); ?></td>
                        </tr>

                        <tr>
                            <td>Total Berat</td>
                            <td class="text-right"><?= $tot_berat ?> Gr</td>
                        </tr>

                        <tr>
                            <td>Ongkir</td>
                            <td class="text-right">
                                <span id="ongkir">Rp 0</span>
                            </td>
                        </tr>

                        <tr class="font-weight-bold">
                            <td>Total Bayar</td>
                            <td class="text-right">
                                <span id="total_bayar">Rp <span id="total_bayar">Rp <?= number_format($grand_total, 0); ?></span></span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <!-- Hidden Inputs -->
    <input name="no_order" value="<?= $no_order ?>" hidden>
    <input name="estimasi" hidden>
    <input name="ongkir" hidden>
    <input name="berat" value="<?= $tot_berat ?>" hidden>
    <input name="grand_total" value="<?= $grand_total ?>" hidden>
    <input name="total_bayar" value="<?= $grand_total ?>" hidden>

    <!-- Buttons -->
    <div class="row mt-4">
        <div class="col-12 d-flex justify-content-between">
            <a href="<?= base_url('belanja') ?>" class="btn btn-danger px-4">Kembali</a>
            <button type="submit" class="btn btn-primary px-4">
                <i class="fas fa-shopping-cart"></i> Proses Checkout
            </button>
        </div>
    </div>

    <?php echo form_close(); ?>

</div>

<!-- SCRIPT AJAX untuk RajaOngkir (dengan pengembalian fungsionalitas) -->
<script>
    $(document).ready(function() {
        // 1) Load provinsi
        $.ajax({
            type: "post",
            url: "<?= base_url('rajaongkir/provinsi') ?>",
            success: function(hasil_provinsi) {
                $("select[name=provinsi]").html(hasil_provinsi);
            },
            error: function(xhr, status, err) {
                console.error('Error load provinsi:', err);
            }
        });

        // 2) On provinsi change -> load kota
        $("select[name=provinsi]").on("change", function() {
            var id_provinsi_terpilih = $("option:selected", this).attr("id_provinsi");
            $.ajax({
                type: "post",
                url: "<?= base_url('rajaongkir/kota') ?>",
                data: {
                    id_provinsi: id_provinsi_terpilih
                },
                success: function(hasil_kota) {
                    $("select[name=kota]").html(hasil_kota);
                    // kosongkan ekspedisi & paket ketika ganti kota
                    $("select[name=ekspedisi]").html('');
                    $("select[name=paket]").html('');
                    let subtotal = parseInt("<?= (int) $grand_total ?>");
                    $("#ongkir").html('Rp. 0');
                    $("#total_bayar").html("Rp. " + subtotal.toLocaleString('id-ID'));

                },
                error: function(xhr, status, err) {

                    console.warn('API RajaOngkir gagal, gunakan ongkir 0');

                    let subtotal = parseInt("<?= (int) $grand_total ?>");

                    // Ongkir jadi 0
                    $("#ongkir").html("Rp. 0");
                    $("#total_bayar").html("Rp. " + subtotal.toLocaleString('id-ID'))
                    // Set hidden input
                    $("input[name=ongkir]").val(0);
                    $("input[name=total_bayar]").val(subtotal);
                }

            });
        });

        // 3) On kota change -> load ekspedisi
        $("select[name=kota]").on("change", function() {
            $.ajax({
                type: "post",
                url: "<?= base_url('rajaongkir/ekspedisi') ?>",
                success: function(hasil_ekspedisi) {
                    $("select[name=ekspedisi]").html(hasil_ekspedisi);
                    $("select[name=paket]").html('');
                    let subtotal = parseInt("<?= (int) $grand_total ?>");
                    $("#ongkir").html("Rp. 0");
                    $("#total_bayar").html("Rp. " + subtotal.toLocaleString('id-ID'))
                },
                error: function(xhr, status, err) {
                    console.error('Error load ekspedisi:', err);
                }
            });
        });

        // 4) On ekspedisi change -> load paket (ongkir options)
        $("select[name=ekspedisi]").on("change", function() {
            var ekspedisi_terpilih = $("select[name=ekspedisi]").val();
            var id_kota_tujuan_terpilih = $("option:selected", "select[name=kota]").attr('id_kota');
            var total_berat = <?= $tot_berat ?>;

            $.ajax({
                type: "post",
                url: "<?= base_url('rajaongkir/paket') ?>",
                data: {
                    ekspedisi: ekspedisi_terpilih,
                    id_kota: id_kota_tujuan_terpilih,
                    berat: total_berat
                },
                success: function(hasil_paket) {
                    $("select[name=paket]").html(hasil_paket);
                    let subtotal = parseInt("<?= (int) $grand_total ?>");
                    $("#ongkir").html("Rp. 0");
                    $("#total_bayar").html("Rp. " + subtotal.toLocaleString('id-ID'))
                },
                error: function(xhr, status, err) {
                    console.error('Error load paket:', err);
                }
            });
        });

        // 5) On paket change -> tampilkan ongkir & total bayar, serta set hidden inputs
        $("select[name=paket]").on("change", function() {

            let selected = $("option:selected", this);
            let dataongkir = parseInt(selected.attr("ongkir")) || 0;

            let subtotal = parseInt("<?= (int) $grand_total ?>") || 0;

            let total_bayar = subtotal + dataongkir;

            const formatRupiah = (angka) =>
                angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");

            // tampilkan ongkir
            $("#ongkir").html("Rp. " + formatRupiah(dataongkir));

            // tampilkan total bayar
            $("#total_bayar").html("Rp. " + formatRupiah(total_bayar));

            // isi hidden input
            $("input[name=estimasi]").val(selected.attr("estimasi") || "-");
            $("input[name=ongkir]").val(dataongkir);
            $("input[name=total_bayar]").val(total_bayar);
        });


    });
</script>