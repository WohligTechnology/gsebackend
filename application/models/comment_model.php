<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class comment_model extends CI_Model
{
public function create($google,$twitter,$facebook,$name,$image,$description)
{
$data=array("google" => $google,"twitter" => $twitter,"facebook" => $facebook,"name" => $name,"image" => $image,"description" => $description);
$query=$this->db->insert( "comment", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("gse_comment")->row();
return $query;
}
function getsinglecomment($id){
$this->db->where("id",$id);
$query=$this->db->get("gse_comment")->row();
return $query;
}
public function edit($id,$google,$twitter,$facebook,$name,$image,$description)
{
  if($image=="")
  {
  $image=$this->comment_model->getimagebyid($id);
  $image=$image->image;
  }
$data=array("google" => $google,"twitter" => $twitter,"facebook" => $facebook,"name" => $name,"image" => $image,"description" => $description);
$this->db->where( "id", $id );
$query=$this->db->update( "gse_comment", $data );
return 1;
}
public function delete($id)
{
  echo"id".$id;
$query=$this->db->query("DELETE FROM `gse_comment` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `gse_comment` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `gse_comment` ORDER BY `id` ASC")->result();
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
