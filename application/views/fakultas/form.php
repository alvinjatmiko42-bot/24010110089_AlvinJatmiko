<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="m-0"><?php echo $title; ?></h5>
                </div>
                <div class="card-body">
                    <form action="<?php echo $action; ?>" method="POST">
                        
                        <div class="mb-3">
                            <label for="fakultas_id" class="form-label">ID Fakultas</label>
                            <input type="number" name="fakultas_id" id="fakultas_id" class="form-control <?php echo form_error('fakultas_id') ? 'is-invalid' : (isset($_POST['fakultas_id']) ? 'is-valid' : ''); ?>" 
                            value="<?php echo set_value('fakultas_id', isset($fakultas['fakultas_id']) ? $fakultas['fakultas_id'] : ''); ?>" <?php echo isset($fakultas) ? 'readonly' : ''; ?>>
                            <?php if (form_error('fakultas_id')): ?>
                                <div class="invalid-feedback"><?php echo form_error('fakultas_id'); ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="fakultas_name" class="form-label">Nama Fakultas</label>
                            <input type="text" name="fakultas_name" id="fakultas_name" class="form-control <?php echo form_error('fakultas_name') ? 'is-invalid' : (isset($_POST['fakultas_name']) ? 'is-valid' : ''); ?>" 
                            value="<?php echo set_value('fakultas_name', isset($fakultas['fakultas_name']) ? $fakultas['fakultas_name'] : ''); ?>">
                            <?php if (form_error('fakultas_name')): ?>
                                <div class="invalid-feedback"><?php echo form_error('fakultas_name'); ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="<?php echo base_url('fakultas'); ?>" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-success"><?php echo $button; ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>