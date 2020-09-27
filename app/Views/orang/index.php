<?= $this->extend('layouts/template');  ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-6">
            <h1 class="mt-3">Daftar Orang</h1>
            <form action="" method="get">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Masukkan Keyword" name="keyword">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="submit">Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    <?php   
                            if ($keyword == '') {
                                $i = 1 + (10 * ($currentPage - 1));
                            }else{
                                $i = 1; 
                            }
                            foreach($orang as $o): 
                    ?>

                    <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td>
                            <?= $o['nama']; ?>
                        </td>
                        <td><?= $o['alamat']; ?></td>
                        <td>
                            <a href="#" class="btn btn-success">detail</a>
                        </td>
                    </tr>
                    <?php $i++; endforeach; ?>
                </tbody>
            </table>
            <?= $pager->links('orang','orang_pagination') ?>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>