<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");
class Json extends CI_Controller
{function getallcategory()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`gse_category`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements[1]=new stdClass();
$elements[1]->field="`gse_category`.`order`";
$elements[1]->sort="1";
$elements[1]->header="Order";
$elements[1]->alias="order";

$elements[2]=new stdClass();
$elements[2]->field="`gse_category`.`status`";
$elements[2]->sort="1";
$elements[2]->header="Status";
$elements[2]->alias="status";

$elements[3]=new stdClass();
$elements[3]->field="`gse_category`.`name`";
$elements[3]->sort="1";
$elements[3]->header="Name";
$elements[3]->alias="name";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_category`");
$this->load->view("json",$data);
}
public function getsinglecategory()
{
$id=$this->input->get_post("id");
$data["message"]=$this->category_model->getsinglecategory($id);
$this->load->view("json",$data);
}
function getallsubscribe()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`gse_subscribe`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements[1]=new stdClass();
$elements[1]->field="`gse_subscribe`.`email`";
$elements[1]->sort="1";
$elements[1]->header="Email";
$elements[1]->alias="email";

$elements[2]=new stdClass();
$elements[2]->field="`gse_subscribe`.`timestamp`";
$elements[2]->sort="1";
$elements[2]->header="Timestamp";
$elements[2]->alias="timestamp";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_subscribe`");
$this->load->view("json",$data);
}
public function getsinglesubscribe()
{
$id=$this->input->get_post("id");
$data["message"]=$this->subscribe_model->getsinglesubscribe($id);
$this->load->view("json",$data);
}
function getalltestimonial()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`gse_testimonial`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements[1]=new stdClass();
$elements[1]->field="`gse_testimonial`.`category`";
$elements[1]->sort="1";
$elements[1]->header="Category";
$elements[1]->alias="category";

$elements[2]=new stdClass();
$elements[2]->field="`gse_testimonial`.`status`";
$elements[2]->sort="1";
$elements[2]->header="Status";
$elements[2]->alias="status";

$elements[3]=new stdClass();
$elements[3]->field="`gse_testimonial`.`order`";
$elements[3]->sort="1";
$elements[3]->header="Order";
$elements[3]->alias="order";

$elements[4]=new stdClass();
$elements[4]->field="`gse_testimonial`.`name`";
$elements[4]->sort="1";
$elements[4]->header="Name";
$elements[4]->alias="name";

$elements[5]=new stdClass();
$elements[5]->field="`gse_testimonial`.`author`";
$elements[5]->sort="1";
$elements[5]->header="Author";
$elements[5]->alias="author";

$elements[6]=new stdClass();
$elements[6]->field="`gse_testimonial`.`image`";
$elements[6]->sort="1";
$elements[6]->header="Image";
$elements[6]->alias="image";

$elements[7]=new stdClass();
$elements[7]->field="`gse_testimonial`.`quote`";
$elements[7]->sort="1";
$elements[7]->header="Quote";
$elements[7]->alias="quote";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_testimonial`");
$this->load->view("json",$data);
}
public function getsingletestimonial()
{
$id=$this->input->get_post("id");
$data["message"]=$this->testimonial_model->getsingletestimonial($id);
$this->load->view("json",$data);
}
function getallgetintouch()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`gse_getintouch`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements[1]=new stdClass();
$elements[1]->field="`gse_getintouch`.`category`";
$elements[1]->sort="1";
$elements[1]->header="Category";
$elements[1]->alias="category";

$elements[2]=new stdClass();
$elements[2]->field="`gse_getintouch`.`firstname`";
$elements[2]->sort="1";
$elements[2]->header="First Name";
$elements[2]->alias="firstname";

$elements[3]=new stdClass();
$elements[3]->field="`gse_getintouch`.`lastname`";
$elements[3]->sort="1";
$elements[3]->header="Last Name";
$elements[3]->alias="lastname";

$elements[4]=new stdClass();
$elements[4]->field="`gse_getintouch`.`email`";
$elements[4]->sort="1";
$elements[4]->header="Email";
$elements[4]->alias="email";

$elements[5]=new stdClass();
$elements[5]->field="`gse_getintouch`.`phone`";
$elements[5]->sort="1";
$elements[5]->header="Phone";
$elements[5]->alias="phone";

$elements[6]=new stdClass();
$elements[6]->field="`gse_getintouch`.`timestamp`";
$elements[6]->sort="1";
$elements[6]->header="Timestamp";
$elements[6]->alias="timestamp";

$elements[7]=new stdClass();
$elements[7]->field="`gse_getintouch`.`comment`";
$elements[7]->sort="1";
$elements[7]->header="Comment";
$elements[7]->alias="comment";

$elements[8]=new stdClass();
$elements[8]->field="`gse_getintouch`.`enquiryfor`";
$elements[8]->sort="1";
$elements[8]->header="Enquiry For";
$elements[8]->alias="enquiryfor";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_getintouch`");
$this->load->view("json",$data);
}
public function getsinglegetintouch()
{
$id=$this->input->get_post("id");
$data["message"]=$this->getintouch_model->getsinglegetintouch($id);
$this->load->view("json",$data);
}
function getalldiarycategory()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`gse_diarycategory`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements[1]=new stdClass();
$elements[1]->field="`gse_diarycategory`.`order`";
$elements[1]->sort="1";
$elements[1]->header="Order";
$elements[1]->alias="order";

