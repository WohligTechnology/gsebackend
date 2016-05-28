<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class mediacorner_model extends CI_Model
{
public function create($name,$image,$date,$medianame,$url,$facebook,$twitter,$message)
{
$data=array("name" => $name,"image" => $image,"date" => $date,"medianame" => $medianame,"url" => $url,"facebook" => $facebook,"twitter" => $twitter,"message" => $message);
$query=$this->db->insert( "gse_mediacorner", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("gse_mediacorner")->row();
return $query;
}
function getsinglemediacorner($id){
$this->db->where("id",$id);
$query=$this->db->get("gse_mediacorner")->row();
return $query;
}
public function edit($id,$name,$image,$date,$medianame,$url,$facebook,$twitter,$message)
{
if($image=="")
{
$image=$this->mediacorner_model->getimagebyid($id);
$image=$image->image;
}
$data=array("name" => $name,"image" => $image,"date" => $date,"medianame" => $medianame,"url" => $url,"facebook" => $facebook,"twitter" => $twitter,"message" => $message);
$this->db->where( "id", $id );
$query=$this->db->update( "gse_mediacorner", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `gse_mediacorner` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `gse_mediacorner` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `gse_mediacorner` ORDER BY `id`
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
