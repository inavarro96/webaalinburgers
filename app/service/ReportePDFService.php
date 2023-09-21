<?php
require_once '../utils/GeneraPDF.php';
require_once '../model/PedidoModel.php';
class ReportePDFService {
    function generarReportePdfPedido($id): GeneraPDF {
        $pedidoService = new PedidoModel();
        $pdf = new GeneraPDF();
        $pdf->AliasNbPages();
        $pdf->AddPage();

        $pdf->SetFillColor(232,232,232);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(60,6,'Nombre',1,0,'C',1);
        $pdf->Cell(65,6,'Ingredientes',1,0,'C',1);
        $pdf->Cell(22,6,'Precio',1,0,'C',1);
        $pdf->Cell(22,6,'Cantidad',1,0,'C',1);
        $pdf->Cell(22,6,'SubTotal',1,1,'C',1);

        $pdf->SetFont('Arial','',10);
        $productos = $pedidoService -> getProductosByIdPedido($id);

        foreach ($productos as &$producto) {
            $pdf -> Cell(60,6,utf8_decode($producto['nombre']),1,0,'C');
            $pdf -> Cell(65,6,utf8_decode($producto['ingredientes']),1,0,'C');
            $pdf -> Cell(22,6,$producto['precio'],1,0,'C');
            $pdf -> Cell(22,6,$producto['cantidad'],1,0,'C');
            $pdf -> Cell(22,6,$producto['precio'] * $producto['cantidad'],1,1,'C');
        }

        return $pdf;
    }
}

