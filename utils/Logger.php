<?php

class Log
{
	private $handle;
	protected $fileName;

	public function __construct($prefix = 'log')
	{
		$this->setFileName("data_log/" . $prefix . "-" . date("Y-m-d") . ".log");
		$this->handle = fopen($this->fileName, 'a');
	}

	protected function setFileName($fileName)
	{
		$this->fileName= (is_string($fileName)) ? trim($fileName) : NULL;

		if (is_writeable($this->fileName)){
			touch($this->fileName);
		}
	}

	public function logMessage($logLevel, $message)
	{
		//Each entry is formated with YYYY-MM-DD HH:MM: SS [LEVEL] MESSAGE
		$todaysDate= date("Y-m-d");
		$todaysDateTime= date("h:i:s A");

		//Append string to file if file exists or create file and write
		$formattedMessage = $todaysDate . " ". $todaysDateTime .  " " . $logLevel . " " . $message . PHP_EOL;
		fwrite($this->handle, $formattedMessage);
	}

	public function info($message)
	{
		$this->logMessage("Info", $message);
	}

	public function error($message)
	{
		$this->logMessage("Error", $message);
	}

	public function __destruct(){
		fclose($this->handle);
	}
}
?>