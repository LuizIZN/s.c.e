<?php

session_start();
include("conexao.php");

$cpf = $_SESSION['cpf'];
$query = "SELECT nome from usuarios WHERE cpf='$cpf'";
$result = mysqli_query($conn, $query);

while($row = $result->fetch_array()) {
    $user = $row['nome'];
}

date_default_timezone_set('America/Recife');
$time = date("d/m/Y H:i:s");

$query_rel = "SELECT * FROM vendas WHERE vendedor='$user'";
$result_rel = mysqli_query($conn, $query_rel);

$html = '<table  width="100%" border="1" cellspacing="0" cellpadding="3px">';
$html .= '<tr>';
$html .= '<th>Código</th>';
$html .= '<th>Produto</th>';
$html .= '<th>Preço</th>';
$html .= '<th>Qtde</th>';
$html .= '<th>Total</th>';
$html .= '<th>Vendido em</th>';
$html .= '</tr>';
while($row = $result_rel->fetch_array()) {
    $html .= '<tbody>';
    $html .= '<tr><td align="center">' . $row['cod_venda'] . "</td>";
    $html .= '<td  align="center">' . $row['nome_produto'] . "</td>";
    $html .= '<td  align="right">R$' . number_format($row['preco_produto'], 2, ',', '.') . "</td>";
    $html .= '<td align="center">' . $row['qtde_vendida'] . "</td>";
    $html .= '<td align="right">R$' . number_format($row['valor_total'], 2, ',', '.') . "</td>";
    $html .= '<td align="right">' . $row['created'] . "</td></tr>";
    $html .= '</tbody>';
}
$html .= '</table';

use Dompdf\Dompdf;

require_once '../dompdf/autoload.inc.php';

$dompdf = new Dompdf();

$dompdf->loadHtml('

    
    <h1 style="margin: 0; padding: 0; text-align: center;">Relatório de Vendas</h1>
    <table border="1" style="width: 100%; margin-top: 10px;" cellspacing="0" cellpadding="3px">
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
    <br>
    <br>
    '.$html.'
');

$dompdf->render();

$dompdf->stream(
    "relatorio.pdf",
    array(
    "Attachment"=>false
    )
)

?>
