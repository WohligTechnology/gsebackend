<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class service_model extends CI_Model
{
public function create($name,$content,$type,$order)
{
$data=array("name" => $name,"content" => $content,"type" => $type,"order" => $order);
$query=$this->db->insert( "gse_service", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("gse_service")->row();
return $query;
}
function getsingleservice($id){
$this->db->where("id",$id);
$query=$this->db->get("gse_service")->row();
return $query;
}
public function edit($id,$name,$content,$type,$order)
{

$data=array("name" => $name,"content" => $content,"type" => $type,"order" => $order);
$this->db->where( "id", $id );
$query=$this->db->update( "gse_service", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `gse_service` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `gse_service` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `gse_service` ORDER BY `id` 
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
    
            public function getservicetypedropdown()
        {
  
        $return=array(
        "" => "Select type",
        "1" => "Wedding",
        "2" => "Sports",
        );
     
        return $return;
        }
}
?>
