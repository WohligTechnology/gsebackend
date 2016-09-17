<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class author_model extends CI_Model
{
public function create($google,$twitter,$facebook,$name,$image,$description,$order,$status)
{
$data=array("google" => $google,"twitter" => $twitter,"facebook" => $facebook,"name" => $name,"image" => $image,"description" => $description,"order" => $order,"status" => $status);
$query=$this->db->insert( "author", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("author")->row();
return $query;
}
function getsingleauthor($id){
$this->db->where("id",$id);
$query=$this->db->get("author")->row();
return $query;
}
public function edit($id,$google,$twitter,$facebook,$name,$image,$description,$order,$status)
{
  if($image=="")
  {
  $image=$this->author_model->getimagebyid($id);
  $image=$image->image;
  }
$data=array("google" => $google,"twitter" => $twitter,"facebook" => $facebook,"name" => $name,"image" => $image,"description" => $description,"order" => $order,"status" => $status);
$this->db->where( "id", $id );
$query=$this->db->update( "author", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `author` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `author` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `author` ORDER BY `id` ASC")->result();
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
