<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class eventtype_model extends CI_Model
{
public function create($event,$url,$order,$eventsubtype)
{
$data=array("event" => $event,"order" => $order,"url" => $url,"eventsubtype" => $eventsubtype);
$query=$this->db->insert( "gse_eventvideos", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("gse_eventvideos")->row();
return $query;
}
function getsingleeventvideos($id){
$this->db->where("id",$id);
$query=$this->db->get("gse_eventvideos")->row();
return $query;
}
public function edit($id,$event,$status,$order,$url,$eventsubtype)
{
if($image=="")
{
$image=$this->eventtype_model->getimagebyid($id);
$image=$image->image;
}
$data=array("event" => $event,"status" => $status,"order" => $order,"url" => $url,"eventsubtype" => $eventsubtype);
$this->db->where( "id", $id );
$query=$this->db->update( "gse_eventvideos", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `gse_eventvideos` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `gse_eventvideos` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `gse_eventvideos` ORDER BY `id`
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
