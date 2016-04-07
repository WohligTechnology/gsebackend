<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class weddingtype_model extends CI_Model
{
public function create($wedding,$name,$image,$banner)
{
$data=array("wedding" => $wedding,"name" => $name,"image" => $image,"banner" => $banner);
$query=$this->db->insert( "gse_weddingtype", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("gse_weddingtype")->row();
return $query;
}
function getsingleweddingtype($id){
$this->db->where("id",$id);
$query=$this->db->get("gse_weddingtype")->row();
return $query;
}
public function edit($id,$wedding,$name,$image,$banner)
{
if($image=="")
{
$image=$this->weddingtype_model->getimagebyid($id);
$image=$image->image;
}
    if($banner=="")
{
$banner=$this->weddingtype_model->getbannerbyid($id);
$banner=$banner->banner;
}
$data=array("wedding" => $wedding,"name" => $name,"image" => $image,"banner" => $banner);
$this->db->where( "id", $id );
$query=$this->db->update( "gse_weddingtype", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `gse_weddingtype` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `gse_weddingtype` WHERE `id`='$id'")->row();
return $query;
}
    public function getbannerbyid($id)
{
$query=$this->db->query("SELECT `banner` FROM `gse_weddingtype` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `gse_weddingtype` ORDER BY `id` 
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
