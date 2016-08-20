<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class worldtour_model extends CI_Model
{
public function create($type,$image,$name,$location,$date,$venue,$content,$banner,$hashtag,$facebook,$twitter,$instagram)
{
$data=array("type" => $type,"image" => $image,"name" => $name,"location" => $location,"date" => $date,"venue" => $venue,"content" => $content,"banner" => $banner,"hashtag" => $hashtag,"facebook" => $facebook,"twitter" => $twitter,"instagram" => $instagram);
$query=$this->db->insert( "gse_worldtour", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("gse_worldtour")->row();
return $query;
}
function getsingleworldtour($id){
$this->db->where("id",$id);
$query=$this->db->get("gse_worldtour")->row();
return $query;
}
public function edit($id,$type,$image,$name,$location,$date,$venue,$content,$banner,$hashtag,$facebook,$twitter,$instagram)
{
if($image=="")
{
$image=$this->worldtour_model->getimagebyid($id);
$image=$image->image;
}
$data=array("type" => $type,"image" => $image,"name" => $name,"location" => $location,"date" => $date,"venue" => $venue,"content" => $content,"banner" => $banner,"hashtag" => $hashtag,"facebook" => $facebook,"twitter" => $twitter,"instagram" => $instagram);
$this->db->where( "id", $id );
$query=$this->db->update( "gse_worldtour", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `gse_worldtour` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `gse_worldtour` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `gse_worldtour` ORDER BY `id`
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
public function gettypedropdown()
{

$return=array(
"" => "Select type",
"1" => "Past Concert",
"2" => "Upcoming Concert"
);

return $return;
}

}
?>
