<?php

class DevExam{

	private $path_list = [];

	public function __construct()
	{
		$this->path_list = [
			'/home/user/folder1/folder2/kdh4kdk8.txt',
			'/home/user/folder1/folder2/565shdhh.txt',
			'/home/user/folder1/folder2/folder3/nhskkuu4.txt',
			'/home/user/folder1/iiskjksd.txt',
			'/home/user/folder1/folder2/folder3/owjekksu.txt'

		];
	}

	private function _methodNumberOne($path, $array) 
	{
		try 
		{
			
			$path = trim($path, '/');

		    $exploded = explode('/',$path);
		    if (count($exploded) > 1) {
		        $key = $exploded[0];

		        if (!isset($array[$key])){
		            $array[$key] = array();
		        }

		        $array[$key] = array_replace_recursive($array[$key], $this->_methodNumberOne(substr($path, strpos($path, '/')), $array[$key]));
		  
		    }
		    else{
		        if (!in_array($path, $array))
		            $array[] = $path;
		    }

		    return $array;  

		} catch (Exception $e) 
		{
			echo "<pre>";
			print_r($e);
		}
	    
	}

	public function _generaRandom($length=8)
	{
		try {
			$random = "";
			$string = "abcdefghijklmnopqrstuvwxyz";
			$string .= "0123456789";
			$max = strlen($string);

			for ($i=0; $i < $length; $i++) { 
				$random .= $string[rand(0, $max-1)];
			}

			return $random.".txt";	
		} catch (Exception $e) {
			print_r($e);
			die();
		}
		
	}

		/**
	* Use in method number three
	* random generation of path
	*/
	private function generatePath($base_path=NULL, $vpaths=1, $vdepth=1, $vfiles=1)
	{
		try {
			$data 	   = [];
			$full_path = "/home/user";
			if( $base_path!==NULL ){
				$full_path = $base_path;
			}

			for ($i=1; $i < $vpaths+1 ; $i++) 
			{ 
				$generated = $this->generateFolder($vdepth, $vfiles);
				$data[] = $full_path."/".$generated['depths'].$generated['files'][0];
			}

			return $data;
			
		} catch (Exception $e) {
			
		}
	}

	/**
	* Use in method number three
	* random generation of folder
	*/
	private function generateFolder($depth=1, $files=1)
	{
		try {
			$number_of_depth = rand(1,$depth);
			$folder_name = "";
			$folder_arr = [];
			for ($i=0; $i < $number_of_depth ; $i++) { 
					$number = $i+1; 
					$folder_name .= "folder".$number.'/';
			}
			$folder_arr = ['depths'=>$folder_name, 'files'=>$this->generateFile(3)];

			return $folder_arr;

		} catch (Exception $e) {
			
		}
	}

	/**
	* Use in method number three
	* random generation of file
	*/
	private function generateFile($files=1)
	{
		try {
			$number_of_files = rand(1, $files);
			$file_name = [];
			for ($i=0; $i < $number_of_files; $i++) { 
				$file_name[] = $this->_generaRandom(8);
			}
			return $file_name;
		} catch (Exception $e) {
			
		}
	}

	/**
	* Method Number 1
	*/
	public function methodNumberOne()
	{
		$list = $this->path_list;

		$nested_array = array();

		foreach($list as $path)
	    	$nested_array = $this->_methodNumberOne($path, $nested_array);

	    echo "<pre>";
	    print_r(array_reverse($nested_array));
	}


	/**
	* Method number 3
	*/
	public function methodNumberThree($base_path=NULL, $paths=1, $depths=1, $files=1)
	{
		try{
			$data = $this->generatePath($base_path, $paths, $depths, $files);
			print_r($data);

		} catch (Exception $e) {
			print_r($e);
		}
	}

	/**
	* Can't understand method number 2
	*/
	public function methodNumberTwo()
	{
		try {
			
		} catch (Exception $e) {
			
		}
	}

}

//Create new instance of class
$exam = new DevExam();

//Call methodNumberOne
echo "<pre>";
echo "* Method Number One";
echo "<br>";
echo "--------------------";
$exam->methodNumberOne();	

echo "<pre>";
echo "** Not finish method number two **";
echo "<br><br>";


echo "* Method Number Three";
echo "<br>";
echo "--------------------";
echo "<br>";
$exam->methodNumberThree(NULL, 5, 3, 3);	


