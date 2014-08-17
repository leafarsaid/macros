<?
	  $dados = explode(";",$linha);

	  $mct= 0;

   // posição inicial de leitura dos dados na linha

   $inicio = @strpos($linha, '$M06$')+5+1;

  // lendo os dados da linha

   $achou = 0;

   $b = $linha;

	for ($i=0;$i<500;$i++) {

		if ($b[$i] == "_" && $achou==0) {

			/*

			$local = "";			

			for ($l=138;$l<191;$l++) {

				$local .= $b[$l];				

			}	

			*/

			

			//////// remetente - usuário

			/*

			$j=2;			

			$rem1 = $b[$i+1];

			$sair=0;

			while ($sair == 0) {

				if ($b[$i+$j] == "_" || $b[$i+$j] == "") $sair = 1;

				else {

					$rem1 = sprintf("%s%s",$rem1,$b[$i+$j]);

					$sair = 0;

					$j++;

				}

			}

			//////// remetente - domínio

			$j=$j+1;

			$sair=0;

			$dom1 = $b[$i+$j];

			$j=$j+1;

			while ($sair == 0) {

				if ($b[$i+$j] == "_" || $b[$i+$j] == "") $sair = 1;

				else {

					$dom1 = sprintf("%s%s",$dom1,$b[$i+$j]);

					$sair = 0;

					$j++;

				}

			}

			*/

			//////// destinatário - usuário

			//$j=$j+1;

			$j=1;

			$sair=0;

			$des2 = $b[$i+$j];

			$j=$j+1;

			while ($sair == 0) {

				if ($b[$i+$j] == "_" || $b[$i+$j] == "") $sair = 1;

				else {

					$des2 = sprintf("%s%s",$des2,$b[$i+$j]);

					$sair = 0;

					$j++;

				}

			}

			//////// destinatário - domínio

			$j=$j+1;

			$sair=0;

			$dom2 = $b[$i+$j];

			$j=$j+1;

			while ($sair == 0) {

				if ($b[$i+$j] == "_" || $b[$i+$j] == "") $sair = 1;

				else {

					$dom2 = sprintf("%s%s",$dom2,$b[$i+$j]);

					$sair = 0;

					$j++;

				}

			}

			//////// titulo

			$j=$j+1;

			$sair=0;

			$tit = $b[$i+$j];

			$j=$j+1;

			while ($sair == 0) {

				if ($b[$i+$j] == "_" || $b[$i+$j] == "") $sair = 1;

				else {

					$tit = sprintf("%s%s",$tit,$b[$i+$j]);

					$sair = 0;

					$j++;

				}

			}

			//////// msg

			$j=$j+1;

			$sair=0;

			$msg = $b[$i+$j];

			$j=$j+1;

			while ($sair == 0) {

				if ($b[$i+$j] == "") $sair = 1;

				else {

					$msg = sprintf("%s%s",$msg,$b[$i+$j]);

					$sair = 0;

					$j++;

				}

			}

			$achou = 1;

//$rem1 = strtolower($rem1);

//$dom1 = strtolower($dom1);

$des2 = strtolower($des2);

$dom2 = strtolower($dom2);

$msg = sprintf("%s\n\nLocal:%s",$msg,$local);

//echo "DE: ".$remetente = sprintf("%s@%s",$rem1,$dom1);

//echo "DE: ".$remetente = "chronosat@chronosat.com.br";

echo "DE:".$remetente = $mct."@chronosat.com.br";

//echo "DE:".$remetente = "fca@chronosat.com.br";

echo "<br>";

echo "PARA: ".$destinatario = sprintf("%s@%s",$des2,$dom2);

echo "<br><br>";

echo $tit;

echo "<br><br>";

echo $msg;

echo "<br><br><br>";

$hora = gmstrftime ("%d/%m/%y - %T",time()-10800);

echo $guarda = sprintf("\nDATA:\t%s\nDE:\t%s\nPARA:\t%s\n\n%s\n\n%s\n\n\n",$hora,$remetente,$destinatario,$tit,$msg);

mail($destinatario,$tit,$msg,"From: $remetente\r\n");

mail("rafael78@gmail.com",$tit,$msg,"From: $remetente\r\n");

		}

	}

             
