<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class wedding_model extends CI_Model
{
public function create($name,$image,$banner,$content,$order,$status)
{
$data=array("name" => $name,"image" => $image,"banner" => $banner,"content" => $content,"order" => $order,"status" => $status);
$query=$this->db->insert( "gse_wedding", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
    public function getbannerbyid($id)
{
$query=$this->db->query("SELECT `banner` FROM `gse_wedding` WHERE `id`='$id'")->row();
return $query;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("gse_wedding")->row();
return $query;
}
function getsinglewedding($id){
$this->db->where("id",$id);
$query=$this->db->get("gse_wedding")->row();
return $query;
}
public function edit($id,$name,$image,$banner,$content,$order,$status)
{
if($image=="")
{
$image=$this->wedding_model->getimagebyid($id);
$image=$image->image;
}
      if($banner=="")
{
$banner=$this->wedding_model->getbannerbyid($id);
$banner=$banner->banner;
}
$data=array("name" => $name,"image" => $image,"banner" => $banner,"content" => $content,"order" => $order,"status" => $status);
$this->db->where( "id", $id );
$query=$this->db->update( "gse_wedding", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `gse_wedding` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `gse_wedding` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `gse_wedding` ORDER BY `id` ASC")->result();
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
