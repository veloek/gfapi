<?php
/**
 * Endpoint to upload games and fetch list of available games.
 *
 * @Route('games')
 */
class GamesService extends Service {

    public function post($file) {

        // Check that we've got input
        if ($file !== NULL) {

            // Check file type
            if ($file['type'] == 'application/java-archive') {

                // TODO: Store jar file in games folder

            } else {
                throw new ServiceException(HttpStatus::BAD_REQUEST,
                    'Uploaded file is not a jar file');
            }
        } else {
            throw new ServiceException(HttpStatus::BAD_REQUEST,
                'Missing file');
        }
    }

    /**
     * Return list of available games
     *
     * @return JSON formatted list of games with meta data
     * @ContentType('application/json')
     */
    public function get() {

        // TODO: Return list of available games

        // Mock data
        $tmp = new stdClass();
        $tmp->info = 'List of Game Frame games';
        $tmp->version = '0.0.1';
        $tmp->games = array();

        $game = new stdClass();
        $game->name = 'Snake for Game Frame';
        $game->version = '0.0.1';
        $game->author = 'Vegard Løkken';
        $game->url = "$_SERVER['HTTP_HOST']$_SERVER['REQUEST_URI']/GFSnake.jar";

        $tmp->games[] = $game;

        return json_encode($tmp);
    }
}
