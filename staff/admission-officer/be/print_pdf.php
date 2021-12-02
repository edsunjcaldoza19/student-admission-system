<?php

    //Backend Scripts

    require 'database/db_pdo.php';
    require_once('../../../plugins/tcpdf/tcpdf.php');

    $sy_id = $_GET['sy_id'];
    $sem = $_GET['sem'];

    $sql3 = $conn->prepare("SELECT * FROM tbl_academic_year WHERE `id` = $sy_id");
    $sql3->execute();
    $fetch3 = $sql3->fetch();

    // Extend the TCPDF class to create custom Header and Footer
    class MYPDF extends TCPDF {

        //Page header
        public function Header() {
            // Logo
            $image_file = '../../../images/lnu_logo.jpg';
            $this->Image($image_file, 40, 21, 20, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
            $this->SetFont('helvetica', false, 12);
            $this->Cell(90, 15, 'Republic of the Philippines', 0, false, 'C', 0, '', 0, false, 'M', 'M');
            $image_file2 = '../../../images/iso_logo.jpg';
            $this->Image($image_file2, 150, 22, 32, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        }

        // Page footer
        public function Footer() {
            // Position at 15 mm from bottom
            $this->SetY(-15);
            // Set font
            $this->SetFont('helvetica', 'I', 8);
            // Page number
            $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
        }

        public function generateRow(){

            require 'database/db_pdo.php';

            $sy_id = $_GET['sy_id'];
            $sem = $_GET['sem'];

            $sql3 = $conn->prepare("SELECT *, tbl_applicant.id FROM tbl_applicant
                LEFT JOIN tbl_applicant_account ON tbl_applicant_account.id = tbl_applicant.applicant_account_id
                WHERE `school_year_id` = $sy_id AND `semester` = '$sem'
                AND `form_status`='Approved' AND `exam_status`='Scored'
                AND `interview_status_1`='Qualified' OR `interview_status_2`='Qualified'
                AND `admission_status`='Evaluated' 
                AND ((`approved_first_choice` = 1 AND `approved_second_choice` = 1) 
                    OR (`approved_first_choice` = 1 AND `approved_second_choice` = 0) 
                    OR (`approved_first_choice` = 0 AND `approved_second_choice` = 1))
                ORDER BY `last_name` ASC
                ");
            $sql3->execute();

            $contents = '';
            $contents .= '
                <tr>
                    <th width="5%"><b>No.</b></th>
                    <th width="25%"><b>Last Name</b></th>
                    <th width="25%"><b>First Name</b></th>
                    <th width="5%"><b>M.I.</b></th>
                    <th width="40%"><b>Program</b></th>
                </tr>
            ';

            $num = 1;

            while($fetch3 = $sql3->fetch()){

            if($fetch3['middle_name'] != ''){
                $middlename = $fetch3['middle_name'];
                $mi = $middlename[0].'.';
            }else{
                $mi = '';
            }

            $firstChoice = $fetch3['program_first_choice'];
            $secondChoice = $fetch3['program_second_choice'];

            $sql4 = $conn->prepare("SELECT * FROM `tbl_course` WHERE `course_id` = '$firstChoice'");
            $sql4->execute();

            $sql5 = $conn->prepare("SELECT * FROM `tbl_course` WHERE `course_id` = '$secondChoice'");
            $sql5->execute();

                while($fetch4 = $sql4->fetch()){
                    while($fetch5 = $sql5->fetch()){

                    if($fetch3['approved_first_choice'] == 1 && $fetch3['approved_second_choice'] == 1){
                        $course = $fetch4['course_name'];
                    }else if($fetch3['approved_first_choice'] == 1 && $fetch3['approved_second_choice'] == 3){
                        $course = $fetch4['course_name'];
                    }else if($fetch3['approved_first_choice'] == 1 && $fetch3['approved_second_choice'] == 0){
                        $course = $fetch4['course_name'];
                    }else if($fetch3['approved_first_choice'] == 0 && $fetch3['approved_second_choice'] == 1){
                        $course = $fetch5['course_name'];
                    }else if($fetch3['approved_first_choice'] == 3 && $fetch3['approved_second_choice'] == 1){
                        $course = $fetch5['course_name'];
                    }
        
            $contents .= "
                <tr>
                    <td>".$num.".</td>
                    <td>".$fetch3['last_name']."</td>
                    <td>".$fetch3['first_name']."</td>
                    <td>".$mi."</td>
                    <td>".$course."</td>
                </tr>
            ";
                $num = $num+1;

                    }
                }
            }

            return $contents;
        }
    }

    // create new PDF document
    $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Admissions Office');
    $pdf->SetTitle('Official List of Qualifiers - ' .$fetch3['ay_year'].'');
    $pdf->SetSubject('Admission Qualifiers');
    $pdf->SetKeywords('LNU', 'Qualifiers');

    // set default header data
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // ---------------------------------------------------------

    // set font
    $pdf->AddPage();

    $pdf->SetFont('helvetica', 'B', 14);
    $txt = <<<EOD
    Leyte Normal University
    EOD;
    $pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);
    $pdf->SetFont('helvetica', false, 14);
    $txt = "Admissions Office";
    $pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);

    $pdf->SetFont('helvetica', false, 14);
    $txt = <<<EOD
    Tacloban City
    EOD;
    $pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);

    $pdf->SetFont('helvetica', false, 14);
    $txt = "LIST OF QUALIFIED APPLICANTS";
    $pdf->Write(20, $txt, '', 0, 'C', true, 0, false, false, 0);
    $pdf->SetFont('helvetica', 'B', 12);
    $txt = "A.Y. ". $fetch3['ay_year']." - ".$sem;
    $pdf->Write(10, $txt, '', 0, 'L', true, 0, false, false, 0);

    $pdf->SetFont('helvetica', false, 12);

    $content = '';
    $content .= '
        <table border="1" cellspacing="0" cellpadding="1" style="font-size: 12px;">
    ';
    $generate = new MYPDF();
    $content .= $generate->generateRow();
    $content .= '</table>';
    $pdf->writeHTML($content);

    // ---------------------------------------------------------

    //Close and output PDF document
    $pdf->Output('admission_qualifiers.pdf', 'I');

    //============================================================+
    // END OF FILE
    //============================================================+

    $pdf->Output('Admission_Qualifiers_'.$fetch['course_name'].'.pdf', 'I');

?>