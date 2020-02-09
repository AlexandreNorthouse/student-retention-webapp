<?php
	
	class University
	{
		// Class variables, only accessible through getters
		private int $ID;
		private string $name;

		// constructor method
		public function __construct(int $ID, string $name)
		{
			$this->ID	= $ID;
			$this->name	= $name;
		}

		// getters
		public function getID(): int { return $this->ID; }
		public function getName(): string { return $this->name; }

		// setters
		//	 there's no "setID" because that would compromise the database's integrity
		public function setName(string $name) {  $this->name = $name; }
	}

?>