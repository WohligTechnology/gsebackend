<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class getintouch_model extends CI_Model
{
public function create($category,$firstname,$lastname,$email,$phone,$timestamp,$comment,$enquiryfor)
{
$data=array("category" => $category,"firstname" => $firstname,"lastname" => $lastname,"email" => $email,"phone" => $phone,"timestamp" => $timestamp,"comment" => $comment,"enquiryfor" => $enquiryfor);
$query=$this->db->insert( "gse_getintouch", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("gse_getintouch")->row();
return $query;
}
function getsinglegetintouch($id){
$this->db->where("id",$id);
$query=$this->db->get("gse_getintouch")->row();
return $query;
}
public function edit($id,$category,$firstname,$lastname,$email,$phone,$timestamp,$comment,$enquiryfor)
{
$data=array("category" => $category,"firstname" => $firstname,"lastname" => $lastname,"email" => $email,"phone" => $phone,"timestamp" => $timestamp,"comment" => $comment,"enquiryfor" => $enquiryfor);
$this->db->where( "id", $id );
$query=$this->db->update( "gse_getintouch", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `gse_getintouch` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `gse_getintouch` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `gse_getintouch` ORDER BY `id` 
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
