<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class testimonial_model extends CI_Model
{
public function create($category,$status,$order,$name,$author,$image,$quote)
{
$data=array("category" => $category,"status" => $status,"order" => $order,"name" => $name,"author" => $author,"image" => $image,"quote" => $quote);
$query=$this->db->insert( "gse_testimonial", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("gse_testimonial")->row();
return $query;
}
function getsingletestimonial($id){
$this->db->where("id",$id);
$query=$this->db->get("gse_testimonial")->row();
return $query;
}
public function edit($id,$category,$status,$order,$name,$author,$image,$quote)
{
if($image=="")
{
$image=$this->testimonial_model->getimagebyid($id);
$image=$image->image;
}
$data=array("category" => $category,"status" => $status,"order" => $order,"name" => $name,"author" => $author,"image" => $image,"quote" => $quote);
$this->db->where( "id", $id );
$query=$this->db->update( "gse_testimonial", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `gse_testimonial` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `gse_testimonial` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `gse_testimonial` ORDER BY `id` 
                    ASC")->row();
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
