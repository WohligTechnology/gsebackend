<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class author_model extends CI_Model
{
public function create($google,$twitter,$facebook,$name,$image,$description,$order,$status,$type,$date,$banner)
{
  $date = explode(" ",$date);
    $nmonth = date('m',strtotime($date[1]));
    $date=$date[2]."-".$nmonth."-".$date[0];
$data=array("google" => $google,"twitter" => $twitter,"facebook" => $facebook,"name" => $name,"image" => $image,"description" => $description,"order" => $order,"status" => $status,"type" => $type,"date" => $date,"banner" => $banner);
$query=$this->db->insert( "author", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("author")->row();
return $query;
}
function getsingleauthor($id){
$this->db->where("id",$id);
$query=$this->db->get("author")->row();
return $query;
}
public function edit($id,$google,$twitter,$facebook,$name,$image,$description,$order,$status,$type,$date,$banner)
{
  if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date))
    {
      echo "done";
        // return true;
    }else{
      $date = explode(" ",$date);
      $nmonth = date('m',strtotime($date[1]));
      $date=$date[2]."-".$nmonth."-".$date[0];
        // return false;
    }
  if($image=="")
  {
  $image=$this->author_model->getimagebyid($id);
  $image=$image->image;
  }
  if($banner=="")
  {
  $banner=$this->author_model->getbanner($id);
  $banner=$banner->banner;
  }
$data=array("google" => $google,"twitter" => $twitter,"facebook" => $facebook,"name" => $name,"image" => $image,"description" => $description,"order" => $order,"status" => $status,"type" => $type,"date" => $date,"banner" => $banner);
$this->db->where( "id", $id );
$query=$this->db->update( "author", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `author` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `author` WHERE `id`='$id'")->row();
return $query;
}
public function getbanner($id)
{
$query=$this->db->query("SELECT `banner` FROM `author` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `author` ORDER BY `id` ASC")->result();
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
