<?php

	class vcardexp
	{
		var $fields = array();
		
		var $allowed = array(
			"fName", "picture","lname", "birth_date","email", "adress", "descr", "interests"
		);
		
		function setValue($setting, $value)
		{
			if(in_array($setting, $this->allowed))
			{
				$this->fields[$setting] = $value;
				return true;
			}
			else
			{
				return false;
			}
		
		}
		
		
		
		function copyPicture($path)
		{
			if(is_file($path))
			{
				$temp = getimagesize($path);
				if($temp[0] <= 185 && $temp[1] <= 185)
				{
					$this->fields["picture"] = base64_encode(file_get_contents ($path));
					return true;
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
		}

		function setPicture($value)
		{
			$this->fields["picture"] = $value;
			return true;
		}
		
		
		
		function dump()
		{
		
			echo "<pre>";
			print_r($this->fields);
			echo "</pre>";
			return true;
		
		}
		
		
		
		function getCard()
		{
		
			//Header ausgeben
			header('Content-Type: text/x-vcard');
			header('Content-Disposition: attachment; filename=data.vcf');
			
			$card  = "BEGIN:VCARD\n";
			$card .= "VERSION:2.1\n";

			$card .= "FN:".$this->fields["fName"]."\n";
			$card .= "LN:".$this->fields["lName"]."\n";
			$card .= "B:".$this->fields["birth_date"]."\n";
			$card .= "E:".$this->fields["email"]."\n";
			$card .= "A:".$this->fields["adress"]."\n";
			$card .= "D:".$this->fields["description"]."\n";
			$card .= "I:".$this->fields["interests"]."\n";
			
			
			if(isset($this->fields["picture"]))
			{
				$card .= "PHOTO;TYPE=JPEG;ENCODING=BASE64:\n";
				$card .= $this->fields["picture"];
				$card .= "\n\n\n";
			}

			$card .= "END:VCARD";

			echo $card;
			$card = "";
		}
	
	}

?>