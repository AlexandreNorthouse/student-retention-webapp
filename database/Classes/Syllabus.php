<?php
	
	class Question
	{
		// Class variables, only accessible through getters
		private int $ID;
		private int $crseID;
		private string $courseTitle;
		private string $contactInformation;
		private string $officeHoursPolicy;
		private string $courseDescription;
		private string $courseGoals;
		private string $requiredMaterials;
		private string $gradingPolicy;
		private string $attendancePolicy;
		private string $universityPolicy;
		private string $studentResources;

		// constructor method
		public function __construct(int $ID, int $crseID, string $courseTitle, 
			string $contactInformation, string $officeHoursPolicy, string $courseDescription, 
			string $courseGoals, string $requiredMaterials, string $gradingPolicy, 
			string $attendancePolicy, string $universityPolicy, string $studentResources)
		{
			$this->ID		= $ID;
			$this->crseID	= $crseID;
			$this->courseTitle			= $courseTitle;
			$this->contactInformation	= $contactInformation;
			$this->officeHoursPolicy	= $officeHoursPolicy;
			$this->courseDescription	= $courseDescription;
			$this->courseGoals			= $courseGoals;
			$this->requiredMaterials	= $requiredMaterials;
			$this->gradingPolicy		= $gradingPolicy;
			$this->attendancePolicy		= $attendancePolicy;
			$this->universityPolicy		= $universityPolicy;
			$this->studentResources		= $studentResources;
		}

		// getters
		public function getID(): int { return $this->ID; }
		public function getCrseID(): int { return $this->crseID; }
		public function get(): string { return $this->; }
		public function get(): string { return $this->; }
		public function get(): string { return $this->; }
		public function get(): string { return $this->; }
		public function get(): string { return $this->; }
		public function get(): string { return $this->; }
		public function get(): string { return $this->; }
		public function get(): string { return $this->; }
		public function get(): string { return $this->; }
		public function get(): string { return $this->; }

		// setters
		//	 there's no "setID" because that would compromise the database's integrity
		public function setCrseID(int $crseID) {  $this->crseID = $crseID; }
		public function set(string ) {  $this-> = ; }
		public function set(string ) {  $this-> = ; }
		public function set(string ) {  $this-> = ; }
		public function set(string ) {  $this-> = ; }
		public function set(string ) {  $this-> = ; }
		public function set(string ) {  $this-> = ; }
		public function set(string ) {  $this-> = ; }
		public function set(string ) {  $this-> = ; }
		public function set(string ) {  $this-> = ; }
		public function set(string ) {  $this-> = ; }
	}

?>