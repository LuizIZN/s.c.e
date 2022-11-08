<?php

session_start();
include("conexao.php");

use Dompdf\Dompdf;

require_once '../dompdf/autoload.inc.php';

$cpf = $_SESSION['cpf'];$cpf = $_SESSION['cpf'];
$query = "SELECT nome from admin WHERE cpf='$cpf'";
$result = mysqli_query($conn, $query);

while($row = $result->fetch_array()) {
    $user = $row['nome'];
}

date_default_timezone_set('America/Recife');
$time = date("d/m/Y H:i:s");

$filtro_nome = filter_input(INPUT_POST, 'produto-filtro', FILTER_SANITIZE_STRING);
$filtro_vendedor = filter_input(INPUT_POST, 'vendedor-filtro', FILTER_SANITIZE_STRING);

if (($filtro_nome == '') and ($filtro_vendedor != '')) {
    $query_rel = "SELECT * FROM vendas WHERE vendedor='$filtro_vendedor'";
    $result_rel = mysqli_query($conn, $query_rel);
    
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
    
    
    $dompdf = new Dompdf();
    
    $dompdf->loadHtml('
    
        
        <h1 style="margin: 0; padding: 0; text-align: center;">Relatório de Vendas</h1>
        <table border="1" style="width: 104%; margin-top: 10px;" cellspacing="0" cellpadding="3px">
        <tr>
            <th>Solicitado por:</th>
            <th style="width: 200px">CPF de n°:</th>
            <th style="width: 200px">Em:</th>
        </tr>
        <tr>
            <td style="text-align: center;">'.$user.'</td>
            <td style="text-align: center;">'.$cpf.'</td>
            <td style="text-align: center;">'.$time.'</td>
        </tr>
        </table>
        
        <p style="text-align: center;"><i>Filtrado por vendedor.</i></p>
        
        '.$html.'
    ');
    
    $dompdf->render();
    
    $dompdf->stream(
        "Relatorio_".$vendedor.".pdf",
        array(
        "Attachment"=>false
        )
    ); 
} elseif (($filtro_nome != '') and ($filtro_vendedor == '')) {
    # code...
    $query_rel = "SELECT * FROM vendas WHERE nome_produto='$filtro_nome'";
    $result_rel = mysqli_query($conn, $query_rel);
    
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
    
    
    $dompdf = new Dompdf();
    
    $dompdf->loadHtml('
    
        
        <h1 style="margin: 0; padding: 0; text-align: center;">Relatório de Vendas</h1>
        <table border="1" style="width: 104%; margin-top: 10px;" cellspacing="0" cellpadding="3px">
        <tr>
            <th>Solicitado por:</th>
            <th style="width: 200px">CPF de n°:</th>
            <th style="width: 200px">Em:</th>
        </tr>
        <tr>
            <td style="text-align: center;">'.$user.'</td>
            <td style="text-align: center;">'.$cpf.'</td>
            <td style="text-align: center;">'.$time.'</td>
        </tr>
        </table>
        
        <p style="text-align: center;"><i>Filtrado por produto.</i></p>
        
        '.$html.'
    ');
    
    $dompdf->render();
    
    $dompdf->stream(
        "Relatorio_".$produto.".pdf",
        array(
        "Attachment"=>false
        )
    ); 
} elseif(($filtro_nome != '') and ($filtro_vendedor != '')) {
    $query_rel = "SELECT * FROM vendas WHERE nome_produto='$filtro_nome' and vendedor='$filtro_vendedor'";
    $result_rel = mysqli_query($conn, $query_rel);
    
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
    while($row = $result_rel->fetch_assoc()) {
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
        $produto = $row['nome_produto'];
        $vendedor = $row['vendedor'];
    }
    $html .= '</table';
    
    
    $dompdf = new Dompdf();
    
    $dompdf->loadHtml('
    
        
        <h1 style="margin: 0; padding: 0; text-align: center;">Relatório de Vendas</h1>
        <table border="1" style="width: 104%; margin-top: 10px;" cellspacing="0" cellpadding="3px">
        <tr>
            <th>Solicitado por:</th>
            <th style="width: 200px">CPF de n°:</th>
            <th style="width: 200px">Em:</th>
        </tr>
        <tr>
            <td style="text-align: center;">'.$user.'</td>
            <td style="text-align: center;">'.$cpf.'</td>
            <td style="text-align: center;">'.$time.'</td>
        </tr>
        </table>
        
        <p style="text-align: center;"><i>Filtrado por produto e vendedor.</i></p>
        
        '.$html.'
    ');
    
    $dompdf->render();
    
    $dompdf->stream(
        "Relatorio_".$produto."_".$vendedor.".pdf",
        array(
        "Attachment"=>false
        )
    ); 
} else {
    echo"<script language='javascript' type='text/javascript'>
          alert('Não foi possível filtrar o resultado!');window.location
          .href='../pages/admin/vendas.php'</script>";
}
?>