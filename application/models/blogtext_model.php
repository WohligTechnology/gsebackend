<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class blogtext_model extends CI_Model
{
public function create($diaryarticle,$content,$image,$order)
{
$data=array("diaryarticle" => $diaryarticle,"content" => $content,"image" => $image,"order" => $order);
$query=$this->db->insert( "gse_blogtext", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("gse_blogtext")->row();
return $query;
}
function getsingleblogtext($id){
$this->db->where("id",$id);
$query=$this->db->get("gse_blogtext")->row();
return $query;
}
public function edit($id,$diaryarticle,$content,$image,$order)
{
if($image=="")
{
$image=$this->blogtext_model->getimagebyid($id);
$image=$image->image;
}
$data=array("diaryarticle" => $diaryarticle,"content" => $content,"image" => $image,"order" => $order);
$this->db->where( "id", $id );
$query=$this->db->update( "gse_blogtext", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `gse_blogtext` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `gse_blogtext` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `gse_blogtext` ORDER BY `id` 
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
