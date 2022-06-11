<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 



class Consult_model extends CI_Model { 


	

	#################### Filtering Data ###################

	public function filter($array)

	{



		foreach($array as $key=>$row)

		{

		  if(!is_array($row))

		   $filt_array[$key] = addslashes($row);

		  else

		     $filt_array[$key] = $row;

		}


		return $filt_array ;


	}

	public function remove_data($id,$table,$field,$where)

	{

	  $query_update	=	"update  ".$table." set ".$field." ='C' where ".$where." =".$id;



			$this->db->trans_begin();

			

			//$this->db->query($query_delete);

			$this->db->query($query_update);

		//---------- after execution process - execution completed successfully then commited aotherwise rollbacks all inserted datas -----------//

			

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

	public function get_login_data($array)

	{

       $username = $array['loginusername'];

	   $password = md5($array['loginpassword']);
	   
	  // echo "select admid,admfname,admlname,atype

		                           // from  cart_admin where admusername = '$username' and admpassword = '$password' and admstatus = '1'

								  //  ";

		 $query = $this->db->query("select admid,admfname,admlname,atype

		                            from  cart_admin where admusername = '$username' and admpassword = '$password' and admstatus = '1'

								    ");

		return $query->result_array() ;
	}
		
}