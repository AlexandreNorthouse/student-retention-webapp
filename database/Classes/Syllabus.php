<?php
	
	class Syllabus
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
		public function getCourseTitle(): string { return $this->courseTitle; }
		public function getContactInformation(): string { return $this->contactInformation; }
		public function getOfficeHoursPolicy(): string { return $this->officeHoursPolicy; }
		public function getCourseDescription(): string { return $this->courseDescription; }
		public function getCourseGoals(): string { return $this->courseGoals; }
		public function getRequiredMaterials(): string { return $this->requiredMaterials; }
		public function getGradingPolicy(): string { return $this->gradingPolicy; }
		public function getAttendancePolicy(): string { return $this->attendancePolicy; }
		public function getUniversityPolicy(): string { return $this->universityPolicy; }
		public function getStudentResources(): string { return $this->studentResources; }

		// setters
		//	 there's no "setID" because that would compromise the database's integrity
		public function setCrseID(int $crseID) {  $this->crseID = $crseID; }
		public function setCourseTitle(string $courseTitle) {  $this->courseTitle = $courseTitle; }
		public function setContactInformation(string $contactInformation) {  $this->contactInformation = $contactInformation; }
		public function setOfficeHoursPolicy(string $officeHoursPolicy) {  $this->officeHoursPolicy = $officeHoursPolicy; }
		public function setCourseDescription(string $courseDescription) {  $this->courseDescription = $courseDescription; }
		public function setCourseGoals(string $courseGoals) {  $this->courseGoals = $courseGoals; }
		public function setRequiredMaterials(string $requiredMaterials) {  $this->requiredMaterials = $requiredMaterials; }
		public function setGradingPolicy(string $gradingPolicy) {  $this->gradingPolicy = $gradingPolicy; }
		public function setAttendancePolicy(string $attendancePolicy) {  $this->attendancePolicy = $attendancePolicy; }
		public function setUniversityPolicy(string $universityPolicy) {  $this->universityPolicy = $universityPolicy; }
		public function setStudentResources(string $studentResources) {  $this->studentResources = $studentResources; }
	}

?>