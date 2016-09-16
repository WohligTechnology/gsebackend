<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class upcoming_model extends CI_Model
{
public function create($team1,$logo1,$team2,$logo2,$location,$date,$time,$link,$team1score,$team2score,$banner)
{
  $date = explode(" ",$date);
  $nmonth = date('m',strtotime($date[1]));
  $date=$date[2]."-".$nmonth."-".$date[0];
$data=array("team1" => $team1,"logo1" => $logo1,"team2" => $team2,"logo2" => $logo2,"location" => $location,"date" => $date,"time" => $time,"link" => $link,"team1score" => $team1score,"team2score" => $team2score,"banner" => $banner);
$query=$this->db->insert( "upcoming", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("upcoming")->row();
return $query;
}
function getsinglematch($id){
$this->db->where("id",$id);
$query=$this->db->get("upcoming")->row();
return $query;
}
public function edit($id,$team1,$logo1,$team2,$logo2,$location,$date,$time,$link,$team1score,$team2score,$banner)
{
if($logo1=="")
{
$logo1=$this->match_model->getlogo1byid($id);
$logo1=$logo1->logo1;
}
if($logo2=="")
{
$logo2=$this->match_model->getlogo2byid($id);
$logo2=$logo2->logo2;
}
if($banner=="")
{
$banner=$this->match_model->getbannerbyid($id);
$banner=$banner->banner;
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
$data=array("team1" => $team1,"logo1" => $logo1,"team2" => $team2,"logo2" => $logo2,"location" => $location,"date" => $date,"time" => $time,"link" => $link,"team1score" => $team1score,"team2score" => $team2score,"banner" => $banner);
$this->db->where( "id", $id );
$query=$this->db->update( "upcoming", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `upcoming` WHERE `id`='$id'");
return $query;
}
public function getlogo1byid($id)
{
$query=$this->db->query("SELECT `logo1` FROM `upcoming` WHERE `id`='$id'")->row();
return $query;
}
public function getlogo2byid($id)
{
$query=$this->db->query("SELECT `logo2` FROM `upcoming` WHERE `id`='$id'")->row();
return $query;
}
public function getbannerbyid($id)
{
$query=$this->db->query("SELECT `banner` FROM `upcoming` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `upcoming` ORDER BY `id`
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
