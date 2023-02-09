<?php if ($args['error']): ?>
    <p class="alert alert-danger">Error: Unable to get movie results.</p>
<?php else: ?>

<?php if (isset($args['results'])): ?>
<header>
    <h1 class="h2">Results</h1>
    <h2 class="h4">Showing results
        <span id="resultNumStart"><b><?= $args['result_start_num'] ?></b></span>
        to
        <span id="resultNumEnd"><b><?= $args['result_end_num'] ?></b></span>
        of
        <span id="resultTotal"><?= $args['total_results'] ?></span>
    </h2>
</header>
<div id="resultList">
    <?= TemplateReader::parseTemplate('resultList', $args); ?>
</div>
<div id="pageNav">
    <?= TemplateReader::parseTemplate('pageNav', $args) ?>
</div>
<?php endif; ?>
<?php endif; ?>
