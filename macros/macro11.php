<?
   // posição inicial de leitura dos dados na linha
//echo $linha = "59871794;958880;$M11$;_01_100_15_14_13_12_11_22_00;Jul 17 2013  1:08AM";
   $inicio = @strpos($linha, '$M11$')+5+1;
   //$inicio = $inicio -1;   

   $dados = explode(";",$linha);
   $mct = @substr($linha, 0, 6);
   $trecho = @intval(@substr($linha, $inicio + 1, 2));
   $competidor = @intval(@substr($linha, $inicio + 4, 3));
   $tempo = @substr($linha, $inicio + 8, 2) * 3600;
   $tempo += @substr($linha, $inicio + 11, 2) * 60;
   $tempo += @substr($linha, $inicio + 14, 2);
   $tempo += @substr($linha, $inicio + 17, 2) / 100;
   $tempo2 = @substr($linha, $inicio + 20, 2) * 3600;
   $tempo2 += @substr($linha, $inicio + 23, 2) * 60;
   $tempo2 += @substr($linha, $inicio + 26, 2);   

   // instrução sql   

   print_r("trecho: ".$trecho."<br>");
   print_r("competidor: ".$competidor."<br>");
   print_r("tempo: ".$tempo."<br>");      

   echo $sql1 = "INSERT INTO t01_tempos (c01_valor, c01_tipo, c01_status, c03_codigo, c02_codigo, c01_sigla, c01_conta, c01_mct) VALUES ($tempo, 'C', getTempoStatus($competidor, $trecho, 'C'), getCodigoVeiculo($competidor), $trecho, 'M11', 0, 0)";   
   echo $sql2 = "INSERT INTO t01_tempos (c01_valor, c01_tipo, c01_status, c03_codigo, c02_codigo, c01_sigla, c01_conta, c01_mct) VALUES ($tempo2, 'L', getTempoStatus($competidor, $trecho, 'L'), getCodigoVeiculo($competidor), $trecho, 'M11', 0, 0)";

   // insere o registro no banco
   $obj_controle->executa($sql1);
   $obj_controle->executa($sql2);   

   // escrevendo no arquivo de log
   //@fwrite($arquivo_log_novo, $mct . @substr($linha, $inicio, 30) . "\r\n");
   //print_r($mct . @substr($linha, $inicio, 30));