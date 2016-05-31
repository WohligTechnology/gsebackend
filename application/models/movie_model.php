<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class movie_model extends CI_Model
{
public function create($content,$movie)
{
$data=array("content" => $content, "movie" => $movie);
$query=$this->db->insert( "gse_movie", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("gse_movie")->row();
return $query;
}
function getsinglemovie($id){
$this->db->where("id",$id);
$query=$this->db->get("gse_movie")->row();
return $query;
}
public function edit($id,$content,$movie)
{
$data=array("content" => $content, "movie" => $movie);
$this->db->where( "id", $id );
$query=$this->db->update( "gse_movie", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `gse_movie` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `gse_movie` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `gse_movie` ORDER BY `id` 
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
