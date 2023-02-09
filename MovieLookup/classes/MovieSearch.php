<?php

class MovieSearch
{
    const SEARCH_URL = 'https://api.themoviedb.org/3/search/movie';
    const CONFIG_URL = 'https://api.themoviedb.org/3/configuration';
    const MOVIE_URL =  'https://api.themoviedb.org/3/movie';

    private static array $imgconfig = [];

    /**
     * Sends a search query to the Movie Database and returns results in an associative array
     *
     * @param string $query A movie name to search for
     * @param int|null $page Optional; The page of search results.
     * @return array
     * @throws Exception If the Movie Database lookup fails
     */
    public static function search(string $query, ?int $page = null, ?int $limit = null) : array {
        $urlparams = [
            'api_key' => MOVIE_DB_KEY,
            'query' => $query,
            'include_adult' => 'false'
        ];

        if (!empty($page)) {
            $urlparams['page'] =  $page;
        }

        $url = self::SEARCH_URL."?". http_build_query($urlparams);

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $search_response = curl_exec($curl);

        if (!$search_response) {
            throw new Exception("Error retrieving search data");
        }

        $results = json_decode($search_response, true);

        if (!is_null($limit) && $limit > 0 && $limit < count($results['results'])) {
            $results['page'] = 1;
            $results['total_results'] = $limit;
            $results['total_pages'] = 1;

            $results['results'] = array_slice($results['results'], 0, $limit);
        }

        $config = self::getImgConfig();

        $results['result_start_num'] = ($results['page'] - 1) * count($results['results']) + 1;
        $results['result_end_num'] = $results['result_start_num'] + count($results['results']) - 1;
        $results['nav_url_string'] = '/index.php?' . http_build_query(['search' => $query]);
        $results['img_base'] = $config['secure_base_url'] . '/' . $config['poster_sizes'][min(count($config['poster_sizes']), 1)];

        return $results;
    }

    public static function getMovieDetails(string $id) : array {
        $urlparams = [
            'api_key' => MOVIE_DB_KEY
        ];

        $url = self::MOVIE_URL . "/{$id}?" . http_build_query($urlparams);

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($curl);

        if (!$response) {
            throw new Exception("Error retrieving movie details");
        }

        $results = json_decode($response, true);
        $config = self::getImgConfig();

        $results['poster'] = $config['secure_base_url'] . '/' . $config['poster_sizes'][min(count($config['poster_sizes']), 2)] . '/' . $results['poster_path'] ;

        return $results;
    }

    /**
     * Get the array of image configuration data in order to display movie images.
     *
     * @return array|mixed
     */
    private static function getImgConfig() {
        if (empty(self::$imgconfig)) {
            $urlparams = [
                'api_key' => MOVIE_DB_KEY
            ];

            $url = self::CONFIG_URL . "?" . http_build_query($urlparams);

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $config_response = curl_exec($curl);

            $config = json_decode($config_response, true)['images'];
            self::$imgconfig = $config;
        }
        else {
            $config = self::$imgconfig;
        }

        return $config;
    }
}