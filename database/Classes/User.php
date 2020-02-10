<?php
	
	class User
	{
		// Class variables, only accessible through getters
		private int $ID;
		private int $uniID;
		private string $username;
		private string $password;
		private string $fname;
		private string $lname;
		private bool $isProf;
		private array $courseRoster;

		// constructor method
		public function __construct(int $ID, int $crseID, string $username, string $password, string $fname, string $lname, bool $isProf)
		{
			$this->ID		= $ID;
			$this->crseID	= $crseID;
			$this->username	= $username;
			$this->password	= $password;
			$this->fname	= $fname;
			$this->lname	= $lname;
			$this->isProf	= $isProf;
			$this->courseRoster	= DatabaseMethods::getCourseRoster($ID);
		}

		// getters
		public function getID(): int { return $this->ID; }
		public function getCrseID(): int { return $this->crseID; }
		public function getUsername(): string { return $this->username; }
		public function getPassword(): string { return $this->password; }
		public function getFName(): string { return $this->fname; }
		public function getLName(): string { return $this->lname; }
		public function getIsProf(): bool { return $this->isProf; }
		public function getCourseRoster(): array { return $this->courseRoster; }

		// setters
		//	 there's no "setID" because that would compromise the database's integrity
		public function setCrseID(int crseID) {  $this->crseID = crseID; }
		public function setUsername(string $username) {  $this->username = $username; }
		public function setPassword(string $password) {  $this->password = $password; }
		public function setFName(string $fname) {  $this->fname = $fname; }
		public function setLName(string $lname) {  $this->lname = $lname; }
		public function setIsProf(bool $isProf) {  $this->isProf = $isProf; }
		public function setCourseRoster(array $courseRoster) {  $this->courseRoster = $courseRoster; }
	}

?>