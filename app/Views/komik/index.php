<?= $this->extend('layouts/template');  ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="mt-3">Daftar Komik</h1>
            <a href="/komik/create" class="btn btn-primary mb-2">Tambah Komik</a>

            <?php if(session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Sampul</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; foreach($komik as $k): ?>
                    <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td>
                            <img src="/img/<?= $k['sampul']; ?>" class="sampul" alt="">
                        </td>
                        <td><?= $k['judul']; ?></td>
                        <td>
                            <a href="/komik/<?= $k['slug']; ?>" class="btn btn-success">detail</a>
                        </td>
                    </tr>
                    <?php $i++; endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>