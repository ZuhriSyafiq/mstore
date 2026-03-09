<nav class="main-header navbar navbar-expand-lg navbar-dark navbar-navy">

    <div class="container">

        <style>
            /* Boxed Home nav link */
            .nav-home-box {
                display: inline-flex;
                align-items: center;
                gap: .35rem;
                padding: .28rem .6rem;
                border: 1px solid rgba(255,255,255,0.12);
                border-radius: 6px;
                transition: background-color .12s ease, transform .06s ease;
                color: #fff !important;
            }
            .nav-home-box:hover, .nav-home-box:focus {
                background-color: rgba(255,255,255,0.07);
                transform: translateY(-1px);
                text-decoration: none;
            }
            @media (max-width: 991.98px) {
                .nav-home-box { padding: .22rem .45rem; }
            }
        </style>

        <!-- Brand -->
        <a href="<?= base_url() ?>" class="navbar-brand">
           <img src="<?= base_url() ?>assets/logo/logo.png.png" alt="Mstore Logo" style="opacity:.8" width="40px">
            <span class="brand-text font-weight-light"><b> Mstore</b></span>
        </a>
        

        <!-- Hamburger -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMain"
            aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- NAVBAR CONTENT -->
        <div class="collapse navbar-collapse" id="navbarMain">

            <!-- LEFT MENU -->
            <ul class="navbar-nav mr-auto ml-4">
                <li class="nav-item">
                    <a href="<?= base_url() ?>" class="nav-link nav-home-box" aria-label="Beranda"><i class="fas fa-home"></i> Home</a>
                </li>

                <!-- Dropdown Kategori -->
                <?php $kategori = $this->m_home->get_all_data_kategori(); ?>
                <li class="nav-item dropdown ml-2">
                    <a href="#" class="nav-link nav-home-box dropdown-toggle" data-toggle="dropdown">
                        Kategori
                    </a>
                    <div class="dropdown-menu">
                        <a href="#" class="dropdown-item category-filter" data-category-id="0">Semua</a>
                        <?php foreach ($kategori as $key => $value) { ?>
                            <a href="#" data-category-id="<?= $value->id_kategori ?>" class="dropdown-item category-filter">
                                <?= $value->nama_kategori ?>
                            </a>
                        <?php } ?>
                    </div>
                </li>

            </ul>

            <!-- RIGHT MENU (Keranjang + User) -->
            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">

                <!-- Search -->
                    <!-- Search (desktop) -->
                    <li class="nav-item d-none d-lg-block mr-2 mt-2">
                        <form id="navSearchForm" class="form-inline" action="<?= base_url('home/search') ?>" method="get">
                            <div class="input-group">
                                <input id="navSearch" name="q" class="form-control form-control-sm" type="search" placeholder="Cari produk..." aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-sm btn-light" type="submit"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                            <div id="navSearchList" class="list-group position-absolute" style="z-index:1100; display:none; max-height:280px; overflow:auto; width:260px;"></div>
                        </form>
                    </li>

                    <!-- Search (mobile) - visible inside collapsed navbar -->
                    <li class="nav-item d-block d-lg-none w-100">
                        <form id="navSearchFormMobile" class="form-inline w-100 p-2" action="<?= base_url('home/search') ?>" method="get">
                            <div class="input-group w-100">
                                <input id="navSearchMobile" name="q" class="form-control form-control-sm" type="search" placeholder="Cari produk..." aria-label="Search Mobile">
                                <div class="input-group-append">
                                    <button class="btn btn-sm btn-light" type="submit"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                            <div id="navSearchListMobile" class="list-group position-relative" style="display:none; max-height:260px; overflow:auto; margin-top:6px;"></div>
                        </form>
                    </li>

                <!-- Keranjang -->
                <!-- Keranjang -->
                <?php
                $id_pelanggan = $this->session->userdata('id_pelanggan');

                $jml_item = 0;
                $total = 0;
                $keranjang = [];

                if ($id_pelanggan) {
                    $this->load->model('M_cart');
                    $keranjang = $this->M_cart->get_cart_by_pelanggan($id_pelanggan);

                    foreach ($keranjang as $item) {
                        $subtotal = $item->harga * $item->qty;
                        $total += $subtotal;
                        $jml_item += $item->qty;
                    }
                }
                ?>

                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fas fa-shopping-cart fa-lg fa-2x"></i>
                        <span class="badge-danger navbar-badge"><?= $jml_item ?></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <?php if (empty($keranjang)) { ?>
                            <span class="dropdown-item">Keranjang Kosong</span>
                        <?php } else { ?>

                            <?php foreach ($keranjang as $item) {
                                $subtotal = $item->harga * $item->qty;
                            ?>
                                <a href="#" class="dropdown-item">
                                    <div class="media">
                                        <img src="<?= base_url('assets/gambar/' . $item->gambar) ?>"
                                            class="img-size-50 mr-3">
                                        <div class="media-body">
                                            <h3 class="dropdown-item-title"><?= $item->nama_barang ?></h3>
                                            <p class="text-sm">
                                                <?= $item->qty ?> x Rp.<?= number_format($item->harga, 0) ?>
                                            </p>
                                            <p class="text-sm text-muted">
                                                <i class="fa fa-calculator"></i>
                                                Rp.<?= number_format($subtotal) ?>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                                <div class="dropdown-divider"></div>
                            <?php } ?>

                            <div class="dropdown-item text-right font-weight-bold">
                                Total: Rp.<?= number_format($total) ?>
                            </div>

                            <div class="dropdown-divider"></div>
                            <a href="<?= base_url('belanja') ?>" class="dropdown-item dropdown-footer">
                              <span><i class="fas fa-eye mr-2"></i> View Cart</span> 
                            </a>
                            <a href="<?= base_url('belanja/checkout') ?>" class="dropdown-item dropdown-footer">
                                Check Out
                            </a>

                        <?php } ?>

                    </div>
                </li>

                <!-- Login / User -->
                <li class="nav-item dropdown">
                    <?php if ($this->session->userdata('email') == "") { ?>
                        <a class="nav-link" href="<?= base_url('pelanggan/login') ?>">
                            <img src="<?= base_url() ?>template/dist/img/AdminLTELogo.png"
                                class="brand-image img-circle elevation-3" style="opacity:.8">
                            <span class="brand-text font-weight-light">Log In</span>
                        </a>
                    <?php } else { ?>
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
                            <img src="<?= base_url() ?>assets/foto/profil.jpg"
                                class="brand-image img-circle elevation-3" style="opacity:.8">
                            <span class="brand-text font-weight-light"><?= $this->session->userdata('nama_pelanggan') ?></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="<?= base_url('pelanggan/akun') ?>" class="dropdown-item">
                                <i class="fas fa-user mr-2"></i> Akun Saya
                            </a>
                            <div class="dropdown-divider"></div>

                            <a href="<?= base_url('pesanan_saya') ?>" class="dropdown-item">
                                <i class="fas fa-box-open mr-2"></i> Pesanan Saya
                            </a>
                            <div class="dropdown-divider"></div>

                            <a href="<?= base_url('pelanggan/logout') ?>" class="dropdown-item dropdown-footer">
                                <i class="fas fa-sign-out-alt mr-2"></i>Log Out
                            </a>
                        </div>
                    <?php } ?>
                </li>

            </ul>
        </div>

    </div>
