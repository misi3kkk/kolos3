<html>
<head>
	<title>Kalkulator BMI</title>
</head>
<body>
<form method="POST" action="">
	Kalkulator BMI
	<br>Podaj płeć:
	<input type="radio" value="m" name="plec"/>Mężczyzna
	<input type="radio" value="k" name="plec"/>Kobieta<br>
	Podaj wzrost:
	<input type="text" name="wzrost"/>
	<br>Podaj wagę:
	<input type="text" name="waga"/>
	<br>Podaj wiek:
	<input type="text" name="wiek"/>
	<br>Poziom aktywności fizycznej:
	<br>
	<select name="aktywnosc">
		<option name="akt1" value="akt1">Brak aktywności</option>
		<option name="akt2" value="akt2">Bardzo lekka aktywność (1 dzień w tygodniu)</option>
		<option name="akt3" value="akt3">Lekka aktywność (2-3 dni w tygodniu)</option>
		<option name="akt4" value="akt4">Średnia aktywność (4-5 dni w tygodniu)</option>
		<option name="akt5" value="akt5">Duża aktywność (codziennie)</option>
		<option name="akt6" value="akt6">Bardzo duża aktywność</option>
	</select>
	<br>
	<input type="submit" value="Zapisz i oblicz" name="submit"/>
	<br>
	</form>
	<?php
	error_reporting(0);
	$ra = "";
	$CPM = 0;
	$PAL = 0;
	$aktywnosc = $_POST['aktywnosc'];
	$wzrost = $_POST['wzrost'];
	$waga = $_POST['waga'];
	$wiek = $_POST['wiek'];
	$plec = $_POST['plec'];
	function calculateBMI($waga, $wzrost)
	{
    return round($waga / (($wzrost / 100) ** 2), 2);
    }
	function calculatePPM($waga, $wzrost, $wiek)
	{
    return round((10*$waga)+(6.25*$wzrost)-(5*$wiek)+5);
    }
	function calculateCPM($PAL, $PPM)
	{
		return round($PPM*$PAL);
	}
	$PPM = calculatePPM($waga, $wzrost, $wiek);
	$bmi = calculateBMI($waga, $wzrost);	
	echo "Twoje BMI wynosi: ". $bmi;
	echo " Twoje PPM wynosi: ". $PPM;
	if($plec == "m")
	{
		if($aktywnosc == "akt1")
		{
			$PAL = 1.2;
			$ra = "Brak aktywności";
		}
		else if($aktywnosc == "akt2")
		{
			$PAL = 1.3;
			$ra = "Bardzo lekka aktywność (1 dzień w tygodniu)";
		}
		else if($aktywnosc == "akt3")
		{
			$PAL = 1.6;
			$ra = "Lekka aktywność (2-3 dni w tygodniu)";
		}
		else if($aktywnosc == "akt4")
		{
			$PAL = 1.7;
			$ra = "Średnia aktywność (4-5 dni w tygodniu)";
		}
		else if($aktywnosc == "akt5")
		{
			$PAL = 2.1;
			$ra = "Duża aktywność (codziennie)";
		}
		else if($aktywnosc == "akt6")
		{
			$PAL = 2.4;
			$ra = "Bardzo duża aktywność";
		}
	}
	else if($plec == "k")
	{
		if($aktywnosc == "akt1")
		{
			$PAL = 1.2;
			$ra = "Brak aktywności";
		}
		else if($aktywnosc == "akt2")
		{
			$PAL = 1.3;
			$ra = "Bardzo lekka aktywność (1 dzień w tygodniu)";
		}
		else if($aktywnosc == "akt3")
		{
			$PAL = 1.5;
			$ra = "Lekka aktywność (2-3 dni w tygodniu)";
		}
		else if($aktywnosc == "akt4")
		{
			$PAL = 1.6;
			$ra = "Średnia aktywność (4-5 dni w tygodniu)";
		}
		else if($aktywnosc == "akt5")
		{
			$PAL = 1.9;
			$ra = "Duża aktywność (codziennie)";
		}
		else if($aktywnosc == "akt6")
		{
			$PAL = 2.2;
			$ra = "Bardzo duża aktywność";
		}
	}
	$CPM = calculateCPM($PAL, $PPM);
	echo " Twoje CPM wynosi: ". $CPM;
	$polaczenie = new mysqli('localhost', 'root', '', 'kolos_bmi');
	$query = "INSERT INTO raport values ('$wzrost', '$waga', '$wiek', '$plec', '$bmi', '$ra')";
	$result = mysqli_query($polaczenie, $query);
	if($bmi<16)
	{
		echo "	Wygłodzenie!";
	}
	else if($bmi>=16 && $bmi<=16.99)
	{
		echo "	Wychudzenie!";
	}
	else if($bmi>=17 && $bmi<=24.99)
	{
		echo "	Waga prawidłowa";
	}
	else if($bmi>=25 && $bmi<=29.99)
	{
		echo "	Nadwaga!";
	}
	else if($bmi>=30 && $bmi<=34.99)
	{
		echo "	I stopień otyłości";
	}
	else if($bmi>=35 && $bmi<=39.99)
	{
		echo "	II stopień otyłości";
	}
	else if($bmi>=40)
	{
		echo "	Otyłość skrajna!";
	}
	?>
</body>
</html>