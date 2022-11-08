<?php
include("conexao.php");
include("verifica_login.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de vendas</title>
</head>
<body>
    <?php
        $cpf = $_SESSION['cpf'];
        $query = "SELECT nome from admin WHERE cpf='$cpf'";
        $result = mysqli_query($conn, $query);
        
        while($row = $result->fetch_array()) {
            $user = $row['nome'];
        }
        
        
        
        date_default_timezone_set('America/Recife');
        $time = date("d/m/Y H:i:s");
        

        $query_rel = "SELECT * FROM vendas";
        $result_rel = mysqli_query($conn, $query_rel);
        
        $file = 'relatorio_'.$user.'_'.$time.'.xls';
        $html = '';
        $html .= '<table border="1">';
        $html .= '<tr>';
        $html .= '<td colspan="7" style="text-align: center;"><strong>Relatório de vendas</strong></td>';
        $html .= '</tr>';

        $html = '<table  width="104%" border="1" cellspacing="0" cellpadding="3px">';
        $html .= '<tr>';
        $html .= '<th>Código</th>';
        $html .= '<th>Produto</th>';
        $html .= '<th>Preço</th>';
        $html .= '<th>Qtde</th>';
        $html .= '<th>Total</th>';
        $html .= '<th>Vendedor</th>';
        $html .= '<th>Vendido em</th>';
        $html .= '</tr>';
        while($row = $result_rel->fetch_array()) {
            $html .= '<tbody>';
            $html .= '<tr><td align="center">' . $row['cod_venda'] . "</td>";
            $html .= '<td  align="center">' . $row['nome_produto'] . "</td>";
            $html .= '<td  align="right">R$' . number_format($row['preco_produto'], 2, ',', '.') . "</td>";
            $html .= '<td align="center">' . $row['qtde_vendida'] . "</td>";
            $html .= '<td align="right">R$' . number_format($row['valor_total'], 2, ',', '.') . "</td>";
            if ($row['vendedor'] == '') {
                $html .= '<td align="center">' . $row['vendedor_adm'] . "</td>";
            } elseif ($row['vendedor_adm'] == '') {
                $html .= '<td align="center">' . $row['vendedor'] . "</td>";
            }
            $html .= '<td align="right">' . $row['created'] . "</td></tr>";
            $html .= '</tbody>';
        }

        $html .= '</table';
        header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
		header ("Cache-Control: no-cache, must-revalidate");
		header ("Pragma: no-cache");
		header ("Content-type: application/x-msexcel");
		header ("Content-Disposition: attachment; filename=\"{$file}\"" );
		header ("Content-Description: PHP Generated Data" );
		// Envia o conteúdo do arquivo
		echo $html;
    ?>
</body>
</html>