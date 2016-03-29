<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class subscribe_model extends CI_Model
{
public function create($email,$timestamp)
{
$data=array("email" => $email);
$query=$this->db->insert( "gse_subscribe", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("gse_subscribe")->row();
return $query;
}
function getsinglesubscribe($id){
$this->db->where("id",$id);
$query=$this->db->get("gse_subscribe")->row();
return $query;
}
public function edit($id,$email,$timestamp)
{

$data=array("email" => $email,"timestamp" => $timestamp);
$this->db->where( "id", $id );
$query=$this->db->update( "gse_subscribe", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `gse_subscribe` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `gse_subscribe` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `gse_subscribe` ORDER BY `id` 
                    ASC")->row();
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
