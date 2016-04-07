<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class careerform_model extends CI_Model
{
public function create($name,$email,$phone,$resume,$comment)
{
$data=array("name" => $name,"email" => $email,"phone" => $phone,"resume" => $resume,"comment" => $comment);
$query=$this->db->insert( "gse_careerform", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("gse_careerform")->row();
return $query;
}
function getsinglecareerform($id){
$this->db->where("id",$id);
$query=$this->db->get("gse_careerform")->row();
return $query;
}
public function edit($id,$name,$email,$phone,$resume,$comment)
{
if($image=="")
{
$image=$this->careerform_model->getimagebyid($id);
$image=$image->image;
}
$data=array("name" => $name,"email" => $email,"phone" => $phone,"resume" => $resume,"comment" => $comment);
$this->db->where( "id", $id );
$query=$this->db->update( "gse_careerform", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `gse_careerform` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `gse_careerform` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `gse_careerform` ORDER BY `id` 
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
