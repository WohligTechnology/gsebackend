<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class player_model extends CI_Model
{
public function create($order,$status,$sportscategory,$name,$image)
{
$data=array("order" => $order,"status" => $status,"sportscategory" => $sportscategory,"name" => $name,"image" => $image);
$query=$this->db->insert( "gse_player", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("gse_player")->row();
return $query;
}
function getsingleplayer($id){
$this->db->where("id",$id);
$query=$this->db->get("gse_player")->row();
return $query;
}
public function edit($id,$order,$status,$sportscategory,$name,$image)
{
if($image=="")
{
$image=$this->player_model->getimagebyid($id);
$image=$image->image;
}
$data=array("order" => $order,"status" => $status,"sportscategory" => $sportscategory,"name" => $name,"image" => $image);
$this->db->where( "id", $id );
$query=$this->db->update( "gse_player", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `gse_player` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `gse_player` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `gse_player` ORDER BY `id` 
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
