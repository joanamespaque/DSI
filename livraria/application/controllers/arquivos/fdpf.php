<?php 
session_start();
require_once("../fpdf/fpdf.php");
$pdf= new FPDF("P","pt","A4");
$pdf->Open();
$pdf->AddPage();
$dir = "/var/www/html/formsCodeIgniter-3.1.10/arquivos";
$files = scandir($dir, 1);
for ($cont=0; $cont < 2; $cont++) { 
    array_pop($files);
}
$files = array_reverse($files);
$size = array();
for ($cont=0; $cont < count($files); $cont++) { 
    array_push($size, filesize($dir."/".$files[$cont]));
}
$i = 0;
$up = array();
while($i<count($files)){
    $a = explode(".",$files[$i]);
    if ($_SESSION['usuario']==$a[0]){
        array_push($up,array($a[1].".".$a[2]));
        if($size[$i]/1000000>=1){
            $a = (($size[$i])/(1024*1024))." mb";
        }
        else if($size[$i]/1024>=1){
            $a = (($size[$i])/1000)." kb";
        }
        else{
            $a = (($size[$i]))." b";
        }
        array_push( $up[count($up)-1],$a);
    }
    $i+= 1;
}    
$pdf->SetFont('arial','B',25);
$pdf->Cell(0,5,'Registro de:  '.$_SESSION['usuario'],0,1,'C');
$pdf->SetFont('arial','B',20);
$pdf->Cell(0,80,"Nome",0,0,'L');
$pdf->setFont('arial','B',20);
$pdf->Cell(0,80,"Tamanho",0,1,'R');
$i=0;
while($i<count($up)){
    $pdf->SetFont('arial','',18);
    $pdf->Cell(0,40,$up[$i][0],0,0,'L');
    $pdf->setFont('arial','',18);
    $pdf->Cell(0,40,$up[$i][1],0,1,'R');
    $i++;
}
$pdf->Output("arquivo.pdf","I");
?>
