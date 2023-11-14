<div class="col-md-12">
    <div class="card card-primary card-outline shadow-lg">
        <div class="card-header">
            <h3 class="card-title">Data Jabatan</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-sm btn-primary btn-flat" data-toggle="modal" data-target="#add"><i class="fas fa-plus mr-1"></i>Tambah
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
                    <th>Jabatan</th>
                    <th width="150px">Aksi</th>
                </tr>
                <?php $no = 1;
                foreach ($jabatan as $key => $value) { ?>
                    <tr>
                        <td class="text-center"><?= $no++; ?></td>
                        <td><?= $value['nama_jabatan']; ?></td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-flat btn-warning" data-toggle="modal" data-target="#edit<?= $value['id_jabatan']; ?>"><i class="fas fa-pencil-alt"></i></button>
                            <a href="<?= base_url('Jabatan/deleteData/' . $value['id_jabatan']); ?>" onclick="return confirm('Yakin Hapus Data..?')" class="btn btn-sm btn-flat btn-danger"><i class="fas fa-trash"></i></a>
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
                <h4 class="modal-title">Tambah Jabatan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('Jabatan/insertData'); ?>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Jabatan</label>
                    <input name="nama_jabatan" placeholder="Nama Jabatan" class="form-control" required>
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



<!-- Modal Edit-->
<?php foreach ($jabatan as $key => $value) { ?>
    <div class="modal fade" id="edit<?= $value['id_jabatan']; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Jabatan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?= form_open('Jabatan/updateData/' . $value['id_jabatan']); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Jabatan</label>
                        <input name="nama_jabatan" value="<?= $value['nama_jabatan']; ?>" placeholder="Nama Jabatan" class="form-control" required>
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

<?php } ?>