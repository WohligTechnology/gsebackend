<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class talenttype_model extends CI_Model
{
public function create($talent,$order,$status,$name,$image,$url,$banner,$content,$videos)
{
$data=array("talent" => $talent,"order" => $order,"status" => $status,"name" => $name,"image" => $image,"url" => $url,"banner" => $banner,"content" => $content,"videos" => $videos);
$query=$this->db->insert( "gse_talenttype", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("gse_talenttype")->row();
return $query;
}
function getsingletalenttype($id){
$this->db->where("id",$id);
$query=$this->db->get("gse_talenttype")->row();
return $query;
}
public function edit($id,$talent,$order,$status,$name,$image,$url,$banner,$content,$videos)
{
if($image=="")
{
$image=$this->talenttype_model->getimagebyid($id);
$image=$image->image;
}
    if($banner=="")
{
$banner=$this->talenttype_model->getbannerbyid($id);
$banner=$banner->banner;
}
$data=array("talent" => $talent,"order" => $order,"status" => $status,"name" => $name,"image" => $image,"url" => $url,"banner" => $banner,"content" => $content,"videos" => $videos);
$this->db->where( "id", $id );
$query=$this->db->update( "gse_talenttype", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `gse_talenttype` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `banner` FROM `gse_talenttype` WHERE `id`='$id'")->row();
return $query;
}
    public function getbannerbyid($id)
{
$query=$this->db->query("SELECT `banner` FROM `gse_talenttype` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `gse_talenttype` ORDER BY `id` 
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
