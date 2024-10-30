<?php

// Include fpdf library

require_once('lib/fpdf.php');

/* -------------------------------------
	Class for PDF template -------------
------------------------------------- */

class jseacgp_pdfTemplate {

	// Get post meta information

	public function cardMetaInfo( $meta_id ){
 
		$meta_name = get_post_meta( get_the_ID(),$meta_id,true );
			if($meta_name){
				return $meta_name;
		}
	}

	// Get data from plugin option

	public function cardOptionInfo( $id ){
 
		$option_val = get_option($id);
			if($option_val){
				return $option_val;
		}
	}

	// Get file extension

	public function getEx($file_url){
		$fileName = $file_url;
		$file_ex = explode(".",$fileName);
		$arrayL = count(explode(".",$fileName));
		$last_ele = $arrayL - 1;
		return $fileEx = $file_ex[$arrayL-1];
	}

    // Get taxonomy

    public function taxonomyRp($taxonomy){ 
		$tax = get_the_term_list( get_the_ID(), $taxonomy, '', ', ', '' );
		$tax = strip_tags($tax);
		
		if( get_the_term_list( get_the_ID(), $taxonomy ) != null ){
			return $tax;
	
		}
	}

	// Get all subjects from post meta

	public function getSubjects($array){
		$subjects = explode("/", $this->cardMetaInfo($array));
		return $subjects;
	}

	// Delete files after generating pdf

	public function deleteFiles($path) {
	  
	  if (is_dir($path)) {
	    
	    $files = array('logo'.get_the_ID().'.jpg','student'.get_the_ID().'.jpg','signature'.get_the_ID().'.jpg','logo'.get_the_ID().'.png','student'.get_the_ID().'.png','signature'.get_the_ID().'.png');

	    foreach ($files as $file) {
	    	if(file_exists($path.$file)){
	    		unlink($path.$file);
	    	}
	    }

	  }

	}

	// Hide class info if get zero value from option

	public function classHide($optionID,$className){
		if(empty($this->cardOptionInfo($optionID))){
			return '';
		}
		else{
			return $this->taxonomyRp($className);
		}
	}

    // General pdf template

