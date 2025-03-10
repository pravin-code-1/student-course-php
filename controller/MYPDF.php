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
            $this->Cell($w[0], 6, 'sd', 'LR', 0, 'C', $fill);
            $this->Cell($w[1], 6, 'ds' . " " . $row->lastname, 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 6, 'ds', 'LR', 0, 'L', $fill);
            $this->Cell($w[3], 6, 'ds', 'LR', 0, 'C', $fill);
            $this->Cell($w[4], 6, 'ds', 'LR', 0, 'L', $fill);
            $this->Cell($w[5], 6, 'ds', 'LR', 0, 'C', $fill);
            $this->Cell($w[6], 6, 'ds', 'LR', 0, 'R', $fill);
            $this->Ln();
            $fill = !$fill;
        }
        $this->Cell(array_sum($w), 0, '', 'T');
    }
}

?>