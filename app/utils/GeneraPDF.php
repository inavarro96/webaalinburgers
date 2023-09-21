<?php
require_once '../libs/fpdf.php';

class GeneraPDF extends FPDF {
    function Header(): void {
        $this->SetFont('Arial','B',15);
        $this->Cell(120,10, 'Pedido realizado',0,0,'C');
        $this->Ln(20);
    }

    function Footer(): void
    {
        $this->SetY(-15);
        $this->SetFont('Arial','I', 8);
        $this->Cell(0,10, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C' );
    }

}