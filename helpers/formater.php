<?php 

class Formater{
	public function DateFormater($date){
		return date("F j, Y, g:i a",strtotime($date));
	}

	public function PostFormater($str,$size){
		$text=" ";
		$ln=strlen($str);
		if ($ln<$size){
			$text= $text.$str."......";
		}
		else{
			$text=$text.substr($str,0,$size);
			$text=substr($text,0,strrpos($text, " "));
			$text=$text."...";
		}
		return $text;
	}

	public function validation($data){
		$data=trim($data);
		$data=stripcslashes($data);
		$data=htmlspecialchars($data);
		return $data;
	}
	public function title(){
		$path=$_SERVER['SCRIPT_FILENAME'];
		$title=basename($path,'.php');
		if($title == 'index'){
			$title='Home';
		}elseif($title=='contact'){
        $title='contact';
		}
		return $title=ucwords($title);


	}
}


?>