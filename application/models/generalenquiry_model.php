<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class generalenquiry_model extends CI_Model
{
public function create($firstname,$middlename,$lastname,$companyname,$email,$phone,$webaddress,$message)
{
$data=array("firstname" => $firstname,"middlename" => $middlename,"lastname" => $lastname,"companyname" => $companyname,"email" => $email,"phone" => $phone,"webaddress" => $webaddress,"message" => $message);
$query=$this->db->insert( "gse_generalenquiry", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("gse_generalenquiry")->row();
return $query;
}
function getsinglegeneralenquiry($id){
$this->db->where("id",$id);
$query=$this->db->get("gse_generalenquiry")->row();
return $query;
}
public function edit($id,$firstname,$middlename,$lastname,$companyname,$email,$phone,$webaddress,$message)
{
if($image=="")
{
$image=$this->generalenquiry_model->getimagebyid($id);
$image=$image->image;
}
$data=array("firstname" => $firstname,"middlename" => $middlename,"lastname" => $lastname,"companyname" => $companyname,"email" => $email,"phone" => $phone,"webaddress" => $webaddress,"message" => $message);
$this->db->where( "id", $id );
$query=$this->db->update( "gse_generalenquiry", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `gse_generalenquiry` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `gse_generalenquiry` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `gse_generalenquiry` ORDER BY `id` 
                    ASC")->result();
$return=array(
"" => "Select Option"
);
foreach($query as $row)
{
$return[$row->id]=$row->name;
}
return $return;
}
}
?>
