<ul class="listview image-listview">
    <?php foreach ($databulanan as $key => $value) { ?>
        <li>
            <div class="item">
                <div class="icon-box bg-primary">
                    <i class="fas fa-fingerprint"></i>
                </div>
                <div class="in">
                    <div><?= date('d-m-Y', strtotime($value['tgl_presensi'])); ?></div>
                    <span class="badge badge-success"><?= $value['jam_in']; ?></span>
                    <span class="badge badge-danger"><?= $value['jam_out'] == '00:00:00' ? '--:--:--' : $value['jam_out']; ?></span>
                </div>
            </div>
        </li>
    <?php } ?>


</ul>