<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class subscribe_model extends CI_Model
{
public function create($email,$timestamp)
{
$data=array("email" => $email);
$query=$this->db->insert( "gse_subscribe", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("gse_subscribe")->row();
return $query;
}
function getsinglesubscribe($id){
$this->db->where("id",$id);
$query=$this->db->get("gse_subscribe")->row();
return $query;
}
public function edit($id,$email,$timestamp)
{

$data=array("email" => $email,"timestamp" => $timestamp);
$this->db->where( "id", $id );
$query=$this->db->update( "gse_subscribe", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `gse_subscribe` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `gse_subscribe` WHERE `id`='$id'")->row();
return $query;
}
public function exportSubscribeCsv()
{
	$this->load->dbutil();
		$query=$this->db->query("SELECT  `id` ,  `email` ,  `timestamp` 
FROM  `gse_subscribe` 
WHERE 1 ");
        $content= $this->dbutil->csv_from_result($query);
        //$data = 'Some file data';
        $timestamp=new DateTime();
        $timestamp=$timestamp->format('Y-m-d_H.i.s');
//        file_put_contents("gs://magicmirroruploads/products_$timestamp.csv", $content);
//		redirect("http://magicmirror.in/servepublic?name=products_$timestamp.csv", 'refresh');
        if ( ! write_file("./uploads/subscribe_$timestamp.csv", $content))
        {
             echo 'Unable to write the file';
        }
        else
        {
            redirect(base_url("uploads/subscribe_$timestamp.csv"), 'refresh');
             echo 'File written!';
        }
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `gse_subscribe` ORDER BY `id` 
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
