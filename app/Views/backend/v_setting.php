<div class="col-md-12">
    <div class="card card-primary shadow-lg">
        <div class="card-header">
            <h3 class="card-title"><?= $judul ?></h3>

            <!--<div class="card-tools">
                  <a  class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-plus"></i>
                  </a>
                </div>-->
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <?= form_open('Admin/updateSetting'); ?>
        <div class="card-body">
            <?php
            if (session()->get('pesan')) {
                echo '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fas fa-check"></i>';
                echo session()->get('pesan');
                echo '</div>';
            }
            ?>
            <div class="form-group">
                <label>Nama Kantor</label>
                <input name="nama_kantor" value="<?= $setting['nama_kantor']; ?> " class="form-control" placeholder="Nama Kantor" required>
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <input name="alamat" value="<?= $setting['alamat']; ?> " class="form-control" placeholder="Alamat" required>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Lokasi Kantor</label>
                        <input name="lokasi_kantor" value=" <?= $setting['lokasi_kantor']; ?> " class="form-control" placeholder="Lokasi Kantor" required>
                    </div>
                </div>


                <div class="col-sm-6">

                    <div class="form-group">
                        <label>Radius (*meter)</label>
                        <input name="radius" value="<?= $setting['radius']; ?> " class="form-control" type="number" required>
                    </div>

                </div>
            </div>

            <div id="map" style="width:100%; height: 300px;">
            </div>
        </div>

        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        </form>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<?= form_close(); ?>

<script>
    var map = L.map('map').setView([<?= $setting['lokasi_kantor']; ?>], 15);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    L.marker([<?= $setting['lokasi_kantor']; ?>]).addTo(map)
        .bindPopup('<?= $setting['nama_kantor']; ?>')
        .openPopup();

    L.circle = L.circle([<?= $setting['lokasi_kantor']; ?>], {
        color: 'blue',
        fillColor: 'blue',
        fillOpacity: 0.5,
        radius: <?= $setting['radius']; ?>,
    }).addTo(map);
</script>