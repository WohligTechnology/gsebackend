<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class movie_model extends CI_Model
{
public function create($url,$talent)
{
$data=array("url" => $url, "talent" => $talent);
$query=$this->db->insert( "talentvideo", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("talentvideo")->row();
return $query;
}
function getsinglemovie($id){
$this->db->where("id",$id);
$query=$this->db->get("talentvideo")->row();
return $query;
}
public function edit($id,$url,$movie)
{
$data=array("url" => $url, "movie" => $movie);
$this->db->where( "id", $id );
$query=$this->db->update( "talentvideo", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `talentvideo` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `talentvideo` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `talentvideo` ORDER BY `id` 
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
