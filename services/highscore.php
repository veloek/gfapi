<?php
/**
 * Endpoint to store and retrieve highscores for a game.
 *
 * @Route('highscore')
 */
class HighscoreService extends Service {

	private $db;

	public function __construct() {
		parent::__construct();

		// Setup DB connection
		$this->db = new PDO('sqlite:highscore.sqlite');
		$this->db->setAttribute(PDO::ATTR_ERRMODE,
			PDO::ERRMODE_EXCEPTION);
		$this->db->exec("CREATE TABLE IF NOT EXISTS highscore (
			game_id TEXT,
			score INTEGER,
			name TEXT)");
	}

	public function post($gameId, $score, $name) {
		if (!$gameId || !$score || !$name)
			throw new ServiceException(HttpStatus::BAD_REQUEST,
				'Missing gameId, score and/or name');

		$stmt = $this->db->prepare("INSERT INTO highscore (game_id, score, name)
			VALUES(:gameId, :score, :name)");
		$stmt->execute(array(':gameId' => $gameId, ':score' => $score, ':name' => $name));
	}

	/**
	 * @ContentType('application/json')
	 */
	public function get($gameId) {
		$stmt = $this->db->prepare('SELECT name, score FROM highscore WHERE game_id = ? ORDER BY score DESC');
		$stmt->execute(array($gameId));
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		echo json_encode($result);
	}

}
