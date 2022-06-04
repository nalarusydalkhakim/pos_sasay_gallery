<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
			<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('dashboard') ?>">
				<div class="sidebar-brand-icon">
				<img  class="fas" src="<?php echo base_url('/sb-admin/img/logo_sample.png'); ?>" />	
				</div>
				<!-- <div class="sidebar-brand-text mx-3">Sasay</div> -->
			</a>
			<hr class="sidebar-divider my-0">
			<li class="nav-item <?= $aktif == 'dashboard' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('dashboard') ?>">
					<i class="fas fa-fw fa-tachometer-alt"></i>
					<span>Dashboard</span></a>
			</li>
			<hr class="sidebar-divider">

			<!-- Divider -->

			<div class="sidebar-heading">
				Master
			</div>

			<li class="nav-item <?= $aktif == 'barang' ? 'active' : '' ?>">
				<a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseBarang"
                    aria-expanded="true" aria-controls="collapseUtilities">
					<i class="fas fa-fw fa-box"></i>
					<span>Master Barang</span>
				</a>
				<div id="collapseBarang" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Barang:</h6>
                        <a class="collapse-item" href="<?= base_url('barang') ?>">Barang</a>
                        <a class="collapse-item" href="<?= base_url('brand') ?>">Brand</a>
                    </div>
                </div>
			</li>

			<li class="nav-item <?= $aktif == 'kasir' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('kasir') ?>">
					<i class="fas fa-fw fa-cash-register"></i>
					<span>Master Kasir</span></a>
			</li>

			<li class="nav-item <?= $aktif == 'pelanggan' ? 'active' : '' ?>">
				<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePelanggan"
                    aria-expanded="true" aria-controls="collapsePelanggan">
					<i class="fas fa-fw fa-users"></i>
					<span>Master Customer</span>
				</a>
				<div id="collapsePelanggan" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Customer:</h6>
						<a class="collapse-item" href="<?= base_url('pelanggan') ?>">Data</a>
						<!-- <a class="collapse-item" href="<?= base_url('level') ?>">Level</a> -->
						<?php if ($this->session->login['role'] == 'admin'): ?>
							<a class="collapse-item" href="<?= base_url('pelanggan/laporan') ?>">Laporan</a>
						<?php endif ?>
                    </div>
                </div>
			</li>

			<?php if ($this->session->login['role'] == 'admin'): ?>
			<!-- master bank -->
			<li class="nav-item <?= $aktif == 'bank' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('bank') ?>">
					<i class="fas fa-fw fa-money-check"></i>
					<span>Master Bank</span></a>
			</li>
			<?php endif ?>

			<!-- Divider -->
			<hr class="sidebar-divider">
			<div class="sidebar-heading">
				Transaksi
			</div>
			<!-- Transaksi -->
			<li class="nav-item <?= $aktif == 'penjualan' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('penjualan') ?>">
					<i class="fas fa-fw fa-cash-register"></i>
					<span>Transaksi Penjualan</span></a>
			</li>
			<?php if ($this->session->login['role'] == 'admin'): ?>
			<!-- Pengeluaran -->
			<li class="nav-item <?= $aktif == 'pengeluaran' ? 'active' : '' ?>">
				<a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePengeluaran"
                    aria-expanded="true" aria-controls="collapseUtilities">
					<i class="fas fa-fw fa-file-invoice"></i>
					<span>Pengeluaran</span></a>
				</a>
				<div id="collapsePengeluaran" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Pengeluaran:</h6>
                        <a class="collapse-item" href="<?= base_url('pengeluaran') ?>">Pengeluaran</a>
                        <a class="collapse-item" href="<?= base_url('akun') ?>">Akun</a>
                    </div>
                </div>
			</li>
			<?php endif ?>
			<!-- Laporan -->
			<?php if ($this->session->login['role'] == 'admin'): ?>
			<li class="nav-item <?= $aktif == 'laporan' ? 'active' : '' ?>">
				<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTransaksi"
                    aria-expanded="true" aria-controls="collapseTransaksi">
					<i class="fas fa-fw fa-file"></i>
					<span>Rangkuman</span>
				</a>
				<div id="collapseTransaksi" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Rangkuman:</h6>
						<!-- <a class="collapse-item" href="<?= base_url('laporan') ?>">Harian</a> -->
						<a class="collapse-item" href="<?= base_url('laporan/bulanan') ?>">Bulanan</a>
						<a class="collapse-item" href="<?= base_url('laporan/tahunan') ?>">Tahunan</a>
                    </div>
                </div>
			</li>
			<?php endif ?>

			<hr class="sidebar-divider">
			<?php if ($this->session->login['role'] == 'admin'): ?>
				<!-- Divider -->
				<!-- Heading -->
				<div class="sidebar-heading">
					Lainya
				</div>

				<li class="nav-item <?= $aktif == 'pengguna' ? 'active' : '' ?>">
					<a class="nav-link" href="<?= base_url('pengguna') ?>">
						<i class="fas fa-fw fa-user"></i>
						<span>Manajemen Pengguna</span></a>
				</li>

				<li class="nav-item <?= $aktif == 'toko' ? 'active' : '' ?>">
					<a class="nav-link" href="<?= base_url('toko') ?>">
						<i class="fas fa-fw fa-building"></i>
						<span>Profil Toko</span></a>
				</li>
				<li class="nav-item <?= $aktif == 'bantuan' ? 'active' : '' ?>">
					<a class="nav-link" href="<?= base_url('bantuan') ?>">
						<i class="fas fa-fw fa-question-circle"></i>
						<span>Bantuan</span></a>
				</li>
				<!-- Divider -->
				<hr class="sidebar-divider d-none d-md-block">
			<?php endif; ?>

			<!-- Sidebar Toggler (Sidebar) -->
			<div class="text-center d-none d-md-inline">
				<button class="rounded-circle border-0" id="sidebarToggle"></button>
			</div>
		</ul>