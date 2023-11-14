<!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="<?= base_url('Presensi/Izin'); ?>" class="headerButton goBack">
            <i class="fas fa-arrow-left fa-2x"></i>
        </a>
    </div>
    <div class="pageTitle"><?= $judul; ?></div>
    <div class="right"></div>
</div>
<!-- * App Header -->

<div class="row" style="margin-top : 70px;margin-left:1px; margin-right: 1px;">
    <div class="col-sm-12">
        <?php $errors = validation_errors();


        ?>
        <?php echo form_open('Presensi/submitIzin'); ?>
        <div class="form-group">
            <label>Tanggal</label>
            <input type="date" name="tgl_izin" class="form-control">
            <p class="text text-danger"><?= isset($errors['tgl_izin']) == isset($errors['tgl_izin']) ? validation_show_error('tgl_izin') : ''; ?></p>

        </div>
        <div class="form-group">
            <label>Status Izin</label>
            <select name="status_izin" class="form-control">
                <option value="">--pilih--</option>
                <option value="1">Izin</option>
                <option value="2">Sakit</option>
            </select>
            <p class="text text-danger"><?= isset($errors['status_izin']) == isset($errors['status_izin']) ? validation_show_error('status_izin') : ''; ?></p>
        </div>
        <div class="form-group">
            <label>Keterangan</label>
            <textarea name="ket_izin" rows="5" class="form-control"></textarea>
            <p class="text text-danger"><?= isset($errors['ket_izin']) == isset($errors['ket_izin']) ? validation_show_error('ket_izin') : ''; ?></p>
        </div>

        <button class="btn btn-primary btn-block">Submit</button>


        <?php echo form_close(); ?>

    </div>
</div>