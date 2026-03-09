<!-- Default box -->
<div class="card card-solid">
    <div class="card-body">
        <div class="row">

            <!-- LEFT: GAMBAR -->
            <div class="col-12 col-md-6">
                <h3 class="d-md-none mb-2"><?= $barang->nama_barang ?></h3>

                <!-- Gambar Utama -->
                <div class="main-image-wrapper">
                    <img id="mainImage"
                        src="<?= base_url('assets/gambar/' . $barang->gambar) ?>"
                        class="main-product-img"
                        alt="Product Image">
                </div>

                <!-- Thumbnail (klik untuk ganti gambar) -->
                <div class="row mt-3">

                    <!-- Thumb utama -->
                    <div class="col-3 col-sm-2 mb-2">
                        <div class="thumb-item active"
                            data-image="<?= base_url('assets/gambar/' . $barang->gambar) ?>">
                            <img src="<?= base_url('assets/gambar/' . $barang->gambar) ?>"
                                class="thumb-img"
                                alt="thumb">
                        </div>
                    </div>

                    <?php foreach ($gambar as $key => $value) { ?>
                        <div class="col-3 col-sm-2 mb-2">
                            <div class="thumb-item"
                                data-image="<?= base_url('assets/gambarbarang/' . $value->gambar) ?>">
                                <img src="<?= base_url('assets/gambarbarang/' . $value->gambar) ?>"
                                    class="thumb-img"
                                    alt="thumb">
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <!-- RIGHT: DETAIL -->
            <div class="col-12 col-md-6 mt-4 mt-md-0">
                <h3 class="my-3"><?= $barang->nama_barang ?></h3>
                <hr>
                <h5 class="text-muted">Kategori : <?= $barang->nama_kategori ?></h5>
                <hr>

                <p class="text-justify"><?= $barang->deskripsi ?></p>
                <hr>

                <!-- Harga -->
                <div class="py-2 px-3 bg-light rounded mb-3">
                    <h1 class="mb-0 text-success font-weight-bold">
                        Rp.<?= number_format($barang->harga, 0) ?>.-
                    </h1>
                </div>

                <!-- Form Add to Cart -->
                <?php
                echo form_open('belanja/add');
                echo form_hidden('id', $barang->id_barang);
                echo form_hidden('price', $barang->harga);
                echo form_hidden('name', $barang->nama_barang);
                echo form_hidden('redirect_page', str_replace('index.php/', '', current_url()));
                ?>

                <!-- Qty Modern -->
                <div class="col-auto mb-2">
                    <div class="input-group" style="width: 140px;">

                        <div class="input-group-prepend">
                            <button class="btn btn-outline-secondary" type="button" id="btnMinus">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>

                        <input type="text"
                            name="qty"
                            id="qtyInput"
                            class="form-control text-center font-weight-bold"
                            value="1"
                            min="1">

                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="btnPlus">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>

                    </div>
                </div>

                <!-- Tombol (responsive) -->
                <div class="col-12 mt-3">
                    <button type="submit"
                        id="btnAddCart"
                        class="btn btn-primary btn-lg btn-block shadow-sm">

                        <span id="btnText">
                            <i class="fas fa-cart-plus mr-2"></i>
                            Tambah ke Keranjang
                        </span>

                        <span id="btnLoading" class="d-none">
                            <i class="fas fa-spinner fa-spin mr-2"></i>
                            Memproses...
                        </span>

                    </button>
                    <a href="<?= base_url() ?>"
                        class="btn btn-outline-secondary btn-block mt-2">
                        Kembali
                    </a>

                </div>

                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<!-- /.card -->
<style>
    #qtyInput {
        border-left: 0;
        border-right: 0;
    }

    #btnMinus,
    #btnPlus {
        width: 45px;
    }

    .input-group button:hover {
        background-color: #007bff;
        color: white;
    }
</style>
<!-- Style Thumbnail-->
<style>
    .main-image-wrapper {
        width: 100%;
        height: 400px;
        background-color: #f8f9fa;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .main-product-img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        /* ini yang bikin tidak kepotong */
        transition: transform 0.3s ease;
    }

    .main-product-img:hover {
        transform: scale(1.05);
    }

    @media (max-width: 768px) {
        .main-image-wrapper {
            height: 300px;
        }
    }
</style>

<style>
    .thumb-item {
        cursor: pointer;
        border: 2px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .thumb-item:hover {
        border-color: #007bff;
        transform: scale(1.05);
    }

    .thumb-item.active {
        border-color: #28a745;
        box-shadow: 0 0 8px rgba(40, 167, 69, 0.5);
    }

    .thumb-img {
        width: 100%;
        height: 80px;
        object-fit: contain;
    }

    @media (min-width: 992px) {
        .thumb-img {
            height: 90px;
        }
    }
</style>
<!--Style Button -->
<style>
    .btn-lg {
        height: 50px;
        font-size: 16px;
        border-radius: 8px;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        transition: 0.2s ease;
    }

    .btn-outline-secondary {
        border-radius: 8px;
    }
</style>

<!-- AdminLTE for demo purposes -->
<script src="<?= base_url() ?>template/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="<?= base_url() ?>template/dist/js/demo.js"></script>
<script>
    $(function() {

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1500
        });

        <?php if ($this->session->flashdata('success')): ?>
            Toast.fire({
                icon: 'success',
                title: '<?= $this->session->flashdata('success') ?>'
            });

            setTimeout(function() {
                window.location.href = "<?= base_url('belanja') ?>";
            }, 1600);
        <?php endif; ?>

    });
</script>
<script>
    $(function() {

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1500
        });

        <?php if ($this->session->flashdata('success')): ?>
            Toast.fire({
                icon: 'success',
                title: 'Barang berhasil ditambahkan!'
            });

            setTimeout(function() {
                window.location.href = "<?= base_url('belanja') ?>";
            }, 1600);
        <?php endif; ?>

    });
</script>
<script>
    const mainImage = document.getElementById('mainImage');
    const thumbs = document.querySelectorAll('.thumb-item');

    thumbs.forEach(thumb => {
        thumb.addEventListener('click', function() {

            // ganti gambar utama
            mainImage.src = this.dataset.image;

            // hilangkan active di semua thumbnail
            thumbs.forEach(t => t.classList.remove('active'));

            // tandai thumbnail yang dipilih
            this.classList.add('active');
        });
    });
</script>
<script>
    const qtyInput = document.getElementById("qtyInput");
    const btnPlus = document.getElementById("btnPlus");
    const btnMinus = document.getElementById("btnMinus");

    btnPlus.addEventListener("click", function() {
        qtyInput.value = parseInt(qtyInput.value) + 1;
    });

    btnMinus.addEventListener("click", function() {
        if (parseInt(qtyInput.value) > 1) {
            qtyInput.value = parseInt(qtyInput.value) - 1;
        }
    });

    // supaya tidak bisa isi angka minus manual
    qtyInput.addEventListener("input", function() {
        if (this.value < 1) {
            this.value = 1;
        }
    });
</script>