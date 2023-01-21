<ul class="list-group">
    <?php foreach ($args['results'] as $result): ?>
    <details class="container movieResult">
        <summary class="h4"><?= $result['title'] ?></h1></summary>
        <div class="row">
            <?php if (!empty($result['poster_path'])): ?>
            <figure class="col-2">
                <img src="<?= $args['img_base'] . $result['poster_path'] ?>" alt="Poster for <?= $result['title'] ?>" class="img-fluid">
            </figure>
            <div class="col-10 movie_details">
            <?php else: ?>
            <div class="col-12 movie_details">
            <?php endif; ?>
                <p><b>Release Year:</b> <?= preg_replace('/-.*$/', '', $result['release_date']) ?></p>
                <p><?= $result['overview'] ?></p>
                <p><a href="/index.php?details=<?= $result['id'] ?>" class="detailsLink" title="Get more details on this movie">More Details…</a></p>
            </div>
        </div>
    </details>
    <?php endforeach; ?>
</ul>
