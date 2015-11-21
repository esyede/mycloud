<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dasbor</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-tasks fa-fw"></i> Berkas - berkas<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="akun.php?aksi=unggah_berkas"><i class="fa fa-upload fa-fw"></i> Unggah berkas</a>
                    </li>
                    <li>
                        <a href="akun.php?aksi=lihat_berkas"><i class="fa fa-th fa-fw"></i> Daftar berkas</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="akun.php?aksi=ganti_pass"><i class="fa fa-cogs fa-fw"></i> Ganti sandi</a>
            </li>
            <?php
            if(dia_dosen()) { ?>
              <li>
                <a href="#"><i class="fa fa-key fa-fw"></i> Menu dosen<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="dosen.php?aksi=list_akun"><i class="fa fa-sitemap fa-fw"></i> List akun</a>
                    </li>
                    <li>
                        <a href="dosen.php?aksi=tambah_akun"><i class="fa fa-plus fa-fw"></i> Tambahkan akun</a>
                    </li>
                    <li>
                        <a href="dosen.php?aksi=buat_info"><i class="fa fa-bullhorn fa-fw"></i> Buat Informasi</a>
                    </li>
                </ul>
            </li> <?php } ?>
            <li>
                <a href="#"><i class="fa fa-shield fa-fw"></i> Panduan<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="panduan.php?baca=unggah_berkas"><i class="fa fa-question-circle fa-fw"></i> Mengunggah berkas</a>
                    </li>
                    <li>
                        <a href="panduan.php?baca=ganti_pass"><i class="fa fa-question-circle fa-fw"></i> Mengganti sandi</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
</nav>
