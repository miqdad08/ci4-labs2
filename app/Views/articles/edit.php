<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<h2>Edit Artikel</h2>
<form action="/articles/update/<?= $article['id'] ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <input type="hidden" name="old_image" value="<?= $article['image'] ?>">

    Judul <br>
    <input type="text" name="title" value="<?= $article['title'] ?>"><br><br>

    Isi <br>
    <textarea name="content"><?= $article['content'] ?></textarea><br><br>

    Kategori <br>
    <select name="category_id">
        <?php foreach($categories as $c): ?>
        <option value="<?= $c['id'] ?>" <?= $c['id'] == $article['category_id'] ? 'selected' : '' ?>>
            <?= $c['name'] ?>
        </option>
        <?php endforeach ?>
    </select><br><br>

    Gambar Lama <br>
    <img src="/uploads/<?= $article['image'] ?>" width="120"><br><br>

    Ganti Gambar <br>
    <input type="file" name="image"><br><br>

    <button type="submit">Update</button>
</form>


<?= $this->endSection() ?>
