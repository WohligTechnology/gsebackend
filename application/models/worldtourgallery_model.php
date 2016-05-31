<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class worldtourgallery_model extends CI_Model
{
public function create($worldtour,$image,$order,$worldtoursubtype)
{
$data=array("worldtour" => $worldtour,"order" => $order,"image" => $image);
$query=$this->db->insert( "gse_worldtourimage", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("gse_worldtourimage")->row();
return $query;
}
function getsingleworldtourvideos($id){
$this->db->where("id",$id);
$query=$this->db->get("gse_worldtourimage")->row();
return $query;
}
public function edit($id,$worldtour,$image,$order,$worldtoursubtype)
{
if($image=="")
{
$image=$this->worldtourgallery_model->getimagebyid($id);
$image=$image->image;
}
$data=array("worldtour" => $worldtour,"order" => $order,"image" => $image);
$this->db->where( "id", $id );
$query=$this->db->update( "gse_worldtourimage", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `gse_worldtourimage` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `gse_worldtourimage` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `gse_worldtourimage` ORDER BY `id`
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
