<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<form action="/articles/store" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <?php if(session()->getFlashdata('errors')): ?>
    <ul style="color:red;">
        <?php foreach(session()->getFlashdata('errors') as $e): ?>
        <li><?= $e ?></li>
        <?php endforeach ?>
    </ul>
    <?php endif; ?>

    Judul <br>
    <input type="text" name="title" value="<?= old('title') ?>"><br><br>

    Isi <br>
    <textarea name="content"><?= old('content') ?></textarea><br><br>

    Kategori <br>
    <select name="category_id">
        <option value="">--Pilih--</option>
        <?php foreach($categories as $c): ?>
        <option value="<?= $c['id'] ?>"><?= $c['name'] ?></option>
        <?php endforeach ?>
    </select><br><br>

    Upload Gambar <br>
    <input type="file" name="image"><br><br>

    <button type="submit">Simpan</button>
</form>

<?= $this->endSection() ?>