	public function templateGeneral() {

		$student = plugin_dir_path( __FILE__ )."../assets/img/blank-student.png";
		$signature = plugin_dir_path( __FILE__ )."../assets/img/blank-signature.png";

		//create pdf object
		$pdf = new FPDF('P','mm','A4');
		//add new page
		$pdf->AddPage();

		// Header
		//set font to arial, bold, 14pt

		//$pdf->SetFillColor(976,245,458); // Cell backgound color
		$pdf->SetTextColor(28, 28, 28); // Set text color
		$pdf->SetFont('arial','B',12);
		$pdf->Cell(189 ,10, $this->cardOptionInfo('jseacgp_ctitle'),1,1,'C');//end of line

		$pdf->SetFont('arial','',12);
		$pdf->SetTextColor(28, 28, 28); // Set text color
		$pdf->Cell(94.50 ,10, ' '.$this->cardOptionInfo('jseacgp_ename').' : '.$this->taxonomyRp('jseacgExam'),'LB',0,'L');//end of line
		$pdf->Cell(94.50 ,10, $this->cardOptionInfo('jseacgp_tyear').' : '.$this->taxonomyRp('jseacgYear').' ','RB',1,'R');//end of line

		// Main content
		$pdf->SetTextColor(37, 38, 37);
		$pdf->Cell(37 ,10,' '.$this->cardOptionInfo('jseacgp_sname'),'LB',0);
		$pdf->Cell(5 ,10,':','B',0);
		$pdf->Cell(102 ,10, get_the_title(), 'BR',0);
		$pdf->Cell(45, 60, $pdf->Image($student, $pdf->GetX(), $pdf->GetY(), 45.00), 1, 0, false );
		$pdf->Cell(0 ,10,'',0,1);//Important

		$pdf->SetFont('arial','I',11);
		$pdf->Cell(37 ,10,' '.$this->cardOptionInfo('jseacgp_f1'),'LB',0);
		$pdf->Cell(5 ,10,':','B',0);
		$pdf->Cell(55 ,10, $this->cardMetaInfo('_jseacgp_f1'),'B',0);

		$pdf->Cell(21 ,10,' '.$this->cardOptionInfo('jseacgp_f7'),'B',0,'L');
		$pdf->Cell(5 ,10,':','B',0,'L');
		$pdf->Cell(21 ,10, $this->cardMetaInfo('_jseacgp_f7'),'B',0,'L');
		$pdf->Cell(0 ,10,'',0,1);//Important

		$pdf->Cell(37 ,10,' '.$this->cardOptionInfo('jseacgp_f2'),'LB',0);
		$pdf->Cell(5 ,10,':','B',0);
		$pdf->Cell(55 ,10, $this->cardMetaInfo('_jseacgp_f2'),'B',0);

		$pdf->Cell(21 ,10,' '.$this->cardOptionInfo('jseacgp_f8'),'B',0,'L');
		$pdf->Cell(5 ,10,':','B',0,'L');
		$pdf->Cell(21 ,10, $this->cardMetaInfo('_jseacgp_f8'),'B',0,'L');
		$pdf->Cell(0 ,10,'',0,1);//Important

		$pdf->Cell(37 ,10,' '.$this->cardOptionInfo('jseacgp_f4'),'LB',0);
		$pdf->Cell(5 ,10,':','B',0);
		$pdf->Cell(55 ,10, $this->cardMetaInfo('_jseacgp_f4'),'B',0);

		$pdf->Cell(21 ,10,' '.$this->cardOptionInfo('jseacgp_f6'),'B',0,'L');
		$pdf->Cell(5 ,10,':','B',0,'L');
		$pdf->Cell(21 ,10, $this->cardMetaInfo('_jseacgp_f6'),'B',0,'L');
		$pdf->Cell(0 ,10,'',0,1);//Important

		$pdf->Cell(37 ,10,' '.$this->cardOptionInfo('jseacgp_f3'),'LB',0);
		$pdf->Cell(5 ,10,':','B',0);
		$pdf->Cell(55 ,10, $this->cardMetaInfo('_jseacgp_f3'),'B',0);

		$pdf->Cell(21 ,10,' '.$this->cardOptionInfo('jseacgp_f5'),'B',0);
		$pdf->Cell(5 ,10,':','B',0);
		$pdf->Cell(21 ,10, $this->cardMetaInfo('_jseacgp_f5'),'B',0);
		$pdf->Cell(0 ,10,'',0,1);//Important

		$pdf->Cell(37 ,10,' '.$this->cardOptionInfo('jseacgp_f11'),'LB',0);
		$pdf->Cell(5 ,10,':','B',0);
		$pdf->Cell(55 ,10, $this->cardMetaInfo('_jseacgp_f11'),'B',0);

		$pdf->Cell(21 ,10,'','B',0);
		$pdf->Cell(5 ,10,'','B',0);
		$pdf->Cell(21 ,10, '','B',1);

		$pdf->SetFont('arial','',12);
		$pdf->Cell(63 ,10,' '.$this->cardOptionInfo('jseacgp_f9'),'LB',0);//end of line
		$pdf->Cell(10 ,10,':','B',0);//end of line
		$pdf->Cell(116 ,10, $this->cardMetaInfo('_jseacgp_f9'),'BR',1);//end of line

		$pdf->Cell(63 ,10,' '.$this->cardOptionInfo('jseacgp_f10'),'LB',0);//end of line
		$pdf->Cell(10 ,10,':','B',0);//end of line
		$pdf->Cell(116 ,10, $this->cardMetaInfo('_jseacgp_f10'),'BR',1);//end of line

		$pdf->SetFont('arial','',12);
		$pdf->Cell(63 ,10,' '.$this->cardOptionInfo('jseacgp_f16'),1,0,'C');//end of line
		$pdf->Cell(63 ,10,' '.$this->cardOptionInfo('jseacgp_soinvi'),1,0,'C');//end of line
		$pdf->Cell(63 ,10,' '.$this->cardOptionInfo('jseacgp_ssignat'),1,1,'C');//end of line
		$pdf->Cell(63 ,20,$pdf->Image($signature, $pdf->GetX(), $pdf->GetY(), 65.50),1,0,'C');//end of line
		$pdf->Cell(63 ,20,'',1,0,'C');//end of line
		$pdf->Cell(63 ,20,'',1,1,'C');//end of line

		// Force browser to download the file
		$pdf->Output(get_the_title().'.pdf', 'D'); 

		// Delete files from temp folder
		$this->deleteFiles(plugin_dir_path( __FILE__ )."temp-image/");
	}
}