<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class highlight_model extends CI_Model
{
public function create($sportscategory,$name,$image,$link,$location,$content,$videos,$date,$banner,$order,$status)
{
        $date = new DateTime($date);
        $date = $date->format('Y-m-d');
$data=array("sportscategory" => $sportscategory,"name" => $name,"image" => $image,"link" => $link,"location" => $location,"content" => $content,"videos" => $videos,"date" => $date,"banner" => $banner,"order" => $order,"status" => $status);
$query=$this->db->insert( "gse_highlight", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("gse_highlight")->row();
return $query;
}
function getsinglehighlight($id){
$this->db->where("id",$id);
$query=$this->db->get("gse_highlight")->row();
return $query;
}
public function edit($id,$sportscategory,$name,$image,$link,$location,$content,$videos,$date,$banner,$order,$status)
{
            $date = new DateTime($date);
        $date = $date->format('Y-m-d');
if($image=="")
{
$image=$this->highlight_model->getimagebyid($id);
$image=$image->image;
}
if($banner=="")
{
$banner=$this->highlight_model->getbannerbyid($id);
$banner=$banner->banner;
}
$data=array("sportscategory" => $sportscategory,"name" => $name,"image" => $image,"link" => $link,"location" => $location,"content" => $content,"videos" => $videos,"date" => $date,"banner" => $banner,"order" => $order,"status" => $status);
$this->db->where( "id", $id );
$query=$this->db->update( "gse_highlight", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `gse_highlight` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `gse_highlight` WHERE `id`='$id'")->row();
return $query;
}
public function getbannerbyid($id)
{
$query=$this->db->query("SELECT `banner` FROM `gse_highlight` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `gse_highlight` ORDER BY `id` ASC")->result();
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
