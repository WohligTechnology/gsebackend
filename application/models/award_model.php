<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class award_model extends CI_Model
{
public function create($movie,$name)
{
$data=array("movie" => $movie,"name" => $name);
$query=$this->db->insert( "gse_award", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("gse_award")->row();
return $query;
}
function getsingleaward($id){
$this->db->where("id",$id);
$query=$this->db->get("gse_award")->row();
return $query;
}
public function edit($id,$movie,$name)
{

$data=array("movie" => $movie,"name" => $name);
$this->db->where( "id", $id );
$query=$this->db->update( "gse_award", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `gse_award` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `gse_award` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `gse_award` ORDER BY `id` 
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
