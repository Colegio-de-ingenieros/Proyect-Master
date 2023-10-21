<?php
    include './libreria-pdf/fpdf.php';
    include 'exfpdf.php';
    include 'easyTable.php';
    
    $pdf = new exFPDF('L', 'mm', 'A4');
    $pdf->AddPage();
    $pdf->Output();
?>