$elements[2]=new stdClass();
$elements[2]->field="`gse_diarycategory`.`status`";
$elements[2]->sort="1";
$elements[2]->header="Status";
$elements[2]->alias="status";

$elements[3]=new stdClass();
$elements[3]->field="`gse_diarycategory`.`name`";
$elements[3]->sort="1";
$elements[3]->header="Name";
$elements[3]->alias="name";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_diarycategory`");
$this->load->view("json",$data);
}
public function getsinglediarycategory()
{
$id=$this->input->get_post("id");
$data["message"]=$this->diarycategory_model->getsinglediarycategory($id);
$this->load->view("json",$data);
}
function getalldiarysubcategory()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`gse_diarysubcategory`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements[1]=new stdClass();
$elements[1]->field="`gse_diarysubcategory`.`order`";
$elements[1]->sort="1";
$elements[1]->header="Order";
$elements[1]->alias="order";

$elements[2]=new stdClass();
$elements[2]->field="`gse_diarysubcategory`.`status`";
$elements[2]->sort="1";
$elements[2]->header="Status";
$elements[2]->alias="status";

$elements[3]=new stdClass();
$elements[3]->field="`gse_diarysubcategory`.`category`";
$elements[3]->sort="1";
$elements[3]->header="Category";
$elements[3]->alias="category";

$elements[4]=new stdClass();
$elements[4]->field="`gse_diarysubcategory`.`name`";
$elements[4]->sort="1";
$elements[4]->header="Name";
$elements[4]->alias="name";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_diarysubcategory`");
$this->load->view("json",$data);
}
public function getsinglediarysubcategory()
{
$id=$this->input->get_post("id");
$data["message"]=$this->diarysubcategory_model->getsinglediarysubcategory($id);
$this->load->view("json",$data);
}
function getalldiaryarticle()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`gse_diaryarticle`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements[1]=new stdClass();
$elements[1]->field="`gse_diaryarticle`.`status`";
$elements[1]->sort="1";
$elements[1]->header="Status";
$elements[1]->alias="status";

$elements[2]=new stdClass();
$elements[2]->field="`gse_diaryarticle`.`category`";
$elements[2]->sort="1";
$elements[2]->header="Category";
$elements[2]->alias="category";

$elements[3]=new stdClass();
$elements[3]->field="`gse_diaryarticle`.`subcategory`";
$elements[3]->sort="1";
$elements[3]->header="Sub Category";
$elements[3]->alias="subcategory";

$elements[4]=new stdClass();
$elements[4]->field="`gse_diaryarticle`.`name`";
$elements[4]->sort="1";
$elements[4]->header="Name";
$elements[4]->alias="name";

$elements[5]=new stdClass();
$elements[5]->field="`gse_diaryarticle`.`image`";
$elements[5]->sort="1";
$elements[5]->header="Image";
$elements[5]->alias="image";

$elements[6]=new stdClass();
$elements[6]->field="`gse_diaryarticle`.`timestamp`";
$elements[6]->sort="1";
$elements[6]->header="Timestamp";
$elements[6]->alias="timestamp";

$elements[7]=new stdClass();
$elements[7]->field="`gse_diaryarticle`.`content`";
$elements[7]->sort="1";
$elements[7]->header="Content";
$elements[7]->alias="content";

