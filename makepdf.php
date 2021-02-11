<?php
// read library ライブラリを読み込む
require('tfpdf/tfpdf.php');

// make instance インスタンスを作成
$pdf = new tFPDF;
// AddFont( [フォントの種類] ,[フォントのスタイル] ,[フォントのファイル], [UTF-8を使うか])  
$pdf->AddFont('ShipporiMincho','','ShipporiMincho-TTF-Regular.ttf',true);

$names = htmlentities($_GET['names'], ENT_QUOTES, "utf-8");
$names = explode("\n", $_GET['names']);

foreach ($names as $name) {
    //ループする処理
    // SetFont( [フォントの種類] ,[フォントのスタイル] ,[フォントのファイル])
    $pdf->SetFont('ShipporiMincho','',20);
    // pdf作成
    $pdf->AddPage();
    // Cell( [横幅], [縦幅], [表示したい文字])
    // Ln( [縦の長さ])
    $pdf->Cell(0,10,"足し算練習プリント");
    $pdf->Ln(5);
    $pdf->Cell(100);
    $pdf->Cell(90,10,"名前：$name","B");

    $pdf->Ln(40);
    make_contents();
    $pdf->Ln(15);
    $pdf->SetFont('ShipporiMincho','',15);
    $pdf->Cell(0,6,戻る,'', '', 'R', '', 'http://localhost/pdfcreator/form.html');

}

$pdf->Output();

function make_contents(){
    global $pdf;
    
    $contents = htmlentities($_GET['contents'], ENT_QUOTES, "utf-8");
    $contents = explode("\n", $_GET['contents']);
    $count = 0;
    $Y = $pdf->getY();

    foreach ($contents as $content) {
        $count++;
        if($count == 10){
            $pdf->setY($Y);
        }
        if($count >= 10){
            $pdf->setX(110);
        }
        $pdf->SetFont('ShipporiMincho','',25);
        $pdf->Cell(20,10,"($count)");
 	    $pdf->SetFont('ShipporiMincho','',30);
        $pdf->Cell(50,10,"$content =");
        $pdf->Ln(25);
    }    
}

