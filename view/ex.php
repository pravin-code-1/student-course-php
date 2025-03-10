<?php
require_once('/var/www/html/Student/vendor/tcpdf.php');


class MYPDF extends TCPDF
{
    public function Header()
    {
        $image_file = K_PATH_IMAGES . 'dolphon.jpg';
        $this->Image($image_file, 10, 10, 50, 25, 'JPG', '', 'T', false, 500, '', false, false, 0, false, false, false);
        $this->SetFont('helvetica', 'B', 25);
        $this->Cell(0, 15, 'Dolphin Web Solution Pvt Ltd', 0, 1, 'R', 0, 'https://dolphinwebsolution.com/', 0);
        $this->SetFont('helvetica', 'I', 15);
        $this->Cell(0, 5, 'Software company in Ahmedabad, Gujarat', 0, 1, 'R', 0, '', 0);
        $this->SetFont('helvetica', 'N', 12);
        $this->Cell(0, 5, 'Date: ' . date("d/m/Y"), 0, 1, 'R', 0, '', 0);
        $style = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(236, 106, 38));
        $this->Line(5, 40, 290, 40, $style);
    }
    public function Footer()
    {
        $this->SetY(-10);
        $this->SetFont('helvetica', 'I', 9);
        $this->Cell(0, 10, 'Copyright © 2024 DOLPHIN WEB SOLUTION. All rights reserved.', 0, false, 'C', 0, '', 0);
        $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, true, 'L', 0, '', 0);
    }
    // Colored table
    public function ColoredTable($header, $data)
    {
        // Colors, line width and bold font
        $this->SetFillColor(255, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');
        // Header
        $w = array(20, 55, 80, 40, 30, 30, 30);
        $num_headers = count($header);
        for ($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();
        // Color and font restoration

        // Data
        foreach ($data as $row) {
            if ($this->getY() > 181) {
                $this->Cell(array_sum($w), 0, '', 'T');
                $this->Ln();
                $this->SetFillColor(255, 0, 0);
                $this->SetTextColor(255);
                $this->SetDrawColor(128, 0, 0);
                $this->SetLineWidth(0.3);
                $this->SetFont('', 'B');
                for ($j = 0; $j < $num_headers; ++$j) {
                    $this->Cell($w[$j], 7, $header[$j], 1, 0, 'C', 1);
                }
                $this->Ln();
            }

            $this->SetFillColor(224, 235, 255);
            $this->SetTextColor(0);
            $this->SetFont('');
            $this->Cell($w[0], 6, $row->s_id, 'LR', 0, 'C', $fill);
            $this->Cell($w[1], 6, $row->firstname ." ". $row->lastname , 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 6, $row->email, 'LR', 0, 'L', $fill);
            $this->Cell($w[3], 6, $row->phone, 'LR', 0, 'C', $fill);
            $this->Cell($w[4], 6, $row->name=="" ? 'Not Select':$row->name, 'LR', 0, 'L', $fill);
            $this->Cell($w[5], 6, $row->gender, 'LR', 0, 'C', $fill);
            $this->Cell($w[6], 6, $row->status, 'LR', 0, 'R', $fill);
            $this->Ln();
            $fill = !$fill;
        }
        $this->Cell(array_sum($w), 0, '', 'T');
    }
}

$pdf = new MYPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 004', PDF_HEADER_STRING);

$pdf->SetCreator("Pravin");
$pdf->SetAuthor('Dolphin web solution');
$pdf->SetTitle('Student');
$pdf->SetSubject('Student Detial');
$pdf->SetKeywords('Student, PDF, Selected, course');

$pdf->SetMargins(PDF_MARGIN_LEFT, 2, PDF_MARGIN_RIGHT);
$pdf->SetFont('times', '', 11);

// set margins
$pdf->SetMargins(5, 45, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(50);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
// add a page
$pdf->AddPage();
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0);
$pdf->SetLineWidth(0.3);
$pdf->SetFont('', 'B');

$pdf->SetFont('helvetica', 'B', 18);
$pdf->Cell(0, 7, "Student Detail", 0, 1, 'C', 1);
$pdf->Ln();
$pdf->SetFont('times', 'B', 14);
$pdf->Cell(143, 7, "Total Number of Student: ". $_GET['length'], "LRT", 0, 'L', 1);
$pdf->Cell(143, 7, "Dolphin Web Solution PVT. LTD.", 'LRT', 1, 'L', 1);
$pdf->SetFont('times', "", 14);
$pdf->Cell(143, 12, "Course Name", 'LR', 0, 'L', 1);
$pdf->MultiCell(143, 7, "Address: Empire Business Hub, B- 203-206, Science City Rd, Sola, Ahmedabad, Gujarat 380060", 'LR', "L", 1, 1, '', '', true);
$pdf->Cell(143, 7, "", 'LR', 0, 'L', 1);
$pdf->Cell(143, 7, "", 'LR', 1, 'L', 1);
$pdf->Cell(143, 7, "", 'LR', 0, 'L', 1);
$pdf->Cell(143, 7, 'Dolphin Web site', "LR", 1, 'R', 0, 'https://dolphinwebsolution.com/', 0);
$pdf->Cell(286, 0, '', 'T');
$pdf->Ln();
$pdf->Ln();
$check = $pdf->getY();

//Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=0, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M')
$header = array('NO', 'Name', 'Email', 'Phone Number', 'Course', 'Gender', 'Status');

$data = $_GET['data'];
$data = json_decode($data);
$studentData = [];
for($i = 0; $i < $_GET['length']; $i++){
    array_push($studentData, $data[$i]);
}
// print colored table
$pdf->ColoredTable($header, $studentData);
$pdf->Cell(286, 0, "", 'T');

$pdf->Output('Student ' . date("Y-m-d h:i:sa") . '.pdf', 'I');

?>