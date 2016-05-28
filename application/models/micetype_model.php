<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class micetype_model extends CI_Model
{
public function create($mice,$url,$order,$micesubtype)
{
$data=array("mice" => $mice,"order" => $order,"url" => $url,"micesubtype" => $micesubtype);
$query=$this->db->insert( "gse_micevideos", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("gse_micevideos")->row();
return $query;
}
function getsinglemicevideos($id){
$this->db->where("id",$id);
$query=$this->db->get("gse_micevideos")->row();
return $query;
}
public function edit($id,$mice,$url,$order,$micesubtype)
{
// if($image=="")
// {
// $image=$this->micetype_model->getimagebyid($id);
// $image=$image->image;
// }
$data=array("mice" => $mice,"order" => $order,"url" => $url,"micesubtype" => $micesubtype);
$this->db->where( "id", $id );
$query=$this->db->update( "gse_micevideos", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `gse_micevideos` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `gse_micevideos` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `gse_micevideos` ORDER BY `id`
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
