<?php
session_start();
require_once '../../../config/bd.php';
require_once 'fpdf/fpdf.php';
$pdf = new FPDF('P', 'mm', array(80, 200));
$pdf->AddPage();
$pdf->SetMargins(5, 0, 0);
$pdf->SetTitle("Ventas");
$pdf->SetFont('Arial', 'B', 12);
$id = $_SESSION['id_cliente'];
$idcompra = $_POST['idcomprat'];
$config = mysqli_query($connect, "SELECT CONCAT(nombre,' ',ap_pat,' ',ap_mat) AS nombreusuario, email FROM usuarios WHERE id_usuario=$id");
$datos = mysqli_fetch_assoc($config);
$compra = mysqli_query($connect, "SELECT * FROM compra WHERE id_compra = $idcompra");
$datosC = mysqli_fetch_assoc($compra);
$ventas = mysqli_query($connect, "SELECT dc.id_product, p.nombre_pr, dc.qty, (p.precio_uni-p.precio_uni*p.descuento) AS preciocondesc, dc.total, (p.descuento*100) AS descuentopr
                                    FROM detalles_compra AS dc INNER JOIN productos AS p ON dc.id_product=p.id_product
                                    WHERE dc.id_compra=$idcompra;");
$pdf->Cell(65, 5, 'Abarrotes "Lucha"', 0, 1, 'C');
$pdf->image("../../../img/logopag.png", 60, 15, 15, 15, 'PNG');
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(15, 5, utf8_decode("Teléfono: "), 0, 0, 'L');
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(15, 5, '488-123-94-68', 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(15, 5, utf8_decode("Dirección: "), 0, 0, 'L');
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(15, 5, "Gral. Anaya 425, Centro", 0, 1, 'L');
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(15, 5, "78520 Cedral, S.L.P.", 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(15, 5, "Correo: ", 0, 0, 'L');
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(15, 5, utf8_decode("l18660381@matehuala.tecnm.mx"), 0, 1, 'L');
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetFillColor(0, 0, 0);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(70, 5, "Datos del cajero", 1, 1, 'C', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(30, 5, utf8_decode('Nombre'), 0, 0, 'L');
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(30, 5, utf8_decode($datos['nombreusuario']), 0, 1, 'L');
// $pdf->Cell(20, 5, utf8_decode('Teléfono'), 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(20, 5, utf8_decode('Correo'), 0, 0, 'L');
$pdf->SetFont('Arial', '', 7);
// $pdf->Cell(20, 5, utf8_decode($datosC['telefono']), 0, 0, 'L');
$pdf->Cell(30, 5, utf8_decode($datos['email']), 0, 1, 'L');
$pdf->Ln(3);
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(70, 5, "Detalle de Compra", 1, 1, 'C', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(30, 5, utf8_decode('Descripción'), 0, 0, 'L');
$pdf->Cell(10, 5, 'Cant.', 0, 0, 'L');
$pdf->Cell(15, 5, 'Precio', 0, 0, 'L');
$pdf->Cell(15, 5, 'Sub Total.', 0, 1, 'L');
$pdf->SetFont('Arial', '', 7);
$total = 0.00;
$desc = 0.00;
while ($row = mysqli_fetch_assoc($ventas)) {
    $pdf->Cell(30, 5,utf8_decode( $row['nombre_pr']), 0, 0, 'L');
    $pdf->Cell(10, 5, $row['qty'], 0, 0, 'L');
    $pdf->Cell(15, 5, $row['preciocondesc'], 0, 0, 'L');
    $sub_total = $row['total'];
    $total = $total + $sub_total;
    $desc = $desc + $row['descuentopr'];
    $pdf->Cell(15, 5, number_format($sub_total, 2, '.', ','), 0, 1, 'L');
}
$pdf->Ln();
// $pdf->SetFont('Arial', 'B', 10);
// $pdf->Cell(65, 5, 'Descuento Total', 0, 1, 'R');
// $pdf->SetFont('Arial', '', 10);
// $pdf->Cell(65, 5, number_format($desc, 2, '.', ','), 0, 1, 'R');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(65, 5, 'Total Pagar', 0, 1, 'R');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(65, 5, number_format($total, 2, '.', ','), 0, 1, 'R');


$rutaticket="../../Tickets/ventas".$idcompra.".pdf";
$pdf->Output("F", $rutaticket);
$queryPDFTICKET="UPDATE compra SET pdf_ticket='$rutaticket' WHERE id_compra=$idcompra";
$connect->query($queryPDFTICKET);

$response=array(
    'rutapdf'=>$rutaticket
);
die(json_encode($response));
?>