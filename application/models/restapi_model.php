<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class restapi_model extends CI_Model
{
    public function getInTouch($firstname, $lastname, $email, $phone,$location,$enquiry,$noofpeople,$comment,$category,$startdate,$enddate)
    {
      // check if mail exist already
      $checkemail=$this->db->query("SELECT * FROM `gse_getintouch` WHERE `email`='$email'");
        $obj = new stdClass();
      if($checkemail->num_rows() > 0)
      {
           $obj->value = false;
           $obj->data = "User already exists";
           return $obj;
      }
      else
      {
          $data=array("category" => $category,"firstname" => $firstname,"lastname" => $lastname,"email" => $email,"phone" => $phone,"comment" => $comment,"enquiryfor" => $enquiry,"location" => $location,"startdate" => $startdate,"enddate" => $enddate,"noofpeople" => $noofpeople);
          $query=$this->db->insert( "gse_getintouch", $data );
          $id=$this->db->insert_id();

         if(!$query)
         {  $obj->value = false;
            $obj->data = "User already exists";
            return $obj;
         }
         else
         {
           //send email
           $data['mailer']=$this->db->query("SELECT `gse_getintouch`.`id`, `gse_getintouch`.`category`,`gse_category`.`name` as `categoryname`, `gse_getintouch`.`firstname`, `gse_getintouch`.`lastname`, `gse_getintouch`.`email`, `gse_getintouch`.`phone`, `gse_getintouch`.`timestamp`, `gse_getintouch`.`comment`, `gse_getintouch`.`enquiryfor`, `gse_getintouch`.`location`, `gse_getintouch`.`noofpeople`, `gse_getintouch`.`startdate`, `gse_getintouch`.`enddate` FROM `gse_getintouch` INNER JOIN `gse_category` ON `gse_category`.`id`=`gse_getintouch`.`category` WHERE `gse_getintouch`.`id`='$id'")->row();
           $username=$firstname." ".$lastname;
           $messageplan = $this->load->view('emailers/getInTouch', $data, true);
           $this->email_model->emailer($messageplan,'Get In Touch','jsw@gsentertainment.com',$username);
          //  $this->email_model->emailer($messageplan,'Get In Touch','pooja@wohlig.com',$username);


           $obj->value = true;
           $obj->data = "Successfully registered";
           return $obj;
         }
      }
    }
    public function generalenquirySubmit($firstname,$middlename, $lastname,$companyname, $email, $phone,$webaddress,$message)
    {
          $data=array("firstname" => $firstname,"middlename" => $middlename,"lastname" => $lastname,"companyname" => $companyname,"email" => $email,"phone" => $phone,"webaddress" => $webaddress,"message" => $message);
          $query=$this->db->insert( "gse_generalenquiry", $data );
          $id=$this->db->insert_id();
          $obj = new stdClass();
         if(!$query)
         {  $obj->value = false;
            return $obj;
         }
         else
         {
           $obj->value = true;
           $obj->data = "Successfully sent";
           return $obj;
         }
    }
    public function projectSubmit($name,$company, $webaddress,$country, $phone, $email,$question1ans,$question2ans,$question3ans,$content)
    {
          $data=array("name" => $name,"company" => $company,"webaddress" => $webaddress,"country" => $country,"phone" => $phone,"email" => $email,"question1ans" => $question1ans,"question2ans" => $question2ans,"question3ans" => $question3ans,"content" => $content);
          $query=$this->db->insert( "gse_proposedproject", $data );
          $id=$this->db->insert_id();
          $obj = new stdClass();
         if(!$query)
         {  $obj->value = false;
            return $obj;
         }
         else
         {
           $obj->value = true;
           $obj->data = "Successfully saved";
           return $obj;
         }
    }


    public function getAllCount()
    {
          $movie = $this->db->query("SELECT count(id) AS `movie` FROM `gse_moviedetail` WHERE 1")->row();
          $query['movie'] = $movie->movie;
          $wedding = $this->db->query("SELECT count(id) AS 'wedding' FROM `gse_weddingsubtype` WHERE 1")->row();
          $query['wedding'] = $wedding->wedding;
          // $query['isupcoming'] = $this->db->query("SELECT `id`, `name`, `banner`, `releasedate`, `image` FROM `gse_moviedetail`

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
    public function getMovieDetails()
    {
          $query['description'] = $this->db->query("SELECT `id`, `order`, `status`, `name`, `content`,`hashtag`,`facebook`,`twitter`,`instagram` FROM `gse_category` WHERE `status`=1 AND `id`=1")->row();
          $query['isreleased'] = $this->db->query("SELECT `id`, `name`, `banner`, `releasedate`, `image`,`status` FROM `gse_moviedetail` WHERE `isreleased`=1 ORDER BY `releasedate` DESC ")->result();
          $query['isupcoming'] = $this->db->query("SELECT `id`, `name`, `banner`, `releasedate`, `image`,`status` FROM `gse_moviedetail` WHERE `isupcoming`=1 ORDER BY `releasedate` DESC ")->result();
          $query['moviediaries'] = $this->db->query("SELECT `gse_diaryarticle`.`id`, `gse_diaryarticle`.`status`, `gse_diaryarticle`.`diarycategory`, `gse_diaryarticle`.`diarysubcategory`, `gse_diaryarticle`.`name`, `gse_diaryarticle`.`image`, `gse_diaryarticle`.`timestamp`, `gse_diaryarticle`.`content`, `gse_diaryarticle`.`date`, `gse_diaryarticle`.`type`, `gse_diaryarticle`.`showhide`,`author`.`name` AS 'authorname' FROM `gse_diaryarticle`
          LEFT OUTER JOIN `gse_diarycategory` ON `gse_diarycategory`.`id`=`gse_diaryarticle`.`diarycategory`
          LEFT OUTER JOIN `author` ON `gse_diaryarticle`.`author`=`author`.`id`
          WHERE `gse_diarycategory`.`name` LIKE '%movie%' OR `gse_diarycategory`.`name` LIKE '%movies%' AND `gse_diaryarticle`.`status`=1 ORDER BY `date` DESC LIMIT 3 ")->result();
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
          $query['description'] = $this->db->query("SELECT `id`, `order`, `status`, `name`, `content`,`hashtag`,`facebook`,`twitter`,`instagram` FROM `gse_category` WHERE `id`=2")->row();
          $query['weddingtype'] = $this->db->query("SELECT * FROM `gse_wedding` ORDER BY `order` DESC")->result();
          $query['services'] = $this->db->query("SELECT `id`, `name`, `content`, `type`, `order` FROM `gse_service` WHERE `type`=1 ORDER BY `order`")->result();

          $query['weddingdiaries'] = $this->db->query("SELECT `gse_diaryarticle`.`id`, `gse_diaryarticle`.`status`, `gse_diaryarticle`.`diarycategory`, `gse_diaryarticle`.`diarysubcategory`, `gse_diaryarticle`.`name`, `gse_diaryarticle`.`image`, `gse_diaryarticle`.`timestamp`, `gse_diaryarticle`.`content`, `gse_diaryarticle`.`date`, `gse_diaryarticle`.`type`, `gse_diaryarticle`.`showhide`,`author`.`name` AS 'authorname' FROM `gse_diaryarticle`
          LEFT OUTER JOIN `gse_diarycategory` ON `gse_diarycategory`.`id`=`gse_diaryarticle`.`diarycategory`
          LEFT OUTER JOIN `author` ON `gse_diaryarticle`.`author`=`author`.`id`
          WHERE `gse_diaryarticle`.`name` = 'Weddings' AND `gse_diarycategory`.`name` = 'Weddings' AND `gse_diaryarticle`.`status`=1 ORDER BY `date` DESC LIMIT 3 ")->result();
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

    public function getMovieInside($id){
      $query['moviedetail']=$this->db->query("SELECT `id`, `isupcoming`, `isreleased`, `name`, `banner`, `imdb`, `producer`, `director`, `cast`, `music`, `synopsis`, `videos`, `releasedate`, `image`,`hashtag`,`facebook`,`twitter`,`instagram`,`status` FROM `gse_moviedetail` WHERE `id`='$id' AND `status`=1")->row();
      $query['wallpaper']=$this->db->query("SELECT `id`, `movie`, `image` FROM `gse_moviewallpaper` WHERE `movie`='$id'")->result();
      $query['imagegallery']=$this->db->query("SELECT `id`, `movie`, `order`, `status`, `image` FROM `gse_moviegallery` WHERE `movie`='$id' AND `status`=1 ORDER BY `order`")->result();
      $query['featuredvideos']=$this->db->query("SELECT `id`, `content`, `movie` FROM `gse_movie` WHERE `movie`='$id'")->result();
      $query['award']=$this->db->query("SELECT `id`, `award`, `awardname`, `awardreceiver`, `winnername`, `movie` FROM `gse_awarddetail` WHERE `movie`='$id'")->result();
      if($query)
      {
        $obj->value = true;
        $obj->data = $query;
        return $obj;
      }
      else
      {
        $obj->value = false;
        $obj->data = "No data found";
        return $obj;
      }

    }


    public function getWeddingInsideDetails($id){
      $query['weddingdetail']=$this->db->query("SELECT `id`, `wedding`, `name`, `image`,`banner`, `content`, `videos`,`status` FROM `gse_weddingsubtype` WHERE `id`='$id'")->row();
      // $query['wallpaper']=$this->db->query("SELECT `id`, `movie`, `image` FROM `gse_moviewallpaper` WHERE `movie`='$id'")->result();
      $query['imagegallery']=$this->db->query("SELECT `id`, `wedding`, `status`, `order`, `image`, `weddingsubtype` FROM `gse_weddinggallery` WHERE `weddingsubtype`=$id AND `status`=1 ORDER BY `order`")->result();
      $query['featuredvideos']=$this->db->query("SELECT `id`, `wedding`, `name`, `image`, `banner`, `weddingsubtype` FROM `gse_weddingtype` WHERE `weddingsubtype`=$id")->result();
      $wedding = $this->db->query("SELECT `wedding` FROM `gse_weddingsubtype` WHERE `id`='$id'")->row();
      $query['relatedarticles'] = $this->db->query("SELECT `id`, `wedding`, `name`, `image`, `content`, `videos`,`status` FROM `gse_weddingsubtype` WHERE `wedding` = $wedding->wedding AND `id` !='$id' ORDER BY `order` DESC LIMIT 0,3")->result();

          
          if(empty($query['relatedarticles'])){
             $query['relatedarticles'] = $this->db->query("SELECT `id`, `wedding`, `name`, `image`, `content`, `videos` FROM `gse_weddingsubtype` WHERE `id` !='$id' ORDER BY `id` DESC LIMIT 0,3")->result();
          }
      if($query)
      {
        $obj->value = true;
        $obj->data = $query;
        return $obj;
      }
      else
      {
        $obj->value = false;
        $obj->data = "No data found";
        return $obj;
      }

    }
    public function getSangeetInsideDetails($id){
        $query['weddingdetail']=$this->db->query("SELECT `id`, `name`, `image`, `banner`, `content` FROM `gse_wedding` WHERE `id`='$id'")->row();
      $query['imagegallery']=$this->db->query("SELECT `id`, `wedding`, `status`, `order`, `image`, `weddingsubtype` FROM `gse_weddinggallery` WHERE `wedding`=$id AND `status`=1 ORDER BY `order`")->result();
      $query['featuredvideos']=$this->db->query("SELECT `id`, `wedding`, `name`, `image`, `banner`, `weddingsubtype` FROM `gse_weddingtype` WHERE `wedding`=$id")->result();
      if($id==2 || $id==3){
  $query['relatedarticles'] = $this->db->query("SELECT `id`, `wedding`, `name`, `image`, `content`, `videos` FROM `gse_weddingsubtype` ORDER BY `id` DESC LIMIT 0,3")->result();
      }
      
         
    
      if($query)
      {
        $obj->value = true;
        $obj->data = $query;
        return $obj;
      }
      else
      {
        $obj->value = false;
        $obj->data = "No data found";
        return $obj;
      }

    }

    public function getWeddingInsideBanner($id){
      $query=$this->db->query("SELECT `id`, `name`, `image`, `banner` FROM `gse_wedding` WHERE `id`='$id'")->row();
      if($query)
      {
        $obj->value = true;
        $obj->data = $query;
        return $obj;
      }
      else
      {
        $obj->value = false;
        $obj->data = "No data found";
        return $obj;
      }

    }

    public function getWeddingImagesVideos($id){
      $query['Images']=$this->db->query("SELECT `id`, `wedding`, `status`, `order`, `image`, `weddingsubtype` FROM `gse_weddinggallery` WHERE `weddingsubtype`='$id' AND `status`=1 ORDER BY `order` ASC")->result();
      $query['Videos']=$this->db->query("SELECT `name` as `url` FROM `gse_weddingtype` WHERE `weddingsubtype`='$id'")->result();
      if($query)
      {
        $obj->value = true;
        $obj->data = $query;
        return $obj;
      }
      else
      {
        $obj->value = false;
        $obj->data = "No data found";
        return $obj;
      }

    }

    public function getEvents()
    {
      $query['description'] = $this->db->query("SELECT `id`, `order`, `status`, `name`, `content`,`hashtag`,`facebook`,`twitter`,`instagram` FROM `gse_category` WHERE `status`=1 AND `id`=4")->row();

      $query['events'] = $this->db->query("SELECT * FROM `gse_event` ORDER BY `order`")->result();

      $query['services'] = $this->db->query("SELECT `id`, `name`, `content`, `type`, `order` FROM `gse_service` WHERE `type`=3 ORDER BY `order`")->result();

      $query['eventdiaries'] = $this->db->query("SELECT `gse_diaryarticle`.`id`, `gse_diaryarticle`.`status`, `gse_diaryarticle`.`diarycategory`, `gse_diaryarticle`.`diarysubcategory`, `gse_diaryarticle`.`name`, `gse_diaryarticle`.`image`, `gse_diaryarticle`.`timestamp`, `gse_diaryarticle`.`content`, `gse_diaryarticle`.`date`, `gse_diaryarticle`.`type`, `gse_diaryarticle`.`showhide`, `author`.`name` AS 'authorname' FROM `gse_diaryarticle`
      LEFT OUTER JOIN `gse_diarycategory` ON `gse_diarycategory`.`id`=`gse_diaryarticle`.`diarycategory` LEFT OUTER JOIN `author` ON `gse_diaryarticle`.`author`=`author`.`id`
      WHERE `gse_diarycategory`.`name` LIKE '%event%' OR `gse_diarycategory`.`name` LIKE '%events%' ORDER BY `date` DESC LIMIT 3 ")->result();
      $query['testimonial'] = $this->db->query("SELECT * FROM `gse_testimonial` WHERE `category`=4")->result();
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


    public function getEventInsideBanner($id){
      $query=$this->db->query("SELECT `id`, `name`, `image`, `banner`,`hashtag`,`facebook`,`twitter`,`instagram`,`status` FROM `gse_event` WHERE `id`='$id' ORDER BY `order`")->row();
      if($query)
      {
        $obj->value = true;
        $obj->data = $query;
        return $obj;
      }
      else
      {
        $obj->value = false;
        $obj->data = "No data found";
        return $obj;
      }
    }

    public function getEventInsideDetails($id){
      $query['eventdetail']=$this->db->query("SELECT `id`, `event`, `name`, `image`, `content`, `order`, `status`, `date`, `location`,`banner` FROM `gse_eventsubtype` WHERE `id`='$id'")->row();
      $query['imagegallery']=$this->db->query("SELECT `id`, `event`, `status`, `order`, `image`, `eventsubtype` FROM `gse_eventgallery` WHERE `eventsubtype`=$id AND `status`=1 ORDER BY `order`")->result();
      $query['featuredvideos']=$this->db->query("SELECT `id`, `event`, `status`, `order`, `url`, `eventsubtype` FROM `gse_eventvideos` WHERE `eventsubtype`=$id")->result();
      $event = $this->db->query("SELECT `event` FROM `gse_eventsubtype` WHERE `id`='$id'")->row();
      if(empty($event))
      {
        $query['relatedarticles'] =[];
      }
      else
      {
        $query['relatedarticles'] = $this->db->query("SELECT `id`, `event`, `name`, `image`, `content`, `order`, `status`, `date`, `location` FROM `gse_eventsubtype` WHERE `event` = $event->event AND `id` !='$id' ORDER BY `order` DESC LIMIT 0,3")->result();
      }

      if($query)
      {
        $obj->value = true;
        $obj->data = $query;
        return $obj;
      }
      else
      {
        $obj->value = false;
        $obj->data = "No data found";
        return $obj;
      }
    }

    public function getMices()
    {
      $query['description'] = $this->db->query("SELECT `id`, `order`, `status`, `name`, `content`,`hashtag`,`facebook`,`twitter`,`instagram` FROM `gse_category` WHERE `status`=1 AND `id`=6")->row();

      $query['mice'] = $this->db->query("SELECT * FROM `gse_mice`")->result();

      $query['services'] = $this->db->query("SELECT `id`, `name`, `content`, `type`, `order` FROM `gse_service` WHERE `type`=5 ORDER BY `order`")->result();

      $query['micediaries'] = $this->db->query("SELECT `gse_diaryarticle`.`id`, `gse_diaryarticle`.`status`, `gse_diaryarticle`.`diarycategory`, `gse_diaryarticle`.`diarysubcategory`, `gse_diaryarticle`.`name`, `gse_diaryarticle`.`image`, `gse_diaryarticle`.`timestamp`, `gse_diaryarticle`.`content`, `gse_diaryarticle`.`date`, `gse_diaryarticle`.`type`, `gse_diaryarticle`.`showhide`,`author`.`name` AS 'authorname' FROM `gse_diaryarticle`
      LEFT OUTER JOIN `gse_diarycategory` ON `gse_diarycategory`.`id`=`gse_diaryarticle`.`diarycategory`
      LEFT OUTER JOIN `author` ON `gse_diaryarticle`.`author`=`author`.`id`
      WHERE `gse_diarycategory`.`name` LIKE '%mice%' OR `gse_diarycategory`.`name` LIKE '%mices%'  ORDER BY `date` DESC LIMIT 3 ")->result();
      $query['testimonial'] = $this->db->query("SELECT * FROM `gse_testimonial` WHERE `category`=6")->result();
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
    public function getMiceInsideBanner($id){
      $query=$this->db->query("SELECT `id`, `name`, `image`, `banner`,`hashtag`,`facebook`,`twitter`,`instagram`,`status` FROM `gse_mice` WHERE `id`='$id'")->row();
      if($query)
      {
        $obj->value = true;
        $obj->data = $query;
        return $obj;
      }
      else
      {
        $obj->value = false;
        $obj->data = "No data found";
        return $obj;
      }
    }

    public function getMiceInsideDetails($id){
      $query['micedetail']=$this->db->query("SELECT `id`, `mice`, `order`, `name`, `image`, `url`, `banner`, `content`,`status` FROM `gse_micesubtype` WHERE `id`='$id'")->row();
      $query['imagegallery']=$this->db->query("SELECT `id`, `mice`, `status`, `order`, `image`, `micesubtype` FROM `gse_micegallery` WHERE `micesubtype`=$id AND `status`=1 ORDER BY `order`")->result();
      $query['featuredvideos']=$this->db->query("SELECT `id`, `mice`, `status`, `order`, `url`, `micesubtype` FROM `gse_micevideos` WHERE `micesubtype`=$id")->result();
      $mice = $this->db->query("SELECT `mice` FROM `gse_micesubtype` WHERE `id`='$id'")->row();
      // print_r($mice);
      if(empty($mice))
      {
        $query['relatedarticles'] = [];
      }
      else
      {
          $query['relatedarticles'] = $this->db->query("SELECT `id`, `mice`, `order`, `name`, `image`, `url`, `banner`, `content`,`status` FROM `gse_micesubtype` WHERE `mice` = $mice->mice AND `id` !='$id' ORDER BY `id` DESC LIMIT 0,3")->result();
      }

      if($query)
      {
        $obj->value = true;
        $obj->data = $query;
        return $obj;
      }
      else
      {
        $obj->value = false;
        $obj->data = "No data found";
        return $obj;
      }
    }

    public function getWorldTour()
    {
      $query['description'] = $this->db->query("SELECT `id`, `order`, `status`, `name`, `content`,`hashtag`,`facebook`,`twitter`,`instagram` FROM `gse_category` WHERE `status`=1 AND `id`=7")->row();

      $query['worldtourpast'] = $this->db->query("SELECT * FROM `gse_worldtour` WHERE `type`=1 ")->result();
      $query['worldtourupcoming'] = $this->db->query("SELECT * FROM `gse_worldtour` WHERE `type`=2 ")->result();

      $query['services'] = $this->db->query("SELECT `id`, `name`, `content`, `type`, `order` FROM `gse_service` WHERE `type`=6 ORDER BY `order`")->result();
      $query['testimonial'] = $this->db->query("SELECT `id`, `category`, `status`, `order`, `name`, `author`, `image`, `quote` FROM `gse_testimonial` WHERE `category`=7")->result();

      $query['worldtourdiaries'] = $this->db->query("SELECT `gse_diaryarticle`.`id`, `gse_diaryarticle`.`status`, `gse_diaryarticle`.`diarycategory`, `gse_diaryarticle`.`diarysubcategory`, `gse_diaryarticle`.`name`, `gse_diaryarticle`.`image`, `gse_diaryarticle`.`timestamp`, `gse_diaryarticle`.`content`, `gse_diaryarticle`.`date`, `gse_diaryarticle`.`type`, `gse_diaryarticle`.`showhide`, `author`.`name` AS 'authorname' FROM `gse_diaryarticle`
      LEFT OUTER JOIN `gse_diarycategory` ON `gse_diarycategory`.`id`=`gse_diaryarticle`.`diarycategory`
      LEFT OUTER JOIN `author` ON `gse_diaryarticle`.`author`=`author`.`id`
      WHERE `gse_diarycategory`.`name` LIKE '%world tour%' OR `gse_diarycategory`.`name` LIKE '%worldtour%' ORDER BY `date` DESC LIMIT 3 ")->result();
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

    public function getMediaCorner(){
// $where = " WHERE 1";
// if(!empty($year))
// {
//   $where = "WHERE year(date)='$year'";
// }
 $query['years']= $this->db->query("SELECT DISTINCT year(date) AS 'year' FROM `gse_mediacorner`")->result();
      $query['description'] = $this->db->query("SELECT `id`, `order`, `status`, `name`, `content` FROM `gse_category` WHERE `id`=9")->row();

      if($query)
      {
        $obj->value = true;
        $obj->data = $query;
        return $obj;
      }
      else
      {
        $obj->value = false;
        $obj->data = "No data found";
        return $obj;
      }
    }
    public function getSport(){
      $query['description'] = $this->db->query("SELECT `id`, `order`, `status`, `name`, `content`,`hashtag`,`facebook`,`twitter`,`instagram` FROM `gse_category` WHERE `status`=1 AND `id`=3")->row();
      $query['sports']=$this->db->query("SELECT `id`, `order`, `status`, `name`, `image`, `link`, `banner`, `content` FROM `gse_sportscategory` ORDER BY `order` DESC")->result();
      $query['services'] = $this->db->query("SELECT `id`, `name`, `content`, `type`, `order` FROM `gse_service` WHERE `type`=2 ORDER BY `order`")->result();

      $query['sportdiaries'] = $this->db->query("SELECT `gse_diaryarticle`.`id`, `gse_diaryarticle`.`status`, `gse_diaryarticle`.`diarycategory`, `gse_diaryarticle`.`diarysubcategory`, `gse_diaryarticle`.`name`, `gse_diaryarticle`.`image`, `gse_diaryarticle`.`timestamp`, `gse_diaryarticle`.`content`, `gse_diaryarticle`.`date`, `gse_diaryarticle`.`type`, `gse_diaryarticle`.`showhide`,`author`.`name` AS 'authorname' FROM `gse_diaryarticle`
      LEFT OUTER JOIN `gse_diarycategory` ON `gse_diarycategory`.`id`=`gse_diaryarticle`.`diarycategory`
      LEFT OUTER JOIN `author` ON `gse_diaryarticle`.`author`=`author`.`id`
      WHERE `gse_diarycategory`.`name` LIKE '%sport%' OR `gse_diarycategory`.`name` LIKE '%sports%'  ORDER BY `date` DESC LIMIT 3 ")->result();
      $query['testimonial'] = $this->db->query("SELECT * FROM `gse_testimonial` WHERE `category`=3")->result();
      if($query)
      {
        $obj->value = true;
        $obj->data = $query;
        return $obj;
      }
      else
      {
        $obj->value = false;
        $obj->data = "No data found";
        return $obj;
      }
    }

    public function getSportsDetail($id){
      $query['description'] = $this->db->query("SELECT `id`, `order`, `status`, `name`, `image`, `link`, `banner`, `content`,`hashtag`,`facebook`,`twitter`,`instagram` FROM `gse_sportscategory` WHERE `id`=$id ORDER BY `order` ASC")->row();

      $query['testimonial'] = $this->db->query("SELECT * FROM `gse_testimonial` WHERE `category`=15")->result();
      if($query)
      {
        $obj->value = true;
        $obj->data = $query;
        return $obj;
      }
      else
      {
        $obj->value = false;
        $obj->data = "No data found";
        return $obj;
      }
    }
    public function getasfcSportsDetail($id){
      $query['description'] = $this->db->query("SELECT `id`, `order`, `status`, `name`, `image`, `link`, `banner`, `content`,`hashtag`,`facebook`,`twitter`,`instagram` FROM `gse_sportscategory` WHERE `id`=$id")->row();
      $cdate = date("Y-m-d");
      $query['playerlist'] = $this->db->query("SELECT `id`, `order`, `status`, `sportscategory`, `name`, `image` FROM `gse_player`  WHERE `sportscategory`=$id AND `status`=1 ORDER BY `order`")->result();
      $query['upcomingmatch'] = $this->db->query("SELECT `id`, `sportscategory`, `name`, `image`, `link`, `location`, `content`, `videos`, `date` FROM `gse_highlight` WHERE date > '$cdate' AND `sportscategory`=$id ")->result();
      $query['testimonial'] = $this->db->query("SELECT * FROM `gse_testimonial` WHERE`category`=16")->result();
      if($query)
      {
        $obj->value = true;
        $obj->data = $query;
        return $obj;
      }
      else
      {
        $obj->value = false;
        $obj->data = "No data found";
        return $obj;
      }
    }
    public function getpfhSportsDetail($id){
      $query['description'] = $this->db->query("SELECT `id`, `order`, `status`, `name`, `image`, `link`, `banner`, `content`,`hashtag`,`facebook`,`twitter`,`instagram` FROM `gse_sportscategory` WHERE `id`=$id")->row();
      // $query['playerlist'] = $this->db->query("SELECT `id`, `order`, `status`, `sportscategory`, `name`, `image` FROM `gse_player`  WHERE `sportscategory`=$id")->result();
      // $query['upcomingmatch'] = $this->db->query("SELECT `id`, `sportscategory`, `name`, `image`, `link`, `location`, `content`, `videos`, `date` FROM `gse_highlight` WHERE date > '$cdate' AND `sportscategory`=$id ")->result();
      $query['testimonial'] = $this->db->query("SELECT * FROM `gse_testimonial` WHERE`category`=17")->result();
      if($query)
      {
        $obj->value = true;
        $obj->data = $query;
        return $obj;
      }
      else
      {
        $obj->value = false;
        $obj->data = "No data found";
        return $obj;
      }
    }
    public function getWorldTourInsideDetails($id){
      $query['worldtourdetail']=$this->db->query("SELECT `id`, `type`, `image`, `name`, `location`, `date`, `venue`, `content`, `banner`,`hashtag`,`facebook`,`twitter`,`instagram` FROM `gse_worldtour` WHERE `id`='$id'")->row();
      $query['wallpaper']=$this->db->query("SELECT `id`, `image`, `order`, `worldtour` FROM `gse_worldtourwallpaper` WHERE `worldtour`='$id'")->result();
      $query['imagegallery']=$this->db->query("SELECT `id`, `image`, `order`, `worldtour` FROM `gse_worldtourimage` WHERE `worldtour`='$id' ORDER BY `order` ASC")->result();
      $query['featuredvideos']=$this->db->query("SELECT `id`, `worldtour`, `order`, `url` FROM `gse_worldtourvideos` WHERE `worldtour`='$id' ORDER BY `order` ASC")->result();
      if($query)
      {
        $obj->value = true;
        $obj->data = $query;
        return $obj;
      }
      else
      {
        $obj->value = false;
        $obj->data = "No data found";
        return $obj;
      }

    }

    public function getHome(){
      $query['description'] = $this->db->query("SELECT `id`, `order`, `status`, `name`, `content` FROM `gse_category` WHERE   `id`=11")->row();
          $query['homediaries'] = $this->db->query("SELECT `gse_diaryarticle`.`id`, `gse_diaryarticle`.`status`, `gse_diaryarticle`.`diarycategory`, `gse_diaryarticle`.`diarysubcategory`, `gse_diaryarticle`.`name`, `gse_diaryarticle`.`image`, `gse_diaryarticle`.`timestamp`, `gse_diaryarticle`.`content`, `gse_diaryarticle`.`date`, `gse_diaryarticle`.`type`, `gse_diaryarticle`.`showhide`, `gse_diaryarticle`.`author`,`author`.`name` AS 'authorname', `gse_diaryarticle`.`views` FROM `gse_diaryarticle` LEFT OUTER JOIN `author` ON `gse_diaryarticle`.`author`=`author`.`id` WHERE 1 ORDER BY `gse_diaryarticle`.`date` DESC")->result();
      $query['testimonial'] = $this->db->query("SELECT * FROM `gse_testimonial` WHERE `category`=11")->result();
      if($query)
      {
        $obj->value = true;
        $obj->data = $query;
        return $obj;
      }
      else
      {
        $obj->value = false;
        $obj->data = "No data found";
        return $obj;
      }
    }

public function subscribeSubmit($email)
{
  if(!empty($email))
  {
    $query1 = $this->db->query("SELECT * FROM `gse_subscribe` WHERE `email`='$email'");
    $num = $query1->num_rows();
    if ($num > 0) {
        $object = new stdClass();
        $object->value = false;
        $object->comment = 'already exists';

        return $object;
    } else {
        $this->db->query("INSERT INTO `gse_subscribe`(`email`) VALUE('$email')");
        $id = $this->db->insert_id();
        $object = new stdClass();
        $object->value = true;

        return $object;
    }
  }
  else
  {
    $object = new stdClass();
    $object->value = false;
    $object->message = "Please Enter Email Id";
    }
    return $object;
}

public function getSportsDetailInside($id){
  $query['sportdetail']=$this->db->query("SELECT `id`, `sportscategory`, `name`, `image`, `link`, `location`, `content`, `videos`, `date`,`banner` FROM `gse_highlight` WHERE `id`='$id'")->row();
  $query['imagegallery']=$this->db->query("SELECT `id`, `order`, `status`, `highlight`, `sportscategory`, `image` FROM `gse_previousgamegallery` WHERE `highlight`=$id AND `status`=1 ORDER BY `order`")->result();
  $query['featuredvideos']=$this->db->query("SELECT `id`, `url`, `order`, `highlight`, `sportscategory` FROM `gse_previousgamevideo` WHERE `highlight`=$id")->result();
  $sport = $this->db->query("SELECT `sportscategory` FROM `gse_highlight` WHERE `id`='$id'")->row();
  // print_r($mice);
  if(empty($sport))
  {
    $query['relatedarticles'] = [];
  }
  else
  {
      $query['relatedarticles'] = $this->db->query("SELECT `id`, `sportscategory`, `name`, `image`, `link`, `location`, `content`, `videos`, `date` FROM `gse_highlight` WHERE `sportscategory` = $sport->sportscategory AND `id` !='$id' ORDER BY `id` DESC LIMIT 0,3")->result();
  }

  if($query)
  {
    $obj->value = true;
    $obj->data = $query;
    return $obj;
  }
  else
  {
    $obj->value = false;
    $obj->data = "No data found";
    return $obj;
  }
}

public function getTalent(){
  $query['description'] = $this->db->query("SELECT `id`, `order`, `status`, `name`, `content`,`hashtag`,`facebook`,`twitter`,`instagram` FROM `gse_category` WHERE `status`=1 AND `id`=5")->row();
  $query['talent']=$this->db->query("SELECT `id`, `name`, `image`, `link`,`status` FROM `gse_talent` ")->result();
  $query['services'] = $this->db->query("SELECT `id`, `name`, `content`, `type`, `order` FROM `gse_service` WHERE `type`=4 ORDER BY `order`")->result();

  $query['talentdiaries'] = $this->db->query("SELECT `gse_diaryarticle`.`id`, `gse_diaryarticle`.`status`, `gse_diaryarticle`.`diarycategory`, `gse_diaryarticle`.`diarysubcategory`, `gse_diaryarticle`.`name`, `gse_diaryarticle`.`image`, `gse_diaryarticle`.`timestamp`, `gse_diaryarticle`.`content`, `gse_diaryarticle`.`date`, `gse_diaryarticle`.`type`, `gse_diaryarticle`.`showhide`,`author`.`name` AS 'authorname' FROM `gse_diaryarticle`
  LEFT OUTER JOIN `gse_diarycategory` ON `gse_diarycategory`.`id`=`gse_diaryarticle`.`diarycategory`
  LEFT OUTER JOIN `author` ON `gse_diaryarticle`.`author`=`author`.`id`
  WHERE `gse_diarycategory`.`name` LIKE '%talent%' OR `gse_diarycategory`.`name` LIKE '%talents%'   ORDER BY `date` DESC LIMIT 3 ")->result();
  $query['testimonial'] = $this->db->query("SELECT * FROM `gse_testimonial` WHERE `category`=5")->result();
  if($query)
  {
    $obj->value = true;
    $obj->data = $query;
    return $obj;
  }
  else
  {
    $obj->value = false;
    $obj->data = "No data found";
    return $obj;
  }
}

public function getTalentInsideBanner($id){
  $query = $this->db->query("SELECT `id`, `name`, `image`, `link`, `banner`,`hashtag`,`facebook`,`twitter`,`instagram` FROM `gse_talent` WHERE `id`=$id")->row();
if($query)
  {
    $obj->value = true;
    $obj->data = $query;
    return $obj;
  }
  else
  {
    $obj->value = false;
    $obj->data = "No data found";
    return $obj;
  }
}

public function getTalentDetailInside($id){
  $query['talentdetail']=$this->db->query("SELECT `id`, `talent`, `order`, `status`, `name`, `image`, `url`, `banner`, `content`, `videos` FROM `gse_talenttype` WHERE `id`='$id'")->row();
  $query['imagegallery']=$this->db->query("SELECT `id`, `order`, `status`, `talenttype`, `talent`, `image` FROM `gse_talenttypegallery` WHERE `talenttype`=$id AND `status`=1 ORDER BY `order`")->result();
  $query['featuredvideos']=$this->db->query("SELECT `id`, `url`, `order`, `talenttype` FROM `gse_talenttypevideo` WHERE `talenttype`=$id")->result();
  $talent = $this->db->query("SELECT `talent` FROM `gse_talenttype` WHERE `id`='$id'")->row();
  // print_r($mice);
  if(empty($talent))
  {
    $query['relatedarticles'] = [];
  }
  else
  {
      $query['relatedarticles'] = $this->db->query("SELECT `id`, `talent`, `order`, `status`, `name`, `image`, `url`, `banner`, `content`, `videos`,`location`,`date` FROM `gse_talenttype` WHERE `talent` = $talent->talent AND `id` !='$id' ORDER BY `order` DESC LIMIT 0,3")->result();
  }

  if($query)
  {
    $obj->value = true;
    $obj->data = $query;
    return $obj;
  }
  else
  {
    $obj->value = false;
    $obj->data = "No data found";
    return $obj;
  }
}

public function getClients(){
  $query['description']=$this->db->query("SELECT `id`, `order`, `status`, `name`, `content` FROM `gse_category` WHERE `status`=1 AND `id`=12")->row();
  $query['logos']= $this->db->query("SELECT `id`, `order`, `status`, `name`, `image` FROM `gse_clientlogo` WHERE `status`=1")->result();

  if($query)
  {
    $obj->value = true;
    $obj->data = $query;
    return $obj;
  }
  else
  {
    $obj->value = false;
    $obj->data = "No data found";
    return $obj;
  }
}
public function getCareer(){
  $query= $this->db->query("SELECT * FROM `gse_careerposition` WHERE `status`=1 ORDER BY `order`")->result();

  if($query)
  {
    $obj->value = true;
    $obj->data = $query;
    return $obj;
  }
  else
  {
    $obj->value = false;
    $obj->data = "No data found";
    return $obj;
  }
}
public function getClientDetail($id){
  if(!empty($id))
  {
$query= $this->db->query("SELECT `id`, `order`, `status`, `name`, `image`, `title`, `url`, `content`, `banner` FROM `gse_clientdetail` WHERE `id`=$id")->row();
  }
  else {
    $query= $this->db->query("SELECT `id`, `order`, `status`, `name`, `image`, `title`, `url`, `content`, `banner` FROM `gse_clientdetail` ORDER BY `order`")->result();
  }
  if($query)
  {
    $obj->value = true;
    $obj->data = $query;
    return $obj;
  }
  else
  {
    $obj->value = false;
    $obj->data = "No data found";
    return $obj;
  }
}
public function careersSubmit($category,$name,$email, $phone,$resume,$address,$suburb,$state,$postcode,$dob,$linkedin,$twitter,$github,$portfolio,$otherwebsite,$type,$salary,$expectedctc){
 
    $query=$this->db->query("INSERT INTO `gse_careerform`(`category`, `name`, `email`, `phone`, `resume`, `address`, `suburb`, `state`, `postcode`, `dob`, `linkedin`, `twitter`, `github`, `portfolio`, `otherwebsite`, `type`, `salary`, `expectedctc`) VALUES ('$category','$name','$email', '$phone','$resume','$address','$suburb','$state','$postcode','$dob','$linkedin','$twitter','$github','$portfolio','$otherwebsite','$type','$salary','$expectedctc')");
    if($query)
    {
      $obj->value = true;
      $obj->data = "data saved";
      return $obj;
    }
    else
    {
      $obj->value = false;
      return $obj;
    }
 

}
public function getMatch(){
  $cdate = date("Y-m-d");
  $query['upcoming']=$this->db->query("SELECT `id`, `team1`, `logo1`, `team2`, `logo2`, `location`, `date`, `time`, `link`, `team1score`, `team2score`, `banner`,`stadium` FROM `gse_match` WHERE `date` > '$cdate'")->result();
  $query['previous']=$this->db->query("SELECT `id`, `team1`, `logo1`, `team2`, `logo2`, `location`, `date`, `time`, `link`, `team1score`, `team2score`, `banner`,`stadium`  FROM `gse_match` WHERE `date` < '$cdate'")->result();
  if($query)
  {
    $obj->value = true;
    $obj->data = $query;
    return $obj;
  }
  else
  {
    $obj->value = false;
    $obj->data = "No data found";
    return $obj;
  }
}
public function getDiary(){
    $query['description']=$this->db->query("SELECT `id`, `order`, `status`, `name`, `content` FROM `gse_category` WHERE  `id`=13 ORDER BY `order`")->row();
  $query['category']=$this->db->query("SELECT `id`, `order`, `status`, `name` FROM `gse_diarycategory` WHERE 1 ORDER BY `order`")->result();
  $query['years']=$this->db->query("SELECT DISTINCT year(`date`) AS 'year',MONTHNAME(`date`) AS 'month' FROM `gse_diaryarticle` ORDER BY `date` DESC")->result();
  if($query)
  {
    $obj->value = true;
    $obj->data = $query;
    return $obj;
  }
  else
  {
    $obj->value = false;
    $obj->data = "No data found";
    return $obj;
  }
}
public function getDiaryInside($page){
  $queryid=$this->db->query("SELECT DISTINCT `id`,`name` FROM `gse_diarycategory` WHERE 1")->result();
  // print_r($queryid);
  if(!empty($page))
  {
    $startingfrom = ($page - 1) * 1;
    $page = "$startingfrom,1";
  }
  else {
    $page = "1";
  }
  if($queryid)
  {
    foreach ($queryid as $value) {
      $string = str_replace(" ", "", $value->name);
      $q="SELECT `gse_diaryarticle`.`id`, `gse_diaryarticle`.`status`, `gse_diaryarticle`.`diarycategory`, `gse_diaryarticle`.`diarysubcategory`, `gse_diaryarticle`.`name`, `gse_diaryarticle`.`image`, `gse_diaryarticle`.`timestamp`, `gse_diaryarticle`.`content`, `gse_diaryarticle`.`date`, `gse_diaryarticle`.`type`, `gse_diaryarticle`.`showhide`,`gse_diarycategory`.`name` AS 'categoryname',`author`.`id` AS 'authorid',`author`.`name` AS 'authorname',`gse_diaryarticle`.`views` FROM `gse_diaryarticle` LEFT OUTER JOIN `gse_diarycategory` ON `gse_diaryarticle`.`diarycategory`=`gse_diarycategory`.`id` LEFT OUTER JOIN `author` ON `gse_diaryarticle`.`author`=`author`.`id` WHERE `diarycategory`='$value->id' ORDER BY `id` DESC LIMIT $page";
      // echo $q;
      $query[$string]=$this->db->query($q)->result();
  }
    $obj->value = true;
    $obj->data = $query;
    return $obj;
  }
  else
  {
    $obj->value = false;
    $obj->data = "No data found";
    return $obj;
  }
}

public function getDiaryInsideDetail($id){

  $getview = $this->db->query("SELECT `views` FROM `gse_diaryarticle` WHERE `id`=$id")->row();
  // print_r($getview);
$uhetview = $this->db->query("UPDATE `gse_diaryarticle` SET `views`=$getview->views+1 WHERE `id`=$id");
  $query['description']=$this->db->query("SELECT `gse_diaryarticle`.`id`, `gse_diaryarticle`.`status`, `gse_diaryarticle`.`diarycategory`, `gse_diaryarticle`.`diarysubcategory`, `gse_diaryarticle`.`name`, `gse_diaryarticle`.`image`, `gse_diaryarticle`.`timestamp`, `gse_diaryarticle`.`content`, `gse_diaryarticle`.`date`, `gse_diaryarticle`.`type`, `gse_diaryarticle`.`showhide`,`gse_diaryarticle`.`views`,`author`.`id` AS 'authorid',`author`.`name` AS 'authorname' FROM `gse_diaryarticle` LEFT OUTER JOIN `author` ON `gse_diaryarticle`.`author`=`author`.`id` WHERE `gse_diaryarticle`.`id`=$id")->row();
  if($query['description']->type==1)
  {
      $query['text']=$this->db->query("SELECT `id`, `diaryarticle`, `content`, `image`, `order` FROM `gse_blogtext` WHERE `diaryarticle`=$id ORDER BY `order` ASC")->result();
  }
  if($query['description']->type==2)
  {
    $query['image']=$this->db->query("SELECT `id`, `diaryarticle`, `image`, `order` FROM `gse_blogimage` WHERE `diaryarticle`=$id ORDER BY `order` ASC")->result();
  }
  if($query['description']->type==3)
  {
  $query['video']=$this->db->query("SELECT `id`, `diaryarticle`, `url`, `order` FROM `gse_blogvideo` WHERE  `diaryarticle`=$id ORDER BY `order` ASC")->result();
    // echo "video";
  }
  $dcat=$query["description"]->diarycategory;
  $cdate = new DateTime();
  if(!empty($dcat))
  {
  $query['relatedarticles']=$this->db->query("SELECT `gse_diaryarticle`.`id`, `gse_diaryarticle`.`status`, `gse_diaryarticle`.`diarycategory`, `gse_diaryarticle`.`diarysubcategory`, `gse_diaryarticle`.`name`, `gse_diaryarticle`.`image`, `gse_diaryarticle`.`timestamp`, `gse_diaryarticle`.`content`, `gse_diaryarticle`.`date`, `gse_diaryarticle`.`type`, `gse_diaryarticle`.`showhide`,`gse_diarycategory`.`name` AS 'categoryname' FROM `gse_diaryarticle` LEFT OUTER JOIN `gse_diarycategory` ON `gse_diaryarticle`.`diarycategory`=`gse_diarycategory`.`id` WHERE `gse_diaryarticle`.`id`!=$id AND `gse_diaryarticle`.`diarycategory`='$dcat'")->result();
  }
  $query['comments']=$this->db->query("SELECT `id`, `diaryarticle`, `userid`, `timestamp`, `name`,`image`, `comment` FROM `gse_comment` WHERE `diaryarticle`=$id ORDER BY `id` DESC")->result();
  if($query)
  {
    $obj->value = true;
    $obj->data = $query;
    return $obj;
  }
  else
  {
    $obj->value = false;
    $obj->data = "No data found";
    return $obj;
  }
}
public function commentSubmit($diaryarticle,$userid,$name,$image,$comment)
{
  if(!empty($comment))
  {
    $query=$this->db->query("INSERT INTO `gse_comment`(`diaryarticle`, `userid`, `name`, `image`,`comment`) VALUES ('$diaryarticle','$userid','$name','$image','$comment')");
    if($query)
    {
      $obj->value = true;
      $obj->data = "data saved";
      return $obj;
    }
    else
    {
      $obj->value = false;
      return $obj;
    }
  }
  else {
    $obj->value = false;
    $obj->data = "Plaese enter comment";
    return $obj;
  }
}
public function getAuthor($id){
    $query['description']=$this->db->query("SELECT `id`, `name`, `image`, `description`, `facebook`, `twitter`, `google` FROM `author` WHERE `id`='$id'")->row();
  $query['articles']=$this->db->query("SELECT `gse_diaryarticle`.`id`, `gse_diaryarticle`.`status`, `gse_diaryarticle`.`diarycategory`, `gse_diaryarticle`.`diarysubcategory`, `gse_diaryarticle`.`name`, `gse_diaryarticle`.`image`, `gse_diaryarticle`.`timestamp`, `gse_diaryarticle`.`content`, `gse_diaryarticle`.`date`, `gse_diaryarticle`.`type`, `gse_diaryarticle`.`showhide`, `gse_diaryarticle`.`author`, `gse_diaryarticle`.`views`,`gse_diarycategory`.`name` AS 'categoryname' FROM `gse_diaryarticle` LEFT OUTER JOIN `gse_diarycategory` ON `gse_diaryarticle`.`diarycategory`=`gse_diarycategory`.`id` WHERE `gse_diaryarticle`.`author`=$id ORDER BY `date` DESC")->result();

  if($query)
  {
    $obj->value = true;
    $obj->data = $query;
    return $obj;
  }
  else
  {
    $obj->value = false;
    $obj->data = "No data found";
    return $obj;
  }
}

}
?>