$elements[8]=new stdClass();
$elements[8]->field="`gse_diaryarticle`.`date`";
$elements[8]->sort="1";
$elements[8]->header="Date";
$elements[8]->alias="date";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_diaryarticle`");
$this->load->view("json",$data);
}
public function getsinglediaryarticle()
{
$id=$this->input->get_post("id");
$data["message"]=$this->diaryarticle_model->getsinglediaryarticle($id);
$this->load->view("json",$data);
}
public function getInTouch()
{
  $data = json_decode(file_get_contents('php://input'), true);
  if(empty($data))
  {
    $data["message"] = 0;
  }
  else
  {
    $firstname=$data['firstname'];
    $lastname=$data['lastname'];
    $email=$data['email'];
    $phone=$data['phone'];
    $location=$data['location'];
    $enquiry=$data['enquiry'];
    $noofpeople=$data['noofpeople'];
    $comment=$data['comment'];
    $category=$data['category'];
    $startdate=$data['date'];
    $enddate=$data['enddate'];
    $data["message"] = $this->restapi_model->getInTouch($firstname, $lastname, $email, $phone,$location,$enquiry,$noofpeople,$comment,$category,$startdate,$enddate);
  }

  $this->load->view("json", $data);
}
public function getMovieDetails()
{
$data["message"]=$this->restapi_model->getMovieDetails($id);
$this->load->view("json",$data);
}

public function getMovieInside()
{
$id=$this->input->get('id');
$data["message"]=$this->restapi_model->getMovieInside($id);
$this->load->view("json",$data);
}

public function getWeddingDetails()
{
$id=$this->input->get('id');
$data["message"]=$this->restapi_model->getWeddingDetails($id);
$this->load->view("json",$data);
}
public function getWeddingInsideDetails()
{
$id=$this->input->get('id');
$data["message"]=$this->restapi_model->getWeddingInsideDetails($id);
$this->load->view("json",$data);
}

public function getWeddingInsideBanner()
{
  $id=$this->input->get('id');
$data["message"]=$this->restapi_model->getWeddingInsideBanner($id);
$this->load->view("json",$data);
}
public function getWeddingImagesVideos()
{
  $id=$this->input->get('id');
$data["message"]=$this->restapi_model->getWeddingImagesVideos($id);
$this->load->view("json",$data);
}
public function getWeddingInside()
{
  $id=$this->input->get('id');
  $elements=array();
  $elements[0]=new stdClass();
  $elements[0]->field="`gse_weddingsubtype`.`id`";
  $elements[0]->sort="1";
  $elements[0]->header="ID";
  $elements[0]->alias="id";
  $elements[1]=new stdClass();
  $elements[1]->field="`gse_weddingsubtype`.`name`";
  $elements[1]->sort="1";
  $elements[1]->header="Name";
  $elements[1]->alias="name";
  $elements[2]=new stdClass();
  $elements[2]->field="`gse_weddingsubtype`.`image`";
  $elements[2]->sort="1";
  $elements[2]->header="Image";
  $elements[2]->alias="image";
  $elements[3]=new stdClass();
  $elements[3]->field="`gse_weddingsubtype`.`wedding`";
  $elements[3]->sort="1";
  $elements[3]->header="Wedding";
  $elements[3]->alias="wedding";
  $elements[4]=new stdClass();
  $elements[4]->field="`gse_weddingsubtype`.`content`";
  $elements[4]->sort="1";
  $elements[4]->header="Content";
  $elements[4]->alias="content";
  $search=$this->input->get_post("search");
  $pageno=$this->input->get_post("pageno");
  $orderby=$this->input->get_post("orderby");
  $orderorder=$this->input->get_post("orderorder");
  $maxrow=$this->input->get_post("maxrow");
  if($maxrow=="")
  {
  }
  if($orderby=="")
  {
  $orderby="id";
  $orderorder="ASC";
  }
  $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_weddingsubtype`","WHERE `gse_weddingsubtype`.`wedding`='$id'");
  $this->load->view("json",$data);
}

public function getEvents()
{
$data["message"]=$this->restapi_model->getEvents();
$this->load->view("json",$data);
}
public function getEventInsideBanner()
{
$id=$this->input->get('id');
$data["message"]=$this->restapi_model->getEventInsideBanner($id);
$this->load->view("json",$data);
}

