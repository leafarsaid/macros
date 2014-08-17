<?
//echo "abriu macro01";
   // posição inicial de leitura dos dados na linha
   $inicio = @strpos($linha, '$M01$')+5+1;
   
   // lendo os dados da linha
   $dados = explode(";",$linha);
   $mct = @substr($linha, 0, 6);
   $trecho = @intval(@substr($linha, $inicio + 1, 2));
   $competidor = @intval(@substr($linha, $inicio + 4, 3));
   $tempo = @substr($linha, $inicio + 8, 2) * 3600;
   $tempo += @substr($linha, $inicio + 11, 2) * 60;
   $tempo += @substr($linha, $inicio + 14, 2);
   $dec = @substr($linha, $inicio + 17, 1)*1;
   $cen = @substr($linha, $inicio + 18, 1)*1;
   
   $tipoTempo = "C";
   
   if ($trecho > 10 && $trecho < 20) {
        $tipoTempo = "I1";
		$trecho = $trecho-10;
	}
   if ($trecho > 20 && $trecho < 30) {
        $tipoTempo = "I2";
		$trecho = $trecho-20;
	}
   
   if ($dec>0 && $cen==0) $tempo += @substr($linha, $inicio + 17, 1) / 10;
   elseif ($dec>0 && $cen>0) $tempo += @substr($linha, $inicio + 17, 2) / 100;
   
   $obs = @substr($linha, $inicio + 18);
   
   // instrução sql
   
   print_r("trecho: ".$trecho."<br>");
   print_r("competidor: ".$competidor."<br>");
   print_r("tempo: ".$tempo."<br>");
   
   // instrução sql
   echo $sql1 = "INSERT INTO t01_tempos (c01_valor, c01_tipo, c01_status, c03_codigo, c02_codigo, c01_sigla, c01_conta, c01_mct, c01_obs) VALUES ($tempo, '$tipoTempo', getTempoStatus($competidor, $trecho, '$tipoTempo'), getCodigoVeiculo($competidor), $trecho, 'M01', $dados[0], $dados[1], '')";

   // insere o registro no banco
   $obj_controle->executa($sql1);
   
   // escrevendo no arquivo de log
   //@fwrite($arquivo.$log_novo, "$mct " . @substr($linha, $inicio, -1) . "\r\n");
   
      
   //print_r("$mct " . @substr($linha, $inicio, -1));