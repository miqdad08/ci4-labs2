<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<a href="/">Kembali</a>
<h2><?= $article['title'] ?></h2>
<img src="/uploads/<?= $article['image'] ?>" width="300">
<p><?= $article['content'] ?></p>


<?= $this->endSection() ?>