<?php

require_once '../libs/fpdf.php';
class GeneraHeadersAndFooterPDF extends FPDF {

    function Header(): void {
        $this -> SetFont('Arial', 'B', 16);
        $this -> Cell(120, 10, 'Estadisticas por fechas',0,0, 'C');
        $this -> Ln(20);
    }

    function Footer(): void {
       $this -> SetY(-15);
       $this -> SetFont('Arial', 'I', 8);
       $this -> Cell(0,10,'Página'.$this->PageNo().'/{nb}',0,0,'C' );
    }
}