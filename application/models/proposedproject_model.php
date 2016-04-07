<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class proposedproject_model extends CI_Model
{
public function create($name,$company,$webaddress,$country,$phone,$email,$question1ans,$question2ans,$question3ans,$content)
{
$data=array("name" => $name,"company" => $company,"webaddress" => $webaddress,"country" => $country,"phone" => $phone,"email" => $email,"question1ans" => $question1ans,"question2ans" => $question2ans,"question3ans" => $question3ans,"content" => $content);
$query=$this->db->insert( "gse_proposedproject", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("gse_proposedproject")->row();
return $query;
}
function getsingleproposedproject($id){
$this->db->where("id",$id);
$query=$this->db->get("gse_proposedproject")->row();
return $query;
}
public function edit($id,$name,$company,$webaddress,$country,$phone,$email,$question1ans,$question2ans,$question3ans,$content)
{
if($image=="")
{
$image=$this->proposedproject_model->getimagebyid($id);
$image=$image->image;
}
$data=array("name" => $name,"company" => $company,"webaddress" => $webaddress,"country" => $country,"phone" => $phone,"email" => $email,"question1ans" => $question1ans,"question2ans" => $question2ans,"question3ans" => $question3ans,"content" => $content);
$this->db->where( "id", $id );
$query=$this->db->update( "gse_proposedproject", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `gse_proposedproject` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `gse_proposedproject` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `gse_proposedproject` ORDER BY `id` 
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
