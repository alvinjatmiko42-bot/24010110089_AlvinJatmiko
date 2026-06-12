<div class="container-fluid px-4 mt-4">
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-table me-1"></i>
                <?php echo $title; ?>
            </div>
            <a href="<?php echo base_url('prodi/tambah'); ?>" class="btn btn-primary btn-sm">Tambah Prodi</a>
        </div>
        <div class="card-body">
            <table id="datatable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="10%">ID</th>
                        <th>Nama Program Studi</th>
                        <th width="10%">Strata</th>
                        <th>Fakultas</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($prodi as $p): ?>
                    <tr>
                        <td><?php echo $p['prodi_id']; ?></td>
                        <td><?php echo $p['prodi_name']; ?></td>
                        <td><span class="badge bg-secondary"><?php echo $p['prodi_strata']; ?></span></td>
                        <td><?php echo $p['fakultas_name']; ?></td>
                        <td>
                            <a href="<?php echo base_url('prodi/ubah/' . $p['prodi_id']); ?>" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a href="<?php echo base_url('prodi/hapus/' . $p['prodi_id']); ?>" class="btn btn-danger btn-sm btn-hapus">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>