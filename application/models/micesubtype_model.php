<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class micesubtype_model extends CI_Model
{
public function create($mice,$name,$image,$content,$banner,$url,$order)
{
$data=array("mice" => $mice,"name" => $name,"image" => $image,"content" => $content,"banner" => $banner,"url" => $url,"order" => $order);
$query=$this->db->insert( "gse_micesubtype", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("gse_micesubtype")->row();
return $query;
}
function getsingleweddingsubtype($id){
$this->db->where("id",$id);
$query=$this->db->get("gse_micesubtype")->row();
return $query;
}
public function edit($id,$mice,$name,$image,$content,$banner,$url,$order)
{
if($image=="")
{
$image=$this->micesubtype_model->getimagebyid($id);
$image=$image->image;
}
if($banner=="")
{
$banner=$this->micesubtype_model->getbannerbyid($id);
$banner=$banner->banner;
}
$data=array("mice" => $mice,"name" => $name,"image" => $image,"content" => $content,"banner" => $banner,"url" => $url,"order" => $order);
$this->db->where( "id", $id );
$query=$this->db->update( "gse_micesubtype", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `gse_micesubtype` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `gse_micesubtype` WHERE `id`='$id'")->row();
return $query;
}
public function getbannerbyid($id)
{
$query=$this->db->query("SELECT `banner` FROM `gse_micesubtype` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown($id)
{
$query=$this->db->query("SELECT * FROM `gse_micesubtype` WHERE `mice`='$id' ORDER BY `id` ASC")->result();
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
