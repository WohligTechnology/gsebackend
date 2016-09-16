<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class talent_model extends CI_Model
{
public function create($name,$image,$link,$banner,$hashtag,$facebook,$twitter,$instagram,$order,$status)
{
$data=array("name" => $name,"image" => $image,"link" => $link,"banner" => $banner,"hashtag" => $hashtag,"facebook" => $facebook,"twitter" => $twitter,"instagram" => $instagram,"order" => $order,"status" => $status);
$query=$this->db->insert( "gse_talent", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("gse_talent")->row();
return $query;
}
function getsingletalent($id){
$this->db->where("id",$id);
$query=$this->db->get("gse_talent")->row();
return $query;
}
public function edit($id,$name,$image,$link,$banner,$hashtag,$facebook,$twitter,$instagram,$order,$status)
{
if($image=="")
{
$image=$this->talent_model->getimagebyid($id);
$image=$image->image;
}
if($banner=="")
{
$banner=$this->talent_model->getbannerbyid($id);
$banner=$banner->banner;
}
$data=array("name" => $name,"image" => $image,"link" => $link,"banner" => $banner,"hashtag" => $hashtag,"facebook" => $facebook,"twitter" => $twitter,"instagram" => $instagram,"order" => $order,"status" => $status);
$this->db->where( "id", $id );
$query=$this->db->update( "gse_talent", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `gse_talent` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `gse_talent` WHERE `id`='$id'")->row();
return $query;
}
public function getbannerbyid($id)
{
$query=$this->db->query("SELECT `banner` FROM `gse_talent` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `gse_talent` ORDER BY `id`
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
