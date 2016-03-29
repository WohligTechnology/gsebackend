<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class diarysubcategory_model extends CI_Model
{
public function create($order,$status,$diarycategory,$name)
{
$data=array("order" => $order,"status" => $status,"diarycategory" => $diarycategory,"name" => $name);
$query=$this->db->insert( "gse_diarysubcategory", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("gse_diarysubcategory")->row();
return $query;
}
function getsinglediarysubcategory($id){
$this->db->where("id",$id);
$query=$this->db->get("gse_diarysubcategory")->row();
return $query;
}
public function edit($id,$order,$status,$diarycategory,$name)
{
$data=array("order" => $order,"status" => $status,"diarycategory" => $diarycategory,"name" => $name);
$this->db->where( "id", $id );
$query=$this->db->update( "gse_diarysubcategory", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `gse_diarysubcategory` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `gse_diarysubcategory` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `gse_diarysubcategory` ORDER BY `id` ASC")->result();
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
