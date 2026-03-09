<div class="container mt-4">

<?php $active_tab = $this->session->flashdata('active_tab'); ?>

    <ul class="nav nav-tabs" id="orderTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#belumBayar" role="tab">Belum Bayar</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#diproses" role="tab">Diproses</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#dikirim" role="tab">Dikirim</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#selesai" role="tab">Selesai</a>
        </li>
    </ul>

    <div class="tab-content mt-3">

        <!-- TAB BELUM BAYAR -->
        <div class="tab-pane fade show active" id="belumBayar" role="tabpanel">
            <div class="table-responsive-custom">
                <table class="table">
                    <thead>
                        </tr>
                        <th>No Order</th>
                        <th>Gambar Barang</th>
                        <th>Nama Barang</th>
                        <th>Penerima</th>
                        <th>Alamat</th>
                        <th width="120">Tanggal</th>
                        <th>Ekspedisi</th>
                        <th>Total Bayar</th>
                        <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($belum_bayar as $value) {
                            // kumpulkan item terkait untuk order ini
                            $items = array();
                            if (!empty($detail)) {
                                foreach ($detail as $row) {
                                    if (isset($row->no_order) && $row->no_order == $value->no_order) {
                                        $items[] = $row;
                                    }
                                }
                            }
                        ?>
                            <tr>
                                <td><?= $value->no_order ?></td>

                                <td>
                                    <?php if (!empty($items)) {
                                        foreach ($items as $it) {
                                    ?>
                                            <img src="<?= base_url('assets/gambar/') ?><?= htmlspecialchars($it->gambar) ?>" width="80" style="margin-right:6px; margin-bottom:4px;">
                                    <?php
                                        }
                                    } else {
                                        echo '-';
                                    }
                                    ?>
                                </td>

                                <td>
                                    <?php if (!empty($items)) {
                                        foreach ($items as $it) {
                                            echo htmlspecialchars($it->nama_barang) . ' <small>(x' . intval($it->qty) . ')</small><br>';
                                        }
                                    } else {
                                        echo '-';
                                    }
                                    ?>
                                </td>

                                <td><?= $value->nama_penerima ?></td>

                                <td>
                                    <?= $value->provinsi ?>,<br>
                                    <?= $value->kota ?>,<br>
                                    <?= $value->alamat ?><br>
                                    (<?= $value->kode_pos ?>)
                                </td>

                                <td><?= $value->tgl_order ?></td>

                                <td>
                                    <b><?= $value->ekspedisi ?></b><br>
                                    Paket: <?= $value->paket ?><br>
                                    Ongkir: Rp<?= number_format($value->ongkir, 0) ?><br>
                                    Estimasi: <?= $value->estimasi ?>
                                </td>

                                <td>
                                    <b>Rp<?= number_format($value->total_bayar, 0) ?></b><br>

                                    <?php if ($value->status_bayar == 0) { ?>
                                        <span class="badge badge-warning">Belum Bayar</span>
                                    <?php } else { ?>
                                        <span class="badge badge-success">Sudah Bayar</span><br>
                                        <span class="badge badge-primary mt-1">Menunggu Verifikasi</span>
                                    <?php } ?>
                                </td>

                                <td>
                                    <?php if ($value->status_bayar == 0) { ?>
                                        <a href="<?= base_url('pesanan_saya/bayar/' . $value->id_transaksi) ?>" class="btn btn-primary btn-sm">
                                            Bayar Sekarang
                                        </a>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>

                </table>
            </div>
        </div>

        <!-- TAB DIPROSES -->
        <div class="tab-pane fade show" id="diproses" role="tabpanel">
            <div class="table-responsive-custom">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No Order</th>
                            <th>Gambar Barang</th>
                            <th>Nama Barang</th>
                            <th>Penerima</th>
                            <th>Alamat</th>
                            <th>Tanggal</th>
                            <th>Ekspedisi</th>
                            <th>Total Bayar</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($diproses as $value) {
                            $items = array();
                            if (!empty($detail)) {
                                foreach ($detail as $row) {
                                    if (isset($row->no_order) && $row->no_order == $value->no_order) {
                                        $items[] = $row;
                                    }
                                }
                            }
                        ?>
                            <tr>
                                <td><?= $value->no_order ?></td>

                                <td>
                                    <?php if (!empty($items)) {
                                        foreach ($items as $it) {
                                    ?>
                                            <img src="<?= base_url('assets/gambar/') ?><?= htmlspecialchars($it->gambar) ?>" width="80" style="margin-right:6px; margin-bottom:4px;">
                                    <?php
                                        }
                                    } else {
                                        echo '-';
                                    }
                                    ?>
                                </td>

                                <td>
                                    <?php if (!empty($items)) {
                                        foreach ($items as $it) {
                                            echo htmlspecialchars($it->nama_barang) . ' <small>(x' . intval($it->qty) . ')</small><br>';
                                        }
                                    } else {
                                        echo '-';
                                    }
                                    ?>
                                </td>

                                <td><?= $value->nama_penerima ?></td>

                                <td>
                                    <?= $value->provinsi ?>,<br>
                                    <?= $value->kota ?>,<br>
                                    <?= $value->alamat ?><br>
                                    (<?= $value->kode_pos ?>)
                                </td>

                                <td><?= $value->tgl_order ?></td>

                                <td>
                                    <b><?= $value->ekspedisi ?></b><br>
                                    Paket: <?= $value->paket ?><br>
                                    Ongkir: Rp<?= number_format($value->ongkir, 0) ?><br>
                                    Estimasi: <?= $value->estimasi ?>
                                </td>
                                <td><span class="badge badge-success">Rp<?= number_format($value->total_bayar, 0) ?>
                            </span><span class="fas fa-check text-success ml-1"></span></td>
                                <td><span class="badge badge-info">Diproses</span></td>
                            </tr>
                        <?php } ?>
                    </tbody>

                </table>
            </div>
        </div>

        <!-- TAB DIKIRIM -->
        <div class="tab-pane fade" id="dikirim" role="tabpanel">
            <div class="table-responsive-custom">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No Order</th>
                            <th>Gambar Barang</th>
                            <th>Nama Barang</th>
                            <th>Penerima</th>
                            <th>Alamat</th>
                            <th>Tanggal</th>
                            <th>Ekspedisi</th>
                            <th>Resi</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($dikirim as $value) {
                            $items = array();
                            if (!empty($detail)) {
                                foreach ($detail as $row) {
                                    if (isset($row->no_order) && $row->no_order == $value->no_order) {
                                        $items[] = $row;
                                    }
                                }
                            }
                        ?>
                            <tr>
                                <td><?= $value->no_order ?></td>

                                <td>
                                    <?php if (!empty($items)) {
                                        foreach ($items as $it) {
                                    ?>
                                            <img src="<?= base_url('assets/gambar/') ?><?= htmlspecialchars($it->gambar) ?>" width="80" style="margin-right:6px; margin-bottom:4px;">
                                    <?php
                                        }
                                    } else {
                                        echo '-';
                                    }
                                    ?>
                                </td>

                                <td>
                                    <?php if (!empty($items)) {
                                        foreach ($items as $it) {
                                            echo htmlspecialchars($it->nama_barang) . ' <small>(x' . intval($it->qty) . ')</small><br>';
                                        }
                                    } else {
                                        echo '-';
                                    }
                                    ?>
                                </td>

                                <td><?= $value->nama_penerima ?></td>

                                <td>
                                    <?= $value->provinsi ?>,<br>
                                    <?= $value->kota ?>,<br>
                                    <?= $value->alamat ?><br>
                                    (<?= $value->kode_pos ?>)
                                </td>

                                <td><?= $value->tgl_order ?></td>

                                <td>
                                    <b><?= $value->ekspedisi ?></b><br>
                                    Paket: <?= $value->paket ?><br>
                                    Ongkir: Rp<?= number_format($value->ongkir, 0) ?><br>
                                    Estimasi: <?= $value->estimasi ?>
                                </td>

                                <td>
                                    <?php if (!empty($value->no_resi)) { ?>
                                        <b><?= htmlspecialchars($value->no_resi) ?></b>
                                    <?php } else { ?>
                                        -
                                    <?php } ?>

                                <td>
                                    <span class="badge badge-primary">Barang Dikirim</span>
                                    <div class="mt-2">
                                        <a href="<?= base_url('pesanan_saya/diterima/' . intval($value->id_transaksi)) ?>" class="btn btn-success btn-sm btn-terima" data-no-order="<?= htmlspecialchars($value->no_order) ?>">Pesanan Diterima</a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>

                </table>
            </div>
        </div>

        <!-- TAB SELESAI -->
        <div class="tab-pane fade" id="selesai" role="tabpanel">
            <div class="table-responsive-custom">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No Order</th>
                            <th>Gambar Barang</th>
                            <th>Nama Barang</th>
                            <th>Penerima</th>
                            <th>Alamat</th>
                            <th>Tanggal</th>
                            <th>Ekspedisi</th>
                            <th>Total Bayar</th>
                            <th>Resi</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($selesai as $value) {
                            $items = array();
                            if (!empty($detail)) {
                                foreach ($detail as $row) {
                                    if (isset($row->no_order) && $row->no_order == $value->no_order) {
                                        $items[] = $row;
                                    }
                                }
                            }
                        ?>
                            <tr>
                                <td><?= $value->no_order ?></td>

                                <td>
                                    <?php if (!empty($items)) {
                                        foreach ($items as $it) {
                                    ?>
                                            <img src="<?= base_url('assets/gambar/') ?><?= htmlspecialchars($it->gambar) ?>" width="80" style="margin-right:6px; margin-bottom:4px;">
                                    <?php
                                        }
                                    } else {
                                        echo '-';
                                    }
                                    ?>
                                </td>

                                <td>
                                    <?php if (!empty($items)) {
                                        foreach ($items as $it) {
                                            echo htmlspecialchars($it->nama_barang) . ' <small>(x' . intval($it->qty) . ')</small><br>';
                                        }
                                    } else {
                                        echo '-';
                                    }
                                    ?>
                                </td>

                                <td><?= $value->nama_penerima ?></td>

                                <td>
                                    <?= $value->provinsi ?>,<br>
                                    <?= $value->kota ?>,<br>
                                    <?= $value->alamat ?><br>
                                    (<?= $value->kode_pos ?>)
                                </td>

                                <td><?= $value->tgl_order ?></td>

                                <td>
                                    <b><?= $value->ekspedisi ?></b><br>
                                    Paket: <?= $value->paket ?><br>
                                    Ongkir: Rp<?= number_format($value->ongkir, 0) ?><br>
                                    Estimasi: <?= $value->estimasi ?>
                                </td>
                                <td>Rp<?= number_format($value->total_bayar, 0) ?></td>
                                <td>
                                    <?php if (!empty($value->no_resi)) { ?>
                                        <b><?= htmlspecialchars($value->no_resi) ?></b>
                                    <?php } else { ?>
                                        -
                                    <?php } ?>
                                </td>
                                <td><span class="badge badge-success">Selesai</span></td>
                            </tr>
                        <?php } ?>
                    </tbody>

                </table>
            </div>
        </div>

    </div>
</div>
<style>
    /* Import modern sans font */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap');

    :root {
        --accent: #17214B;
        --muted: #6b7280;
    }

    /* Apply font to container */
    .container, .table, .nav-tabs {
        font-family: 'Arial', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
        color: #111827;
    }

    .table-responsive-custom {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        margin-bottom: 16px;
    }

    table.table {
        border-collapse: separate !important;
        border-spacing: 0 8px !important;
        font-size: 12px;
        line-height: 1.45;
    }

    table.table thead th {
        background: var(--accent);
        color: white;
        border: none;
        padding: 12px 14px;
        white-space: nowrap;
        font-size: 14px;
        text-align: left;
        font-weight: 600;
        letter-spacing: 0.2px;
    }

    table.table tbody tr {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.08);
    }

    table.table tbody td {
        background: #fff;
        padding: 12px;
        font-size: 12px;
        vertical-align: middle;
    }

    .badge {
        padding: 6px 10px;
        font-size: 12px;
        border-radius: 6px;
    }

    .nav-tabs .nav-link.active {
        font-weight: bold;
        background: #17214B !important;
        color: #fff !important;
        border-radius: 6px 6px 0 0;
    }

    .nav-tabs .nav-link {
        font-weight: 600;
        color: #333;
    }

    @media(max-width: 768px) {
        .nav-tabs .nav-link {
            padding: 8px;
            font-size: 13px;
        }

        table.table tbody td {
            font-size: 13px;
        }
    }
</style>
<script type="text/javascript">
    // Activate specific tab if set by flashdata
    (function(){
        var active = '<?= isset($active_tab) ? $active_tab : '' ?>';
        if (active) {
            var selector = 'a[data-toggle="tab"][href="#' + active + '"]';
            var $link = document.querySelector(selector);
            if ($link) {
                // using Bootstrap tab show
                $link.click();
            }
        }
    })();
</script>
<script type="text/javascript">
    // Confirm before marking order as received
    document.addEventListener('DOMContentLoaded', function(){
        document.querySelectorAll('.btn-terima').forEach(function(btn){
            btn.addEventListener('click', function(e){
                e.preventDefault();
                var url = this.getAttribute('href');
                var no = this.dataset.noOrder || '';
                if (confirm('Konfirmasi: Pesanan ' + no + ' telah Anda terima?')) {
                    window.location = url;
                }
            });
        });
    });
</script>