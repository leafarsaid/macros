<?
  // posição inicial de leitura dos dados na linha
   $inicio = @strpos($linha, '**') - 5;   

   // lendo os dados da linha
   $dados = explode(";",$linha);
   $mct = @substr($linha, 0, 6);
   $trecho = @intval(@substr($linha, $inicio, 4));
   $competidor = 1*(@substr($linha, $inicio + 20));
   
   if ($trecho>=100 && $trecho<400) {
		$trecho=$trecho-100;
		$tipo_tempo = "L"; 
	} elseif ($trecho>=400) {
		$trecho=$trecho-400;
		$tipo_tempo = "CH"; 
	} else {
		$tipo_tempo = "C"; 
	} 
	
   $tempo_chegada = @substr($linha, $inicio + 8, 2) * 3600;
   $tempo_chegada += @substr($linha, $inicio + 11, 2) * 60;
   if ($tipo_tempo!='L') $tempo_chegada += @substr($linha, $inicio + 14, 2);
   if ($tipo_tempo!='L') $tempo_chegada += @substr($linha, $inicio + 17, 2) / 100;   

   $sql = "INSERT INTO t01_tempos (c01_valor, c01_tipo, c01_status, c03_codigo, c02_codigo, c01_sigla, c01_conta, c01_mct) VALUES ($tempo_chegada, '$tipo_tempo', getTempoStatus($competidor, $trecho, '$tipo_tempo'), getCodigoVeiculo($competidor), $trecho, '**', 0, 0)";

   // escrevendo no arquivo de log
   //@fwrite($arquivo.$log_novo, "$mct " . @substr($linha, $inicio, -1) . "\r\n");
 