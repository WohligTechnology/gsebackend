<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class moviewallpaper_model extends CI_Model
{
public function create($movie,$image)
{
$data=array("movie" => $movie,"image" => $image);
$query=$this->db->insert( "gse_moviewallpaper", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("gse_moviewallpaper")->row();
return $query;
}
function getsinglemoviewallpaper($id){
$this->db->where("id",$id);
$query=$this->db->get("gse_moviewallpaper")->row();
return $query;
}
public function edit($id,$movie,$image)
{
if($image=="")
{
$image=$this->moviewallpaper_model->getimagebyid($id);
$image=$image->image;
}
$data=array("movie" => $movie,"image" => $image);
$this->db->where( "id", $id );
$query=$this->db->update( "gse_moviewallpaper", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `gse_moviewallpaper` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `gse_moviewallpaper` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `gse_moviewallpaper` ORDER BY `id` 
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
