<?php
require('../controllers/fpdf/fpdf.php');
include '../controllers/config.inc.php';

$paymentId = $customerId = $customerName = $projectId = $projectName = $amount = $releaseDate = $releaseUser = "";

$dbQuery = "SELECT payment.id,payment.customer_id,customer.first_name,customer.last_name,payment.project_id,payment.amount,payment.release_date,payment.release_user
            FROM payment JOIN customer ON payment.customer_id = customer.id WHERE payment.id = '".$_GET['id']."';";

if ($result = mysqli_query($conn, $dbQuery)){
    $row = mysqli_fetch_assoc($result);

    $dbQueryPro = "SELECT project.pro_name FROM project WHERE project.id = '".$row['project_id']."';";
    $resultPro = mysqli_query($conn, $dbQueryPro);
    $rowPro = mysqli_fetch_assoc($resultPro);

    $dbQueryUser = "SELECT users.email FROM users WHERE users.id = '".$row['release_user']."';";
    $resultUser = mysqli_query($conn, $dbQueryUser);
    $rowUser = mysqli_fetch_assoc($resultUser);

    $paymentId = $row['id'];
    $customerId = $row['customer_id'];
    $customerName = $row['first_name']. ' '.$row['last_name'];
    $projectId = $row['project_id'];
    $projectName = $rowPro['pro_name'];
    $amount = $row['amount'];
    $releaseDate = $row['release_date'];
    $releaseUser = $rowUser['email'];
}

class myPDF extends FPDF {
    function header() {
        $this -> Image('../res/images/logo.png',10,10,50);
        $this -> Ln(10);
        $this -> SetFont('Arial','B',20);
        $this -> Cell(276,4,'Reciept',0,0,'R');
        $this -> Ln();
        $this -> SetFont('Times','',12);
        $this -> Cell(276,10,'Payment',0,0,'R');
        $this -> Ln();

     

       


        $this -> Ln(20);
    }
    function footer() {
        $this -> SetY(-15);
        $this -> SetFont('Arial','',8);
        $this -> Cell(0,10,'Page'.$this -> PageNo(),0,0,'C');
    }
}

$pdf = new myPDF();

$pdf->AddPage('L','A4',0);

$pdf -> SetFont('Times','',12); 
$pdf -> Cell(276,10,'Reciept Reference :  '.$releaseDate,0,0,'R');
$pdf -> Ln();

$pdf -> SetFont('Times','',12); 
$pdf -> Cell(276,10,'Date :  '.$releaseDate,0,0,'R');
$pdf -> Ln();




$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(60, 10, 'Customer Infromation: ');
$pdf -> Ln();
$pdf -> SetFont('Times','',12); 
$pdf->Cell(60, 10, 'Customer ID            :     '.$customerId);
$pdf -> Ln();
$pdf->Cell(60, 10, 'Customer Name       :      '.$customerName);
$pdf -> Ln(20);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(60, 10, 'Payment Details: ');
$pdf -> Ln();
$pdf -> SetFont('Times','',12); 
$pdf->Cell(60, 10, 'Project ID             :     '.$projectId);
$pdf -> Ln();
$pdf->Cell(60, 10, 'Project Name        :     '.$projectName);
$pdf -> Ln();  
$pdf->Cell(60, 10, 'Amount                :      '.$amount);
$pdf -> Ln();
$pdf -> Ln();


$pdf -> SetFont('Times','',12); 
$pdf->Cell(280,5,"ID",1,0);

$pdf->Ln();




// $pdf->SetFont('Arial', 'B', 12);
// $pdf->Cell(40, 10, 'Payment ID: ');

// $pdf->SetFont('Arial', '', 12);
// $pdf->Cell(40, 10, $paymentId,0,0,'R');
// $pdf -> Ln();
// $pdf->Cell(60, 10, 'Payment Date: '.$releaseDate);
// $pdf -> Ln();

// $pdf->Cell(60, 10, 'Project ID: '.$projectId);
// $pdf -> Ln();
// $pdf->Cell(60, 10, 'Project Name: '.$projectName);
// $pdf -> Ln();
// $pdf->Cell(60, 10, 'Amount: '.$amount);



// $pdf->SetFont('Arial','B',14);
// $pdf->Cell(50,5,"ID",1,0);
// $pdf->Cell(50,5,"First Name",1,0);
// $pdf->Ln();
$pdf->Output();
