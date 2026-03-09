<!-- flash messages are shown via JavaScript to avoid layout shifts -->
<div id="carouselExampleIndicators" class="carousel slide carousel-fade modern-carousel" data-ride="carousel" data-interval="3000">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="<?= base_url() ?>assets/slider/slider1.jpg" class="d-block w-100 slider-img">
            <div class="carousel-overlay"></div>
        </div>
        <div class="carousel-item">
            <img src="<?= base_url() ?>assets/slider/slider8.jpg" class="d-block w-100 slider-img">
            <div class="carousel-overlay"></div>
        </div>
        <div class="carousel-item">
            <img src="<?= base_url() ?>assets/slider/slider7.jpg" class="d-block w-100 slider-img">
            <div class="carousel-overlay"></div>
        </div>
        <div class="carousel-item">
            <img src="<?= base_url() ?>assets/slider/slider4.jpg" class="d-block w-100 slider-img">
            <div class="carousel-overlay"></div>
        </div>
        <div class="carousel-item">
            <img src="<?= base_url() ?>assets/slider/slider5.jpg" class="d-block w-100 slider-img">
            <div class="carousel-overlay"></div>
        </div>
        <div class="carousel-item">
            <img src="<?= base_url() ?>assets/slider/slider6.jpg" class="d-block w-100 slider-img">
            <div class="carousel-overlay"></div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon"></span>
    </a>
</div>
<style>
    /* Slider: responsive heights for different viewports */
    .modern-carousel {
        position: relative;
        overflow: hidden;
    }

    .modern-carousel .carousel-item {
        height: 220px; /* default (tablet / small desktop) */
        transition: height .18s ease-in-out;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .modern-carousel .slider-img {
        object-fit: cover;
        height: 100%;
        min-width: 100%;
        display: block;
        transition: transform 4s ease-in-out;
        transform: scale(1);
    }

    /* Fade + gentle zoom animation for nicer auto-advance */
    .modern-carousel.carousel-fade .carousel-item {
        transition: opacity .7s ease-in-out;
    }

    .modern-carousel .carousel-item.active .slider-img {
        transform: scale(1.03);
    }

    .modern-carousel .carousel-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
    }

    .modern-carousel .carousel-caption {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: #fff;
    }

    /* Card clickable pointer + focus style for accessibility */
    .card-clickable { cursor: pointer; }
    .card-clickable:focus { outline: 3px solid rgba(0,123,255,0.18); outline-offset: 2px; }

    /* Mobile: make slider smaller */
    @media (max-width: 400.98px) {
        .modern-carousel .carousel-item {
            height: 150px;
        }
    }

    /* Small to medium devices */
    @media (min-width: 576px) and (max-width: 991.98px) {
        .modern-carousel .carousel-item {
            height: 300px;
        }
    }

    /* Large devices and up: slightly taller */
    @media (min-width: 992px) {
        .modern-carousel .carousel-item {
            height: 380px;
        }
    }
</style>

<div class="card card-solid">
    <div class="card-body pb-0" style="background-color: #FFFFF0;">
        <div class="row">
            <?php foreach ($barang as $key => $value) { ?>

                <!-- 2 kolom di HP -->
                <div class="col-6 col-sm-6 col-md-4 col-lg-3 mb-0">

                    <?php
                    echo form_open('belanja/add');
                    echo form_hidden('id', $value->id_barang);
                    echo form_hidden('qty', 1);
                    echo form_hidden('price', $value->harga);
                    echo form_hidden('name', $value->nama_barang);
                    echo form_hidden('redirect_page', str_replace('index.php/', '', current_url()));
                    ?>

                    <div class="card h-90 d-flex flex-column p-2 shadow-sm card-clickable" role="button" tabindex="0" data-category-id="<?= $value->id_kategori ?>" data-href="<?= base_url('home/detail_barang/' . $value->id_barang) ?>" aria-label="Lihat detail <?= htmlspecialchars($value->nama_barang, ENT_QUOTES) ?>" style="background-color: #CBDFF4;">
                        <div class="card-header text-muted p-1">
                            <h2 class="lead text-truncate mb-1" style="font-size: 14px;">
                                <b><?= $value->nama_barang ?></b>
                            </h2>
                            <p class="text-muted text-sm mb-0" style="font-size: 10px;">
                                <b>Kategori:</b> <?= $value->nama_kategori ?>
                            </p>
                        </div>

                        <div class="card-body text-center p-2 d-flex align-items-center justify-content-center">
                            <img src="<?= base_url('assets/gambar/' . $value->gambar) ?>"
                                class="img-fluid"
                                style="height: 140px; object-fit: cover; border-radius: 6px;">
                        </div>

                        <div class="card-footer p-2 mt-auto">
                            <!-- MOBILE: flex-column | DESKTOP: flex-row -->
                            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">

                                <!-- Harga -->
                                <span class="font-weight-bold mb-2 mb-md-0" style="font-size: 14px;">
                                    Rp <?= number_format($value->harga, 0) ?>
                                </span>

                                <!-- Tombol -->
                                <div class="d-flex">
                                    <button type="submit"
                                        class="btn btn-primary btn-sm swalDefaultSuccess d-flex align-items-center justify-content-center ml-2"
                                        style="width: 32px; height: 32px; margin-left: 6px;">
                                        <i class="fas fa-cart-plus"></i>
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>

                    <?php echo form_close(); ?>
                </div>

            <?php } ?>
        </div>
    </div>
</div>


<script src="<?= base_url() ?>template/plugins/sweetalert2/sweetalert2.min.js"></script>
<script type="text/javascript">
    $(function() {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        $('.swalDefaultSuccess').click(function() {
            Toast.fire({
                icon: 'success',
                title: 'Barang Berhasil Di Tambahkan Ke Keranjang'
            })
        });

        // display any server-side flash message via Toast as well
        <?php if($msg = $this->session->flashdata('pesan')): ?>
            Toast.fire({
                icon: 'success',
                title: <?= json_encode($msg) ?>
            });
        <?php endif; ?>
        <?php if($msg = $this->session->flashdata('error')): ?>
            Toast.fire({
                icon: 'error',
                title: <?= json_encode($msg) ?>
            });
        <?php endif; ?>
    });
</script>
<!-- Fallback: pastikan carousel auto-advance setiap 3 detik -->
<script type="text/javascript">
    $(document).ready(function() {
        if (typeof $.fn.carousel === 'function') {
            $('#carouselExampleIndicators').carousel({ interval: 3000 });
        }
    });
</script>
<script type="text/javascript">
    // Klik pada card (selain tombol/anchor/input) akan membuka halaman detail
    $(document).on('click', '.card-clickable', function(e) {
        // jika klik berasal dari tombol, link, atau input, jangan navigasi
        if ($(e.target).closest('button, a, input, select, textarea, label').length) return;
        var href = $(this).data('href');
        if (href) window.location = href;
    });
</script>
<script type="text/javascript">
    // Handle category filtering triggered by navbar (filter-category event)
    $(document).on('filter-category', function(e, catId) {
        // Normalize
        var id = String(catId);
        if (!id || id === '0') {
            // show all product columns
            $('.card-clickable').closest('[class*="col-"]').show();
            return;
        }
        $('.card-clickable').each(function() {
            var mine = String($(this).data('category-id'));
            var $col = $(this).closest('[class*="col-"]');
            if (mine === id) {
                $col.show();
            } else {
                $col.hide();
            }
        });

        // scroll to product grid for visibility
        var $grid = $('.card-solid');
        if ($grid.length) {
            $('html, body').animate({ scrollTop: $grid.offset().top - 70 }, 300);
        }
    });
</script>