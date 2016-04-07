<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class awarddetail_model extends CI_Model
{
public function create($award,$awardname,$awardreceiver,$winnername)
{
$data=array("award" => $award,"awardname" => $awardname,"awardreceiver" => $awardreceiver,"winnername" => $winnername);
$query=$this->db->insert( "gse_awarddetail", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("gse_awarddetail")->row();
return $query;
}
function getsingleawarddetail($id){
$this->db->where("id",$id);
$query=$this->db->get("gse_awarddetail")->row();
return $query;
}
public function edit($id,$award,$awardname,$awardreceiver,$winnername)
{
if($image=="")
{
$image=$this->awarddetail_model->getimagebyid($id);
$image=$image->image;
}
$data=array("award" => $award,"awardname" => $awardname,"awardreceiver" => $awardreceiver,"winnername" => $winnername);
$this->db->where( "id", $id );
$query=$this->db->update( "gse_awarddetail", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `gse_awarddetail` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `gse_awarddetail` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `gse_awarddetail` ORDER BY `id` 
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
