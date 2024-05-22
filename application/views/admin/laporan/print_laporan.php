<html>

<head>
    <title>Laporan Transaksi Waroeng penjual</title>
    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/dist/img/logo/cic_putih.png">
</head>

<body>

    <style>
        .clearfix {
            clear: both;
            float: none;
        }
    </style>

    <div align='center' width="750px" style="width:100%;">
        <!-- <div class="clearfix"></div> -->
        <div style="float:left">
            <img src="<?php echo base_url(); ?>assets/backend/images/logo/logo_cic.png" width='145px' height='70px'>
        </div>
        <!-- <div class="clearfix"></div> -->
        <div style="float:right">
            <img src="<?php echo base_url(); ?>assets/backend/images/logo/logo_bkm.png" width='120px' height='70px'>
        </div>
        <div style="line-height:8pt;text-align:center;">
            <h3> BADAN KOORDINASI penjual CIC </h3>
            <p> Jl. Kesambi No. 202 Cirebon - 45134</p>
            <p> Website : http://www.bkmcic.com Email : bkmcic.official@gmail.com</p>
        </div>
        <div class="clearfix"></div>
    </div>

    <hr size="2" style="background-color:black">
    <br>
    <h3>Laporan Transaksi Per <?= $tgl_awal; ?> s/d <?= $tgl_akhir; ?></h3>
    <table border=1 cellspadding=0 cellspacing=0 style="width: 100%">
        <tr>
            <th>Order ID</th>
            <th>Metode Pembayaran</th>
            <th>Tanggal dan Waktu</th>
            <th>Nama Pelanggan</th>
            <th>Total Bayar</th>
            <th>Status</th>
        </tr>

        <?php
        $volume_transaksi_berhasil = 0;
        $jumlah_transaksi_masuk = 0;
        $jumlah_transaksi_berhasil = 0;
        ?>

        <?php foreach ($transaksi as $t) : ?>
            <tr align="center">
                <td><?= $t['order_id']; ?></td>
                <td>
                    <?php if ($t['tipe_pembayaran'] == 'gopay') { ?>
                        <span>GO-PAY</span>
                    <?php } ?>

                    <?php if ($t['tipe_pembayaran'] == 'cstore') { ?>
                        <?php if ($t['store'] == 'alfamart') { ?>
                            <span>Alfamart</span>
                        <?php } else { ?>
                            <span>Indomaret</span>
                        <?php } ?>
                    <?php } ?>

                    <?php if ($t['tipe_pembayaran'] == 'bank_transfer') { ?>
                        <span>Bank Transfer</span>
                    <?php } ?>
                </td>
                <td><?= $t['waktu_transaksi'] ?></td>
                <td><?= $t['nama_pelanggan']; ?></td>
                <td>Rp<?= number_format($t['total_bayar'], 0, ',', '.'); ?></td>
                <td>
                    <?php if ($t['status_bayar'] == 'pending') { ?>
                        <span class="badge badge-warning">Pending</span>
                    <?php } else if ($t['status_bayar'] == 'expire') { ?>
                        <span class="badge badge-danger">Failure</span>
                    <?php } else if ($t['status_bayar'] == 'settlement') { ?>
                        <span class="badge badge-success">Settlement</span>
                    <?php } else { ?>
                        <span class="badge badge-danger">Cancel</span>
                    <?php } ?>
                </td>
            </tr>

            <?php if ($t['status_bayar'] == "settlement") {
                $volume_transaksi_berhasil += $t['total_bayar'];
                $jumlah_transaksi_berhasil++;
            }
            $jumlah_transaksi_masuk++;
            ?>



        <?php endforeach; ?>
    </table>

    <br>
    <b>Keterangan :</b>
    <br>
    <table>
        <tr>
            <td>Total Transaksi Berhasil</td>
            <td>: Rp<?= number_format($volume_transaksi_berhasil, 0, ',', '.'); ?></td>
        </tr>
        <tr>
            <td>Jumlah Transaksi Masuk</td>
            <td>: <?= $jumlah_transaksi_masuk++; ?></td>
        </tr>
        <tr>
            <td>Jumlah Transaksi Berhasil</td>
            <td>: <?= $jumlah_transaksi_berhasil; ?></td>
        </tr>
    </table>


    <br>
    <br>
    <div align='right' style='padding-right: 74px;'>Cirebon, <?php echo date("d F Y") ?></div>
    <br>
    <br>
    <br>

    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;
    <div align='right' style='padding-right: 100px;'>R&D BKM CIC</div>
    <script>
        window.print();
    </script>

</body>

</html>