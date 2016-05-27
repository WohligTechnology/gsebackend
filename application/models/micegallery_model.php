<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class micegallery_model extends CI_Model
{
public function create($mice,$status,$order,$image,$micesubtype)
{
$data=array("mice" => $mice,"status" => $status,"order" => $order,"image" => $image,"micesubtype" => $micesubtype);
$query=$this->db->insert( "gse_micegallery", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("gse_micegallery")->row();
return $query;
}
function getsinglemicegallery($id){
$this->db->where("id",$id);
$query=$this->db->get("gse_micegallery")->row();
return $query;
}
public function edit($id,$mice,$status,$order,$image,$micesubtype)
{
if($image=="")
{
$image=$this->micegallery_model->getimagebyid($id);
$image=$image->image;
}
$data=array("mice" => $mice,"status" => $status,"order" => $order,"image" => $image,"micesubtype" => $micesubtype);
$this->db->where( "id", $id );
$query=$this->db->update( "gse_micegallery", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `gse_micegallery` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `gse_micegallery` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `gse_micegallery` ORDER BY `id`
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
