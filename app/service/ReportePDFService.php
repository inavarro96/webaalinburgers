<?php
require_once '../utils/GeneraPDF.php';
require_once '../model/PedidoModel.php';
class ReportePDFService {
    function generarReportePdfPedido($id): GeneraPDF {
        $pedidoService = new PedidoModel();
        $pdf = new GeneraPDF();
        $productos = $pedidoService -> getProductosByIdPedido($id);
        $pedido = $pedidoService ->getById($id);
        $pdf->AliasNbPages();
        $pdf->AddPage();

        $pdf->SetFillColor(255,255,255);
        $pdf->SetFont('Arial','B',10);
        $pdf ->Cell(33,6,'Nombre Completo:',0,0,'L',1);
        $pdf->SetFont('Arial','',10);
        $pdf ->Cell(80,6,utf8_decode($pedido['nombre_completo']),0,1,'L',1);
        $pdf->SetFont('Arial','B',10);

        $pdf ->Cell(33,6,utf8_decode('Dirección: '),0,0,'L',1);
        $pdf->SetFont('Arial','',10);
        $pdf ->Cell(80,6,utf8_decode($pedido['direccion']),0,1,'L',1);

        $pdf->SetFont('Arial','B',10);
        $pdf ->Cell(33,6,utf8_decode('Teléfono: '),0,0,'L',1);
        $pdf->SetFont('Arial','',10);
        $pdf ->Cell(80,6,utf8_decode($pedido['telefono']),0,1,'L',1);

        $pdf->SetFont('Arial','B',10);
        $pdf ->Cell(33,6,utf8_decode('Fecha Creado: '),0,0,'L',1);
        $pdf->SetFont('Arial','',10);
        $pdf ->Cell(80,6,utf8_decode($pedido['fecha_creado']),0,1,'L',1);

        $pdf ->Cell(60,6,'',0,1,'C',1);

        $pdf->SetFillColor(232,232,232);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(60,6,'Nombre',1,0,'C',1);
        $pdf->Cell(65,6,'Ingredientes',1,0,'C',1);
        $pdf->Cell(22,6,'Precio',1,0,'C',1);
        $pdf->Cell(22,6,'Cantidad',1,0,'C',1);
        $pdf->Cell(22,6,'SubTotal',1,1,'C',1);

        $pdf->SetFont('Arial','',10);
        $totalCantidad = 0;
        $totalPrecio = 0;
        foreach ($productos as &$producto) {
            $pdf -> Cell(60,6,utf8_decode($producto['nombre']),1,0,'C');
            $pdf -> Cell(65,6,utf8_decode($producto['ingredientes']),1,0,'C');
            $pdf -> Cell(22,6,$producto['precio'],1,0,'C');
            $pdf -> Cell(22,6,$producto['cantidad'],1,0,'C');
            $pdf -> Cell(22,6,$producto['precio'] * $producto['cantidad'],1,1,'C');
            $totalCantidad += $producto['cantidad'];
            $totalPrecio += $producto['precio'] * $producto['cantidad'];
        }
        $pdf->SetFont('Arial','B',10);
        $pdf -> Cell(60,6,'',0,0,'C');
        $pdf -> Cell(65,6,'',0,0,'C');
        $pdf -> Cell(22,6,'Total',1,0,'C');
        $pdf -> Cell(22,6,$totalCantidad,1,0,'C');
        $pdf -> Cell(22,6,$totalPrecio,1,1,'C');

        return $pdf;
    }
}

