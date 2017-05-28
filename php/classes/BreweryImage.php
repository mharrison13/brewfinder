<?php
//namespace com/michaelharrisonwebdev;
require_once("autoload.php");
/**
 * BreweryImage Class for Brewfinder
 *
 * @author Lea McDuffie <lea@littleloveprint.io>
 * @version 1.0
 **/
class BreweryImage implements \JsonSerializable {
	/**
	 * Id of the image being posted; this is a a component of a composite primary and foreign key
	 * @var int $breweryImageImageId
	 **/
	private $breweryImageImageId;
	/**
	 * Id of the brewery the image belongs to; this is a a component of a composite primary and foreign key
	 * @var int $breweryImageBreweryId
	 **/
	private $breweryImageBreweryId;
	/**
	 * Constructor for breweryImage
	 *
	 * @param int $newBreweryImageBreweryId id of the parent breweryImage belongs to
	 * @param int $newBreweryImageImageId id of the parent Image
	 */
	public function  __construct(int $newBreweryImageImageId, int $newBreweryImageBreweryId) {
		try {
			$this->setBreweryImageImageId($newBreweryImageImageId);
			$this->setBreweryImageBreweryId($newBreweryImageBreweryId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {

			// Determine what exception type was thrown
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}
	/**
	 * Accessor method for image id
	 *
	 * @return int value of image id
	 **/
	public function getBreweryImageImageId(): int {
		return($this->breweryImageImageId);
	}

	/**
	 * Mutator for image id
	 *
	 * @param int $newBreweryImageImageId new value of image id
	 * @throws \RangeException if $newBreweryImageImageId is not positive
	 * @throws \TypeError if $newBreweryImageImageId is not an integer
	 **/
	public function setBreweryImageImageId(int $newBreweryImageImageId): void {

		// Verify the image id is positive
		if($newBreweryImageImageId <= 0) {
			throw(new \RangeException("brewery image image id is not positive"));
		}

		// Convert and store the image id
		$this->breweryImageImageId = $newBreweryImageImageId;
	}

	/**
	 * Accessor method for event id
	 *
	 * @return int value of brewery image brewery id
	 **/
	public function getBreweryImageBreweryId(): int {
		return ($this->breweryImageBreweryId);
	}

	/**
	 * mutator method for brewery image brewery id
	 *
	 * @param int $newBreweryImageBreweryId new value of brewery image brewery id
	 * @throws \RangeException if $newBreweryImageBreweryId is not positive
	 * @throws \TypeError if $newBreweryImageBreweryId is not an integer
	 **/
	public function setBreweryImageBreweryId(int $newBreweryImageBreweryId): void {

		// Verify the brewery image brewery id is positive
		if($newBreweryImageBreweryId <= 0) {
			throw(new \RangeException("brewery image brewery id is not positive"));
		}

		// Convert and store the event id
		$this->breweryImageBreweryId = $newBreweryImageBreweryId;
	}

	/**
	 * Insert into mySQL
	 *
	 * @param \PDO $pdo connection object
	 * @throws \PDOException whe mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo): void {

		// Enforce the brewery image image id is null (i.e., don't insert a brewery image that already exists)
		if($this->breweryImageImageId !== null) {
			throw(new \PDOException("not a new image"));
		}

		// Create query template
		$query = "INSERT INTO breweryImage(breweryImageImageId, breweryImageBreweryId) VALUES (:breweryImageImageId, :breweryImageBreweryId)";
		$statement = $pdo->prepare($query);

		// Bind the member variables to the place holders in the template
		$parameters = ["breweryImageImageId" => $this->breweryImageImageId, "breweryImageBreweryId" => $this->breweryImageBreweryId];
		$statement->execute($parameters);

		// Update the null brewery image image id with what mySQL gave us
		$this->breweryImageImageId = intval($pdo->lastInsertId());
	}

	/**
	 * Deletes this breweryImage from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo) : void {

		// Ensure the object exists before deleting
		if($this->breweryImageImageId === null || $this->breweryImageImageId === null) {
			throw(new \PDOException("cannot delete an image that does not exist"));
		}

		// Create query template
		$query = "DELETE FROM breweryImage WHERE breweryImageImageId = :breweryImageImageId AND breweryImageBreweryId = :breweryImageBreweryId";
		$statement = $pdo->prepare($query);

		// Bind the member variables to the place holders in the template
		$parameters = ["breweryImageImageId" => $this->breweryImageImageId, "breweryImageBreweryId" => $this->breweryImageBreweryId];
		$statement->execute($parameters);
	}

	/**
	 * Update in mySQL
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo) : void {

		// Enforce the image is not null
		if($this->breweryImageImageId === null) {
			throw(new \PDOException("cannot update an image that does not exist"));
		}
	}

