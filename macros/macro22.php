<?
//59871794;958880;          $M22$;_01_100_09_05_00;Jul 17 2013  1:03AM
  // posição inicial de leitura dos dados na linha
   $inicio = @strpos($linha, '$M22$')+5+1;
   //$inicio = $inicio -1;   

   // lendo os dados da linha
   $dados = explode(";",$linha);
   $mct = @substr($linha, 0, 6);
   $trecho = @intval(@substr($linha, $inicio + 1, 2));
   $competidor = @intval(@substr($linha, $inicio + 4, 3));
   $tempo = @substr($linha, $inicio + 8, 2) * 3600;
   $tempo += @substr($linha, $inicio + 11, 2) * 60;
   $tempo += @substr($linha, $inicio + 14, 2);
   $obs = @substr($linha, $inicio + 16);   
   
   echo "<br>trecho=".substr($linha, $inicio + 1, 2)."<br>";

   // instrução sql
   echo $sql1 = "INSERT INTO t01_tempos (c01_valor, c01_tipo, c01_status, c03_codigo, c02_codigo, c01_sigla, c01_conta, c01_mct, c01_obs) VALUES ($tempo, 'L', getTempoStatus($competidor, $trecho, 'L'), getCodigoVeiculo($competidor), $trecho, 'M22', 0, 0, '')";

   // insere o registro no banco
   $obj_controle->executa($sql1);   

   // escrevendo no arquivo de log
   //@fwrite($arquivo_log_novo, $mct . @substr($linha, $inicio, 18) . "\r\n");
   //print_r($mct . @substr($linha, $inicio, 18));

        