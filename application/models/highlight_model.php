<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class highlight_model extends CI_Model
{
public function create($sportscategory,$name,$image,$link,$location,$content,$videos,$date)
{
$data=array("sportscategory" => $sportscategory,"name" => $name,"image" => $image,"link" => $link,"location" => $location,"content" => $content,"videos" => $videos,"date" => $date);
$query=$this->db->insert( "gse_highlight", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("gse_highlight")->row();
return $query;
}
function getsinglehighlight($id){
$this->db->where("id",$id);
$query=$this->db->get("gse_highlight")->row();
return $query;
}
public function edit($id,$sportscategory,$name,$image,$link,$location,$content,$videos,$date)
{
if($image=="")
{
$image=$this->highlight_model->getimagebyid($id);
$image=$image->image;
}
$data=array("sportscategory" => $sportscategory,"name" => $name,"image" => $image,"link" => $link,"location" => $location,"content" => $content,"videos" => $videos,"date" => $date);
$this->db->where( "id", $id );
$query=$this->db->update( "gse_highlight", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `gse_highlight` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `gse_highlight` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `gse_highlight` ORDER BY `id` 
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
