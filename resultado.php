<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado3</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
  <main>
    <h1>Resultado final</h1>

    <p>
    <?php
    $inicio = date("m-d-Y", strtotime("-7 days"));
    $fim = date("m-d-Y");
    $url = 'https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarPeriodo(dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@dataInicial=\''. $inicio .'\'&@dataFinalCotacao=\''. $fim .'\'&$top=1&$orderby=dataHoraCotacao%20desc&$format=json&$select=cotacaoCompra,dataHoraCotacao';

    $dados = json_decode(file_get_contents($url), true);
    $cotacao = $dados["value"][0]["cotacaoCompra"];

    $real = $_GET["numero"];
    $dolar = ("$real" / "$cotacao");

      echo "Seus R\$" . number_format($real, 2, "," , ".") . " equivalem a US\$ " . number_format($dolar, 2, "," , ".");
      echo "<p>'Cotação obtida diretamente do site do <strong>Banco Central do Brasil'</strong></p>";

    //formatação de moedas com internacionalização
    //biblioteca intl(internacionalização PHP)
    // $padrão = numfmt_create("pt_BR" , NumberFormatter::CURRENCY);
    //   echo "Seus " . numfmt_format_currency($padrão ,$real , "BRL") . " equivalem a " . numfmt_format_currency($padrão ,$dolar , "USD");
    ?>
    </p>
    <button onclick="javascript:history.go(-1)">Voltar</button>
  </main>
</body>
</html>