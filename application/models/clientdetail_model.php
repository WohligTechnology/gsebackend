<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class clientdetail_model extends CI_Model
{
public function create($order,$status,$name,$image,$title,$url,$content,$banner)
{
$data=array("order" => $order,"status" => $status,"name" => $name,"image" => $image,"title" => $title,"url" => $url,"content" => $content,"banner" => $banner);
$query=$this->db->insert( "gse_clientdetail", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("gse_clientdetail")->row();
return $query;
}
function getsingleclientdetail($id){
$this->db->where("id",$id);
$query=$this->db->get("gse_clientdetail")->row();
return $query;
}
public function edit($id,$order,$status,$name,$image,$title,$url,$content,$banner)
{
if($image=="")
{
$image=$this->clientdetail_model->getimagebyid($id);
$image=$image->image;
}
$data=array("order" => $order,"status" => $status,"name" => $name,"image" => $image,"title" => $title,"url" => $url,"content" => $content,"banner" => $banner);
$this->db->where( "id", $id );
$query=$this->db->update( "gse_clientdetail", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `gse_clientdetail` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `gse_clientdetail` WHERE `id`='$id'")->row();
return $query;
}public function getbannerbyid($id)
{
$query=$this->db->query("SELECT `banner` FROM `gse_clientdetail` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `gse_clientdetail` ORDER BY `id` 
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
