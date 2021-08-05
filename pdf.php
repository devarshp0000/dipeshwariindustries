<?php
// added comment
function doNothing(){
    echo "do nothing";
}
function getIndianCurrency(float $number)
{
    if($number == 0){
        return "Zero";
    }
    //echo $number;
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => '', 1 => 'One', 2 => 'Two',
        3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
        7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
        10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
        13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
        16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
        19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
        40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
        70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
    $digits = array('', 'hundred','thousand','lakh', 'crore');
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
    $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
    /*if(strlen($Rupees)>40){
        $temp = strpos($Rupees,' ',40);
        $Rupees = substr_replace($Rupees,"\\n",$temp,0);

    }*/
    return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
}
    if(!empty($_POST['submit'])){
        $invoice = $_POST['invoice'];
        $gstin = $_POST['gstin'];
        $name = $_POST['name'];
        $address = $_POST['address'];
        $place = $_POST['place'];
        $p1 = $_POST['p1'];
        $p2 = $_POST['p2'];
        $p3 = $_POST['p3'];
        $p4 = $_POST['p4'];
        $qty = $_POST['qty'];
        $rate = $_POST['rate'];
        $igst = $_POST['igst'];
        $sgst = $_POST['sgst'];
        $cgst = $_POST['cgst'];
        $hsn = $_POST['hsn'];
        $date = $_POST['date'];
        $type = $_POST['type'];
        $memo = $_POST['memo'];
        $yyyy = substr($date,0,4);
        $mm = substr($date,5,2);
        $dd = substr($date,8,2);

        $date = $dd."/".$mm."/".$yyyy;
        


    require("fpdf.php");
    $pdf = new FPDF();
    $pdf->AddPage();

    $pdf->SetFont("Arial","B",13);
    if($type=="Invoice")
        $pdf->Cell(0,2.5,"",0,1,'');
    $pdf->Cell(0, 10,"DIPESHWARI AGRICULTURE",1,1,'C');
    $pdf->SetFont("Arial","",10);
    $pdf->Cell(0,5,"",0,1,'');
    $pdf->Cell(0,5,"Plot No.21, National Highway, Bajrang Choraha, At Swaroopganj,",'0','1','C');
    $pdf->Cell(0,5,"Tehsil - Pindwada, Sirohi, Rajasthan, 307023.",0,1,'C');
    $pdf->SetFont("Arial","B",9);
    $pdf->Cell(0,5,"Mobile No.: 8140310780      Email ID:  dipeshwariagriculture@gmail.com",0,1,'C');
    $pdf->Cell(0,5,"GSTIN No.:  08CELPP8515E1Z7",0,1,'C');
    $pdf->Cell(0,4,"",0,1,'');

    $pdf->SetFont("Arial","",7);
    if($type == "Invoice")
        $pdf->Cell(30,8,$memo." Memo","LTB",0,'L');
    else
    $pdf->Cell(30,8,"","LTB",0,'L');
    $pdf->SetFont("Arial","B",9);
    if($type == "Invoice")
        $pdf->Cell(130,8,"TAX INVOICE","TB",0,'C');
    else
        $pdf->Cell(130,8,"Quatation","TB",0,'C');
    $pdf->SetFont("Arial","",7);
    $pdf->Cell(30,8,"Original","TBR",1,'R');
    
    $pdf->SetFont("Arial","B",9);
    $pdf->Cell(140,9,"Name:    ".$name,"LR",0,'L');

    $pdf->SetFont("Arial","",9);
    $pdf->Cell(50,9,"Invoice No.:  ".$invoice,"R",1,'L');

    $pdf->SetFont("Arial","",9);
    $pdf->Cell(20,18,"Address:","L",0,'L');
    $pdf->Cell(120,18,$address,"R",0,'L');

    $pdf->Cell(50,18,"Date:     ".$date,"BR",1,'L');
    
    $pdf->Cell(140,9,"Place of Supply:     ".$place,"LR",0,'L');
    $pdf->Cell(50,9,"","R",1,'');

    $pdf->Cell(140,9,"GSTIN NO.:   ".$gstin,"LBR",0,'L');
    $pdf->Cell(50,9,"","BR",1,'');

    $pdf->SetFont("Arial","B",9);
    $pdf->Cell(8,9,"SrNo","LBR",0,'C');
    $pdf->Cell(75,9,"Product Name","BR",0,'C');
    $pdf->Cell(17,9,"HSN","BR",0,'C');
    $pdf->Cell(17,9,"Qty","BR",0,'C');
    $pdf->Cell(23,9,"Rate","BR",0,'C');
    if($type == "Invoice"){
        $pdf->Cell(11,9,"GST","BR",0,'C');
        $pdf->Cell(39,9,"Amount","BR",1,'C');
    }else{
        $pdf->Cell(50,9,"Amount","BR",1,'C');
    }
    

    

    $pdf->SetFont("Arial","",9);
    
        $pdf->Cell(8,9,1,"LR",0,'C');
        $pdf->Cell(75,9,$p1,"R",0,'C');
        $pdf->Cell(17,9,$hsn,"R",0,'C');
        $pdf->Cell(17,9,$qty,"R",0,'C');
        $pdf->Cell(23,9,number_format($rate,2,'.',''),"R",0,'C');
        if($type == "Invoice"){
            $pdf->Cell(11,9,number_format($igst+$sgst+$cgst,2,'.',''),"R",0,'R');
        }else{
            $pdf->Cell(11,9,"","",0,'R');
        }
        
        $pdf->Cell(39,9,number_format($qty*$rate,2,'.',''),"R",1,'R');

        $pdf->Cell(8,9,"","LR",0,'C');
        $pdf->Cell(75,9,$p2,"R",0,'C');
        $pdf->Cell(17,9,"","R",0,'C');
        $pdf->Cell(17,9,"","R",0,'R');
        $pdf->Cell(23,9,"","R",0,'R');
        if($type == "Invoice"){
            $pdf->Cell(11,9,"","R",0,'R');
            $pdf->Cell(39,9,"","R",1,'R');
        }else{
            $pdf->Cell(50,9,"","R",1,'R');
        }

        $pdf->Cell(8,9,"","LR",0,'C');
        $pdf->Cell(75,9,$p3,"R",0,'C');
        $pdf->Cell(17,9,"","R",0,'C');
        $pdf->Cell(17,9,"","R",0,'R');
        $pdf->Cell(23,9,"","R",0,'R');
        if($type == "Invoice"){
            $pdf->Cell(11,9,"","R",0,'R');
            $pdf->Cell(39,9,"","R",1,'R');
        }else{
            $pdf->Cell(50,9,"","R",1,'R');
        }

        $pdf->Cell(8,9,"","LR",0,'C');
        $pdf->Cell(75,9,$p4,"R",0,'C');
        $pdf->Cell(17,9,"","R",0,'C');
        $pdf->Cell(17,9,"","R",0,'R');
        $pdf->Cell(23,9,"","R",0,'R');
        if($type == "Invoice"){
            $pdf->Cell(11,9,"","R",0,'R');
            $pdf->Cell(39,9,"","R",1,'R');
        }else{
            $pdf->Cell(50,9,"","R",1,'R');
        }
        
        $pdf->Cell(8,9,"","LR",0,'C');
        $pdf->Cell(75,9,"","R",0,'C');
        $pdf->Cell(17,9,"","R",0,'C');
        $pdf->Cell(17,9,"","R",0,'R');
        $pdf->Cell(23,9,"","R",0,'R');
        if($type == "Invoice"){
            $pdf->Cell(11,9,"","R",0,'R');
            $pdf->Cell(39,9,"","R",1,'R');
        }else{
            $pdf->Cell(50,9,"","R",1,'R');
        }

        if($type != "Invoice"){
            for($i = 0 ; $i<11 ; $i+=1){
                $pdf->Cell(8,6,"","LR",0,'C');
                $pdf->Cell(75,6,"","R",0,'C');
                $pdf->Cell(17,6,"","R",0,'C');
                $pdf->Cell(17,6,"","R",0,'R');
                $pdf->Cell(23,6,"","R",0,'R');
                $pdf->Cell(50,6,"","R",1,'R');
            }
            $pdf->Cell(20,9,"Bill Amount:",1,0,'L');
            $pdf->Cell(120,9,getIndianCurrency($qty*$rate),"TBR",0,'L');
            $pdf->SetFont("Arial","B",9);
            $pdf->Cell(20,9,"Grand Total:","TB",0,"L");
            $pdf->Cell(30,9,number_format($qty*$rate,2,'.',''),"TBR",1,"R");
            $pdf->Cell(0,9,"","LR",1,"");
            $pdf->SetFont("Arial","",9);
            $pdf->Cell(120,9,"","L",0,"");
            $pdf->Cell(70,9,"For, DIPESHWARI AGRICULTURE","R",1,"C");
            $pdf->Cell(0,9,"","LR",1,"");
            $pdf->Cell(120,9,"","L",0,"");
            $pdf->Cell(70,9,"Authorized Signature","R",1,"C");
            $pdf->Cell(0,9,"","LBR",1,"");
            $pdf->output("I","Quatation_".$name.".pdf");
        }
    

    if($type == "Invoice"){
        for($i=0;$i<2;$i+=1){
            $pdf->Cell(8,9,"","LR",0,'C');
            $pdf->Cell(75,9,"","R",0,'C');
            $pdf->Cell(17,9,"","R",0,'C');
            $pdf->Cell(17,9,"","R",0,'R');
            $pdf->Cell(23,9,"","R",0,'R');
            if($type == "Invoice"){
                $pdf->Cell(11,9,"","R",0,'R');
                $pdf->Cell(39,9,"","R",1,'R');
            }else{
                $pdf->Cell(50,9,"","R",1,'R');
            }
        }
        
        $pdf->SetFont("Arial","B",9);
        $pdf->Cell(117,9,"",'LTR',0,'L');
        $pdf->Cell(190-117-39,9,"Sub Total:","TB",0,'L');

        $subtotal = $qty*$rate;

        $cgstValue = $subtotal * $cgst / 100;
        $sgstValue = $subtotal * $sgst / 100;
        $igstValue = $subtotal * $igst / 100;

        

        $pdf->Cell(39,9,number_format($subtotal,2,'.',''),"TBR",1,'R');

        $pdf->SetFont("Arial","",9);
        $pdf->Cell(30,5,"Bank Name","L",0,'L');
        $pdf->Cell(87,5,": Bank Of Baroda",0,0,'L');
        $pdf->Cell(190-117,5,"","LR",1,'');
        $pdf->Cell(30,5,"Bank A/c No.","L",0,'L');
        $pdf->Cell(87,5,": 43650200000541 (current account)",0,0,'L');
        $pdf->Cell(190-117,5,"","LR",1,'');
        $pdf->Cell(30,5,"IFSC Code","L",0,'L');
        $pdf->Cell(87,5,": BARB0SWAROO        Branch: Swaroopganj",0,0,'L');
        $pdf->Cell(190-117,5,"","LR",1,'');
        $pdf->Cell(117,9,"",'LB',0,'');
        $pdf->SetFont("Arial","B",9);
        $pdf->Cell(190-117-39,9,"Taxable Amount","LB",0,'');

        $pdf->Cell(39,9,number_format($subtotal,2,'.',''),"BR",1,'R');
        $pdf->SetFont("Arial","",9);
        $pdf->Cell(117,5,"",'L',0,'');
            $pdf->Cell(190-117-39,5,"IGST"." ".$igst."%","L",0,'L');
            $pdf->Cell(39,5,number_format($igstValue,2,'.',''),"R",1,'R');
            $pdf->SetFont("Arial","",9);
            $pdf->Cell(25,5,"","L",0,'L');
            $pdf->Cell(117-25,5,"",0,0,'L');

        

        
        $pdf->SetFont("Arial","",9);
        $pdf->Cell(190-117-39,5,"CGST"." ".$cgst."%","L",0,'L');
        $pdf->Cell(39,5,number_format($cgstValue,2,'.',''),"R",1,'R');
        $pdf->Cell(25,5,"Bill Amount :","L",0,'L');
        $pdf->SetFont("Arial","I",10);

        $grandTotal = $subtotal + $cgstValue + $sgstValue +$igstValue;
        $roundoff = number_format((float)$grandTotal - (int)$grandTotal,2,'.','');
        if($roundoff>=0.50){
            $roundoff = 1-$roundoff;
        }else{
            
            $roundoff = '- '.$roundoff;
        }
        $grandTotal = round($grandTotal);
        $S = getIndianCurrency($grandTotal);
        
        if(strlen($S)>50){
            
            $temp = strpos($S,' ',50);
            $s1 = substr($S,0,$temp);
            $s2 = substr($S,$temp,strlen($S));
            $pdf->Cell(117-25,5,$s1,0,0,'L',0);
            $pdf->SetFont("Arial","",9);
            $pdf->Cell(190-117-39,5,"SGST"." ".$sgst."%","L",0,'L');
            $pdf->Cell(39,5,number_format($sgstValue,2,'.',''),"R",1,'R');
            $pdf->Cell(25,5,"","L",0,'L');
            $pdf->SetFont("Arial","I",9);
            $pdf->Cell(117-25,5,$s2,0,0,'L');
        }else{
            $pdf->Cell(117-25,5,$S,0,0,'L');
            $pdf->SetFont("Arial","",9);
            $pdf->Cell(190-117-39,5,"SGST".$sgst."%","L",0,'L');
            $pdf->Cell(39,5,number_format($sgstValue,2,'.',''),"R",1,'R');
            $pdf->SetFont("Arial","",9);
            $pdf->Cell(25,5,"","L",0,'L');
            $pdf->Cell(117-25,5,"",0,0,'L');

        }
        

        

        
        $pdf->Cell(190-117-39,5,"Round Off","LB",0,'L');
        $pdf->Cell(39,5,$roundoff,"RB",1,'R');
        $pdf->SetFont("Arial","",9);
        $pdf->Cell(117,7,"Note: "."",1,0,"L");
        $pdf->SetFont("Arial","B",9);
        $pdf->Cell(190-117-39,7,"Grand Total","B",0,"L");
        $pdf->Cell(39,7,number_format($grandTotal,2,'.',''),"BR",1,"R");
        $pdf->Cell(20,10,"",0,1,'');
        $pdf->Cell(120, 10, "",0,0,"L");
        $pdf->Cell(70, 10, "For, DIPESHWARI AGRICULTURE",0,1,"L");
        $pdf->Cell(0, 10, "",0,1,"L");
        $pdf->Cell(130, 10, "",0,0,"L");
        $pdf->Cell(60, 10, "Authorized Signature",0,1,"L");
        $pdf->output("I",$invoice."_".$name.".pdf");
}
    

}
?>
