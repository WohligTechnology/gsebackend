<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class blogimage_model extends CI_Model
{
public function create($diaryarticle,$image,$order)
{
$data=array("diaryarticle" => $diaryarticle,"image" => $image,"order" => $order);
$query=$this->db->insert( "gse_blogimage", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("gse_blogimage")->row();
return $query;
}
function getsingleblogimage($id){
$this->db->where("id",$id);
$query=$this->db->get("gse_blogimage")->row();
return $query;
}
public function edit($id,$diaryarticle,$image,$order)
{
if($image=="")
{
$image=$this->blogimage_model->getimagebyid($id);
$image=$image->image;
}
$data=array("diaryarticle" => $diaryarticle,"image" => $image,"order" => $order);
$this->db->where( "id", $id );
$query=$this->db->update( "gse_blogimage", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `gse_blogimage` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `gse_blogimage` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `gse_blogimage` ORDER BY `id` 
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
