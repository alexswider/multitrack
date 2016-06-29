<?php
/*
 * Cache functions
 */
class cache {
	protected $filename;
	protected $tempfilename;
	protected $expriration;
	protected $fp;
	public function __construct($filename, $expiration=false) {
		$this->filename = $filename;
		$this->tempfilename = "$filename.".getmypid();
		$this->expiration = $expiration;
	}
	public function put($buffer) {
		if(($this->fp = fopen($this->tempfilename, "w")) == false) {
			return false;
		}
		fwrite($this->fp, $buffer);
		fclose($this->fp);
		rename($this->tempfilename, $this->filename);
		return true;
	}
	public function get() {
		if($this->expiration) {
			$stat = @stat($this->filename);
			if($stat[9]) {
				if(time() > $modified + $this->expiration) {
					unlink($this->filename);
					return false;
				}
			}
		}
		return @file_get_contents($this->filename);
	}
	public function remove() {
			@unlink($filename);
	}
	public function begin() {
		if(($this->fp = fopen($this->tempfilename, "w")) == false) {
			return false;
		}
		ob_start();
	}
	public function end() {
		$buffer = ob_get_contents();
		ob_end_flush();
		if(strlen($buffer)) {
			fwrite($this->fp, $buffer);
			fclose($this->fp);
			rename($this->tempfilename, $this->filename);
			return true;
		}
		else {
			fclose($this->fp);
			unlink($this->tempfilename);
			return false;
		}
	}
}
?>