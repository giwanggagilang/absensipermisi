<div class="col-md-12">
    <div class="card card-primary card-outline shadow-lg">
        <div class="card-header">
            <h3 class="card-title">Data Presensi</h3>

            <div class="card-tools">
                <button type="submit" class="btn btn-sm
                     btn-default"><i class="fa fa-search"></i></button>
            </div>
            <div class="card-tools" style="margin-right: 0px;">
                <input type="search" class="form-control form-control-sm" placeholder="Search">
            </div>

            <div class="card-tools" style="margin-right: 50px;">
                <button type=" button" class="btn btn-sm btn-primary btn-flat" data-toggle="modal" data-target="#add"><i class="fas fa-plus mr-1"></i>Tambah
                </button>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <?php if (session()->get('pesan')) {
                echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>';
                echo session()->get('pesan');
                echo '</h5></div>';
            }; ?>
            <table class="table table-sm table-bordered">
                <tr class="text-center">
                    <th width="50px">No</th>
                    <th>Nik</th>
                    <th>Nama Karyawan</th>
                    <th>Jabatan</th>
                    <th>Presensi Masuk</th>
                    <th>Presensi Pulang</th>
                    <th width="150px">Aksi</th>
                </tr>
                <?php $no = 1;
                foreach ($monitoring as $key => $value) { ?>
                    <tr>
                        <td class="text-center"><?= $no++; ?></td>
                        <td class="text-center"><?= $value['nik']; ?></td>
                        <td><?= $value['nama_karyawan']; ?></td>
                        <td><?= $value['nama_jabatan']; ?></td>
                        <td><?= $value['tgl_presensi']; ?><br><?= $value['jam_in']; ?><br><img src="<?= base_url('foto/' . $value['foto_in']); ?>" width="100px"></td>
                        <td><?= $value['tgl_presensi']; ?><br><?= $value['jam_out']; ?><br><img src="<?= base_url('foto/' . $value['foto_out']); ?>" width="100px"></td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-flat btn-warning" data-toggle="modal" data-target="#edit<?= $value['id_presensi']; ?>"><i class="fas fa-pencil-alt"></i></button>
                            <a href="<?= base_url('Monitoring/deleteData/' . $value['id_presensi']); ?>" onclick="return confirm('Yakin Hapus Data..?')" class="btn btn-sm btn-flat btn-danger"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                <?php }; ?>
            </table>

        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</div>
<!-- /.col -->


<!-- Modal Tambah-->
<div class="modal fade" id="add">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Karyawan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open_multipart('Monitoring/insertData'); ?>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nik</label>
                    <input name="nik" placeholder="Nik" class="form-control" required>
                </div>


                <div class="form-group">
                    <label>Tanggal Absen</label>
                    <input type="date" name="tgl_presensi" placeholder="Tanggal Absensi" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Jam Masuk</label>
                    <input type="time" name="jam_in" placeholder="Jam Masuk" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Jam Pulang</label>
                    <input type="time" name="jam_out" placeholder="Jam Pulang" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
            </div>
            <?= form_close(); ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>