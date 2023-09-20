<?php

require_once '../service/ReportePDFService.php';


header('Content-Type: application/json');
$response = array('state'=>'', 'data'=>'');

if (isset($_GET['action']) and !empty($_GET['action'])) {
    $reportesService = new ReportePDFService();
    $response['state'] = 'OK';
    if($_GET['action'] === 'reporte') {
        $pdf = $reportesService ->generarReportePdfPedido();
        $pdf -> Output();
    }
} else {
    $response['state'] = 'Error:: Accipn no encontrada';
}

echo json_encode($response, JSON_FORCE_OBJECT);