public function getEventInside()
{
    $where = ' WHERE 1 ';
    $id = $this->input->get_post('id');
    $this->chintantable->createelement('`id`', '1', 'ID', 'id');
    $this->chintantable->createelement('`name`', '1', 'name', 'name');
    $this->chintantable->createelement('`image`', '0', 'image', 'image');
    $this->chintantable->createelement('`content`', '0', 'content', 'content');
    $this->chintantable->createelement('`date`', '0', 'date', 'date');
    $this->chintantable->createelement('`location`', '0', 'location', 'location');
    $this->chintantable->createelement('`order`', '0', 'order', 'order');
    $search = $this->input->get_post('search');
    $pageno = $this->input->get_post('pageno');
    $orderby = $this->input->get_post('orderby');
    $orderorder = $this->input->get_post('orderorder');
    $maxrow = $this->input->get_post('maxrow');
    if ($maxrow == '') {
        $maxrow = 20;
    }
    if ($orderby == '') {
        $orderby = 'id';
        $orderorder = 'DESC';
    }

    if ($id != '') {
        $where = " WHERE `event` = '$id'";
    }
    $data['message'] = $this->chintantable->query($pageno, $maxrow, $orderby, $orderorder, $search, $elements, 'FROM `gse_eventsubtype`', $where, '' );

    $this->load->view('json', $data);
}
public function getEventInsideDetails()
{
$id=$this->input->get('id');
$data["message"]=$this->restapi_model->getEventInsideDetails($id);
$this->load->view("json",$data);
}
public function getMice()
{
$data["message"]=$this->restapi_model->getMices();
$this->load->view("json",$data);
}
public function getMiceInsideBanner()
{
$id=$this->input->get('id');
$data["message"]=$this->restapi_model->getMiceInsideBanner($id);
$this->load->view("json",$data);
}

public function getMiceInside()
{
    $where = ' WHERE 1 ';
    $id = $this->input->get_post('id');
    $this->chintantable->createelement('`id`', '1', 'ID', 'id');
    $this->chintantable->createelement('`name`', '1', 'name', 'name');
    $this->chintantable->createelement('`image`', '0', 'image', 'image');
    $this->chintantable->createelement('`content`', '0', 'content', 'content');
    // $this->chintantable->createelement('`date`', '0', 'date', 'date');
    // $this->chintantable->createelement('`location`', '0', 'location', 'location');
    $this->chintantable->createelement('`order`', '0', 'order', 'order');
    $search = $this->input->get_post('search');
    $pageno = $this->input->get_post('pageno');
    $orderby = $this->input->get_post('orderby');
    $orderorder = $this->input->get_post('orderorder');
    $maxrow = $this->input->get_post('maxrow');
    if ($maxrow == '') {
        $maxrow = 20;
    }
    if ($orderby == '') {
        $orderby = 'id';
        $orderorder = 'DESC';
    }

    if ($id != '') {
        $where = " WHERE `mice` = '$id'";
    }
    $data['message'] = $this->chintantable->query($pageno, $maxrow, $orderby, $orderorder, $search, $elements, 'FROM `gse_micesubtype`', $where, '' );

    $this->load->view('json', $data);
}
public function getMiceInsideDetails()
{
$id=$this->input->get('id');
$data["message"]=$this->restapi_model->getMiceInsideDetails($id);
$this->load->view("json",$data);
}
public function getWorldTour()
{
$data["message"]=$this->restapi_model->getWorldTour();
$this->load->view("json",$data);
}
public function getWorldTourInsideBanner()
{
$id=$this->input->get('id');
$data["message"]=$this->restapi_model->getWorldTourInsideBanner($id);
$this->load->view("json",$data);
}

public function getWorldTourInside()
{
    $where = ' WHERE 1 ';
    $id = $this->input->get_post('id');
    $this->chintantable->createelement('`id`', '1', 'ID', 'id');
    $this->chintantable->createelement('`name`', '1', 'name', 'name');
    $this->chintantable->createelement('`image`', '0', 'image', 'image');
    $this->chintantable->createelement('`content`', '0', 'content', 'content');
    $this->chintantable->createelement('`date`', '0', 'date', 'date');
    $this->chintantable->createelement('`location`', '0', 'location', 'location');
    $this->chintantable->createelement('`order`', '0', 'order', 'order');
    $search = $this->input->get_post('search');
    $pageno = $this->input->get_post('pageno');
    $orderby = $this->input->get_post('orderby');
    $orderorder = $this->input->get_post('orderorder');
    $maxrow = $this->input->get_post('maxrow');
    if ($maxrow == '') {
        $maxrow = 20;
    }
    if ($orderby == '') {
        $orderby = 'id';
        $orderorder = 'DESC';
    }

    if ($id != '') {
        $where = " WHERE `event` = '$id'";
    }
    $data['message'] = $this->chintantable->query($pageno, $maxrow, $orderby, $orderorder, $search, $elements, 'FROM `gse_eventsubtype`', $where, '' );

    $this->load->view('json', $data);
}
public function getWorldTourInsideDetails()
{
$id=$this->input->get('id');
$data["message"]=$this->restapi_model->getWorldTourInsideDetails($id);
$this->load->view("json",$data);
}
public function getMediaCorner()
{
// $year=$this->input->get('year');
$data["message"]=$this->restapi_model->getMediaCorner();
$this->load->view("json",$data);
}

