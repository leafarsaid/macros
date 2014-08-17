<?
   // posição inicial de leitura dos dados na linha

   $inicio = @strpos($linha, '$M23$')+5+1;
   //$inicio = $inicio -1;   

   // lendo os dados da linha

   $dados = explode(";",$linha);

   $mct = @substr($linha, 0, 6);
   $trecho = @intval(@substr($linha, $inicio + 1, 2));   

   $comp1 = @intval(@substr($linha, $inicio + 4, 3));   
   $l1 = @substr($linha, $inicio + 8, 2) * 3600;
   $l1 += @substr($linha, $inicio + 11, 2) * 60;
   $l1 += @substr($linha, $inicio + 14, 2);   

   $comp2 = @intval(@substr($linha, $inicio + 17, 3)); 
   $l2 = @substr($linha, $inicio + 21, 2) * 3600;
   $l2 += @substr($linha, $inicio + 24, 2) * 60;
   $l2 += @substr($linha, $inicio + 27, 2);   

   $comp3 = @intval(@substr($linha, $inicio + 30, 3)); 
   $l3 = @substr($linha, $inicio + 34, 2) * 3600;
   $l3 += @substr($linha, $inicio + 37, 2) * 60;
   $l3 += @substr($linha, $inicio + 40, 2);   

   $comp4 = @intval(@substr($linha, $inicio + 43, 3)); 
   $l4 = @substr($linha, $inicio + 47, 2) * 3600;
   $l4 += @substr($linha, $inicio + 50, 2) * 60;
   $l4 += @substr($linha, $inicio + 53, 2);

   

   // instrução sql
   $sql1 = "INSERT INTO t01_tempos (c01_valor, c01_tipo, c01_status, c03_codigo, c02_codigo, c01_sigla, c01_conta, c01_mct) VALUES ($l1, 'L', getTempoStatus($comp1, $trecho, 'L'), getCodigoVeiculo($comp1), $trecho, 'M23', 0, 0)";
   $sql2 = "INSERT INTO t01_tempos (c01_valor, c01_tipo, c01_status, c03_codigo, c02_codigo, c01_sigla, c01_conta, c01_mct) VALUES ($l2, 'L', getTempoStatus($comp2, $trecho, 'L'), getCodigoVeiculo($comp2), $trecho, 'M23', 0, 0)";
   $sql3 = "INSERT INTO t01_tempos (c01_valor, c01_tipo, c01_status, c03_codigo, c02_codigo, c01_sigla, c01_conta, c01_mct) VALUES ($l3, 'L', getTempoStatus($comp3, $trecho, 'L'), getCodigoVeiculo($comp3), $trecho, 'M23', 0, 0)";
   $sql4 = "INSERT INTO t01_tempos (c01_valor, c01_tipo, c01_status, c03_codigo, c02_codigo, c01_sigla, c01_conta, c01_mct) VALUES ($l4, 'L', getTempoStatus($comp4, $trecho, 'L'), getCodigoVeiculo($comp4), $trecho, 'M23', 0, 0)";

   // insere o registro no banco
   $obj_controle->executa($sql1);
   $obj_controle->executa($sql2);
   $obj_controle->executa($sql3);
   $obj_controle->executa($sql4);

   // escrevendo no arquivo de log
   //@fwrite($arquivo_log_novo, $mct . @substr($linha, $inicio, 60) . "\r\n");
   //print_r($mct . @substr($linha, $inicio, 60));