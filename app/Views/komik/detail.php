<?php $this->extend('layouts/template'); ?>

<?php $this->section('content'); ?>

<div class="container mt-3">
    <div class="row">
        <div class="col">
            <h1 class="mt-2">Detail Komik</h1>
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                    <img src="/img/<?= $komik['sampul'] ?>" class="card-img" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $komik['judul'] ?></h5>
                            <p class="card-text"><?= $komik['penulis'] ?></p>
                            <p class="card-text"><small class="text-muted"><?= $komik['penerbit'] ?></small></p>

                            <a href="/komik/edit/<?= $komik['slug'] ?>" class="btn btn-warning">Edit</a>
                            <!-- Delete With http-spoofing -->
                            <form action="/komik/<?= $komik['id'] ?>" method="POST" class="d-inline">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="btn btn-danger" onclick="return confirm('yakin hapus <?= $komik['judul'] ?> ?')">
                                    Delete
                                </button>
                            </form>
                            <div class="mt-3"><a href="/komik" class="btn btn-primary">Kembali ke daftar komik</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php $this->endSection(); ?>