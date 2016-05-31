<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class talenttypegallery_model extends CI_Model
{
public function create($order,$status,$talenttype,$image)
{
$data=array("order" => $order,"status" => $status,"talenttype" => $talenttype,"image" => $image);
$query=$this->db->insert( "gse_talenttypegallery", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("gse_talenttypegallery")->row();
return $query;
}
function getsingletalenttypegallery($id){
$this->db->where("id",$id);
$query=$this->db->get("gse_talenttypegallery")->row();
return $query;
}
public function edit($id,$order,$status,$talenttype,$image)
{
if($image=="")
{
$image=$this->talenttypegallery_model->getimagebyid($id);
$image=$image->image;
}
$data=array("order" => $order,"status" => $status,"talenttype" => $talenttype,"image" => $image);
$this->db->where( "id", $id );
$query=$this->db->update( "gse_talenttypegallery", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `gse_talenttypegallery` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `gse_talenttypegallery` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `gse_talenttypegallery` ORDER BY `id` 
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
