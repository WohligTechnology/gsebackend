<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class diaryarticle_model extends CI_Model
{
public function create($status,$diarycategory,$diarysubcategory,$name,$image,$timestamp,$content,$date)
{
     $date = new DateTime($date);
    $date = $date->format('Y-m-d');
$data=array("status" => $status,"diarycategory" => $diarycategory,"diarysubcategory" => $diarysubcategory,"name" => $name,"image" => $image,"timestamp" => $timestamp,"content" => $content,"date" => $date);
$query=$this->db->insert( "gse_diaryarticle", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("gse_diaryarticle")->row();
return $query;
}
function getsinglediaryarticle($id){
$this->db->where("id",$id);
$query=$this->db->get("gse_diaryarticle")->row();
return $query;
}
public function edit($id,$status,$diarycategory,$diarysubcategory,$name,$image,$timestamp,$content,$date)
{
if($image=="")
{
$image=$this->diaryarticle_model->getimagebyid($id);
$image=$image->image;
}
    $date = new DateTime($date);
    $date = $date->format('Y-m-d');
$data=array("status" => $status,"diarycategory" => $diarycategory,"diarysubcategory" => $diarysubcategory,"name" => $name,"image" => $image,"timestamp" => $timestamp,"content" => $content,"date" => $date);
$this->db->where( "id", $id );
$query=$this->db->update( "gse_diaryarticle", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `gse_diaryarticle` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `gse_diaryarticle` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `gse_diaryarticle` ORDER BY `id` 
                    ASC")->row();
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
