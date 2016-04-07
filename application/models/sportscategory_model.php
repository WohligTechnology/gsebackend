<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class sportscategory_model extends CI_Model
{
public function create($order,$status,$name,$image,$link,$banner,$content)
{
$data=array("order" => $order,"status" => $status,"name" => $name,"image" => $image,"link" => $link,"banner" => $banner,"content" => $content);
$query=$this->db->insert( "gse_sportscategory", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("gse_sportscategory")->row();
return $query;
}
function getsinglesportscategory($id){
$this->db->where("id",$id);
$query=$this->db->get("gse_sportscategory")->row();
return $query;
}
public function edit($id,$order,$status,$name,$image,$link,$banner,$content)
{
if($image=="")
{
$image=$this->sportscategory_model->getimagebyid($id);
$image=$image->image;
}
     if($banner=="")
{
$banner=$this->weddingtype_model->getbannerbyid($id);
$banner=$banner->banner;
}
$data=array("order" => $order,"status" => $status,"name" => $name,"image" => $image,"link" => $link,"banner" => $banner,"content" => $content);
$this->db->where( "id", $id );
$query=$this->db->update( "gse_sportscategory", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `gse_sportscategory` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `gse_sportscategory` WHERE `id`='$id'")->row();
return $query;
}
     public function getbannerbyid($id)
{
$query=$this->db->query("SELECT `banner` FROM `gse_weddingtype` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `gse_sportscategory` ORDER BY `id` 
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
