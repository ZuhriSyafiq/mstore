<div class="container-fluid mt-3">
    <div class="row">

        <!-- ================= LEFT : CART ITEMS ================= -->
        <div class="col-lg-8">

            <?php echo form_open('belanja/update'); ?>

            <?php
            $i = 1;
            $tot_berat = 0;
            foreach ($cart as $row):
                $barang = $this->m_home->detail_barang($row->id_barang);
                $berat = $row->qty * $barang->berat;
                $tot_berat += $berat;
            ?>

                <div class="cart-item mb-3">
                    <div class="row align-items-center">

                        <!-- Gambar -->
                        <div class="col-3 col-md-2">
                            <img src="<?= base_url('assets/gambar/' . $barang->gambar) ?>"
                                class="cart-img">
                        </div>

                        <!-- Info -->
                        <div class="col-9 col-md-4">
                            <h6 class="mb-1 font-weight-bold"><?= $barang->nama_barang ?></h6>
                            <small class="text-muted"><?= $barang->berat ?> gr</small>
                            <div class="text-danger font-weight-bold mt-1">
                                Rp <?= number_format($row->harga, 0) ?>
                            </div>
                        </div>

                        <!-- Qty -->
                        <div class="col-6 col-md-3 mt-3 mt-md-0">
                            <div class="qty-box">
                                <button type="button" onclick="decrementValue(this)">−</button>
                                <input type="number" min="1"
                                    name="<?= $i . '[qty]' ?>"
                                    value="<?= $row->qty ?>"
                                    data-price="<?= $row->harga ?>"
                                    data-id="<?= $row->id ?>"
                                    class="qty-input">
                                <button type="button" onclick="increamentValue(this)">+</button>
                            </div>
                        </div>

                        <!-- Subtotal + Hapus -->
                        <div class="col-6 col-md-3 text-right mt-3 mt-md-0">
                            <div class="font-weight-bold subtotal">
                                Rp <span class="subtotal-value">
                                    <?= number_format($row->subtotal, 0) ?>
                                </span>
                            </div>
                            <a href="<?= base_url('belanja/hapus/' . $row->id) ?>"
                                class="text-danger small">
                                Hapus
                            </a>
                        </div>

                    </div>
                </div>

            <?php $i++;
            endforeach; ?>

        </div>


        <!-- ================= RIGHT : SUMMARY ================= -->
        <div class="col-lg-4 mt-4 mt-lg-0">

            <div class="cart-summary">

                <h5 class="font-weight-bold mb-3">Ringkasan Belanja</h5>

                <div class="d-flex justify-content-between mb-2">
                    <span>Total Harga</span>
                    <span class="font-weight-bold">
                        Rp <span id="grandTotalDisplay">
                            <?= number_format($total, 0) ?>
                        </span>
                    </span>
                </div>

                <div class="d-flex justify-content-between mb-3">
                    <span>Total Berat</span>
                    <span><?= $tot_berat ?> gr</span>
                </div>
                <a href="<?= base_url('belanja/checkout') ?>"
                    class="btn btn-success btn-block btn-lg mt-2">
                    Checkout
                </a>

            </div>

            <?php echo form_close(); ?>

        </div>

    </div>
</div>

<style>
    .cart-item {
        background: #fff;
        padding: 15px;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        transition: 0.2s ease;
    }

    .cart-item:hover {
        transform: translateY(-2px);
    }

    .cart-img {
        width: 100%;
        height: 100px;
        object-fit: contain;
    }

    .qty-box {
        display: flex;
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
        width: fit-content;
    }

    .qty-box button {
        width: 35px;
        border: none;
        background: #f8f9fa;
        font-size: 18px;
    }

    .qty-box input {
        width: 50px;
        text-align: center;
        border: none;
    }

    .cart-summary {
        background: #fff;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        position: sticky;
        top: 20px;
    }

    .btn-warning {
        background: #ff6600;
        border: none;
    }

    .btn-warning:hover {
        background: #e65c00;
    }

    .card:hover {
        background: #f7faff;
        transition: .2s;
    }

    .input-group .btn {
        width: 38px;
    }
</style>

<script>
    function formatRupiah(angka) {
        return angka.toLocaleString('id-ID');
    }

    function updateCartUI() {

        let grandTotal = 0;

        document.querySelectorAll('.cart-item').forEach(function(item) {

            let qtyInput = item.querySelector('.qty-input');
            let price = parseInt(qtyInput.dataset.price);
            let qty = parseInt(qtyInput.value);

            let subtotal = price * qty;

            // update subtotal
            item.querySelector('.subtotal-value').innerText = formatRupiah(subtotal);

            grandTotal += subtotal;
        });

        // update total ringkasan
        document.getElementById('grandTotalDisplay').innerText = formatRupiah(grandTotal);
    }

    function updateServerCart(inputElement) {

        let id = inputElement.dataset.id;
        let qty = inputElement.value;

        fetch("<?= base_url('belanja/update_qty_ajax') ?>", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                },
                body: "id=" + id + "&qty=" + qty
            })
            .then(response => response.json())
            .then(data => {

                if (data.grand_total) {
                    document.getElementById('grandTotalDisplay')
                        .innerText = formatRupiah(parseInt(data.grand_total));
                }

            });
    }

    function increamentValue(btn) {
        let input = btn.parentNode.children[1];
        input.value = parseInt(input.value || 1) + 1;
        updateCartUI();
        updateServerCart(input);
    }

    function decrementValue(btn) {
    let input = btn.parentNode.children[1];
    if (parseInt(input.value) > 1) {
        input.value = parseInt(input.value) - 1;
        updateCartUI();
        updateServerCart(input); // TAMBAHKAN INI
    }
}

    // kalau user ketik manual
    document.querySelectorAll('.qty-input').forEach(function(input) {
        input.addEventListener('input', function() {
            if (this.value < 1) this.value = 1;
            updateCartUI();
            updateServerCart(this);
        });
    });
</script>