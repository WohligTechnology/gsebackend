<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class restapi_model extends CI_Model
{
    public function getInTouch($firstname, $lastname, $email, $phone,$location,$enquiry,$noofpeople,$comment,$category)
    {
      // check if mail exist already
      $checkemail=$this->db->query("SELECT * FROM `gse_getintouch` WHERE `email`='$email'");
      if($checkemail->num_rows() > 0)
      {
           $obj->value = false;
           $obj->data = "User already exists";
           return $obj;
      }
      else
      {
          $data=array("category" => $category,"firstname" => $firstname,"lastname" => $lastname,"email" => $email,"phone" => $phone,"comment" => $comment,"enquiryfor" => $enquiry,"location" => $location,"noofpeople" => $noofpeople);
          $query=$this->db->insert( "gse_getintouch", $data );
          $id=$this->db->insert_id();
          $obj = new stdClass();
         if(!$query)
         {  $obj->value = false;
            $obj->data = "User already exists";
            return $obj;
         }
         else
         {
           $obj->value = true;
           $obj->data = "Successfully registered";
           return $obj;
         }
      }
    }


    public function getMovieDetails()
    {
          $query['description'] = $this->db->query("SELECT `id`, `order`, `status`, `name`, `content` FROM `gse_category` WHERE `status`=1")->row();
          $query['isreleased'] = $this->db->query("SELECT `id`, `name`, `banner`, `releasedate`, `image` FROM `gse_moviedetail` WHERE `isreleased`=1")->result();
          $query['isupcoming'] = $this->db->query("SELECT `id`, `name`, `banner`, `releasedate`, `image` FROM `gse_moviedetail` WHERE `isupcoming`=1")->result();
          $query['moviediaries'] = $this->db->query("SELECT `gse_diaryarticle`.`id`, `gse_diaryarticle`.`status`, `gse_diaryarticle`.`diarycategory`, `gse_diaryarticle`.`diarysubcategory`, `gse_diaryarticle`.`name`, `gse_diaryarticle`.`image`, `gse_diaryarticle`.`timestamp`, `gse_diaryarticle`.`content`, `gse_diaryarticle`.`date`, `gse_diaryarticle`.`type`, `gse_diaryarticle`.`showhide` FROM `gse_diaryarticle`
          LEFT OUTER JOIN `gse_diarycategory` ON `gse_diarycategory`.`id`=`gse_diaryarticle`.`diarycategory`
          WHERE `gse_diarycategory`.`name` LIKE '%movie%' OR `gse_diarycategory`.`name` LIKE '%movies%' ORDER BY `date` DESC LIMIT 3 ")->result();
          $query['testimonial'] = $this->db->query("SELECT * FROM `gse_testimonial` WHERE `category`=1")->result();

          if (!query)
          {
          $obj->value = false;
          $obj->data = "No data found";
          return $obj;
          }
          else
          {
          $obj->value = true;
          $obj->data = $query;
          return $obj;
          }

    }

    public function getWeddingDetails()
    {
          $query['description'] = $this->db->query("SELECT `id`, `order`, `status`, `name`, `content` FROM `gse_category` WHERE `status`=1 AND `id`=2")->row();

          $query['weddingtype'] = $this->db->query("SELECT * FROM `gse_wedding`")->result();

          $query['services'] = $this->db->query("SELECT `id`, `name`, `content`, `type`, `order` FROM `gse_service` WHERE `type`=1 ORDER BY `order`")->result();

          $query['weddingdiaries'] = $this->db->query("SELECT `gse_diaryarticle`.`id`, `gse_diaryarticle`.`status`, `gse_diaryarticle`.`diarycategory`, `gse_diaryarticle`.`diarysubcategory`, `gse_diaryarticle`.`name`, `gse_diaryarticle`.`image`, `gse_diaryarticle`.`timestamp`, `gse_diaryarticle`.`content`, `gse_diaryarticle`.`date`, `gse_diaryarticle`.`type`, `gse_diaryarticle`.`showhide` FROM `gse_diaryarticle`
          LEFT OUTER JOIN `gse_diarycategory` ON `gse_diarycategory`.`id`=`gse_diaryarticle`.`diarycategory`
          WHERE `gse_diarycategory`.`name` LIKE '%movie%' OR `gse_diarycategory`.`name` LIKE '%movies%' ORDER BY `date` DESC LIMIT 3 ")->result();

          $query['testimonial'] = $this->db->query("SELECT * FROM `gse_testimonial` WHERE `category`=2")->result();

          if (!query)
          {
          $obj->value = false;
          $obj->data = "No data found";
          return $obj;
          }
          else
          {
          $obj->value = true;
          $obj->data = $query;
          return $obj;
          }

    }

}
?>
