<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bit9 Challenge</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="/scripts/movieSearch.js"></script>

    <style>
        html {
            background: #ccc;
        }

        body {
            background: white;
            max-width: 30em;
            padding: 2em;
            border: 1px solid #999;
            margin: 2em auto;
            border-radius: 10px;
        }

        #results > header, #results > article {
            margin-top: 2em;
            border-top: 1px solid #999;
            padding-top: 1em
        }

        .movieResult {
            border: 1px solid #999;
            border-radius: 10px;
            padding: 1em;
            margin: 0.25em;
        }

        .loading-spinner {
            display: none;
            margin: 1em auto;
        }

        #detailsContent {
            display: none
        }

        dt, dd {
            display: inline;
        }

        dd::after {
            content: "";
            display: block;
        }
    </style>
</head>
<body class="container">
    <header class="row">
        <h1>Bit9 Coding Challenge</h1>
    </header>

    <main class="container">
        <h2 class="row">Movie Search</h2>

        <form id="searchForm" class="row align-items-end" action="index.php" method="get">
            <div class="col-md-auto">
                <label for="search" class="form-label">Search</label>
                <input type="search" name="search" id="search" class="form-control">
            </div>
            <div class="col-sm-auto">
                <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Search">
            </div>
        </form>

        <div id="searchLoading" class="loading-spinner">
            <span class="spinner-border" role="status"></span>
            <span>Getting Results…</span>
        </div>

        <section class="row" id="results">
            <?php if ($args['result_type'] == 'search'): ?>
                <?= TemplateReader::parseTemplate('resultSection', $args) ?>
            <?php elseif ($args['result_type'] == 'details'): ?>
                <?= TemplateReader::parseTemplate('movieDetails', $args) ?>
            <?php endif; ?>
        </section>
    </main>

    <?= TemplateReader::parseTemplate('detailsModal'); ?>
</body>
</html>