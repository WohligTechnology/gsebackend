<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class blogvideo_model extends CI_Model
{
public function create($diaryarticle,$url,$order)
{
$data=array("diaryarticle" => $diaryarticle,"url" => $url,"order" => $order);
$query=$this->db->insert( "gse_blogvideo", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("gse_blogvideo")->row();
return $query;
}
function getsingleblogvideo($id){
$this->db->where("id",$id);
$query=$this->db->get("gse_blogvideo")->row();
return $query;
}
public function edit($id,$diaryarticle,$url,$order)
{

$data=array("diaryarticle" => $diaryarticle,"url" => $url,"order" => $order);
$this->db->where( "id", $id );
$query=$this->db->update( "gse_blogvideo", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `gse_blogvideo` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `gse_blogvideo` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `gse_blogvideo` ORDER BY `id` 
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
