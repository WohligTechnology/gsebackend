<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class mice_model extends CI_Model
{
public function create($name,$image,$banner,$link,$order,$hashtag,$facebook,$twitter,$instagram,$status)
{
$data=array("name" => $name,"image" => $image,"banner" => $banner,"link" => $link,"order" => $order,"hashtag" => $hashtag,"facebook" => $facebook,"twitter" => $twitter,"instagram" => $instagram,"status" => $status);
$query=$this->db->insert( "gse_mice", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function getbannerbyid($id)
{
$query=$this->db->query("SELECT `banner` FROM `gse_mice` WHERE `id`='$id'")->row();
return $query;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("gse_mice")->row();
return $query;
}
function getsinglewedding($id){
$this->db->where("id",$id);
$query=$this->db->get("gse_mice")->row();
return $query;
}
public function edit($id,$name,$image,$banner,$link,$order,$hashtag,$facebook,$twitter,$instagram,$status)
{
if($image=="")
{
$image=$this->mice_model->getimagebyid($id);
$image=$image->image;
}
      if($banner=="")
{
$banner=$this->mice_model->getbannerbyid($id);
$banner=$banner->banner;
}
$data=array("name" => $name,"image" => $image,"banner" => $banner,"link" => $link,"order" => $order,"hashtag" => $hashtag,"facebook" => $facebook,"twitter" => $twitter,"instagram" => $instagram,"status" => $status);
$this->db->where( "id", $id );
$query=$this->db->update( "gse_mice", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `gse_mice` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `gse_mice` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `gse_mice` ORDER BY `id` ASC")->result();
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
