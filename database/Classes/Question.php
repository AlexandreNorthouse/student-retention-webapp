<?php

	class Question
	{
		// Class variables, only accessible through getters
		private int $ID;
		private int $crseID;
		private string $qText;
		private string $aText;

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
		//	 there's no "setID" because that would compromise the database's integrity
		public function setCrseID(int $crseID) {  $this->crseID = $crseID; }
		public function setQText(string $qText) {  $this->qText = $qText; }
		public function setAText(string $aText) {  $this->aText = $aText; }
	}
	

	// demonstration code
	$test = new Question(1, 1, "What's this question?", "A test question!");

	echo ('= = Original Values = =');
	echo ('<br>Original ID: ' . $test->getID());
	echo ('<br>Original crseID: ' . $test->getCrseID());
	echo ('<br>Original qText: ' . $test->getQText());
	echo ('<br>Original aText: ' . $test->getAText());
	
	
	
	echo ('<br><br>= = New Values = =');
	$test->setCrseID(0);
	$test->setQText("asdf");
	$test->setAText("asdf");
	
	echo ('<br>New crseID: ' . $test->getCrseID());
	echo ('<br>New qText: ' . $test->getQText());
	echo ('<br>New aText: ' . $test->getAText());
?>