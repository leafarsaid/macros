<?
  // posição inicial de leitura dos dados na linha
   //$#LP#$ 001 200 11:49:19 11:51:00
   $inicio = @strpos($linha, '$#LP#$');  

   // lendo os dados da linha
   $dados = explode(";",$linha);
   $trecho = @intval(@substr($linha, $inicio + 7, 3));
   $competidor = @intval(@substr($linha, $inicio + 11, 3));   

   $tempo_ch = @substr($linha, $inicio + 15, 2) * 3600;
   $tempo_ch += @substr($linha, $inicio + 18, 2) * 60;
   $tempo_ch += @substr($linha, $inicio + 21, 2);   

   $tempo_largada = @substr($linha, $inicio + 24, 2) * 3600;
   $tempo_largada += @substr($linha, $inicio + 27, 2) * 60;
   $tempo_largada += @substr($linha, $inicio + 30, 2);   

   // instrução sql
   $sql = array();
   $sql[] = "INSERT INTO t01_tempos (c01_valor, c01_tipo, c01_status, c03_codigo, c02_codigo, c01_sigla, c01_conta, c01_mct) VALUES ($tempo_ch, 'CH', getTempoStatus($competidor, $trecho, 'CH'), getCodigoVeiculo($competidor), $trecho, 'LP', 0, 0)";
   $sql[] = "INSERT INTO t01_tempos (c01_valor, c01_tipo, c01_status, c03_codigo, c02_codigo, c01_sigla, c01_conta, c01_mct) VALUES ($tempo_largada, 'L', getTempoStatus($competidor, $trecho, 'L'), getCodigoVeiculo($competidor), $trecho, 'LP', 0, 0)";

   // escrevendo no arquivo de log
   //@fwrite($arquivo.$log_novo, "$mct " . @substr($linha, $inicio, -1) . "\r\n");