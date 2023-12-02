<?php
require_once '../utils/GeneraHeadersAndFooterPDF.php';
require_once '../model/PedidoModel.php';
class ReporteProductosVendidosPDFService {
    function generarReporte($fechaInicio, $fechaFin): GeneraHeadersAndFooterPDF {
        $pedidoService = new PedidoModel();
        $pdf = new GeneraHeadersAndFooterPDF();
        $productos = $pedidoService -> getEstadisticasProducto($fechaInicio, $fechaFin);
        $pdf -> AliasNbPages();
        $pdf -> AddPage();

        $pdf -> SetFillColor(255,255,255);
        $pdf -> SetFont('Arial','B',10);
        $pdf -> Cell(33,6,'Fecha Inicio:', 0,0,'L',1);
        $pdf->SetFont('Arial','',10);
        $pdf -> Cell(80,6, utf8_decode($fechaInicio),0,1,'L',1);

        $pdf -> SetFont('Arial','B',10);
        $pdf -> Cell(33,6,'Fecha Fin: ',0,0,'L',1);
        $pdf -> SetFont('Arial','',10);
        $pdf -> Cell(80,6, utf8_decode($fechaFin),0,1,'L',1);

        $pdf ->Cell(60,6,'',0,1,'C',1);

        $pdf -> SetFillColor(232,232,232);
        $pdf -> SetFont('Arial','B',10);
        $pdf->Cell(22,6,'ID',1,0,'C',1);
        $pdf->Cell(65,6,'Nombre',1,0,'C',1);
        $pdf->Cell(22,6,'Fecha',1,0,'C',1);
        $pdf->Cell(22,6,'Cantidad',1,1,'C',1);

        $pdf -> SetFont('Arial','',10);
        $totalCantidad = 0;

        foreach ($productos as &$producto) {
            $pdf -> Cell(22,6, $producto['id'],1,0,'C');
            $pdf -> Cell(65,6,utf8_decode($producto['nombre']),1,0,'C');
            $pdf -> Cell(22,6,$producto['fecha_creado'],1,0,'C');
            $pdf -> Cell(22,6,$producto['total'],1,1,'C');
            $totalCantidad += $producto['total'];
        }
        $pdf->SetFont('Arial','B',10);
        $pdf -> Cell(22,6,'',0,0,'C');
        $pdf -> Cell(65,6,'',0,0,'C');
        $pdf -> Cell(22,6,'Total',1,0,'C');
        $pdf -> Cell(22,6,$totalCantidad,1,1,'C');


        return $pdf;
    }
}