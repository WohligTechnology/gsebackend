<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class previousgamevideo_model extends CI_Model
{
public function create($order,$url,$highlight,$sportscategory)
{
$data=array("order" => $order,"url" => $url,"highlight" => $highlight,"sportscategory" => $sportscategory);
$query=$this->db->insert( "gse_previousgamevideo", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("gse_previousgamevideo")->row();
return $query;
}
function getsinglepreviousgamevideo($id){
$this->db->where("id",$id);
$query=$this->db->get("gse_previousgamevideo")->row();
return $query;
}
public function edit($id,$order,$url,$highlight,$sportscategory)
{

$data=array("order" => $order,"url" => $url,"highlight" => $highlight,"sportscategory" => $sportscategory);
$this->db->where( "id", $id );
$query=$this->db->update( "gse_previousgamevideo", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `gse_previousgamevideo` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `gse_previousgamevideo` WHERE `id`='$id'")->row();
return $query;
}
}
?>
