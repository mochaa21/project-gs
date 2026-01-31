<div class="sidebar shadow" style="width: 260px; flex-shrink: 0;">
    <div class="brand text-center">
        <h4><i class="fas fa-gamepad text-primary"></i> GameStore</h4>
        <small>Admin Dashboard</small>
    </div>

    <div class="py-2">
        <div class="menu-label">Master Data</div>
        <a href="index.php" class="<?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>">
            <i class="fas fa-compact-disc me-2 text-center" style="width: 20px;"></i> Games
        </a>
        <a href="users.php" class="<?= basename($_SERVER['PHP_SELF']) == 'users.php' ? 'active' : '' ?>">
            <i class="fas fa-users me-2 text-center" style="width: 20px;"></i> Users
        </a>
        <a href="developers.php" class="<?= basename($_SERVER['PHP_SELF']) == 'developers.php' ? 'active' : '' ?>">
            <i class="fas fa-code me-2 text-center" style="width: 20px;"></i> Developers
        </a>
        <a href="publishers.php" class="<?= basename($_SERVER['PHP_SELF']) == 'publishers.php' ? 'active' : '' ?>">
            <i class="fas fa-building me-2 text-center" style="width: 20px;"></i> Publishers
        </a>
        <a href="genres.php" class="<?= basename($_SERVER['PHP_SELF']) == 'genres.php' ? 'active' : '' ?>">
            <i class="fas fa-tags me-2 text-center" style="width: 20px;"></i> Genres
        </a>
        <a href="payment.php" class="<?= basename($_SERVER['PHP_SELF']) == 'payment.php' ? 'active' : '' ?>" style="white-space: nowrap;">
            <i class="fas fa-wallet me-2 text-center" style="width: 20px;"></i> Payment Methods
        </a>
        <a href="discounts.php" class="<?= basename($_SERVER['PHP_SELF']) == 'discounts.php' ? 'active' : '' ?>">
            <i class="fas fa-percent me-2 text-center" style="width: 20px;"></i> Discounts
        </a>
        <a href="sysreqs.php" class="<?= basename($_SERVER['PHP_SELF']) == 'sysreqs.php' ? 'active' : '' ?>">
            <i class="fas fa-desktop me-2 text-center" style="width: 20px;"></i> System Reqs
        </a>
        
        <div class="menu-label">Transaksi</div>
        <a href="trx_pembelian.php" class="<?= basename($_SERVER['PHP_SELF']) == 'trx_pembelian.php' ? 'active' : '' ?>">
            <i class="fas fa-shopping-cart me-2 text-center" style="width: 20px;"></i> Pembelian
        </a>
        <a href="trx_detail.php" class="<?= basename($_SERVER['PHP_SELF']) == 'trx_detail.php' ? 'active' : '' ?>">
            <i class="fas fa-list me-2 text-center" style="width: 20px;"></i> Detail Beli
        </a>
        <a href="trx_topup.php" class="<?= basename($_SERVER['PHP_SELF']) == 'trx_topup.php' ? 'active' : '' ?>">
            <i class="fas fa-money-bill me-2 text-center" style="width: 20px;"></i> Topup Wallet
        </a>
        <a href="trx_review.php" class="<?= basename($_SERVER['PHP_SELF']) == 'trx_review.php' ? 'active' : '' ?>">
            <i class="fas fa-star me-2 text-center" style="width: 20px;"></i> Review User
        </a>
        <a href="trx_wishlist.php" class="<?= basename($_SERVER['PHP_SELF']) == 'trx_wishlist.php' ? 'active' : '' ?>">
            <i class="fas fa-heart me-2 text-center" style="width: 20px;"></i> Wishlist
        </a>

        <div class="menu-label">Laporan Join</div>
        <a href="laporan_penjualan.php" class="<?= basename($_SERVER['PHP_SELF']) == 'laporan_penjualan.php' ? 'active' : '' ?>">
            <i class="fas fa-file-invoice-dollar me-2 text-center" style="width: 20px;"></i> Lap. Penjualan
        </a>
        <a href="laporan_user.php" class="<?= basename($_SERVER['PHP_SELF']) == 'laporan_user.php' ? 'active' : '' ?>">
            <i class="fas fa-file-user me-2 text-center" style="width: 20px;"></i> Lap. Aktivitas
        </a>
    </div>
</div>