<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class event_model extends CI_Model
{
public function create($name,$image,$banner,$order,$hashtag,$facebook,$twitter,$instagram,$status)
{
$data=array("name" => $name,"image" => $image,"banner" => $banner,"order" => $order,"hashtag" => $hashtag,"facebook" => $facebook,"twitter" => $twitter,"instagram" => $instagram,"status" => $status);
$query=$this->db->insert( "gse_event", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("gse_event")->row();
return $query;
}
function getsingleevent($id){
$this->db->where("id",$id);
$query=$this->db->get("gse_event")->row();
return $query;
}
public function edit($id,$name,$image,$banner,$order,$hashtag,$facebook,$twitter,$instagram,$status)
{
if($image=="")
{
$image=$this->event_model->getimagebyid($id);
$image=$image->image;
}
$data=array("name" => $name,"image" => $image,"banner" => $banner,"order" => $order,"hashtag" => $hashtag,"facebook" => $facebook,"twitter" => $twitter,"instagram" => $instagram,"status" => $status);
$this->db->where( "id", $id );
$query=$this->db->update( "gse_event", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `gse_event` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `gse_event` WHERE `id`='$id'")->row();
return $query;
}
public function getbannerbyid($id)
{
$query=$this->db->query("SELECT `banner` FROM `gse_event` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `gse_event` ORDER BY `id`
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
