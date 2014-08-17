<?
  // posição inicial de leitura dos dados na linha
   $inicio = @strpos($linha, '$#LC#$');   

   // lendo os dados da linha
   $dados = explode(";",$linha);
   $mct = @substr($linha, 0, 6);
   $trecho = @intval(@substr($linha, $inicio + 7, 3));
   $competidor = @intval(@substr($linha, $inicio + 11, 3));   

   $tempo_largada = @substr($linha, $inicio + 15, 2) * 3600;
   $tempo_largada += @substr($linha, $inicio + 18, 2) * 60;
   $tempo_largada += @substr($linha, $inicio + 21, 2);   

   // instrução sql
   $sql = array();
   $sql[] = "INSERT INTO t01_tempos (c01_valor, c01_tipo, c01_status, c03_codigo, c02_codigo, c01_sigla, c01_conta, c01_mct) VALUES ($tempo_largada, 'L', 'E', getCodigoVeiculo($competidor), $trecho, 'LC', 0, 0)";

   // escrevendo no arquivo de log
   //@fwrite($arquivo.$log_novo, "$mct " . @substr($linha, $inicio, -1) . "\r\n");
   //print_r("$mct " . @substr($linha, $inicio, -1));   
