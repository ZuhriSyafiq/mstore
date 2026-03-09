<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Data User</h3>

            <div class="card-tools">
                <button data-toggle="modal" data-target="#add" type="button" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i>
                    Add</button>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <?php
            if ($this->session->flashdata('pesan')) {
                echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> Success </h5>';
                echo $this->session->flashdata('pesan');
                echo '</div>';
            }

            ?>
             <div class="card-body table-responsive">
                    <?php if (empty($pelanggan)) { ?>
                        <div class="alert alert-info">Belum ada data pelanggan.</div>
                    <?php } else { ?>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Foto</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach ($pelanggan as $p) { ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= htmlspecialchars($p->nama_pelanggan, ENT_QUOTES) ?></td>
                                        <td><?= htmlspecialchars($p->email, ENT_QUOTES) ?></td>
                                        <td>
                                            <?php if (!empty($p->foto)) { ?>
                                                <img src="<?= base_url('assets/foto/' . $p->foto) ?>" alt="foto" style="height:40px;border-radius:4px;">
                                            <?php } else { ?>
                                                -
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php } ?>
                </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

<!-- modal add -->
<div class="modal fade" id="add">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                echo form_open('user/add');
                ?>
                <div class="form-group">
                    <label>Nama User</label>
                    <input type="text" name="nama_user" class="form-control" placeholder="Nama User">
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Username">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password">
                </div>
                <div class="form-group">
                    <label>Level User</label>
                    <select name="level_user" class="form-control">
                        <option value="1" selected>Admin</option>
                        <option value="2">User</option>
                    </select>
                </div>


            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            <?php
            echo form_close();
            ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<!-- /.modal edit -->