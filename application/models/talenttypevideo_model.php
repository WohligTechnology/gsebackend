<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class talenttypevideo_model extends CI_Model
{
public function create($talenttype,$url,$order)
{
$data=array("talenttype" => $talenttype,"url" => $url,"order" => $order);
$query=$this->db->insert( "gse_talenttypevideo", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("gse_talenttypevideo")->row();
return $query;
}
function getsingletalenttypevideo($id){
$this->db->where("id",$id);
$query=$this->db->get("gse_talenttypevideo")->row();
return $query;
}
public function edit($id,$talenttype,$url,$order)
{

$data=array("talenttype" => $talenttype,"url" => $url,"order" => $order);
$this->db->where( "id", $id );
$query=$this->db->update( "gse_talenttypevideo", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `gse_talenttypevideo` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `gse_talenttypevideo` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `gse_talenttypevideo` ORDER BY `id` 
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
