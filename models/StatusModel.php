<?php
////////////////////////////////////////////////////////////////////////////
// SCHEDULEMAKER - Status Model
//
// @file	models/StatusModel.php
// @descrip	This file defines the status model. It basically provides access to
//			the records stored in the database for logging.
// @author	Benjamin Russell (benrr101@csh.rit.edu)
////////////////////////////////////////////////////////////////////////////

class StatusModel extends Model {
	
	// METHODS /////////////////////////////////////////////////////////////
	/**
	 * Retrieves that last x scraper logs from the database. The rows are
	 * returned as an associative array.
	 * @param	int	$x	The number of logs to retrieve
	 * @return	array<string>	The last x logs of the scraper
	 */
	public function getLastScrapeLogs($x) {
		// Build a query to get the last number of logs from the database
		$query = "SELECT * FROM scrapelog ORDER BY timeStarted DESC LIMIT {$this->dbConn->escape($x)}";
		$result = $this->dbConn->query($query);
		if(!$result) {
			// @TODO: Error
		}

		// Return the result
		return $result;
	}
}
