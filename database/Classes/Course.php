<?php
	
	class Course
	{
		// Class variables, only accessible through getters
		private int $ID;
		private int $uniID;
		private string $crseID;
		private int $sectNum;
		private string $crseName;
		private array $userRoster;

		// constructor method
		public function __construct(int $ID, int $uniID, string $crseID, int $sectNum, string $crseName)
		{
			$this->ID		= $ID;
			$this->uniID	= $uniID;
			$this->crseID	= $crseID;
			$this->sectNum	= $sectNum;
			$this->crseName	= $crseName;
			$this->userRoster	= DatabaseMethods::getUserRoster($ID);
		}

		// getters
		public function getID(): int { return $this->ID; }
		public function getUniID(): int { return $this->uniID; }
		public function getCrseID(): string { return $this->crseID; }
		public function getSectNum(): int { return $this->sectNum; }
		public function getCrseName(): string { return $this->crseName; }
		public function getUserRoster(): array { return $this->userRoster; }

		// setters
		//	 there's no "setID" because that would compromise the database's integrity
		public function setUniID(int $uniID) {  $this->uniID = $uniID; }
		public function setCrseID(string $crseID) {  $this->crseID = $crseID; }
		public function setSectNum(int $sectNum) {  $this->sectNum = $sectNum; }
		public function setCrseName(string $crseName) {  $this->crseName = $crseName; }
		public function setUserRoster(array $userRoster) {  $this->userRoster = $userRoster; }
	}

?>