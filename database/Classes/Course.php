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
		public function getuniID(): int { return $this->uniID; }
		public function getcrseID(): string { return $this->crseID; }
		public function getsectNum(): int { return $this->sectNum; }
		public function getcrseName(): string { return $this->crseName; }
		public function getuserRoster(): array { return $this->userRoster; }

		// setters
		//	 there's no "setID" because that would compromise the database's integrity
		public function setuniID(int $uniID) {  $this->uniID = $uniID; }
		public function setcrseID(string $crseID) {  $this->crseID = $crseID; }
		public function setsectNum(int $sectNum) {  $this->sectNum = $sectNum; }
		public function setcrseName(string $crseName) {  $this->crseName = $crseName; }
		public function setuserRoster(array $userRoster) {  $this->userRoster = $userRoster; }
	}

?>