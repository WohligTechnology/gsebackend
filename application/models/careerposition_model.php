<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class careerposition_model extends CI_Model
{
public function create($name,$position,$education)
{
$data=array("name" => $name,"position" => $position,"education" => $education);
$query=$this->db->insert( "gse_careerposition", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("gse_careerposition")->row();
return $query;
}
function getsinglecareerposition($id){
$this->db->where("id",$id);
$query=$this->db->get("gse_careerposition")->row();
return $query;
}
public function edit($id,$name,$position,$education)
{
if($image=="")
{
$image=$this->careerposition_model->getimagebyid($id);
$image=$image->image;
}
$data=array("name" => $name,"position" => $position,"education" => $education);
$this->db->where( "id", $id );
$query=$this->db->update( "gse_careerposition", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `gse_careerposition` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `gse_careerposition` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `gse_careerposition` ORDER BY `id` 
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
