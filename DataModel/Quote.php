<?php 

	class Quote {

		private $idQuote;
		private $idVehicle;
		private $type;
		private $initial_amount;
		private $time_loan;
		private $month_amount;

		public function __construct($idQuote, $idVehicle, $type, $initial_amount, $time_loan, $month_amount) {
			$this -> idQuote = $idQuote;
			$this -> idVehicle = $idVehicle;
			$this -> type = $type;
			$this -> initial_amount = $initial_amount;
			$this -> time_loan = $time_loan;
			$this -> month_amount = $month_amount;
		}

		public function getIdQuote () {
			return $this -> idQuote;
		}

		public function getIdVehicle() {
			return $this -> idVehicle;
		}

		public function getType () {
			return $this -> type;
		}

		public function getInitialAmount() {
			return $this -> initial_amount;
		}

		public function getTimeLoan () {
			return $this -> time_loan;
		}

		public function getMonthAmount () {
			return $this -> month_amount;
		}


	}

 ?>