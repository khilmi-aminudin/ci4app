<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="my-3">Form Tambah Data Komik</h2>
            <?= csrf_field(); ?>
            <form action="/komik/save" method="POST" enctype="multipart/form-data">
                <div class="form-group row">
                    <label for="inputJudul" class="col-sm-2 col-form-label">Judul</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('judul')? 'is-invalid' : '') ?>" id="inputJudul" placeholder="judul" name="judul" value="<?= old('judul') ?>" autofocus>
                        <div class="invalid-feedback">
                            <?= $validation->getError('judul') ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPenulis" class="col-sm-2 col-form-label">Penulis</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputPenulis" placeholder="penulis" name="penulis" value="<?= old('penulis') ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPenerbit" class="col-sm-2 col-form-label">Penerbit</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputPenerbit" placeholder="penerbit" name="penerbit" value="<?= old('penerbit') ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputSampul" class="col-sm-2 col-form-label">Sampul</label>
                    <div class="col-sm-10">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input <?= ($validation->hasError('sampul')? 'is-invalid' : '') ?>" id="sampul" name='sampul'>
                            <label class="custom-file-label" for="sampul">Pilih Gambar</label>
                            <div class="invalid-feedback">
                            <?= $validation->getError('sampul') ?>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Tambah Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>