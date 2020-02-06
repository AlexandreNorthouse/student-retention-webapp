<?php
	
	class Question
	{
		// Class variables, only accessible through getters
		private int $ID;
		private int $crseID;
		private string $qText;
		private string $aText;
		private array $userRoster;

		// constructor method
		public function __construct(int $ID, int $crseID, string $qText, string $aText)
		{
			$this->ID		= $ID;
			$this->crseID	= $crseID;
			$this->qText	= $qText;
			$this->aText	= $aText;
		}

		// getters
		public function getID(): int { return $this->ID; }
		public function getCrseID(): int { return $this->crseID; }
		public function getQText(): string { return $this->qText; }
		public function getAText(): string { return $this->aText; }

		// setters
		public function setID(int $ID) {  $this->ID = $ID; }
		public function setCrseID(int $crseID) {  $this->crseID = $crseID; }
		public function setQText(string $qText) {  $this->qText = $qText; }
		public function setAText(string $aText) {  $this->aText = $aText; }
	}

?>