<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class previousgamegallery_model extends CI_Model
{
public function create($order,$status,$highlight,$sportscategory,$image)
{
$data=array("order" => $order,"status" => $status,"highlight" => $highlight,"sportscategory" => $sportscategory,"image" => $image);
$query=$this->db->insert( "gse_previousgamegallery", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("gse_previousgamegallery")->row();
return $query;
}
function getsinglepreviousgamegallery($id){
$this->db->where("id",$id);
$query=$this->db->get("gse_previousgamegallery")->row();
return $query;
}
public function edit($id,$order,$status,$highlight,$sportscategory,$image)
{
if($image=="")
{
$image=$this->previousgamegallery_model->getimagebyid($id);
$image=$image->image;
}
$data=array("order" => $order,"status" => $status,"highlight" => $highlight,"sportscategory" => $sportscategory,"image" => $image);
$this->db->where( "id", $id );
$query=$this->db->update( "gse_previousgamegallery", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `gse_previousgamegallery` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `gse_previousgamegallery` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `gse_previousgamegallery` ORDER BY `id` 
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
