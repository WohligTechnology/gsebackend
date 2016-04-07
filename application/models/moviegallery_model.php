<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class moviegallery_model extends CI_Model
{
public function create($movie,$order,$status,$image)
{
$data=array("movie" => $movie,"order" => $order,"status" => $status,"image" => $image);
$query=$this->db->insert( "gse_moviegallery", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("gse_moviegallery")->row();
return $query;
}
function getsinglemoviegallery($id){
$this->db->where("id",$id);
$query=$this->db->get("gse_moviegallery")->row();
return $query;
}
public function edit($id,$movie,$order,$status,$image)
{
if($image=="")
{
$image=$this->moviegallery_model->getimagebyid($id);
$image=$image->image;
}
$data=array("movie" => $movie,"order" => $order,"status" => $status,"image" => $image);
$this->db->where( "id", $id );
$query=$this->db->update( "gse_moviegallery", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `gse_moviegallery` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `gse_moviegallery` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `gse_moviegallery` ORDER BY `id` 
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
