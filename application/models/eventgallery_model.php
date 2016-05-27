<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class eventgallery_model extends CI_Model
{
public function create($event,$status,$order,$image,$eventsubtype)
{
$data=array("event" => $event,"status" => $status,"order" => $order,"image" => $image,"eventsubtype" => $eventsubtype);
$query=$this->db->insert( "gse_eventgallery", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("gse_eventgallery")->row();
return $query;
}
function getsingleeventgallery($id){
$this->db->where("id",$id);
$query=$this->db->get("gse_eventgallery")->row();
return $query;
}
public function edit($id,$event,$status,$order,$image,$eventsubtype)
{
if($image=="")
{
$image=$this->eventgallery_model->getimagebyid($id);
$image=$image->image;
}
$data=array("event" => $event,"status" => $status,"order" => $order,"image" => $image,"eventsubtype" => $eventsubtype);
$this->db->where( "id", $id );
$query=$this->db->update( "gse_eventgallery", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `gse_eventgallery` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `gse_eventgallery` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `gse_eventgallery` ORDER BY `id` 
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
