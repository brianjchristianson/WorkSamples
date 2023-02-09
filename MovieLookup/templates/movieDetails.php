<?php if ($args['error']): ?>
    <p class="alert alert-danger">Error: Unable to get movie Details.</p>
<?php else: ?>

<?php if (isset($args['id'])): ?>
<article id="movieDetails_<?= $args['id'] ?>" class="container">
    <header class="row">
        <h1 class="h4"><?= $args['title'] ?></h1>
        <h2 class="h5"><?= $args['tagline'] ?></h2>
    </header>

    <div class="row">
        <figure class="col-2">
            <img src="<?= $args['poster'] ?>" alt="Poster for <?= $args['title'] ?>" class="img-fluid">
        </figure>

        <div class="col-10">
            <dl>
                <dt>Genres:</dt>
                <dd>
                    <?php
                        $genres = [];

                        foreach($args['genres'] as $genre) {
                                $genres[] = $genre['name'];
                        }

                        echo implode(', ', $genres);
                    ?>
                </dd>
                <dt>Release Date:</dt>
                <dd>
                    <?php
                        $date = date_create($args['release_date']);
                        echo date_format($date, 'F d, Y');
                    ?>
                </dd>
                <dt>Runtime:</dt>
                <dd><?= $args['runtime'] ?> min.</dd>
                <dt>Production Companies:</dt>
                <dd>
                    <?php
                    $companies = [];

                    foreach($args['production_companies'] as $company) {
                        $companies[] = $company['name'];
                    }

                    echo implode(', ', $companies);
                    ?>
                </dd>
            </dl>

            <p><?= $args['overview'] ?></p>
        </div>
    </div>
</article>
<?php endif; ?>
<?php endif; ?>
