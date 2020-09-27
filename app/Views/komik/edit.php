<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="my-3">Form Ubah Data Komik</h2>
            <form action="/komik/update/<?= $komik['id'] ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="slug" value="<?= $komik['slug'] ?>">
            <input type="hidden" name="sampulLama" value="<?= $komik['sampul'] ?>">
                <?= csrf_field(); ?>
                <div class="form-group row">
                    <label for="inputJudul" class="col-sm-2 col-form-label">Judul</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('judul')? 'is-invalid' : '') ?>" id="inputJudul" placeholder="judul" name="judul" value="<?= (old('judul')) ? old('judul') :  $komik['judul'] ?>" autofocus>
                        <div class="invalid-feedback">
                            <?= $validation->getError('judul') ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPenulis" class="col-sm-2 col-form-label">Penulis</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputPenulis" placeholder="penulis" name="penulis" value="<?= (old('penulis')) ? old('penulis') :  $komik['penulis'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPenerbit" class="col-sm-2 col-form-label">Penerbit</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputPenerbit" placeholder="penerbit" name="penerbit" value="<?= (old('penerbit')) ? old('penerbit') :  $komik['penerbit'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="sampul" class="col-sm-2 col-form-label">Sampul</label>
                    <div class="col-sm-2">
                        <img src="/img/<?= $komik['sampul'] ?>" alt="" class="img-thumbnail img-preview">
                    </div>
                    <div class="col-sm-8">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input <?= ($validation->hasError('sampul')? 'is-invalid' : '') ?>" id="sampul" name='sampul' onchange="previewImage()">
                            <label class="custom-file-label" for="sampul"><?= $komik['sampul'] ?></label>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('sampul') ?>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Ubah Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>