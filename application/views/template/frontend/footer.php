<footer class="footer bg-white">

    <!-- Footer Top Area -->
    <div class="footer-toparea border-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-12">
                    <div class="footer-widget widget-info">
                        <h5 class="footer-widget-title">Kontak Kami</h5>
                        <p>Hubungi kontak dibawah ini bila ada pertanyaan</p>
                        <ul>
                            <li class="text-muted"><i class="ion ion-ios-pin text-muted"></i> <?= $website['alamat']; ?> </li>
                            <li class="text-muted"><i class="ion ion-ios-call text-muted"></i> Telepon : +<?= $website['telepon']; ?></li>
                            <li class="text-muted"><i class="ion ion-ios-mail text-muted"></i> Email : <?= $website['email']; ?></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4">
                    <div class="footer-widget widget-links">
                        <h5 class="footer-widget-title">PEMBAYARAN</h5>
                        <ul>
                            <li><a href="#">&nbsp;&nbsp;Alfamart</a></li>
                            <li><a href="#">&nbsp;&nbsp;Indomaret</a></li>
                            <li><a href="#">&nbsp;&nbsp;Bank Transfer</a></li>
                            <li><a href="#">&nbsp;&nbsp;Pembayaran QR</a></li>
                        </ul>

                    </div>
                </div>
                <div class="col-lg-2 col-md-4">
                    <div class="footer-widget widget-links">
                        <h5 class="footer-widget-title">IKUTI KAMI</h5>
                        <ul>
                            <li><a href="https://instagram.com/bkmcic/" target="_blank"><i class="ion ion-logo-instagram"></i>&nbsp;&nbsp;Instagram</a></li>
                            <li><a href="https://facebook.com/bkm.cic/" target="_blank"><i class="ion ion-logo-facebook"></i>&nbsp;&nbsp;Facebook</a></li>
                            <li><a href="https://twitter.com/bkmcic/" target="_blank"><i class="ion ion-logo-twitter"></i>&nbsp;&nbsp;Twitter</a></li>
                            <li><a href="https://www.youtube.com/channel/UCIhuRHN9F_tUXx-EMziVWlg/" target="_blank"><i class="ion ion-logo-youtube"></i>&nbsp;&nbsp;Youtube</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="footer-widget widget-links">
                        <h5 class="footer-widget-title">WEBSITE TERKAIT</h5>
                        <ul>
                            <li><a href="https://www.cic.ac.id/" target="_blank">&nbsp;&nbsp;Portal Universitas Catur Insan Cendekia</a></li>
                            <li><a href="https://bkmcic.com/" target="_blank">&nbsp;&nbsp;Website Badan Koordinasi penjual CIC</a></li>
                            <li><a href="https://my.cic.ac.id/portal/module/front/" target="_blank">&nbsp;&nbsp;Sistem Informasi Nilai Akademik (MyCIC)</a></li>
                            <li><a href="https://prota.cic.ac.id/" target="_blank">&nbsp;&nbsp;Sistem Informasi Nilai Proyek dan Skripsi</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottomarea">
        <div class="container">
            <div class="footer-copyright">
                <p class="copyright">Copyright &copy; <a href="<?= site_url('beranda'); ?>"><?= $website['nama_website']; ?></a> by Gabriel M</p>
            </div>
        </div>
    </div>

</footer>