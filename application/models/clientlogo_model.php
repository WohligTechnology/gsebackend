<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class clientlogo_model extends CI_Model
{
public function create($order,$status,$name,$image)
{
$data=array("order" => $order,"status" => $status,"name" => $name,"image" => $image);
$query=$this->db->insert( "gse_clientlogo", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("gse_clientlogo")->row();
return $query;
}
function getsingleclientlogo($id){
$this->db->where("id",$id);
$query=$this->db->get("gse_clientlogo")->row();
return $query;
}
public function edit($id,$order,$status,$name,$image)
{
if($image=="")
{
$image=$this->clientlogo_model->getimagebyid($id);
$image=$image->image;
}
$data=array("order" => $order,"status" => $status,"name" => $name,"image" => $image);
$this->db->where( "id", $id );
$query=$this->db->update( "gse_clientlogo", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `gse_clientlogo` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `gse_clientlogo` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `gse_clientlogo` ORDER BY `id` 
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
