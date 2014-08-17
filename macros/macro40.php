<?
   // posição inicial de leitura dos dados na linha
   $inicio = @strpos($linha, '$M40$')+5+1;
   //$inicio = $inicio -1; 

   // lendo os dados da linha
   $dados = explode(";",$linha);
   $mct = @substr($linha, 0, 6);
   $trecho = @intval(@substr($linha, $inicio + 1, 2));

   $la = @substr($linha, $inicio + 4, 2) * 3600;
   $la += @substr($linha, $inicio + 7, 2) * 60;
   $la += @substr($linha, $inicio + 10, 2);

   $competidor1 = @intval(@substr($linha, $inicio + 13, 3));
   $c1 = @substr($linha, $inicio + 17, 2) * 3600;
   $c1 += @substr($linha, $inicio + 20, 2) * 60;
   $c1 += @substr($linha, $inicio + 23, 2);
   $c1 += @substr($linha, $inicio + 26, 2) / 10;
   $competidor2 = @intval(@substr($linha, $inicio + 29, 3));
   $c2 = @substr($linha, $inicio + 33, 2) * 3600;
   $c2 += @substr($linha, $inicio + 36, 2) * 60;
   $c2 += @substr($linha, $inicio + 39, 2);
   $c2 += @substr($linha, $inicio + 42, 2) / 10;

   // instrução sql    
   $sql1 = "INSERT INTO t01_tempos (c01_valor, c01_tipo, c01_status, c03_codigo, c02_codigo, c01_sigla, c01_conta, c01_mct) VALUES ($la, 'L', getTempoStatus($competidor1, $trecho, 'L'), getCodigoVeiculo($competidor1), $trecho, 'M40', 0, 0)";
   $sql2 = "INSERT INTO t01_tempos (c01_valor, c01_tipo, c01_status, c03_codigo, c02_codigo, c01_sigla, c01_conta, c01_mct) VALUES ($c1, 'C', getTempoStatus($competidor1, $trecho, 'C'), getCodigoVeiculo($competidor1), $trecho, 'M40', 0, 0)";
   $sql3 = "INSERT INTO t01_tempos (c01_valor, c01_tipo, c01_status, c03_codigo, c02_codigo, c01_sigla, c01_conta, c01_mct) VALUES ($la, 'L', getTempoStatus($competidor2, $trecho, 'L'), getCodigoVeiculo($competidor2), $trecho, 'M40', 0, 0)";
   $sql4 = "INSERT INTO t01_tempos (c01_valor, c01_tipo, c01_status, c03_codigo, c02_codigo, c01_sigla, c01_conta, c01_mct) VALUES ($c2, 'C', getTempoStatus($competidor2, $trecho, 'C'), getCodigoVeiculo($competidor2), $trecho, 'M40', 0, 0)";

   // insere o registro no banco
   $obj_controle->executa($sql1);
   $obj_controle->executa($sql2);
   $obj_controle->executa($sql3);
   $obj_controle->executa($sql4);   

   // escrevendo no arquivo de log
   //@fwrite($arquivo_log_novo, $mct . @substr($linha, $inicio, 100) . "\r\n");
   //print_r($mct . @substr($linha, $inicio, 100));
