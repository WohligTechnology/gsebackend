<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class weddingsubtype_model extends CI_Model
{
public function create($wedding,$name,$image,$banner,$content,$videos,$order,$status)
{
$data=array("wedding" => $wedding,"name" => $name,"image" => $image,"banner" => $banner,"content" => $content,"videos" => $videos,"order" => $order,"status" => $status);
$query=$this->db->insert( "gse_weddingsubtype", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("gse_weddingsubtype")->row();
return $query;
}
function getsingleweddingsubtype($id){
$this->db->where("id",$id);
$query=$this->db->get("gse_weddingsubtype")->row();
return $query;
}
public function edit($id,$wedding,$name,$image,$banner,$content,$videos,$order,$status)
{
if($image=="")
{
$image=$this->weddingsubtype_model->getimagebyid($id);
$image=$image->image;
}

$data=array("wedding" => $wedding,"name" => $name,"image" => $image,"banner" => $banner,"content" => $content,"videos" => $videos,"order" => $order,"status" => $status);
$this->db->where( "id", $id );
$query=$this->db->update( "gse_weddingsubtype", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `gse_weddingsubtype` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `gse_weddingsubtype` WHERE `id`='$id'")->row();
return $query;
}
public function getbannerbyid($id)
{
$query=$this->db->query("SELECT `banner` FROM `gse_weddingsubtype` WHERE `id`='$id'")->row();
return $query;
}
// public function getdropdown()
// {
// $query=$this->db->query("SELECT * FROM `gse_weddingsubtype` ORDER BY `id` ASC")->result();
// $return=array(
// "" => "Select Option"
// );
// foreach($query as $row)
// {
// $return[$row->id]=$row->name;
// }
// return $return;
// }
public function getdropdown($id)
{
$query=$this->db->query("SELECT * FROM `gse_weddingsubtype` WHERE `wedding`='$id' ORDER BY `id` ASC")->result();
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
