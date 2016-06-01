<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class eventsubtype_model extends CI_Model
{
public function create($event,$name,$image,$content,$order,$releasedate,$location)
{
$data=array("event" => $event,"name" => $name,"image" => $image,"content" => $content,"order" => $order,"date" => $releasedate,"location" => $location);
$query=$this->db->insert( "gse_eventsubtype", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("gse_eventsubtype")->row();
return $query;
}
function getsingleeventsubtype($id){
$this->db->where("id",$id);
$query=$this->db->get("gse_eventsubtype")->row();
return $query;
}
public function edit($id,$event,$name,$image,$content,$order,$status,$releasedate,$location)
{
if($image=="")
{
$image=$this->eventsubtype_model->getimagebyid($id);
$image=$image->image;
}
$data=array("event" => $event,"name" => $name,"image" => $image,"content" => $content,"order" => $order,"status" => $status,"date" => $releasedate,"location" => $location);
$this->db->where( "id", $id );
$query=$this->db->update( "gse_eventsubtype", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `gse_eventsubtype` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `gse_eventsubtype` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `gse_eventsubtype` ORDER BY `id`
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
