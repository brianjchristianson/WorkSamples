<?php if ($args['total_pages'] > 1): ?>
<nav id="pageNavigation">
    <ul class="pagination pagination-lg">
        <?php if ($args['page'] > 1): ?>
        <li class="page-item"><a href="<?= $args['nav_url_string'] . '&page='. ($args['page'] - 1) ?>" title="Previous Page" class="page-link">⇦ ️Previous</a></li>
        <?php endif; ?>

        <?php if($args['page'] - 5 > 1): ?>
            <li class="page-item disabled"><span class="page-link">…</span></li>
        <?php endif; ?>

        <?php for($i = max(1, $args['page'] - 5); $i < $args['page']; $i++): ?>
        <li class="page-item"><a href="<?= $args['nav_url_string'] . '&page='. $i ?>" title="Page <?= $i ?>" class="page-link"><?= $i ?></a></li>
        <?php endfor; ?>

        <li class="page-item active"><b class="page-link">Page <?= $args['page'] ?></b></li>

        <?php for($i = $args['page'] + 1; $i <= min($args['page'] + 5, $args['total_pages']); $i++): ?>
        <li class="page-item"><a href="<?= $args['nav_url_string'] . '&page='. $i ?>" title="Page <?= $i ?>" class="page-link"><?= $i ?></a></li>
        <?php endfor; ?>

        <?php if($args['page'] + 5 < $args['total_pages']): ?>
            <li class="page-item disabled"><span class="page-link">…</span></li>
        <?php endif; ?>

        <?php if ($args['page'] < $args['total_pages']): ?>
            <li class="page-item"><a href="<?= $args['nav_url_string'] . '&page='. ($args['page'] + 1) ?>" title="Next Page" class="page-link">Next ⇨</a></li>
        <?php endif; ?>
    </ul>
</nav>
<?php endif; ?>