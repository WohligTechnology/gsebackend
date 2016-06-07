<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class category_model extends CI_Model
{
public function create($order,$status,$name,$content)
{
$data=array("order" => $order,"status" => $status,"name" => $name,"content" => $content);
$query=$this->db->insert( "gse_category", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("gse_category")->row();
return $query;
}
function getsinglecategory($id){
$this->db->where("id",$id);
$query=$this->db->get("gse_category")->row();
return $query;
}
public function edit($id,$order,$status,$name,$content)
{
$data=array("order" => $order,"status" => $status,"name" => $name,"content" => $content);
$this->db->where( "id", $id );
$query=$this->db->update( "gse_category", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `gse_category` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `gse_category` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `gse_category` ORDER BY `id` ASC")->result();
$return=array(
"" => "Select Option"
);
foreach($query as $row)
{
$return[$row->id]=$row->name;
}
return $return;
}
public function gettestimonialdropdown()
{
$query=$this->db->query("SELECT * FROM `gse_category` ORDER BY `id` ASC")->result();
$return=array(
"" => "Select Option",
"15" => "JPP",
"16" => "ASFC",
"17" => "PFH"
);
foreach($query as $row)
{
$return[$row->id]=$row->name;
}
return $return;
}
}
?>
