<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class action_model extends CI_Model { 


public function remove_data($id,$table,$field,$where)
	{

	  $query_update	=	"update  ".$table." set ".$field." ='C' where ".$where." =".$id;
	  $this->db->trans_begin();

			$this->db->query($query_update);
	
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				$successflag=FALSE;

			}
			else
			{
			   $this->db->trans_commit();
				 $successflag=TRUE;

			}	

			return $successflag;

	}

	
public function InsertQuery($tablename,$arraydata){

 $sql = 'INSERT INTO `'.$tablename.'`(';
		$values = "VALUES(";
        //while(list($key,$val) =each($arraydata)){
			foreach($arraydata as $key=>$val)
			{
			$sql.=$key.',';
			$values .= "'".addslashes($val)."',";
		}
		$sql = substr($sql,0,-1).")".substr($values,0,-1).")";

		  return $this->db->query($sql);
		
	
	}
	
	
	function UpdateQuery($tablename,$arraydata,$idfield,$id){
	
		
		//print_r($arraydata );
		$id = '"'.$id.'"';
		  $sql = 'UPDATE '.$tablename.' SET ';
		//while(list($key,$val) =each($arraydata)){
			foreach($arraydata as $key=>$val)
			{
			 $sql.=$key.' =\''.addslashes($val).'\',';
		   }
		$sql = substr($sql,0,-1);
		$sql .=' where '.$idfield.' ='.$id;
		//echo $sql;
		return $this->db->query($sql);
	}

}