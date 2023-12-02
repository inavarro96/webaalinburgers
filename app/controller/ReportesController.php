<?php

require_once '../service/ReportePDFService.php';
require_once '../service/ReporteProductosVendidosPDFService.php';


header('Content-Type: application/json');
$response = array('state'=>'', 'data'=>'');

if (isset($_GET['action']) and !empty($_GET['action'])) {

    $response['state'] = 'OK';
    if($_GET['action'] === 'ticket-pedido') {
        $reportesService = new ReportePDFService();
        $pdf = $reportesService ->generarReportePdfPedido($_GET['idPedido']);
        $pdf -> Output();
    }

    if($_GET['action'] === 'productos-vendidos') {
        $reportesService = new ReporteProductosVendidosPDFService();
        $pdf = $reportesService -> generarReporte($_GET['fechaInicio'], $_GET['fechaFin']);
        $pdf -> Output();
    }
} else {
    $response['state'] = 'Error:: Accipn no encontrada';
}

echo json_encode($response, JSON_FORCE_OBJECT);