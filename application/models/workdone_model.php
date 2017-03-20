<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class workdone_model extends CI_Model
{
    public function create($title,$date,$city,$description,$image,$url,$talenttype)
    {
        $data=array("title" => $title,"date" => $date,"city" => $city,"description" => $description,"image" => $image,"url" => $url,"talenttype" => $talenttype);
        $query=$this->db->insert( "gse_workdone", $data );
        $id=$this->db->insert_id();
        if(!$query)
        return  0;
        else
        return  $id;
    }
    public function beforeedit($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("gse_workdone")->row();
        return $query;
    }
    function getsingleworkdone($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("gse_workdone")->row();
        return $query;
    }
    public function edit($id,$title,$date,$city,$description,$image,$url,$talenttype)
    {
        if($image=="")
        {
            $image=$this->clientlogo_model->getimagebyid($id);
            $image=$image->image;
        }
        $data=array("title" => $title,"date" => $date,"city" => $city,"description" => $description,"image" => $image,"url" => $url,"talenttype" => $talenttype);
        $this->db->where( "id", $id );
        $query=$this->db->update( "gse_workdone", $data );
        return 1;
    }
    public function delete($id)
    {
        $query=$this->db->query("DELETE FROM `gse_workdone` WHERE `id`='$id'");
        return $query;
    }
    public function getimagebyid($id)
    {
        $query=$this->db->query("SELECT `image` FROM `gse_workdone` WHERE `id`='$id'")->row();
        return $query;
    }
    public function getdropdown()
    {
        $query=$this->db->query("SELECT * FROM `gse_workdone` ORDER BY `id` ASC")->result();
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
