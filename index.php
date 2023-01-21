<?php
require_once 'config.php';

// @todo Message Logging
//$logger = new Logger(LOGGER_DB, LOGGER_USER, LOGGER_PASS);

$results = ['error' => false];
$template = 'main';

if (isset($_GET['search'])) {
    $query = filter_input(INPUT_GET, 'search', FILTER_DEFAULT);
    $page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, ['default' => 1, 'min_range' => 1]);

    try {
        $results = MovieSearch::search($query, $page, 10);
        $results['error'] = false;
    }
    catch(Exception $e) {
        $results['error'] = true;
    }

    $results['result_type'] = 'search';

    // @todo Message Logging
    //$logger->log('Query: ' . $query, $_SERVER['REMOTE_ADDR']);

    if (filter_input(INPUT_GET, 'resultsOnly', FILTER_VALIDATE_BOOLEAN, ['default' => false])) {
        $template = 'resultSection';
    }

    $out = TemplateReader::parseTemplate($template, $results);

    if (strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false) {
        $out = json_encode(['html' => $out]);
        header('Content-Type:application/json');
    }

    echo $out;

    exit();
}

if (isset($_GET['details'])) {
    $id = filter_input(INPUT_GET, 'details', FILTER_DEFAULT);

    try {
        $results = MovieSearch::getMovieDetails($id);
        $results['error'] = false;
    }
    catch(Exception $e) {
        $results['error'] = true;
    }

    $results['result_type'] = 'details';

    // @todo Message Logging
    //$logger->log('Details: Movie id ' . $id, $_SERVER['REMOTE_ADDR']);

    if (filter_input(INPUT_GET, 'resultsOnly', FILTER_VALIDATE_BOOLEAN, ['default' => false])) {
        $out = [
            'title' => $results['title'],
            'html' => TemplateReader::parseTemplate('movieDetails', $results)
        ];

        header('Content-Type:application/json');
        echo json_encode($out);

        exit();
    }

    echo TemplateReader::parseTemplate('main', $results);

    exit();
}

//No request
echo TemplateReader::parseTemplate($template, ['result_type' => 'none']);




