#Movie Search

A small sample project using Bootstrap to present a simple interface to query movie details from [The Movie DB](https://www.themoviedb.org/). It lets you search for movies and then look at some select details.

##Installing

###Config
After installing the files to their root directory, edit config.sample.php to include your API key for The Movie DB.

The Database credentials are not required, as the logging class is a sample, and places where it would be logged are commented out. Likewise there is currently no Database installation script.

After this file, save it and rename it to just "config.php".

###Scripts
The project currently uses jQuery and Bootstrap loaded from CDNs. If you would rather host it locally, modify the script tags in /templates/main.php.

There are also fallbacks in the pages themselves so if the scripts do not load properly, the search should still work.

##Useage
To use the search:

1. Navigate to the site in your browser.
2. Enter the name of a movie, or a partial movie name, into the search box and submit the form.
3. From the list of returned movies, you can activate the details marker to see the details for the film.
4. From there, you can follow a link for a few more details, including a link to its page on The Movie DB. If Javascript is active, these details should appear in a modal window. You can close it by activating the close button or clicking/tapping on the "X" in the modal’s upper right corner.