</nav>
<script type="text/javascript">
    // When a category in navbar is clicked, trigger a document event
    $(document).on('click', '.category-filter', function(e) {
        e.preventDefault();
        var catId = $(this).data('category-id');
        // close dropdown (Bootstrap)
        $(this).closest('.dropdown').find('.dropdown-toggle').dropdown('toggle');
        // trigger global event
        $(document).trigger('filter-category', [catId]);
        // mark active
        $(this).closest('.dropdown-menu').find('.category-filter').removeClass('active');
        $(this).addClass('active');
    });
</script>
<script type="text/javascript">
    // Nav search typeahead: use products present on page as suggestions when available
    (function() {
        var $input = $('#navSearch');
        var $list = $('#navSearchList');
        var products = [];

        // collect products if present on page (from .card-clickable)
        $('.card-clickable').each(function() {
            var $c = $(this);
            var name = $c.find('.card-header b').text().trim();
            var href = $c.data('href');
            var img = $c.find('img').attr('src') || '';
            if (name) products.push({ name: name, href: href, img: img });
        });

        function showList(items, $listEl) {
            if (!items.length) { $listEl.hide().empty(); return; }
            $listEl.empty();
            items.slice(0,8).forEach(function(it) {
                var $item = $('<a href="#" class="list-group-item list-group-item-action d-flex align-items-center"></a>');
                if (it.img) $item.append('<img src="'+it.img+'" style="width:40px;height:40px;object-fit:cover;border-radius:4px;margin-right:8px;">');
                $item.append('<div><div style="font-weight:600">'+it.name+'</div></div>');
                $item.data('href', it.href);
                $listEl.append($item);
            });
            $listEl.show();
        }

        // debounce helper
        function debounce(fn, delay){ var t; return function(){ clearTimeout(t); t = setTimeout(fn.bind(this, arguments), delay); }; }

        function attachTypeahead($inputEl, $listEl) {
            $inputEl.on('input', debounce(function() {
                var q = $(this).val().trim().toLowerCase();
                if (!q) { $listEl.hide(); return; }
                if (products.length) {
                    var matched = products.filter(function(p){ return p.name.toLowerCase().indexOf(q) !== -1; });
                    showList(matched, $listEl);
                } else {
                    $listEl.hide();
                }
            }, 150));

            // click suggestion
            $(document).on('click', $listEl.selector + ' .list-group-item', function(e){
                e.preventDefault();
                var href = $(this).data('href');
                if (href) window.location = href;
            });

            // hide on outside click
            $(document).on('click', function(e){ if (!$(e.target).closest($listEl.selector + ', ' + $inputEl.selector).length) $listEl.hide(); });

            // Enter key behavior
            $inputEl.on('keydown', function(e){
                if (e.keyCode === 13) {
                    var first = $listEl.find('.list-group-item').first();
                    if (first.length) {
                        e.preventDefault();
                        window.location = first.data('href');
                    }
                }
            });
        }

        // attach to desktop input
        attachTypeahead($input, $list);

        // attach to mobile input if present
        var $inputMobile = $('#navSearchMobile');
        var $listMobile = $('#navSearchListMobile');
        if ($inputMobile.length && $listMobile.length) {
            attachTypeahead($inputMobile, $listMobile);
        }
    })();
</script>