public function getMediaCornerDetails()
{
    $where = ' WHERE 1 ';
    $year = $this->input->get_post('year');
    $this->chintantable->createelement('`id`', '1', 'ID', 'id');
    $this->chintantable->createelement('`name`', '1', 'name', 'name');
    $this->chintantable->createelement('`image`', '0', 'image', 'image');
    $this->chintantable->createelement('`medianame`', '0', 'medianame', 'medianame');
    $this->chintantable->createelement('`date`', '0', 'date', 'date');
    $this->chintantable->createelement('`url`', '0', 'url', 'url');
    $this->chintantable->createelement('`facebook`', '0', 'facebook', 'facebook');
    $this->chintantable->createelement('`twitter`', '0', 'twitter', 'twitter');
    $this->chintantable->createelement('`message`', '0', 'message', 'message');
    $search = $this->input->get_post('search');
    $pageno = $this->input->get_post('pageno');
    $orderby = $this->input->get_post('orderby');
    $orderorder = $this->input->get_post('orderorder');
    $maxrow = $this->input->get_post('maxrow');
    if ($maxrow == '') {
        $maxrow = 20;
    }
    if ($orderby == '') {
        $orderby = 'date';
        $orderorder = 'DESC';
    }

    if ($year != '') {
        $where = " WHERE year(date) = '$year'";
    }
    $data['message'] = $this->chintantable->query($pageno, $maxrow, $orderby, $orderorder, $search, $elements, 'FROM `gse_mediacorner`', $where, '' );

    $this->load->view('json', $data);
}

public function getSport()
{
// $id=$this->input->get('id');
$data["message"]=$this->restapi_model->getSport();
$this->load->view("json",$data);
}

public function getSportInside()
{
    $where = ' WHERE 1 ';
    $sportscategory = $this->input->get_post('sportscategory');
    $this->chintantable->createelement('`id`', '1', 'ID', 'id');
    $this->chintantable->createelement('`name`', '1', 'name', 'name');
    $this->chintantable->createelement('`image`', '0', 'image', 'image');
    $this->chintantable->createelement('`sportscategory`', '0', 'sportscategory', 'sportscategory');
    $this->chintantable->createelement('`date`', '0', 'date', 'date');
    $this->chintantable->createelement('`link`', '0', 'link', 'link');
    $this->chintantable->createelement('`location`', '0', 'location', 'location');
    $this->chintantable->createelement('`content`', '0', 'content', 'content');
    $this->chintantable->createelement('`videos`', '0', 'videos', 'videos');
    $search = $this->input->get_post('search');
    $pageno = $this->input->get_post('pageno');
    $orderby = $this->input->get_post('orderby');
    $orderorder = $this->input->get_post('orderorder');
    $maxrow = $this->input->get_post('maxrow');
    if ($maxrow == '') {
        $maxrow = 20;
    }
    if ($orderby == '') {
        $orderby = 'date';
        $orderorder = 'DESC';
    }
$cdate = date("Y-m-d");
    if ($sportscategory != '') {
        $where = " WHERE sportscategory = '$sportscategory' AND date <= '$cdate'";
    }

    $data['message'] = $this->chintantable->query($pageno, $maxrow, $orderby, $orderorder, $search, $elements, 'FROM `gse_highlight`', $where, '' );

    $this->load->view('json', $data);
}

public function getSportsDetail()
{
  $id=$this->input->get('id');
  $data["message"]=$this->restapi_model->getSportsDetail($id);
  $this->load->view("json",$data);
}
public function getasfcSportsDetail()
{
  $id=$this->input->get('id');
  $data["message"]=$this->restapi_model->getasfcSportsDetail($id);
  $this->load->view("json",$data);
}
public function getpfhSportsDetail()
{
  $id=$this->input->get('id');
  $data["message"]=$this->restapi_model->getpfhSportsDetail($id);
  $this->load->view("json",$data);
}
public function getSportsDetailInside()
{
  $id=$this->input->get('id');
  $data["message"]=$this->restapi_model->getSportsDetailInside($id);
  $this->load->view("json",$data);
}
public function getHome()
{
// $id=$this->input->get('id');
$data["message"]=$this->restapi_model->getHome();
$this->load->view("json",$data);
}
public function subscribeSubmit()
{
  $email=$this->input->get('email');
  $data["message"]=$this->restapi_model->subscribeSubmit($email);
  $this->load->view("json",$data);
}
public function getTalent()
{
// $id=$this->input->get('id');
$data["message"]=$this->restapi_model->getTalent();
$this->load->view("json",$data);
}

} ?>
