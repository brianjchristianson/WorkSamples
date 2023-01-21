const resultsOnly = 'resultsOnly';

$(function() {
    const frm = $('#searchForm');
    const detailsModal = document.getElementById('detailsModal');
    detailsModal.addEventListener('hidden.bs.modal', afterModalClose);

    frm.submit(e => searchMovies(e));
    frm.append('<input type="hidden" name="' + resultsOnly +'" value="true">');

    $(document)
        .delegate('a.page-link', 'click', e => changePage(e))
        .delegate('a.detailsLink', 'click', e => getMovieDetails(e));
});

/**
 * Sends a request to do a movie search
 *
 * @param event Event that triggered the call
 */
function searchMovies(event) {
    event.preventDefault();
    const urlData = $(event.target).serialize();

    updateHistory(urlData);

    $('#searchLoading').show();
    $('#results').fadeOut();

    $.get(
        '/index.php',
        urlData,
        updateResults,
        'json'
    );
}

/**
 * Sends a request to a new search result page
 *
 * @param event Event that triggered the call
 */
function changePage(event) {
    event.preventDefault();
    const urlStr = $(event.target).attr('href');

    let urlObj = new URL(urlStr, window.location.origin);
    updateHistory(urlObj.search.replace(/^\?/, ''));

    $.get(
        urlStr + '&' + resultsOnly + '=true',
        '',
        updateResults,
        'html'
    );
}

/**
 * Updates the search results
 *
 * @param html JSON object with new search results
 */
function updateResults(json) {
    const resultSection = $('#results');
    resultSection.html(json.html);

    $('#searchLoading').hide();
    resultSection.fadeIn();
}

/**
 * Update the browser history
 *
 * @param queryString
 */
function updateHistory(queryString) {
    const params = queryString.split('&');
    let data = {};

    for (let p of params) {
        let vals = p.split('=');
        if (vals[0] != resultsOnly) {
            data[vals[0]] = vals[1];
        }
    }

    window.history.pushState(data, '', window.location.origin);
}

/**
 * Send a request for movie details
 *
 * @param event The event that triggered the call
 */
function getMovieDetails(event) {
    event.preventDefault();
    const urlStr = $(event.target).attr('href');
    const detailsModal = new bootstrap.Modal('#detailsModal');

    $('#detailsLoading').show();
    $('#detailsPermalink').attr('href', urlStr);
    detailsModal.show();

    $.get(
        urlStr + '&' + resultsOnly + '=true',
        '',
        updateModal,
        'json'
    );
}

/**
 * Update the movie details modal
 *
 * @param json An object containing the movie title and html content for the modal
 */
function updateModal(json) {
    let contentArea = $('#detailsContent');

    $('#detailsModal-title').text(json.title);
    contentArea.html(json.html);

    $('#detailsLoading').hide();
    contentArea.fadeIn();
}

/**
 * Cleans up the details modal after it has been closed
 */
function afterModalClose() {
    let contentArea = $('#detailsContent');

    contentArea.hide();

    $('#detailsModal-title').text('');
    contentArea.html('');
    $('#detailsPermalink').attr('href', '');
}