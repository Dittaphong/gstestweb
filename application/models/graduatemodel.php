<?php
		$this->student_relate();
		$this->student_relate();
		$this->db->where($data);
		$this->db->select($id);
		// $this->db->where('doc_approved_by', 'FACU');
		// $this->db->where('doc_approved_status', 1);
		$this->db->where('EXAM_TYPE',$EXAM_TYPE);
		$this->db->join('doc_exam', 'relate_doc_approved.doc_approved_ref = doc_exam.EXAM_ID','LEFT');