<?php
session_start();
require '../vendor/fpdf/fpdf.php';
include '../config/db.php';

// Fetch requests
$requests = $conn->query("
    SELECT r.id, r.status, r.date_requested,
           CONCAT(u.fname,' ',u.lname) AS full_name,
           GROUP_CONCAT(ri.medicine_name SEPARATOR ', ') AS medicines
    FROM requests r
    JOIN users u ON r.user_id = u.id
    JOIN request_items ri ON ri.request_id = r.id
    GROUP BY r.id
    ORDER BY r.date_requested DESC
");

// Create PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Requests Report', 0, 1, 'C');
$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(50, 10, 'User', 1);
$pdf->Cell(60, 10, 'Medicines', 1);
$pdf->Cell(25, 10, 'Status', 1);
$pdf->Cell(40, 10, 'Date', 1);
$pdf->Ln();

$pdf->SetFont('Arial', '', 12);
while ($r = $requests->fetch_assoc()) {
  $pdf->Cell(15, 10, $r['id'], 1);
  $pdf->Cell(50, 10, $r['full_name'], 1);
  $pdf->Cell(60, 10, substr($r['medicines'], 0, 30) . '...', 1);
  $pdf->Cell(25, 10, $r['status'], 1);
  $pdf->Cell(40, 10, $r['date_requested'], 1);
  $pdf->Ln();
}

$pdf->Output('D', 'requests_report.pdf');
