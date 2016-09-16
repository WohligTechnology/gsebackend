<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class diaryarticle_model extends CI_Model
{
public function create($status,$diarycategory,$diarysubcategory,$name,$image,$timestamp,$content,$date,$type,$author,$order)
{
    //  $date = new DateTime($date);
    // $date = $date->format('Y-m-d');
    $date = explode(" ",$date);
    $nmonth = date('m',strtotime($date[1]));
    $date=$date[2]."-".$nmonth."-".$date[0];
$data=array("status" => $status,"diarycategory" => $diarycategory,"diarysubcategory" => $diarysubcategory,"name" => $name,"image" => $image,"timestamp" => $timestamp,"content" => $content,"date" => $date,"type" => $type,"author" => $author,"order" => $order);
$query=$this->db->insert( "gse_diaryarticle", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("gse_diaryarticle")->row();
return $query;
}
function getsinglediaryarticle($id){
$this->db->where("id",$id);
$query=$this->db->get("gse_diaryarticle")->row();
return $query;
}
public function edit($id,$status,$diarycategory,$diarysubcategory,$name,$image,$timestamp,$content,$date,$type,$author,$order)
{
if($image=="")
{
$image=$this->diaryarticle_model->getimagebyid($id);
$image=$image->image;
}
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
$data=array("status" => $status,"diarycategory" => $diarycategory,"diarysubcategory" => $diarysubcategory,"name" => $name,"image" => $image,"timestamp" => $timestamp,"content" => $content,"date" => $date,"type" => $type,"author" => $author,"order" => $order);
$this->db->where( "id", $id );
$query=$this->db->update( "gse_diaryarticle", $data );
return $id;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `gse_diaryarticle` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `gse_diaryarticle` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `gse_diaryarticle` ORDER BY `id` ASC")->result();
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
