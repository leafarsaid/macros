<?
  // posição inicial de leitura dos dados na linha

   $inicio = @strpos($linha, '$M24$')+5+1;
   //$inicio = $inicio -1;

   // lendo os dados da linha
   $dados = explode(";",$linha);
   $mct = @substr($linha, 0, 6);
   $trecho = @intval(@substr($linha, $inicio + 1, 2));
   $comp1 = @intval(@substr($linha, $inicio + 4, 3));   
   $c1 = @substr($linha, $inicio + 8, 2) * 3600;
   $c1 += @substr($linha, $inicio + 11, 2) * 60;
   $c1 += @substr($linha, $inicio + 14, 2);
   $c1 += @substr($linha, $inicio + 17, 2)/100;
   $comp2 = @intval(@substr($linha, $inicio + 20, 3));   
   $c2 = @substr($linha, $inicio + 24, 2) * 3600;
   $c2 += @substr($linha, $inicio + 27, 2) * 60;
   $c2 += @substr($linha, $inicio + 30, 2);
   $c2 += @substr($linha, $inicio + 33, 2)/100;
   $comp3 = @intval(@substr($linha, $inicio + 36, 3));   
   $c3 = @substr($linha, $inicio + 40, 2) * 3600;
   $c3 += @substr($linha, $inicio + 43, 2) * 60;
   $c3 += @substr($linha, $inicio + 46, 2);
   $c3 += @substr($linha, $inicio + 49, 2)/100;
   $comp4 = @intval(@substr($linha, $inicio + 52, 3));   
   $c4 = @substr($linha, $inicio + 56, 2) * 3600;
   $c4 += @substr($linha, $inicio + 59, 2) * 60;
   $c4 += @substr($linha, $inicio + 62, 2);
   $c4 += @substr($linha, $inicio + 65, 2)/100;

   // instrução sql

   $sql1 = "INSERT INTO t01_tempos (c01_valor, c01_tipo, c01_status, c03_codigo, c02_codigo, c01_sigla, c01_conta, c01_mct) VALUES ($c1, 'C', getTempoStatus($comp1, $trecho, 'C'), getCodigoVeiculo($comp1), $trecho, 'M24', 0, 0)";
   $sql2 = "INSERT INTO t01_tempos (c01_valor, c01_tipo, c01_status, c03_codigo, c02_codigo, c01_sigla, c01_conta, c01_mct) VALUES ($c2, 'C', getTempoStatus($comp2, $trecho, 'C'), getCodigoVeiculo($comp2), $trecho, 'M24', 0, 0)";
   $sql3 = "INSERT INTO t01_tempos (c01_valor, c01_tipo, c01_status, c03_codigo, c02_codigo, c01_sigla, c01_conta, c01_mct) VALUES ($c3, 'C', getTempoStatus($comp3, $trecho, 'C'), getCodigoVeiculo($comp3), $trecho, 'M24', 0, 0)";
   $sql4 = "INSERT INTO t01_tempos (c01_valor, c01_tipo, c01_status, c03_codigo, c02_codigo, c01_sigla, c01_conta, c01_mct) VALUES ($c4, 'C', getTempoStatus($comp4, $trecho, 'C'), getCodigoVeiculo($comp4), $trecho, 'M24', 0, 0)";

   // insere o registro no banco

   $obj_controle->executa($sql1);
   $obj_controle->executa($sql2);
   $obj_controle->executa($sql3);
   $obj_controle->executa($sql4);
   // escrevendo no arquivo de log
   //@fwrite($arquivo_log_novo, $mct . @substr($linha, $inicio, 60) . "\r\n");
   //print_r($mct . @substr($linha, $inicio, 60));

            