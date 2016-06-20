<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Site extends CI_Controller
{
	public function __construct( )
	{
		parent::__construct();

		$this->is_logged_in();
	}
	function is_logged_in( )
	{
		$is_logged_in = $this->session->userdata( 'logged_in' );
		if ( $is_logged_in !== 'true' || !isset( $is_logged_in ) ) {
			redirect( base_url() . 'index.php/login', 'refresh' );
		} //$is_logged_in !== 'true' || !isset( $is_logged_in )
	}
	function checkaccess($access)
	{
		$accesslevel=$this->session->userdata('accesslevel');
		if(!in_array($accesslevel,$access))
			redirect( base_url() . 'index.php/site?alerterror=You do not have access to this page. ', 'refresh' );
	}
    public function getOrderingDone()
    {
        $orderby=$this->input->get("orderby");
        $ids=$this->input->get("ids");
        $ids=explode(",",$ids);
        $tablename=$this->input->get("tablename");
        $where=$this->input->get("where");
        if($where == "" || $where=="undefined")
        {
            $where=1;
        }
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $i=1;
        foreach($ids as $id)
        {
            //echo "UPDATE `$tablename` SET `$orderby` = '$i' WHERE `id` = `$id` AND $where";
            $this->db->query("UPDATE `$tablename` SET `$orderby` = '$i' WHERE `id` = '$id' AND $where");
            $i++;
            //echo "/n";
        }
        $data["message"]=true;
        $this->load->view("json",$data);

    }
	public function index()
	{
		$access = array("1","2");
		$this->checkaccess($access);
		$data[ 'page' ] = 'dashboard';
		$data[ 'title' ] = 'Welcome';
		$this->load->view( 'template', $data );
	}
	public function createuser()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['accesslevel']=$this->user_model->getaccesslevels();
		$data[ 'status' ] =$this->user_model->getstatusdropdown();
		$data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
        $data['gender']=$this->user_model->getgenderdropdown();
//        $data['category']=$this->category_model->getcategorydropdown();
		$data[ 'page' ] = 'createuser';
		$data[ 'title' ] = 'Create User';
		$this->load->view( 'template', $data );
	}
	function createusersubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('name','Name','trim|required|max_length[30]');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[user.email]');
		$this->form_validation->set_rules('password','Password','trim|required|min_length[6]|max_length[30]');
		$this->form_validation->set_rules('confirmpassword','Confirm Password','trim|required|matches[password]');
		$this->form_validation->set_rules('accessslevel','Accessslevel','trim');
		$this->form_validation->set_rules('status','status','trim|');
		$this->form_validation->set_rules('socialid','Socialid','trim');
		$this->form_validation->set_rules('logintype','logintype','trim');
		$this->form_validation->set_rules('json','json','trim');
		if($this->form_validation->run() == FALSE)
		{
			$data['alerterror'] = validation_errors();
            $data['gender']=$this->user_model->getgenderdropdown();
			$data['accesslevel']=$this->user_model->getaccesslevels();
            $data[ 'status' ] =$this->user_model->getstatusdropdown();
            $data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
            $data[ 'page' ] = 'createuser';
            $data[ 'title' ] = 'Create User';
            $this->load->view( 'template', $data );
		}
		else
		{
            $name=$this->input->post('name');
            $email=$this->input->post('email');
            $password=$this->input->post('password');
            $accesslevel=$this->input->post('accesslevel');
            $status=$this->input->post('status');
            $socialid=$this->input->post('socialid');
            $logintype=$this->input->post('logintype');
            $json=$this->input->post('json');
            $firstname=$this->input->post('firstname');
            $lastname=$this->input->post('lastname');
            $phone=$this->input->post('phone');
            $billingaddress=$this->input->post('billingaddress');
            $billingcity=$this->input->post('billingcity');
            $billingstate=$this->input->post('billingstate');
            $billingcountry=$this->input->post('billingcountry');
            $billingpincode=$this->input->post('billingpincode');
            $billingcontact=$this->input->post('billingcontact');

            $shippingaddress=$this->input->post('shippingaddress');
            $shippingcity=$this->input->post('shippingcity');
            $shippingstate=$this->input->post('shippingstate');
            $shippingcountry=$this->input->post('shippingcountry');
            $shippingpincode=$this->input->post('shippingpincode');
            $shippingcontact=$this->input->post('shippingcontact');
            $shippingname=$this->input->post('shippingname');
            $currency=$this->input->post('currency');
            $credit=$this->input->post('credit');
            $companyname=$this->input->post('companyname');
            $registrationno=$this->input->post('registrationno');
            $vatnumber=$this->input->post('vatnumber');
            $country=$this->input->post('country');
            $fax=$this->input->post('fax');
            $gender=$this->input->post('gender');

            $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];

                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r);
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }

			}

			if($this->user_model->create($name,$email,$password,$accesslevel,$status,$socialid,$logintype,$image,$json,$firstname,$lastname,$phone,$billingaddress,$billingcity,$billingstate,$billingcountry,$billingpincode,$billingcontact,$shippingaddress,$shippingcity,$shippingstate,$shippingcountry,$shippingpincode,$shippingcontact,$shippingname,$currency,$credit,$companyname,$registrationno,$vatnumber,$country,$fax,$gender)==0)
			$data['alerterror']="New user could not be created.";
			else
			$data['alertsuccess']="User created Successfully.";
			$data['redirect']="site/viewusers";
			$this->load->view("redirect",$data);
		}
	}
    function viewusers()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['page']='viewusers';
        $data['base_url'] = site_url("site/viewusersjson");

		$data['title']='View Users';
		$this->load->view('template',$data);
	}
    function viewusersjson()
	{
		$access = array("1");
		$this->checkaccess($access);


        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`user`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";


        $elements[1]=new stdClass();
        $elements[1]->field="`user`.`name`";
        $elements[1]->sort="1";
        $elements[1]->header="Name";
        $elements[1]->alias="name";

        $elements[2]=new stdClass();
        $elements[2]->field="`user`.`email`";
        $elements[2]->sort="1";
        $elements[2]->header="Email";
        $elements[2]->alias="email";

        $elements[3]=new stdClass();
        $elements[3]->field="`user`.`socialid`";
        $elements[3]->sort="1";
        $elements[3]->header="SocialId";
        $elements[3]->alias="socialid";

        $elements[4]=new stdClass();
        $elements[4]->field="`user`.`logintype`";
        $elements[4]->sort="1";
        $elements[4]->header="Logintype";
        $elements[4]->alias="logintype";

        $elements[5]=new stdClass();
        $elements[5]->field="`user`.`json`";
        $elements[5]->sort="1";
        $elements[5]->header="Json";
        $elements[5]->alias="json";

        $elements[6]=new stdClass();
        $elements[6]->field="`accesslevel`.`name`";
        $elements[6]->sort="1";
        $elements[6]->header="Accesslevel";
        $elements[6]->alias="accesslevelname";

        $elements[7]=new stdClass();
        $elements[7]->field="`statuses`.`name`";
        $elements[7]->sort="1";
        $elements[7]->header="Status";
        $elements[7]->alias="status";


        $search=$this->input->get_post("search");
        $pageno=$this->input->get_post("pageno");
        $orderby=$this->input->get_post("orderby");
        $orderorder=$this->input->get_post("orderorder");
        $maxrow=$this->input->get_post("maxrow");
        if($maxrow=="")
        {
            $maxrow=20;
        }

        if($orderby=="")
        {
            $orderby="id";
            $orderorder="ASC";
        }

        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `user` LEFT OUTER JOIN `logintype` ON `logintype`.`id`=`user`.`logintype` LEFT OUTER JOIN `accesslevel` ON `accesslevel`.`id`=`user`.`accesslevel` LEFT OUTER JOIN `statuses` ON `statuses`.`id`=`user`.`status`");

		$this->load->view("json",$data);
	}


	function edituser()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data[ 'status' ] =$this->user_model->getstatusdropdown();
        $data["before1"]=$this->input->get('id');
        $data["before2"]=$this->input->get('id');
        $data["before3"]=$this->input->get('id');
        $data["before4"]=$this->input->get('id');
        $data["before5"]=$this->input->get('id');
		$data['accesslevel']=$this->user_model->getaccesslevels();
		$data['gender']=$this->user_model->getgenderdropdown();
		$data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
		$data['before']=$this->user_model->beforeedit($this->input->get('id'));
		$data['page']='edituser';
		$data['page2']='block/userblock';
		$data['title']='Edit User';
		$this->load->view('templatewith2',$data);
	}
	function editusersubmit()
	{
		$access = array("1");
		$this->checkaccess($access);

		$this->form_validation->set_rules('name','Name','trim|required|max_length[30]');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email');
		$this->form_validation->set_rules('password','Password','trim|min_length[6]|max_length[30]');
		$this->form_validation->set_rules('confirmpassword','Confirm Password','trim|matches[password]');
		$this->form_validation->set_rules('accessslevel','Accessslevel','trim');
		$this->form_validation->set_rules('status','status','trim|');
		$this->form_validation->set_rules('socialid','Socialid','trim');
		$this->form_validation->set_rules('logintype','logintype','trim');
		$this->form_validation->set_rules('json','json','trim');
		if($this->form_validation->run() == FALSE)
		{
			$data['alerterror'] = validation_errors();
			$data[ 'status' ] =$this->user_model->getstatusdropdown();
            $data['gender']=$this->user_model->getgenderdropdown();
			$data['accesslevel']=$this->user_model->getaccesslevels();
            $data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
			$data['before']=$this->user_model->beforeedit($this->input->post('id'));
			$data['page']='edituser';
//			$data['page2']='block/userblock';
			$data['title']='Edit User';
			$this->load->view('template',$data);
		}
		else
		{

            $id=$this->input->get_post('id');
            $name=$this->input->get_post('name');
            $email=$this->input->get_post('email');
            $password=$this->input->get_post('password');
            $accesslevel=$this->input->get_post('accesslevel');
            $status=$this->input->get_post('status');
            $socialid=$this->input->get_post('socialid');
            $logintype=$this->input->get_post('logintype');
            $json=$this->input->get_post('json');
//            $category=$this->input->get_post('category');
            $firstname=$this->input->post('firstname');
            $lastname=$this->input->post('lastname');
            $phone=$this->input->post('phone');
            $billingaddress=$this->input->post('billingaddress');
            $billingcity=$this->input->post('billingcity');
            $billingstate=$this->input->post('billingstate');
            $billingcountry=$this->input->post('billingcountry');
            $billingpincode=$this->input->post('billingpincode');
            $billingcontact=$this->input->post('billingcontact');

            $shippingaddress=$this->input->post('shippingaddress');
            $shippingcity=$this->input->post('shippingcity');
            $shippingstate=$this->input->post('shippingstate');
            $shippingcountry=$this->input->post('shippingcountry');
            $shippingpincode=$this->input->post('shippingpincode');
            $shippingcontact=$this->input->post('shippingcontact');
            $shippingname=$this->input->post('shippingname');
            $currency=$this->input->post('currency');
            $credit=$this->input->post('credit');
            $companyname=$this->input->post('companyname');
            $registrationno=$this->input->post('registrationno');
            $vatnumber=$this->input->post('vatnumber');
            $country=$this->input->post('country');
            $fax=$this->input->post('fax');
            $gender=$this->input->post('gender');
            $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];

                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r);
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }

			}

            if($image=="")
            {
            $image=$this->user_model->getuserimagebyid($id);
               // print_r($image);
                $image=$image->image;
            }

			if($this->user_model->edit($id,$name,$email,$password,$accesslevel,$status,$socialid,$logintype,$image,$json,$firstname,$lastname,$phone,$billingaddress,$billingcity,$billingstate,$billingcountry,$billingpincode,$billingcontact,$shippingaddress,$shippingcity,$shippingstate,$shippingcountry,$shippingpincode,$shippingcontact,$shippingname,$currency,$credit,$companyname,$registrationno,$vatnumber,$country,$fax,$gender)==0)
			$data['alerterror']="User Editing was unsuccesful";
			else
			$data['alertsuccess']="User edited Successfully.";

			$data['redirect']="site/viewusers";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);

		}
	}

	function deleteuser()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->user_model->deleteuser($this->input->get('id'));
//		$data['table']=$this->user_model->viewusers();
		$data['alertsuccess']="User Deleted Successfully";
		$data['redirect']="site/viewusers";
			//$data['other']="template=$template";
		$this->load->view("redirect",$data);
	}
	function changeuserstatus()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->user_model->changestatus($this->input->get('id'));
		$data['table']=$this->user_model->viewusers();
		$data['alertsuccess']="Status Changed Successfully";
		$data['redirect']="site/viewusers";
        $data['other']="template=$template";
        $this->load->view("redirect",$data);
	}
    public function viewcart()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewcart";
    $data["before1"]=$this->input->get('id');
        $data["before2"]=$this->input->get('id');
        $data["before3"]=$this->input->get('id');
        $data["before4"]=$this->input->get('id');
        $data["before5"]=$this->input->get('id');
$data['page2']='block/userblock';
$data["base_url"]=site_url("site/viewcartjson?id=").$this->input->get('id');
$data["title"]="View cart";
$this->load->view("templatewith2",$data);
}
function viewcartjson()
{
    $id=$this->input->get('id');
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`fynx_cart`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`fynx_cart`.`user`";
$elements[1]->sort="1";
$elements[1]->header="User";
$elements[1]->alias="user";
$elements[2]=new stdClass();
$elements[2]->field="`fynx_cart`.`quantity`";
$elements[2]->sort="1";
$elements[2]->header="Quantity";
$elements[2]->alias="quantity";
$elements[3]=new stdClass();
$elements[3]->field="`fynx_cart`.`product`";
$elements[3]->sort="1";
$elements[3]->header="Product";
$elements[3]->alias="product";
$elements[4]=new stdClass();
$elements[4]->field="`fynx_cart`.`timestamp`";
$elements[4]->sort="1";
$elements[4]->header="Timestamp";
$elements[4]->alias="timestamp";

$elements[5]=new stdClass();
$elements[5]->field="`fynx_cart`.`size`";
$elements[5]->sort="1";
$elements[5]->header="Size";
$elements[5]->alias="size";

$elements[6]=new stdClass();
$elements[6]->field="`fynx_cart`.`color`";
$elements[6]->sort="1";
$elements[6]->header="Color";
$elements[6]->alias="color";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `fynx_cart`","WHERE `fynx_cart`.`user`='$id'");
$this->load->view("json",$data);
}
    public function viewwishlist()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewwishlist";
    $data["before1"]=$this->input->get('id');
        $data["before2"]=$this->input->get('id');
        $data["before3"]=$this->input->get('id');
        $data["before4"]=$this->input->get('id');
        $data["before5"]=$this->input->get('id');
$data['page2']='block/userblock';
$data["base_url"]=site_url("site/viewwishlistjson?id=".$this->input->get('id'));
$data["title"]="View wishlist";
$this->load->view("templatewith2",$data);
}
function viewwishlistjson()
{
    $user=$this->input->get('id');
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`fynx_wishlist`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`fynx_wishlist`.`user`";
$elements[1]->sort="1";
$elements[1]->header="User";
$elements[1]->alias="user";
$elements[2]=new stdClass();
$elements[2]->field="`fynx_wishlist`.`product`";
$elements[2]->sort="1";
$elements[2]->header="Product";
$elements[2]->alias="product";
$elements[3]=new stdClass();
$elements[3]->field="`fynx_wishlist`.`timestamp`";
$elements[3]->sort="1";
$elements[3]->header="Timestamp";
$elements[3]->alias="timestamp";

$elements[4]=new stdClass();
$elements[4]->field="`fynx_product`.`name`";
$elements[4]->sort="1";
$elements[4]->header="Product Name";
$elements[4]->alias="productname";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `fynx_wishlist` LEFT OUTER JOIN `fynx_product` ON `fynx_product`.`id`=`fynx_wishlist`.`product`","WHERE `fynx_wishlist`.`user`='$user'");
$this->load->view("json",$data);
}




public function viewgeneralenquiry()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewgeneralenquiry";
$data["base_url"]=site_url("site/viewgeneralenquiryjson");
$data["title"]="View generalenquiry";
$this->load->view("template",$data);
}
function viewgeneralenquiryjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`gse_generalenquiry`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`gse_generalenquiry`.`firstname`";
$elements[1]->sort="1";
$elements[1]->header="First Name";
$elements[1]->alias="firstname";
$elements[2]=new stdClass();
$elements[2]->field="`gse_generalenquiry`.`middlename`";
$elements[2]->sort="1";
$elements[2]->header="Middle Name";
$elements[2]->alias="middlename";
$elements[3]=new stdClass();
$elements[3]->field="`gse_generalenquiry`.`lastname`";
$elements[3]->sort="1";
$elements[3]->header="Last Name";
$elements[3]->alias="lastname";
$elements[4]=new stdClass();
$elements[4]->field="`gse_generalenquiry`.`companyname`";
$elements[4]->sort="1";
$elements[4]->header="Company Name";
$elements[4]->alias="companyname";
$elements[5]=new stdClass();
$elements[5]->field="`gse_generalenquiry`.`email`";
$elements[5]->sort="1";
$elements[5]->header="Email";
$elements[5]->alias="email";
$elements[6]=new stdClass();
$elements[6]->field="`gse_generalenquiry`.`phone`";
$elements[6]->sort="1";
$elements[6]->header="Phone";
$elements[6]->alias="phone";
$elements[7]=new stdClass();
$elements[7]->field="`gse_generalenquiry`.`webaddress`";
$elements[7]->sort="1";
$elements[7]->header="Web Address";
$elements[7]->alias="webaddress";
$elements[8]=new stdClass();
$elements[8]->field="`gse_generalenquiry`.`message`";
$elements[8]->sort="1";
$elements[8]->header="Message";
$elements[8]->alias="message";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_generalenquiry`");
$this->load->view("json",$data);
}

public function creategeneralenquiry()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="creategeneralenquiry";
$data["title"]="Create generalenquiry";
$this->load->view("template",$data);
}
public function creategeneralenquirysubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("firstname","First Name","trim");
$this->form_validation->set_rules("middlename","Middle Name","trim");
$this->form_validation->set_rules("lastname","Last Name","trim");
$this->form_validation->set_rules("companyname","Company Name","trim");
$this->form_validation->set_rules("email","Email","trim");
$this->form_validation->set_rules("phone","Phone","trim");
$this->form_validation->set_rules("webaddress","Web Address","trim");
$this->form_validation->set_rules("message","Message","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="creategeneralenquiry";
$data["title"]="Create generalenquiry";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$firstname=$this->input->get_post("firstname");
$middlename=$this->input->get_post("middlename");
$lastname=$this->input->get_post("lastname");
$companyname=$this->input->get_post("companyname");
$email=$this->input->get_post("email");
$phone=$this->input->get_post("phone");
$webaddress=$this->input->get_post("webaddress");
$message=$this->input->get_post("message");
if($this->generalenquiry_model->create($firstname,$middlename,$lastname,$companyname,$email,$phone,$webaddress,$message)==0)
$data["alerterror"]="New generalenquiry could not be created.";
else
$data["alertsuccess"]="generalenquiry created Successfully.";
$data["redirect"]="site/viewgeneralenquiry";
$this->load->view("redirect",$data);
}
}
public function editgeneralenquiry()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editgeneralenquiry";
$data["title"]="Edit generalenquiry";
$data["before"]=$this->generalenquiry_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editgeneralenquirysubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("firstname","First Name","trim");
$this->form_validation->set_rules("middlename","Middle Name","trim");
$this->form_validation->set_rules("lastname","Last Name","trim");
$this->form_validation->set_rules("companyname","Company Name","trim");
$this->form_validation->set_rules("email","Email","trim");
$this->form_validation->set_rules("phone","Phone","trim");
$this->form_validation->set_rules("webaddress","Web Address","trim");
$this->form_validation->set_rules("message","Message","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editgeneralenquiry";
$data["title"]="Edit generalenquiry";
$data["before"]=$this->generalenquiry_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$firstname=$this->input->get_post("firstname");
$middlename=$this->input->get_post("middlename");
$lastname=$this->input->get_post("lastname");
$companyname=$this->input->get_post("companyname");
$email=$this->input->get_post("email");
$phone=$this->input->get_post("phone");
$webaddress=$this->input->get_post("webaddress");
$message=$this->input->get_post("message");
if($this->generalenquiry_model->edit($id,$firstname,$middlename,$lastname,$companyname,$email,$phone,$webaddress,$message)==0)
$data["alerterror"]="New generalenquiry could not be Updated.";
else
$data["alertsuccess"]="generalenquiry Updated Successfully.";
$data["redirect"]="site/viewgeneralenquiry";
$this->load->view("redirect",$data);
}
}
public function deletegeneralenquiry()
{
$access=array("1");
$this->checkaccess($access);
$this->generalenquiry_model->delete($this->input->get("id"));
$data["redirect"]="site/viewgeneralenquiry";
$this->load->view("redirect",$data);
}
public function viewproposedproject()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewproposedproject";
$data["base_url"]=site_url("site/viewproposedprojectjson");
$data["title"]="View proposedproject";
$this->load->view("template",$data);
}
function viewproposedprojectjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`gse_proposedproject`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`gse_proposedproject`.`name`";
$elements[1]->sort="1";
$elements[1]->header="Name";
$elements[1]->alias="name";
$elements[2]=new stdClass();
$elements[2]->field="`gse_proposedproject`.`company`";
$elements[2]->sort="1";
$elements[2]->header="Company";
$elements[2]->alias="company";
$elements[3]=new stdClass();
$elements[3]->field="`gse_proposedproject`.`webaddress`";
$elements[3]->sort="1";
$elements[3]->header="Web Address";
$elements[3]->alias="webaddress";
$elements[4]=new stdClass();
$elements[4]->field="`gse_proposedproject`.`country`";
$elements[4]->sort="1";
$elements[4]->header="Country";
$elements[4]->alias="country";
$elements[5]=new stdClass();
$elements[5]->field="`gse_proposedproject`.`phone`";
$elements[5]->sort="1";
$elements[5]->header="Phone";
$elements[5]->alias="phone";
$elements[6]=new stdClass();
$elements[6]->field="`gse_proposedproject`.`email`";
$elements[6]->sort="1";
$elements[6]->header="Email";
$elements[6]->alias="email";
$elements[7]=new stdClass();
$elements[7]->field="`gse_proposedproject`.`question1ans`";
$elements[7]->sort="1";
$elements[7]->header="Question 1 Ans";
$elements[7]->alias="question1ans";
$elements[8]=new stdClass();
$elements[8]->field="`gse_proposedproject`.`question2ans`";
$elements[8]->sort="1";
$elements[8]->header="Question 2 Ans";
$elements[8]->alias="question2ans";
$elements[9]=new stdClass();
$elements[9]->field="`gse_proposedproject`.`question3ans`";
$elements[9]->sort="1";
$elements[9]->header="Question 3 Ans";
$elements[9]->alias="question3ans";
$elements[10]=new stdClass();
$elements[10]->field="`gse_proposedproject`.`content`";
$elements[10]->sort="1";
$elements[10]->header="Content";
$elements[10]->alias="content";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_proposedproject`");
$this->load->view("json",$data);
}

public function createproposedproject()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createproposedproject";
$data["title"]="Create proposedproject";
$this->load->view("template",$data);
}
public function createproposedprojectsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("company","Company","trim");
$this->form_validation->set_rules("webaddress","Web Address","trim");
$this->form_validation->set_rules("country","Country","trim");
$this->form_validation->set_rules("phone","Phone","trim");
$this->form_validation->set_rules("email","Email","trim");
$this->form_validation->set_rules("question1ans","Question 1 Ans","trim");
$this->form_validation->set_rules("question2ans","Question 2 Ans","trim");
$this->form_validation->set_rules("question3ans","Question 3 Ans","trim");
$this->form_validation->set_rules("content","Content","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createproposedproject";
$data["title"]="Create proposedproject";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$name=$this->input->get_post("name");
$company=$this->input->get_post("company");
$webaddress=$this->input->get_post("webaddress");
$country=$this->input->get_post("country");
$phone=$this->input->get_post("phone");
$email=$this->input->get_post("email");
$question1ans=$this->input->get_post("question1ans");
$question2ans=$this->input->get_post("question2ans");
$question3ans=$this->input->get_post("question3ans");
$content=$this->input->get_post("content");
if($this->proposedproject_model->create($name,$company,$webaddress,$country,$phone,$email,$question1ans,$question2ans,$question3ans,$content)==0)
$data["alerterror"]="New proposedproject could not be created.";
else
$data["alertsuccess"]="proposedproject created Successfully.";
$data["redirect"]="site/viewproposedproject";
$this->load->view("redirect",$data);
}
}
public function editproposedproject()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editproposedproject";
$data["title"]="Edit proposedproject";
$data["before"]=$this->proposedproject_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editproposedprojectsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("company","Company","trim");
$this->form_validation->set_rules("webaddress","Web Address","trim");
$this->form_validation->set_rules("country","Country","trim");
$this->form_validation->set_rules("phone","Phone","trim");
$this->form_validation->set_rules("email","Email","trim");
$this->form_validation->set_rules("question1ans","Question 1 Ans","trim");
$this->form_validation->set_rules("question2ans","Question 2 Ans","trim");
$this->form_validation->set_rules("question3ans","Question 3 Ans","trim");
$this->form_validation->set_rules("content","Content","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editproposedproject";
$data["title"]="Edit proposedproject";
$data["before"]=$this->proposedproject_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$name=$this->input->get_post("name");
$company=$this->input->get_post("company");
$webaddress=$this->input->get_post("webaddress");
$country=$this->input->get_post("country");
$phone=$this->input->get_post("phone");
$email=$this->input->get_post("email");
$question1ans=$this->input->get_post("question1ans");
$question2ans=$this->input->get_post("question2ans");
$question3ans=$this->input->get_post("question3ans");
$content=$this->input->get_post("content");
if($this->proposedproject_model->edit($id,$name,$company,$webaddress,$country,$phone,$email,$question1ans,$question2ans,$question3ans,$content)==0)
$data["alerterror"]="New proposedproject could not be Updated.";
else
$data["alertsuccess"]="proposedproject Updated Successfully.";
$data["redirect"]="site/viewproposedproject";
$this->load->view("redirect",$data);
}
}
public function deleteproposedproject()
{
$access=array("1");
$this->checkaccess($access);
$this->proposedproject_model->delete($this->input->get("id"));
$data["redirect"]="site/viewproposedproject";
$this->load->view("redirect",$data);
}
public function viewmovie()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewmovie";
$data["page2"]="block/movieblock";
$data["movie"]=$this->moviedetail_model->getdropdown();
$data["before1"]=$this->input->get('id');
$data["before2"]=$this->input->get('id');
$data["before3"]=$this->input->get('id');
$data["before4"]=$this->input->get('id');
$data["base_url"]=site_url("site/viewmoviejson?id=").$this->input->get('id');
$data["title"]="View movie";
$this->load->view("templatewith2",$data);
}
function viewmoviejson()
{
    $id=$this->input->get('id');
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`gse_movie`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`gse_movie`.`content`";
$elements[1]->sort="1";
$elements[1]->header="Url";
$elements[1]->alias="content";

$elements[2]=new stdClass();
$elements[2]->field="`gse_movie`.`movie`";
$elements[2]->sort="1";
$elements[2]->header="Movie";
$elements[2]->alias="movie";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_movie`","WHERE `gse_movie`.`movie`='$id'");
$this->load->view("json",$data);
}

public function createmovie()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createmovie";
$data["page2"]="block/movieblock";
$data["movie"]=$this->moviedetail_model->getdropdown();
$data["before1"]=$this->input->get('id');
$data["before2"]=$this->input->get('id');
$data["before3"]=$this->input->get('id');
$data["before4"]=$this->input->get('id');
$data["title"]="Create movie";
$this->load->view("templatewith2",$data);
}
public function createmoviesubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("content","Content","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["movie"]=$this->moviedetail_model->getdropdown();
$data["page"]="createmovie";
$data["title"]="Create movie";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$content=$this->input->get_post("content");
$movie=$this->input->get_post("movie");
if($this->movie_model->create($content,$movie)==0)
$data["alerterror"]="New movie could not be created.";
else
$data["alertsuccess"]="movie created Successfully.";
$data["redirect"]="site/viewmovie?id=".$movie;
$this->load->view("redirect2",$data);
}
}
public function editmovie()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editmovie";
$data["page2"]="block/movieblock";
$data["before1"]=$this->input->get('movieid');
$data["movie"]=$this->moviedetail_model->getdropdown();
$data["before2"]=$this->input->get('movieid');
$data["before3"]=$this->input->get('movieid');
$data["before4"]=$this->input->get('movieid');
$data["title"]="Edit movie";
$data["before"]=$this->movie_model->beforeedit($this->input->get("id"));
$this->load->view("templatewith2",$data);
}
public function editmoviesubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("content","Content","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["movie"]=$this->moviedetail_model->getdropdown();
$data["page"]="editmovie";
$data["title"]="Edit movie";
$data["before"]=$this->movie_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$content=$this->input->get_post("content");
$movie=$this->input->get_post("movie");
if($this->movie_model->edit($id,$content,$movie)==0)
$data["alerterror"]="New movie could not be Updated.";
else
$data["alertsuccess"]="movie Updated Successfully.";
$data["redirect"]="site/viewmovie?id=".$movie;
$this->load->view("redirect2",$data);
}
}
public function deletemovie()
{
$access=array("1");
$this->checkaccess($access);
$this->movie_model->delete($this->input->get("id"));
$data["redirect"]="site/viewmovie?id=".$this->input->get('movieid');
$this->load->view("redirect2",$data);
}
public function viewmoviedetail()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewmoviedetail";
$data["base_url"]=site_url("site/viewmoviedetailjson");
$data["title"]="View moviedetail";
$this->load->view("template",$data);
}
function viewmoviedetailjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`gse_moviedetail`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`gse_moviedetail`.`isupcoming`";
$elements[1]->sort="1";
$elements[1]->header="Is upcoming";
$elements[1]->alias="isupcoming";
$elements[2]=new stdClass();
$elements[2]->field="`gse_moviedetail`.`isreleased`";
$elements[2]->sort="1";
$elements[2]->header="Is released";
$elements[2]->alias="isreleased";
$elements[3]=new stdClass();
$elements[3]->field="`gse_moviedetail`.`name`";
$elements[3]->sort="1";
$elements[3]->header="Name";
$elements[3]->alias="name";
$elements[4]=new stdClass();
$elements[4]->field="`gse_moviedetail`.`banner`";
$elements[4]->sort="1";
$elements[4]->header="Banner";
$elements[4]->alias="banner";
$elements[5]=new stdClass();
$elements[5]->field="`gse_moviedetail`.`imdb`";
$elements[5]->sort="1";
$elements[5]->header="Imdb";
$elements[5]->alias="imdb";
$elements[6]=new stdClass();
$elements[6]->field="`gse_moviedetail`.`producer`";
$elements[6]->sort="1";
$elements[6]->header="Producer";
$elements[6]->alias="producer";
$elements[7]=new stdClass();
$elements[7]->field="`gse_moviedetail`.`director`";
$elements[7]->sort="1";
$elements[7]->header="Director";
$elements[7]->alias="director";
$elements[8]=new stdClass();
$elements[8]->field="`gse_moviedetail`.`cast`";
$elements[8]->sort="1";
$elements[8]->header="Cast";
$elements[8]->alias="cast";
$elements[9]=new stdClass();
$elements[9]->field="`gse_moviedetail`.`music`";
$elements[9]->sort="1";
$elements[9]->header="Music";
$elements[9]->alias="music";
$elements[10]=new stdClass();
$elements[10]->field="`gse_moviedetail`.`synopsis`";
$elements[10]->sort="1";
$elements[10]->header="Synopsis";
$elements[10]->alias="synopsis";
$elements[11]=new stdClass();
$elements[11]->field="`gse_moviedetail`.`videos`";
$elements[11]->sort="1";
$elements[11]->header="Videos";
$elements[11]->alias="videos";
$elements[12]=new stdClass();
$elements[12]->field="`gse_moviedetail`.`releasedate`";
$elements[12]->sort="1";
$elements[12]->header="Release Date";
$elements[12]->alias="releasedate";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_moviedetail`");
$this->load->view("json",$data);
}

public function createmoviedetail()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createmoviedetail";
$data["isupcoming"]=$this->moviedetail_model->getisupomingdropdown();
$data["isreleased"]=$this->moviedetail_model->getisupomingdropdown();
$data["title"]="Create moviedetail";
$this->load->view("template",$data);
}
public function createmoviedetailsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("isupcoming","Is upcoming","trim");
$this->form_validation->set_rules("isreleased","Is released","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("banner","Banner","trim");
$this->form_validation->set_rules("imdb","Imdb","trim");
$this->form_validation->set_rules("producer","Producer","trim");
$this->form_validation->set_rules("director","Director","trim");
$this->form_validation->set_rules("cast","Cast","trim");
$this->form_validation->set_rules("music","Music","trim");
$this->form_validation->set_rules("synopsis","Synopsis","trim");
$this->form_validation->set_rules("videos","Videos","trim");
$this->form_validation->set_rules("releasedate","Release Date","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["isupcoming"]=$this->moviedetail_model->getisupomingdropdown();
$data["isreleased"]=$this->moviedetail_model->getisupomingdropdown();
$data["page"]="createmoviedetail";
$data["title"]="Create moviedetail";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$isupcoming=$this->input->get_post("isupcoming");
$isreleased=$this->input->get_post("isreleased");
$name=$this->input->get_post("name");
//$banner=$this->input->get_post("banner");
$imdb=$this->input->get_post("imdb");
$producer=$this->input->get_post("producer");
$director=$this->input->get_post("director");
$cast=$this->input->get_post("cast");
$music=$this->input->get_post("music");
$synopsis=$this->input->get_post("synopsis");
$videos=$this->input->get_post("videos");
$releasedate=$this->input->get_post("releasedate");
    $image=$this->menu_model->createImage();
	$config['upload_path'] = './uploads/';
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$this->load->library('upload', $config);
						$filename="banner";
						$banner="";
						if (  $this->upload->do_upload($filename))
						{
							$uploaddata = $this->upload->data();
							$banner=$uploaddata['file_name'];
						}
if($this->moviedetail_model->create($isupcoming,$isreleased,$name,$banner,$imdb,$producer,$director,$cast,$music,$synopsis,$videos,$releasedate,$image)==0)
$data["alerterror"]="New moviedetail could not be created.";
else
$data["alertsuccess"]="moviedetail created Successfully.";
$data["redirect"]="site/viewmoviedetail";
$this->load->view("redirect",$data);
}
}
public function editmoviedetail()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editmoviedetail";
    $data["isupcoming"]=$this->moviedetail_model->getisupomingdropdown();
$data["isreleased"]=$this->moviedetail_model->getisupomingdropdown();
$data["page2"]="block/movieblock";
$data["before1"]=$this->input->get('id');
$data["before2"]=$this->input->get('id');
$data["before3"]=$this->input->get('id');
$data["before4"]=$this->input->get('id');
$data["title"]="Edit moviedetail";
$data["before"]=$this->moviedetail_model->beforeedit($this->input->get("id"));
$this->load->view("templatewith2",$data);
}
public function editmoviedetailsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("isupcoming","Is upcoming","trim");
$this->form_validation->set_rules("isreleased","Is released","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("banner","Banner","trim");
$this->form_validation->set_rules("imdb","Imdb","trim");
$this->form_validation->set_rules("producer","Producer","trim");
$this->form_validation->set_rules("director","Director","trim");
$this->form_validation->set_rules("cast","Cast","trim");
$this->form_validation->set_rules("music","Music","trim");
$this->form_validation->set_rules("synopsis","Synopsis","trim");
$this->form_validation->set_rules("videos","Videos","trim");
$this->form_validation->set_rules("releasedate","Release Date","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["isupcoming"]=$this->moviedetail_model->getisupomingdropdown();
$data["isreleased"]=$this->moviedetail_model->getisupomingdropdown();
$data["page"]="editmoviedetail";
$data["title"]="Edit moviedetail";
$data["before"]=$this->moviedetail_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$isupcoming=$this->input->get_post("isupcoming");
$isreleased=$this->input->get_post("isreleased");
$name=$this->input->get_post("name");
//$banner=$this->input->get_post("banner");
$imdb=$this->input->get_post("imdb");
$producer=$this->input->get_post("producer");
$director=$this->input->get_post("director");
$cast=$this->input->get_post("cast");
$music=$this->input->get_post("music");
$synopsis=$this->input->get_post("synopsis");
$videos=$this->input->get_post("videos");
$releasedate=$this->input->get_post("releasedate");
 $image=$this->menu_model->createImage();
    $config['upload_path'] = './uploads/';
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$this->load->library('upload', $config);
						$filename="banner";
						$banner="";
						if (  $this->upload->do_upload($filename))
						{
							$uploaddata = $this->upload->data();
							$banner=$uploaddata['file_name'];
						}

						if($banner=="")
						{
						$banner=$this->moviedetail_model->getimagebyid($id);
						   // print_r($image);
							$banner=$banner->banner;
						}
if($this->moviedetail_model->edit($id,$isupcoming,$isreleased,$name,$banner,$imdb,$producer,$director,$cast,$music,$synopsis,$videos,$releasedate,$image)==0)
$data["alerterror"]="New moviedetail could not be Updated.";
else
$data["alertsuccess"]="moviedetail Updated Successfully.";
$data["redirect"]="site/viewmoviedetail";
$this->load->view("redirect",$data);
}
}
public function deletemoviedetail()
{
$access=array("1");
$this->checkaccess($access);
$this->moviedetail_model->delete($this->input->get("id"));
$data["redirect"]="site/viewmoviedetail";
$this->load->view("redirect",$data);
}
public function viewmoviegallery()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewmoviegallery";
$data["page2"]="block/movieblock";
$data["before1"]=$this->input->get('id');
$data["before2"]=$this->input->get('id');
$data["before3"]=$this->input->get('id');
$data["before4"]=$this->input->get('id');
$data["base_url"]=site_url("site/viewmoviegalleryjson?id=").$this->input->get('id');
$data["title"]="View moviegallery";
$this->load->view("templatewith2",$data);
}
function viewmoviegalleryjson()
{
     $id=$this->input->get('id');
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`gse_moviegallery`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`gse_moviegallery`.`movie`";
$elements[1]->sort="1";
$elements[1]->header="movie";
$elements[1]->alias="movie";
$elements[2]=new stdClass();
$elements[2]->field="`gse_moviegallery`.`order`";
$elements[2]->sort="1";
$elements[2]->header="Order";
$elements[2]->alias="order";
$elements[3]=new stdClass();
$elements[3]->field="`gse_moviegallery`.`status`";
$elements[3]->sort="1";
$elements[3]->header="Status";
$elements[3]->alias="status";
$elements[4]=new stdClass();
$elements[4]->field="`gse_moviegallery`.`image`";
$elements[4]->sort="1";
$elements[4]->header="Image";
$elements[4]->alias="image";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_moviegallery`","WHERE `gse_moviegallery`.`movie`='$id'");
$this->load->view("json",$data);
}

public function createmoviegallery()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createmoviegallery";
$data["page2"]="block/movieblock";
$data["before1"]=$this->input->get('id');
$data["before2"]=$this->input->get('id');
$data["before3"]=$this->input->get('id');
$data["before4"]=$this->input->get('id');
$data["before4"]=$this->input->get('id');
$data["movie"]=$this->moviedetail_model->getdropdown();
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["title"]="Create moviegallery";
$this->load->view("templatewith2",$data);
}
public function createmoviegallerysubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("movie","movie","trim");
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("image","Image","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createmoviegallery";
$data["title"]="Create moviegallery";
$data["movie"]=$this->moviedetail_model->getdropdown();
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$movie=$this->input->get_post("movie");
$order=$this->input->get_post("order");
$status=$this->input->get_post("status");
$image=$this->menu_model->createImage();
if($this->moviegallery_model->create($movie,$order,$status,$image)==0)
$data["alerterror"]="New moviegallery could not be created.";
else
$data["alertsuccess"]="moviegallery created Successfully.";
$data["redirect"]="site/viewmoviegallery?id=".$movie;
$this->load->view("redirect2",$data);
}
}
public function editmoviegallery()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editmoviegallery";
$data["title"]="Edit moviegallery";
$data["before"]=$this->moviegallery_model->beforeedit($this->input->get("id"));
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["movie"]=$this->moviedetail_model->getdropdown();
$this->load->view("template",$data);
}
public function editmoviegallerysubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("movie","movie","trim");
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("image","Image","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editmoviegallery";
$data["title"]="Edit moviegallery";
$data["before"]=$this->moviegallery_model->beforeedit($this->input->get("id"));
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["movie"]=$this->moviedetail_model->getdropdown();
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$movie=$this->input->get_post("movie");
$order=$this->input->get_post("order");
$status=$this->input->get_post("status");
$image=$this->menu_model->createImage();
if($this->moviegallery_model->edit($id,$movie,$order,$status,$image)==0)
$data["alerterror"]="New moviegallery could not be Updated.";
else
$data["alertsuccess"]="moviegallery Updated Successfully.";
$data["redirect"]="site/viewmoviegallery?id=".$movie;
$this->load->view("redirect2",$data);
}
}
public function deletemoviegallery()
{
$access=array("1");
$this->checkaccess($access);
$this->moviegallery_model->delete($this->input->get("id"));
$data["redirect"]="site/viewmoviegallery?id=".$this->input->get("movieid");
$this->load->view("redirect2",$data);
}
public function viewmoviewallpaper()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewmoviewallpaper";
$data["page2"]="block/movieblock";
$data["before1"]=$this->input->get('id');
$data["before2"]=$this->input->get('id');
$data["before3"]=$this->input->get('id');
$data["before4"]=$this->input->get('id');
$data["base_url"]=site_url("site/viewmoviewallpaperjson?id=").$this->input->get('id');
$data["title"]="View moviewallpaper";
$this->load->view("templatewith2",$data);
}
function viewmoviewallpaperjson()
{
     $id=$this->input->get('id');
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`gse_moviewallpaper`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`gse_moviewallpaper`.`movie`";
$elements[1]->sort="1";
$elements[1]->header="movie";
$elements[1]->alias="movie";
$elements[2]=new stdClass();
$elements[2]->field="`gse_moviewallpaper`.`image`";
$elements[2]->sort="1";
$elements[2]->header="Image";
$elements[2]->alias="image";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_moviewallpaper`","WHERE `gse_moviewallpaper`.`movie`='$id'");
$this->load->view("json",$data);
}

public function createmoviewallpaper()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createmoviewallpaper";
$data["page2"]="block/movieblock";
$data["before1"]=$this->input->get('id');
$data["before2"]=$this->input->get('id');
$data["before3"]=$this->input->get('id');
$data["before4"]=$this->input->get('id');
$data["before4"]=$this->input->get('id');
$data["movie"]=$this->moviedetail_model->getdropdown();
$data["title"]="Create moviewallpaper";
$this->load->view("templatewith2",$data);
}
public function createmoviewallpapersubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("movie","movie","trim");
$this->form_validation->set_rules("image","Image","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createmoviewallpaper";
$data["title"]="Create moviewallpaper";
$data["movie"]=$this->moviedetail_model->getdropdown();
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$movie=$this->input->get_post("movie");
$image=$this->menu_model->createImage();
if($this->moviewallpaper_model->create($movie,$image)==0)
$data["alerterror"]="New moviewallpaper could not be created.";
else
$data["alertsuccess"]="moviewallpaper created Successfully.";
$data["redirect"]="site/viewmoviewallpaper?id=".$movie;
$this->load->view("redirect2",$data);
}
}
public function editmoviewallpaper()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editmoviewallpaper";
$data["title"]="Edit moviewallpaper";
$data["movie"]=$this->moviedetail_model->getdropdown();
$data["before"]=$this->moviewallpaper_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editmoviewallpapersubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("movie","movie","trim");
$this->form_validation->set_rules("image","Image","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editmoviewallpaper";
$data["title"]="Edit moviewallpaper";
$data["movie"]=$this->moviedetail_model->getdropdown();
$data["before"]=$this->moviewallpaper_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$movie=$this->input->get_post("movie");
$image=$this->menu_model->createImage();
if($this->moviewallpaper_model->edit($id,$movie,$image)==0)
$data["alerterror"]="New moviewallpaper could not be Updated.";
else
$data["alertsuccess"]="moviewallpaper Updated Successfully.";
$data["redirect"]="site/viewmoviewallpaper?id=".$movie;
$this->load->view("redirect2",$data);
}
}
public function deletemoviewallpaper()
{
$access=array("1");
$this->checkaccess($access);
$this->moviewallpaper_model->delete($this->input->get("id"));
$data["redirect"]="site/viewmoviewallpaper?id=".$this->input->get("movieid");
$this->load->view("redirect2",$data);
}
public function viewaward()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewaward";
$data["page2"]="block/movieblock";
$data["before1"]=$this->input->get('id');
$data["before2"]=$this->input->get('id');
$data["before3"]=$this->input->get('id');
$data["before4"]=$this->input->get('id');
$data["base_url"]=site_url("site/viewawardjson?id=").$this->input->get('id');
$data["title"]="View award";
$this->load->view("templatewith2",$data);
}
function viewawardjson()
{
    $id=$this->input->get('id');
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`gse_award`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`gse_award`.`movie`";
$elements[1]->sort="1";
$elements[1]->header="Movie";
$elements[1]->alias="movie";
$elements[2]=new stdClass();
$elements[2]->field="`gse_award`.`name`";
$elements[2]->sort="1";
$elements[2]->header="Name";
$elements[2]->alias="name";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_award`","WHERE `gse_award`.`movie`='$id'");
$this->load->view("json",$data);
}

public function createaward()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createaward";
$data["page2"]="block/movieblock";
$data["before1"]=$this->input->get('id');
$data["before2"]=$this->input->get('id');
$data["before3"]=$this->input->get('id');
$data["before4"]=$this->input->get('id');
$data["movie"]=$this->moviedetail_model->getdropdown();
$data["title"]="Create award";
$this->load->view("templatewith2",$data);
}
public function createawardsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("movie","Movie","trim");
$this->form_validation->set_rules("name","Name","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createaward";
$data["title"]="Create award";
$data["movie"]=$this->moviedetail_model->getdropdown();
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$movie=$this->input->get_post("movie");
$name=$this->input->get_post("name");
if($this->award_model->create($movie,$name)==0)
$data["alerterror"]="New award could not be created.";
else
$data["alertsuccess"]="award created Successfully.";
$data["redirect"]="site/viewaward?id=".$movie;
$this->load->view("redirect2",$data);
}
}
public function editaward()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editaward";
$data["page2"]="block/awardblock";
$data["title"]="Edit award";
$data["before1"]=$this->input->get("id");
$data["before2"]=$this->input->get("movieid");
$data["movie"]=$this->moviedetail_model->getdropdown();
$data["before"]=$this->award_model->beforeedit($this->input->get("id"));
$this->load->view("templatewith2",$data);
}
public function editawardsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("movie","Movie","trim");
$this->form_validation->set_rules("name","Name","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editaward";
$data["title"]="Edit award";
$data["movie"]=$this->moviedetail_model->getdropdown();
$data["before"]=$this->award_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$movie=$this->input->get_post("movie");
$name=$this->input->get_post("name");
if($this->award_model->edit($id,$movie,$name)==0)
$data["alerterror"]="New award could not be Updated.";
else
$data["alertsuccess"]="award Updated Successfully.";
$data["redirect"]="site/viewaward?id=".$movie;
$this->load->view("redirect2",$data);
}
}
public function deleteaward()
{
$access=array("1");
$this->checkaccess($access);
$this->award_model->delete($this->input->get("id"));
$data["redirect"]="site/viewaward?id=".$this->input->get("movieid");
$this->load->view("redirect2",$data);
}
public function viewawarddetail()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewawarddetail";
$data["page2"]="block/movieblock";
$data["before1"]=$this->input->get('id');
$data["before2"]=$this->input->get('id');
$data["before3"]=$this->input->get('id');
$data["before4"]=$this->input->get('id');
$data["base_url"]=site_url("site/viewawarddetailjson?id=").$this->input->get('id');
$data["title"]="View awarddetail";
$this->load->view("templatewith2",$data);
}
function viewawarddetailjson()
{
    $id=$this->input->get('id');
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`gse_awarddetail`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`gse_awarddetail`.`award`";
$elements[1]->sort="1";
$elements[1]->header="Award";
$elements[1]->alias="award";
$elements[2]=new stdClass();
$elements[2]->field="`gse_awarddetail`.`awardname`";
$elements[2]->sort="1";
$elements[2]->header="Award Name";
$elements[2]->alias="awardname";
$elements[3]=new stdClass();
$elements[3]->field="`gse_awarddetail`.`awardreceiver`";
$elements[3]->sort="1";
$elements[3]->header="Award Receiver";
$elements[3]->alias="awardreceiver";
$elements[4]=new stdClass();
$elements[4]->field="`gse_awarddetail`.`winnername`";
$elements[4]->sort="1";
$elements[4]->header="Winner Name";
$elements[4]->alias="winnername";

$elements[5]=new stdClass();
$elements[5]->field="`gse_awarddetail`.`movie`";
$elements[5]->sort="1";
$elements[5]->header="movie";
$elements[5]->alias="movie";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_awarddetail`","WHERE `gse_awarddetail`.`movie`='$id'");
$this->load->view("json",$data);
}

public function createawarddetail()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createawarddetail";
$data["page2"]="block/movieblock";
$data["before1"]=$this->input->get('id');
$data["before2"]=$this->input->get('id');
$data["before3"]=$this->input->get('id');
$data["before4"]=$this->input->get('id');
$data["award"]=$this->award_model->getdropdown();
$data["movie"]=$this->moviedetail_model->getdropdown();
$data["title"]="Create awarddetail";
$this->load->view("templatewith2",$data);
}
public function createawarddetailsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("award","Award","trim");
$this->form_validation->set_rules("awardname","Award Name","trim");
$this->form_validation->set_rules("awardreceiver","Award Receiver","trim");
$this->form_validation->set_rules("winnername","Winner Name","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createawarddetail";
$data["award"]=$this->award_model->getdropdown();
$data["movie"]=$this->moviedetail_model->getdropdown();
$data["title"]="Create awarddetail";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$award=$this->input->get_post("award");
$awardname=$this->input->get_post("awardname");
$awardreceiver=$this->input->get_post("awardreceiver");
$winnername=$this->input->get_post("winnername");
$movie=$this->input->get_post("movie");
if($this->awarddetail_model->create($award,$awardname,$awardreceiver,$winnername,$movie)==0)
$data["alerterror"]="New awarddetail could not be created.";
else
$data["alertsuccess"]="awarddetail created Successfully.";
$data["redirect"]="site/viewawarddetail?id=".$movie;
$this->load->view("redirect2",$data);
}
}
public function editawarddetail()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editawarddetail";
$data["page2"]="block/movieblock";
$data["before1"]=$this->input->get('id');
$data["before2"]=$this->input->get('id');
$data["before3"]=$this->input->get('id');
$data["before4"]=$this->input->get('id');
$data["award"]=$this->award_model->getdropdown();
$data["movie"]=$this->moviedetail_model->getdropdown();
$data["title"]="Edit awarddetail";
$data["before"]=$this->awarddetail_model->beforeedit($this->input->get("id"));
$this->load->view("templatewith2",$data);
}
public function editawarddetailsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("award","Award","trim");
$this->form_validation->set_rules("awardname","Award Name","trim");
$this->form_validation->set_rules("awardreceiver","Award Receiver","trim");
$this->form_validation->set_rules("winnername","Winner Name","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editawarddetail";
$data["award"]=$this->award_model->getdropdown();
$data["movie"]=$this->moviedetail_model->getdropdown();
$data["title"]="Edit awarddetail";
$data["before"]=$this->awarddetail_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$award=$this->input->get_post("award");
$awardname=$this->input->get_post("awardname");
$awardreceiver=$this->input->get_post("awardreceiver");
$winnername=$this->input->get_post("winnername");
    $movie=$this->input->get_post("movie");
if($this->awarddetail_model->edit($id,$award,$awardname,$awardreceiver,$winnername,$movie)==0)
$data["alerterror"]="New awarddetail could not be Updated.";
else
$data["alertsuccess"]="awarddetail Updated Successfully.";
$data["redirect"]="site/viewawarddetail?id=".$movie;
$this->load->view("redirect2",$data);
}
}
public function deleteawarddetail()
{
$access=array("1");
$this->checkaccess($access);
$this->awarddetail_model->delete($this->input->get("id"));
$data["redirect"]="site/viewawarddetail?id=".$this->input->get("movieid");
$this->load->view("redirect2",$data);
}
public function viewwedding()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewwedding";
$data["base_url"]=site_url("site/viewweddingjson");
$data["title"]="View wedding";
$this->load->view("template",$data);
}
function viewweddingjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`gse_wedding`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`gse_wedding`.`name`";
$elements[1]->sort="1";
$elements[1]->header="Name";
$elements[1]->alias="name";
$elements[2]=new stdClass();
$elements[2]->field="`gse_wedding`.`image`";
$elements[2]->sort="1";
$elements[2]->header="Image";
$elements[2]->alias="image";

$elements[3]=new stdClass();
$elements[3]->field="`gse_wedding`.`banner`";
$elements[3]->sort="1";
$elements[3]->header="Banner";
$elements[3]->alias="banner";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_wedding`");
$this->load->view("json",$data);
}

public function createwedding()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createwedding";
$data["title"]="Create wedding";
$this->load->view("template",$data);
}
public function createweddingsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("name","Name","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createwedding";
$data["title"]="Create wedding";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$name=$this->input->get_post("name");
$image=$this->menu_model->createImage();
//$banner=$this->input->get_post("banner");
    $config['upload_path'] = './uploads/';
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$this->load->library('upload', $config);
						$filename="banner";
						$banner="";
						if (  $this->upload->do_upload($filename))
						{
							$uploaddata = $this->upload->data();
							$banner=$uploaddata['file_name'];
						}
if($this->wedding_model->create($name,$image,$banner)==0)
$data["alerterror"]="New wedding could not be created.";
else
$data["alertsuccess"]="wedding created Successfully.";
$data["redirect"]="site/viewwedding";
$this->load->view("redirect",$data);
}
}
public function editwedding()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editwedding";
$data["page2"]="block/weddingblock";
$data["before1"]=$this->input->get('id');
$data["before2"]=$this->input->get('id');
$data["before3"]=$this->input->get('id');
$data["before4"]=$this->input->get('id');
$data["title"]="Edit wedding";
$data["before"]=$this->wedding_model->beforeedit($this->input->get("id"));
$this->load->view("templatewith2",$data);
}
public function editweddingsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("name","Name","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editwedding";
$data["title"]="Edit wedding";
$data["before"]=$this->wedding_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$name=$this->input->get_post("name");
$image=$this->menu_model->createImage();
//$banner=$this->input->get_post("banner");
     $config['upload_path'] = './uploads/';
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$this->load->library('upload', $config);
						$filename="banner";
						$banner="";
						if (  $this->upload->do_upload($filename))
						{
							$uploaddata = $this->upload->data();
							$banner=$uploaddata['file_name'];
						}

						if($banner=="")
						{
						$banner=$this->wedding_model->getbannerbyid($id);
						   // print_r($image);
							$banner=$banner->banner;
						}
if($this->wedding_model->edit($id,$name,$image,$banner)==0)
$data["alerterror"]="New wedding could not be Updated.";
else
$data["alertsuccess"]="wedding Updated Successfully.";
$data["redirect"]="site/viewwedding";
$this->load->view("redirect",$data);
}
}
public function deletewedding()
{
$access=array("1");
$this->checkaccess($access);
$this->wedding_model->delete($this->input->get("id"));
$data["redirect"]="site/viewwedding";
$this->load->view("redirect",$data);
}
public function viewevent()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewevent";
$data["base_url"]=site_url("site/vieweventjson");
$data["title"]="View event";
$this->load->view("template",$data);
}
function vieweventjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`gse_event`.`id`";
$elements[0]->sort="1";
$elements[0]->header="id";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`gse_event`.`name`";
$elements[1]->sort="1";
$elements[1]->header="name";
$elements[1]->alias="name";
$elements[2]=new stdClass();
$elements[2]->field="`gse_event`.`image`";
$elements[2]->sort="1";
$elements[2]->header="image";
$elements[2]->alias="image";
$elements[3]=new stdClass();
$elements[3]->field="`gse_event`.`banner`";
$elements[3]->sort="1";
$elements[3]->header="banner";
$elements[3]->alias="banner";
$elements[4]=new stdClass();
$elements[4]->field="`gse_event`.`order`";
$elements[4]->sort="1";
$elements[4]->header="order";
$elements[4]->alias="order";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_event`");
$this->load->view("json",$data);
}

public function createevent()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createevent";
$data["title"]="Create event";
$this->load->view("template",$data);
}
public function createeventsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("name","Name","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createevent";
$data["title"]="Create event";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$name=$this->input->get_post("name");
$order=$this->input->get_post("order");
$image=$this->menu_model->createImage();
//$banner=$this->input->get_post("banner");
    $config['upload_path'] = './uploads/';
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$this->load->library('upload', $config);
						$filename="banner";
						$banner="";
						if (  $this->upload->do_upload($filename))
						{
							$uploaddata = $this->upload->data();
							$banner=$uploaddata['file_name'];
						}
if($this->event_model->create($name,$image,$banner,$order)==0)
$data["alerterror"]="New event could not be created.";
else
$data["alertsuccess"]="event created Successfully.";
$data["redirect"]="site/viewevent";
$this->load->view("redirect",$data);
}
}
public function editevent()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editevent";
$data["page2"]="block/eventblock";
$data["before1"]=$this->input->get('id');
$data["before2"]=$this->input->get('id');
$data["before3"]=$this->input->get('id');
$data["before4"]=$this->input->get('id');
$data["title"]="Edit event";
$data["before"]=$this->event_model->beforeedit($this->input->get("id"));
$this->load->view("templatewith2",$data);
}
public function editeventsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("name","Name","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editevent";
$data["title"]="Edit event";
$data["before"]=$this->event_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$name=$this->input->get_post("name");
$order=$this->input->get_post("order");
$image=$this->menu_model->createImage();
//$banner=$this->input->get_post("banner");
     $config['upload_path'] = './uploads/';
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$this->load->library('upload', $config);
						$filename="banner";
						$banner="";
						if (  $this->upload->do_upload($filename))
						{
							$uploaddata = $this->upload->data();
							$banner=$uploaddata['file_name'];
						}

						if($banner=="")
						{
						$banner=$this->event_model->getbannerbyid($id);
						   // print_r($image);
							$banner=$banner->banner;
						}
if($this->event_model->edit($id,$name,$image,$banner,$order)==0)
$data["alerterror"]="New event could not be Updated.";
else
$data["alertsuccess"]="event Updated Successfully.";
$data["redirect"]="site/viewevent";
$this->load->view("redirect",$data);
}
}
public function deleteevent()
{
$access=array("1");
$this->checkaccess($access);
$this->event_model->delete($this->input->get("id"));
$data["redirect"]="site/viewevent";
$this->load->view("redirect",$data);
}
public function viewservice()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewservice";
$data["base_url"]=site_url("site/viewservicejson");
$data["title"]="View service";
$this->load->view("template",$data);
}
function viewservicejson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`gse_service`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`gse_service`.`name`";
$elements[1]->sort="1";
$elements[1]->header="Name";
$elements[1]->alias="name";
$elements[2]=new stdClass();
$elements[2]->field="`gse_service`.`content`";
$elements[2]->sort="1";
$elements[2]->header="Content";
$elements[2]->alias="content";

$elements[3]=new stdClass();
$elements[3]->field="`gse_service`.`type`";
$elements[3]->sort="1";
$elements[3]->header="Type";
$elements[3]->alias="type";

$elements[4]=new stdClass();
$elements[4]->field="`gse_service`.`order`";
$elements[4]->sort="1";
$elements[4]->header="Order";
$elements[4]->alias="order";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_service`");
$this->load->view("json",$data);
}

public function createservice()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createservice";
$data["type"]=$this->service_model->getservicetypedropdown();
$data["title"]="Create service";
$this->load->view("template",$data);
}
public function createservicesubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("content","Content","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createservice";
$data["type"]=$this->service_model->getservicetypedropdown();
$data["title"]="Create service";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$name=$this->input->get_post("name");
$content=$this->input->get_post("content");
$type=$this->input->get_post("type");
$order=$this->input->get_post("order");
if($this->service_model->create($name,$content,$type,$order)==0)
$data["alerterror"]="New service could not be created.";
else
$data["alertsuccess"]="service created Successfully.";
$data["redirect"]="site/viewservice";
$this->load->view("redirect",$data);
}
}
public function editservice()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editservice";
$data["title"]="Edit service";
$data["type"]=$this->service_model->getservicetypedropdown();
$data["before"]=$this->service_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editservicesubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("content","Content","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editservice";
$data["title"]="Edit service";
$data["type"]=$this->service_model->getservicetypedropdown();
$data["before"]=$this->service_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$name=$this->input->get_post("name");
$content=$this->input->get_post("content");
$type=$this->input->get_post("type");
$order=$this->input->get_post("order");
if($this->service_model->edit($id,$name,$content,$type,$order)==0)
$data["alerterror"]="New service could not be Updated.";
else
$data["alertsuccess"]="service Updated Successfully.";
$data["redirect"]="site/viewservice";
$this->load->view("redirect",$data);
}
}
public function deleteservice()
{
$access=array("1");
$this->checkaccess($access);
$this->service_model->delete($this->input->get("id"));
$data["redirect"]="site/viewservice";
$this->load->view("redirect",$data);
}
public function viewweddingtype()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewweddingtype";
$data["page2"]="block/weddingblock";
$data["before1"]=$this->input->get('id');
$data["before2"]=$this->input->get('id');
$data["before3"]=$this->input->get('id');
$data["before4"]=$this->input->get('id');
$data["base_url"]=site_url("site/viewweddingtypejson?id=").$this->input->get('id');
$data["title"]="View weddingtype";
$this->load->view("templatewith2",$data);
}
function viewweddingtypejson()
{
    $id=$this->input->get('id');
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`gse_weddingtype`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`gse_weddingtype`.`wedding`";
$elements[1]->sort="1";
$elements[1]->header="Wedding";
$elements[1]->alias="wedding";
$elements[2]=new stdClass();
$elements[2]->field="`gse_weddingtype`.`name`";
$elements[2]->sort="1";
$elements[2]->header="Url";
$elements[2]->alias="name";
$elements[3]=new stdClass();
$elements[3]->field="`gse_weddingtype`.`image`";
$elements[3]->sort="1";
$elements[3]->header="Image";
$elements[3]->alias="image";
$elements[4]=new stdClass();
$elements[4]->field="`gse_weddingtype`.`banner`";
$elements[4]->sort="1";
$elements[4]->header="Banner";
$elements[4]->alias="banner";

$elements[5]=new stdClass();
$elements[5]->field="`gse_weddingsubtype`.`name`";
$elements[5]->sort="1";
$elements[5]->header="Wedding Sub Type";
$elements[5]->alias="weddingsubtype";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_weddingtype` LEFT OUTER JOIN `gse_weddingsubtype` ON `gse_weddingsubtype`.`id`=`gse_weddingtype`.`weddingsubtype`","WHERE `gse_weddingtype`.`wedding`='$id'");
$this->load->view("json",$data);
}

public function createweddingtype()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createweddingtype";
// $data["page2"]="block/weddingblock";
// $data["before1"]=$this->input->get('id');
// $data["before2"]=$this->input->get('id');
// $data["before3"]=$this->input->get('id');
// $data["before4"]=$this->input->get('id');
$data["wedding"]=$this->wedding_model->getdropdown();
$data["weddingsubtype"]=$this->weddingsubtype_model->getdropdown();
$data["title"]="Create weddingtype";
// $this->load->view("templatewith2",$data);
$this->load->view("template",$data);
}
public function createweddingtypesubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("wedding","Wedding","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("image","Image","trim");
$this->form_validation->set_rules("banner","Banner","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createweddingtype";
$data["wedding"]=$this->wedding_model->getdropdown();
$data["weddingsubtype"]=$this->weddingsubtype_model->getdropdown();
$data["title"]="Create weddingtype";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$wedding=$this->input->get_post("wedding");
$weddingsubtype=$this->input->get_post("weddingsubtype");
$name=$this->input->get_post("name");
$image=$this->menu_model->createImage();
//$banner=$this->input->get_post("banner");
    $config['upload_path'] = './uploads/';
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$this->load->library('upload', $config);
						$filename="banner";
						$banner="";
						if (  $this->upload->do_upload($filename))
						{
							$uploaddata = $this->upload->data();
							$banner=$uploaddata['file_name'];
						}
if($this->weddingtype_model->create($wedding,$name,$image,$banner,$weddingsubtype)==0)
$data["alerterror"]="New weddingtype could not be created.";
else
$data["alertsuccess"]="weddingtype created Successfully.";
$data["redirect"]="site/viewweddingtype?id=".$wedding;
$this->load->view("redirect2",$data);
}
}
public function editweddingtype()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editweddingtype";
// $data["page2"]="block/weddingblock";
// $data["before1"]=$this->input->get('id');
// $data["before2"]=$this->input->get('id');
// $data["before3"]=$this->input->get('id');
// $data["before4"]=$this->input->get('id');
$data["wedding"]=$this->wedding_model->getdropdown();
$data["weddingsubtype"]=$this->weddingsubtype_model->getdropdown();
$data["title"]="Edit weddingtype";
$data["before"]=$this->weddingtype_model->beforeedit($this->input->get("id"));
// $this->load->view("templatewith2",$data);
$this->load->view("template",$data);
}
public function editweddingtypesubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("wedding","Wedding","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("image","Image","trim");
$this->form_validation->set_rules("banner","Banner","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editweddingtype";
$data["wedding"]=$this->wedding_model->getdropdown();
$data["weddingsubtype"]=$this->weddingsubtype_model->getdropdown();
$data["title"]="Edit weddingtype";
$data["before"]=$this->weddingtype_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$wedding=$this->input->get_post("wedding");
$name=$this->input->get_post("name");
$weddingsubtype=$this->input->get_post("weddingsubtype");
$image=$this->menu_model->createImage();
//$banner=$this->input->get_post("banner");
     $config['upload_path'] = './uploads/';
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$this->load->library('upload', $config);
						$filename="banner";
						$banner="";
						if (  $this->upload->do_upload($filename))
						{
							$uploaddata = $this->upload->data();
							$banner=$uploaddata['file_name'];
						}

						if($banner=="")
						{
						$banner=$this->weddingtype_model->getbannerbyid($id);
						   // print_r($image);
							$banner=$banner->banner;
						}
if($this->weddingtype_model->edit($id,$wedding,$name,$image,$banner,$weddingsubtype)==0)
$data["alerterror"]="New weddingtype could not be Updated.";
else
$data["alertsuccess"]="weddingtype Updated Successfully.";
$data["redirect"]="site/viewweddingtype?id=".$wedding;
$this->load->view("redirect2",$data);
}
}
public function deleteweddingtype()
{
$access=array("1");
$this->checkaccess($access);
$this->weddingtype_model->delete($this->input->get("id"));
$data["redirect"]="site/viewweddingtype?id=".$this->input->get("weddingid");
$this->load->view("redirect2",$data);
}
public function viewweddingsubtype()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewweddingsubtype";
    $data["page2"]="block/weddingblock";
$data["before1"]=$this->input->get('id');
$data["before2"]=$this->input->get('id');
$data["before3"]=$this->input->get('id');
$data["before4"]=$this->input->get('id');
$data["base_url"]=site_url("site/viewweddingsubtypejson?id=").$this->input->get('id');
$data["title"]="View weddingsubtype";
$this->load->view("templatewith2",$data);
}
function viewweddingsubtypejson()
{
    $id=$this->input->get('id');
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`gse_weddingsubtype`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`gse_weddingsubtype`.`wedding`";
$elements[1]->sort="1";
$elements[1]->header="Wedding";
$elements[1]->alias="wedding";
$elements[2]=new stdClass();
$elements[2]->field="`gse_weddingsubtype`.`name`";
$elements[2]->sort="1";
$elements[2]->header="Name";
$elements[2]->alias="name";
$elements[3]=new stdClass();
$elements[3]->field="`gse_weddingsubtype`.`image`";
$elements[3]->sort="1";
$elements[3]->header="Image";
$elements[3]->alias="image";
$elements[4]=new stdClass();
$elements[4]->field="`gse_weddingsubtype`.`content`";
$elements[4]->sort="1";
$elements[4]->header="Content";
$elements[4]->alias="content";
$elements[5]=new stdClass();
$elements[5]->field="`gse_weddingsubtype`.`videos`";
$elements[5]->sort="1";
$elements[5]->header="Videos";
$elements[5]->alias="videos";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_weddingsubtype`","WHERE `gse_weddingsubtype`.`wedding`='$id'");
$this->load->view("json",$data);
}

public function createweddingsubtype()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createweddingsubtype";
// $data["page2"]="block/weddingblock";
// $data["before1"]=$this->input->get('id');
// $data["before2"]=$this->input->get('id');
// $data["before3"]=$this->input->get('id');
// $data["before4"]=$this->input->get('id');
$data["wedding"]=$this->wedding_model->getdropdown();
$data["title"]="Create weddingsubtype";
// $this->load->view("templatewith2",$data);
$this->load->view("template",$data);
}
public function createweddingsubtypesubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("wedding","Wedding","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("image","Image","trim");
$this->form_validation->set_rules("content","Content","trim");
$this->form_validation->set_rules("videos","Videos","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createweddingsubtype";
$data["title"]="Create weddingsubtype";
$data["wedding"]=$this->wedding_model->getdropdown();
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$wedding=$this->input->get_post("wedding");
$name=$this->input->get_post("name");
$image=$this->menu_model->createImage();
$content=$this->input->get_post("content");
$videos=$this->input->get_post("videos");
$config['upload_path'] = './uploads/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$this->load->library('upload', $config);
				$filename="banner";
				$banner="";
				if (  $this->upload->do_upload($filename))
				{
					$uploaddata = $this->upload->data();
					$banner=$uploaddata['file_name'];
				}
if($this->weddingsubtype_model->create($wedding,$name,$image,$banner,$content,$videos)==0)
$data["alerterror"]="New weddingsubtype could not be created.";
else
$data["alertsuccess"]="weddingsubtype created Successfully.";
$data["redirect"]="site/viewweddingsubtype?id=".$wedding;
$this->load->view("redirect2",$data);
}
}
public function editweddingsubtype()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editweddingsubtype";
// $data["page2"]="block/weddingblock";
// $data["before1"]=$this->input->get('id');
// $data["before2"]=$this->input->get('id');
// $data["before3"]=$this->input->get('id');
// $data["before4"]=$this->input->get('id');
$data["wedding"]=$this->wedding_model->getdropdown();
$data["title"]="Edit weddingsubtype";
$data["before"]=$this->weddingsubtype_model->beforeedit($this->input->get("id"));
// $this->load->view("templatewith2",$data);
$this->load->view("template",$data);
}
public function editweddingsubtypesubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("wedding","Wedding","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("image","Image","trim");
$this->form_validation->set_rules("content","Content","trim");
$this->form_validation->set_rules("videos","Videos","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editweddingsubtype";
$data["title"]="Edit weddingsubtype";
$data["wedding"]=$this->wedding_model->getdropdown();
$data["before"]=$this->weddingsubtype_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$wedding=$this->input->get_post("wedding");
$name=$this->input->get_post("name");
$image=$this->menu_model->createImage();
$content=$this->input->get_post("content");
$videos=$this->input->get_post("videos");
$config['upload_path'] = './uploads/';
			 $config['allowed_types'] = 'gif|jpg|png|jpeg';
			 $this->load->library('upload', $config);
			 $filename="banner";
			 $banner="";
			 if (  $this->upload->do_upload($filename))
			 {
				 $uploaddata = $this->upload->data();
				 $banner=$uploaddata['file_name'];
			 }
			 if($banner=="")
			 {
			 $banner=$this->weddingtype_model->getbannerbyid($id);
					// print_r($image);
				 $banner=$banner->banner;
			 }
if($this->weddingsubtype_model->edit($id,$wedding,$name,$image,$banner,$content,$videos)==0)
$data["alerterror"]="New weddingsubtype could not be Updated.";
else
$data["alertsuccess"]="weddingsubtype Updated Successfully.";
$data["redirect"]="site/viewweddingsubtype?id=".$wedding;
$this->load->view("redirect2",$data);
}
}
public function deleteweddingsubtype()
{
$access=array("1");
$this->checkaccess($access);
$this->weddingsubtype_model->delete($this->input->get("id"));
$data["redirect"]="site/viewweddingsubtype?id=".$this->input->get("weddingid");
$this->load->view("redirect2",$data);
}
public function viewweddinggallery()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewweddinggallery";
$data["page2"]="block/weddingblock";
$data["before1"]=$this->input->get('id');
$data["before2"]=$this->input->get('id');
$data["before3"]=$this->input->get('id');
$data["before4"]=$this->input->get('id');
$data["base_url"]=site_url("site/viewweddinggalleryjson?id=").$this->input->get('id');
$data["title"]="View weddinggallery";
$this->load->view("templatewith2",$data);
}
function viewweddinggalleryjson()
{
    $id=$this->input->get('id');
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`gse_weddinggallery`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`gse_weddinggallery`.`wedding`";
$elements[1]->sort="1";
$elements[1]->header="Wedding";
$elements[1]->alias="wedding";
$elements[2]=new stdClass();
$elements[2]->field="`gse_weddinggallery`.`status`";
$elements[2]->sort="1";
$elements[2]->header="Status";
$elements[2]->alias="status";
$elements[3]=new stdClass();
$elements[3]->field="`gse_weddinggallery`.`order`";
$elements[3]->sort="1";
$elements[3]->header="Order";
$elements[3]->alias="order";
$elements[4]=new stdClass();
$elements[4]->field="`gse_weddinggallery`.`image`";
$elements[4]->sort="1";
$elements[4]->header="Image";
$elements[4]->alias="image";

$elements[5]=new stdClass();
$elements[5]->field="`gse_weddingsubtype`.`name`";
$elements[5]->sort="1";
$elements[5]->header="Wedding Sub Type";
$elements[5]->alias="weddingsubtype";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_weddinggallery` LEFT OUTER JOIN `gse_weddingsubtype` ON `gse_weddingsubtype`.`id`=`gse_weddinggallery`.`weddingsubtype`","WHERE `gse_weddinggallery`.`wedding`='$id'");
$this->load->view("json",$data);
}

public function createweddinggallery()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createweddinggallery";
// $data["page2"]="block/weddingblock";
// $data["before1"]=$this->input->get('id');
// $data["before2"]=$this->input->get('id');
// $data["before3"]=$this->input->get('id');
// $data["before4"]=$this->input->get('id');
$data["wedding"]=$this->wedding_model->getdropdown();
$data["weddingsubtype"]=$this->weddingsubtype_model->getdropdown();
$data["title"]="Create weddinggallery";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
// $this->load->view("templatewith2",$data);
$this->load->view("template",$data);
}
public function createweddinggallerysubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("wedding","Wedding","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("image","Image","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createweddinggallery";
$data["title"]="Create weddinggallery";
$data["wedding"]=$this->wedding_model->getdropdown();
$data["weddingsubtype"]=$this->weddingsubtype_model->getdropdown();
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$wedding=$this->input->get_post("wedding");
$status=$this->input->get_post("status");
$order=$this->input->get_post("order");
$weddingsubtype=$this->input->get_post("weddingsubtype");

$image=$this->menu_model->createImage();
if($this->weddinggallery_model->create($wedding,$status,$order,$image,$weddingsubtype)==0)
$data["alerterror"]="New weddinggallery could not be created.";
else
$data["alertsuccess"]="weddinggallery created Successfully.";
$data["redirect"]="site/viewweddinggallery?id=".$wedding;
$this->load->view("redirect2",$data);
}
}
public function editweddinggallery()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editweddinggallery";
// $data["page2"]="block/weddingblock";
// $data["before1"]=$this->input->get('id');
// $data["before2"]=$this->input->get('id');
// $data["before3"]=$this->input->get('id');
// $data["before4"]=$this->input->get('id');
$data["wedding"]=$this->wedding_model->getdropdown();
$data["weddingsubtype"]=$this->weddingsubtype_model->getdropdown();
$data["title"]="Edit weddinggallery";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["before"]=$this->weddinggallery_model->beforeedit($this->input->get("id"));
// $this->load->view("templatewith2",$data);
$this->load->view("template",$data);
}
public function editweddinggallerysubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("wedding","Wedding","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("image","Image","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editweddinggallery";
$data["title"]="Edit weddinggallery";
$data["wedding"]=$this->wedding_model->getdropdown();
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["weddingsubtype"]=$this->weddingsubtype_model->getdropdown();
$data["before"]=$this->weddinggallery_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$wedding=$this->input->get_post("wedding");
$status=$this->input->get_post("status");
$order=$this->input->get_post("order");
$weddingsubtype=$this->input->get_post("weddingsubtype");
$image=$this->menu_model->createImage();
if($this->weddinggallery_model->edit($id,$wedding,$status,$order,$image,$weddingsubtype)==0)
$data["alerterror"]="New weddinggallery could not be Updated.";
else
$data["alertsuccess"]="weddinggallery Updated Successfully.";
$data["redirect"]="site/viewweddinggallery?id=".$wedding;
$this->load->view("redirect2",$data);
}
}
public function deleteweddinggallery()
{
$access=array("1");
$this->checkaccess($access);
$this->weddinggallery_model->delete($this->input->get("id"));
$data["redirect"]="site/viewweddinggallery?id=".$this->input->get("weddingid");
$this->load->view("redirect2",$data);
}
public function viewtalent()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewtalent";
$data["base_url"]=site_url("site/viewtalentjson");
$data["title"]="View talent";
$this->load->view("template",$data);
}
function viewtalentjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`gse_talent`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`gse_talent`.`name`";
$elements[1]->sort="1";
$elements[1]->header="Name";
$elements[1]->alias="name";
$elements[2]=new stdClass();
$elements[2]->field="`gse_talent`.`image`";
$elements[2]->sort="1";
$elements[2]->header="Image";
$elements[2]->alias="image";
$elements[3]=new stdClass();
$elements[3]->field="`gse_talent`.`link`";
$elements[3]->sort="1";
$elements[3]->header="Link";
$elements[3]->alias="link";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_talent`");
$this->load->view("json",$data);
}

public function createtalent()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createtalent";
$data["title"]="Create talent";
$this->load->view("template",$data);
}
public function createtalentsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("image","Image","trim");
$this->form_validation->set_rules("link","Link","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createtalent";
$data["title"]="Create talent";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$name=$this->input->get_post("name");
$image=$this->menu_model->createImage();
$link=$this->input->get_post("link");
$config['upload_path'] = './uploads/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$this->load->library('upload', $config);
				$filename="banner";
				$banner="";
				if (  $this->upload->do_upload($filename))
				{
					$uploaddata = $this->upload->data();
					$banner=$uploaddata['file_name'];
				}
if($this->talent_model->create($name,$image,$link,$banner)==0)
$data["alerterror"]="New talent could not be created.";
else
$data["alertsuccess"]="talent created Successfully.";
$data["redirect"]="site/viewtalent";
$this->load->view("redirect",$data);
}
}
public function edittalent()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="edittalent";
$data["page2"]="block/talent";
$data["before1"]=$this->input->get('id');
$data["before2"]=$this->input->get('id');
$data["title"]="Edit talent";
$data["before"]=$this->talent_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function edittalentsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("image","Image","trim");
$this->form_validation->set_rules("link","Link","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="edittalent";
$data["title"]="Edit talent";
$data["before"]=$this->talent_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$name=$this->input->get_post("name");
$image=$this->menu_model->createImage();
$link=$this->input->get_post("link");
$config['upload_path'] = './uploads/';
			 $config['allowed_types'] = 'gif|jpg|png|jpeg';
			 $this->load->library('upload', $config);
			 $filename="banner";
			 $banner="";
			 if (  $this->upload->do_upload($filename))
			 {
				 $uploaddata = $this->upload->data();
				 $banner=$uploaddata['file_name'];
			 }

			 if($banner=="")
			 {
			 $banner=$this->event_model->getbannerbyid($id);
					// print_r($image);
				 $banner=$banner->banner;
			 }
if($this->talent_model->edit($id,$name,$image,$link,$banner)==0)
$data["alerterror"]="New talent could not be Updated.";
else
$data["alertsuccess"]="talent Updated Successfully.";
$data["redirect"]="site/viewtalent";
$this->load->view("redirect",$data);
}
}
public function deletetalent()
{
$access=array("1");
$this->checkaccess($access);
$this->talent_model->delete($this->input->get("id"));
$data["redirect"]="site/viewtalent";
$this->load->view("redirect",$data);
}
public function viewtalenttype()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewtalenttype";
$data["page2"]="block/talent";
$data["before1"]=$this->input->get('id');
$data["before2"]=$this->input->get('id');
$data["base_url"]=site_url("site/viewtalenttypejson?id=").$this->input->get('id');
$data["title"]="View talenttype";
$this->load->view("template",$data);
}
function viewtalenttypejson()
{
    $id=$this->input->get('id');
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`gse_talenttype`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`gse_talenttype`.`talent`";
$elements[1]->sort="1";
$elements[1]->header="Talent";
$elements[1]->alias="talent";
$elements[2]=new stdClass();
$elements[2]->field="`gse_talenttype`.`order`";
$elements[2]->sort="1";
$elements[2]->header="Order";
$elements[2]->alias="order";
$elements[3]=new stdClass();
$elements[3]->field="`gse_talenttype`.`status`";
$elements[3]->sort="1";
$elements[3]->header="Status";
$elements[3]->alias="status";
$elements[4]=new stdClass();
$elements[4]->field="`gse_talenttype`.`name`";
$elements[4]->sort="1";
$elements[4]->header="Name";
$elements[4]->alias="name";
$elements[5]=new stdClass();
$elements[5]->field="`gse_talenttype`.`image`";
$elements[5]->sort="1";
$elements[5]->header="Image";
$elements[5]->alias="image";
$elements[6]=new stdClass();
$elements[6]->field="`gse_talenttype`.`url`";
$elements[6]->sort="1";
$elements[6]->header="Url";
$elements[6]->alias="url";
$elements[7]=new stdClass();
$elements[7]->field="`gse_talenttype`.`banner`";
$elements[7]->sort="1";
$elements[7]->header="Banner";
$elements[7]->alias="banner";
$elements[8]=new stdClass();
$elements[8]->field="`gse_talenttype`.`content`";
$elements[8]->sort="1";
$elements[8]->header="Content";
$elements[8]->alias="content";
$elements[9]=new stdClass();
$elements[9]->field="`gse_talenttype`.`videos`";
$elements[9]->sort="1";
$elements[9]->header="Videos";
$elements[9]->alias="videos";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_talenttype`");
$this->load->view("json",$data);
}

public function createtalenttype()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createtalenttype";
$data["page2"]="block/talent";
$data["before1"]=$this->input->get('id');
$data["before2"]=$this->input->get('id');
$data["title"]="Create talenttype";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data[ 'talent' ] =$this->talent_model->getdropdown();
$this->load->view("template",$data);
}
public function createtalenttypesubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("talent","Talent","trim");
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("image","Image","trim");
$this->form_validation->set_rules("url","Url","trim");
$this->form_validation->set_rules("banner","Banner","trim");
$this->form_validation->set_rules("content","Content","trim");
$this->form_validation->set_rules("videos","Videos","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createtalenttype";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data[ 'talent' ] =$this->talent_model->getdropdown();
$data["title"]="Create talenttype";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$talent=$this->input->get_post("talent");
$location=$this->input->get_post("location");
$date=$this->input->get_post("date");
$order=$this->input->get_post("order");
$status=$this->input->get_post("status");
$name=$this->input->get_post("name");
$image=$this->menu_model->createImage();
$url=$this->input->get_post("url");
//$banner=$this->input->get_post("banner");
$content=$this->input->get_post("content");
$videos=$this->input->get_post("videos");
    $config['upload_path'] = './uploads/';
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$this->load->library('upload', $config);
						$filename="banner";
						$banner="";
						if (  $this->upload->do_upload($filename))
						{
							$uploaddata = $this->upload->data();
							$banner=$uploaddata['file_name'];
						}
if($this->talenttype_model->create($talent,$order,$status,$name,$image,$url,$banner,$content,$videos,$location,$date)==0)
$data["alerterror"]="New talenttype could not be created.";
else
$data["alertsuccess"]="talenttype created Successfully.";
$data["redirect"]="site/viewtalenttype";
$this->load->view("redirect",$data);
}
}
public function edittalenttype()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="edittalenttype";
$data["page2"]="block/talentinside";
$data["before1"]=$this->input->get('id');
$data["before2"]=$this->input->get('id');
$data[ 'talent' ] =$this->talent_model->getdropdown();
$data["title"]="Edit talenttype";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["before"]=$this->talenttype_model->beforeedit($this->input->get("id"));
$this->load->view("templatewith2",$data);
}
public function edittalenttypesubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("talent","Talent","trim");
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("image","Image","trim");
$this->form_validation->set_rules("url","Url","trim");
$this->form_validation->set_rules("banner","Banner","trim");
$this->form_validation->set_rules("content","Content","trim");
$this->form_validation->set_rules("videos","Videos","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="edittalenttype";
$data["title"]="Edit talenttype";
$data[ 'talent' ] =$this->talent_model->getdropdown();
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["before"]=$this->talenttype_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$talent=$this->input->get_post("talent");
$location=$this->input->get_post("location");
$date=$this->input->get_post("date");
$order=$this->input->get_post("order");
$status=$this->input->get_post("status");
$name=$this->input->get_post("name");
$image=$this->menu_model->createImage();
$url=$this->input->get_post("url");
//$banner=$this->input->get_post("banner");
$content=$this->input->get_post("content");
$videos=$this->input->get_post("videos");
     $config['upload_path'] = './uploads/';
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$this->load->library('upload', $config);
						$filename="banner";
						$banner="";
						if (  $this->upload->do_upload($filename))
						{
							$uploaddata = $this->upload->data();
							$banner=$uploaddata['file_name'];
						}

						if($banner=="")
						{
						$banner=$this->talenttype_model->getbannerbyid($id);
						   // print_r($image);
							$banner=$banner->banner;
						}
if($this->talenttype_model->edit($id,$talent,$order,$status,$name,$image,$url,$banner,$content,$videos,$location,$date)==0)
$data["alerterror"]="New talenttype could not be Updated.";
else
$data["alertsuccess"]="talenttype Updated Successfully.";
$data["redirect"]="site/viewtalenttype";
$this->load->view("redirect",$data);
}
}
public function deletetalenttype()
{
$access=array("1");
$this->checkaccess($access);
$this->talenttype_model->delete($this->input->get("id"));
$data["redirect"]="site/viewtalenttype";
$this->load->view("redirect",$data);
}
public function viewtalenttypegallery()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewtalenttypegallery";
$data["page2"]="block/talentinside";
$data["before1"]=$this->input->get('id');
$data["base_url"]=site_url("site/viewtalenttypegalleryjson?id=").$this->input->get('id');

$data["title"]="View talenttypegallery";
$this->load->view("templatewith2",$data);
}
function viewtalenttypegalleryjson()
{
    $id=$this->input->get('id');
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`gse_talenttypegallery`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`gse_talenttypegallery`.`order`";
$elements[1]->sort="1";
$elements[1]->header="Order";
$elements[1]->alias="order";
$elements[2]=new stdClass();
$elements[2]->field="`gse_talenttypegallery`.`status`";
$elements[2]->sort="1";
$elements[2]->header="Status";
$elements[2]->alias="status";
$elements[3]=new stdClass();
$elements[3]->field="`gse_talenttypegallery`.`talenttype`";
$elements[3]->sort="1";
$elements[3]->header="Talent Type";
$elements[3]->alias="talenttype";
$elements[4]=new stdClass();
$elements[4]->field="`gse_talenttypegallery`.`talent`";
$elements[4]->sort="1";
$elements[4]->header="Talent";
$elements[4]->alias="talent";
$elements[5]=new stdClass();
$elements[5]->field="`gse_talenttypegallery`.`image`";
$elements[5]->sort="1";
$elements[5]->header="Image";
$elements[5]->alias="image";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_talenttypegallery`","WHERE `gse_talenttypegallery`.`talenttype`='$id'");
$this->load->view("json",$data);
}

public function createtalenttypegallery()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createtalenttypegallery";
$data["page2"]="block/talentinside";
$data["title"]="Create talenttypegallery";
$data["before1"]=$this->input->get('id');
$data["talenttype"]=$this->talenttype_model->getdropdown();
$data["talent"]=$this->talent_model->getdropdown();
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$this->load->view("templatewith2",$data);
}
public function createtalenttypegallerysubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("talenttype","Talent Type","trim");
$this->form_validation->set_rules("talent","Talent","trim");
$this->form_validation->set_rules("image","Image","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createtalenttypegallery";
$data["talenttype"]=$this->talenttype_model->getdropdown();
$data["title"]="Create talenttypegallery";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["talent"]=$this->talent_model->getdropdown();
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$order=$this->input->get_post("order");
$status=$this->input->get_post("status");
$talenttype=$this->input->get_post("talenttype");
$image=$this->menu_model->createImage();
if($this->talenttypegallery_model->create($order,$status,$talenttype,$image)==0)
$data["alerterror"]="New talenttypegallery could not be created.";
else
$data["alertsuccess"]="talenttypegallery created Successfully.";
$data["redirect"]="site/viewtalenttypegallery?id=".$talenttype;
$this->load->view("redirect2",$data);
}
}
public function edittalenttypegallery()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="edittalenttypegallery";
$data["page2"]="block/talentinside";
$data["before1"]=$this->input->get('id');
$data["talenttype"]=$this->talenttype_model->getdropdown();
$data["talent"]=$this->talent_model->getdropdown();
$data["before2"]=$this->input->get('id');
$data["title"]="Edit talenttypegallery";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["before"]=$this->talenttypegallery_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function edittalenttypegallerysubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("talenttype","Talent Type","trim");
$this->form_validation->set_rules("talent","Talent","trim");
$this->form_validation->set_rules("image","Image","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="edittalenttypegallery";
$data["title"]="Edit talenttypegallery";
$data["talent"]=$this->talent_model->getdropdown();
$data["talenttype"]=$this->talenttype_model->getdropdown();
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["before"]=$this->talenttypegallery_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$order=$this->input->get_post("order");
$status=$this->input->get_post("status");
$talenttype=$this->input->get_post("talenttype");
//$talent=$this->input->get_post("talent");
$image=$this->menu_model->createImage();
if($this->talenttypegallery_model->edit($id,$order,$status,$talenttype,$image)==0)
$data["alerterror"]="New talenttypegallery could not be Updated.";
else
$data["alertsuccess"]="talenttypegallery Updated Successfully.";
$data["redirect"]="site/viewtalenttypegallery?id=".$talenttype;
$this->load->view("redirect2",$data);
}
}
public function deletetalenttypegallery()
{
$access=array("1");
$this->checkaccess($access);
$this->talenttypegallery_model->delete($this->input->get("id"));
$data["redirect"]="site/viewtalenttypegallery?id=".$this->input->get("talenttypeid");
$this->load->view("redirect",$data);
}
public function viewsportscategory()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewsportscategory";
$data["base_url"]=site_url("site/viewsportscategoryjson");
$data["title"]="View sportscategory";
$this->load->view("template",$data);
}
function viewsportscategoryjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`gse_sportscategory`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`gse_sportscategory`.`order`";
$elements[1]->sort="1";
$elements[1]->header="Order";
$elements[1]->alias="order";
$elements[2]=new stdClass();
$elements[2]->field="`gse_sportscategory`.`status`";
$elements[2]->sort="1";
$elements[2]->header="Status";
$elements[2]->alias="status";
$elements[3]=new stdClass();
$elements[3]->field="`gse_sportscategory`.`name`";
$elements[3]->sort="1";
$elements[3]->header="Name";
$elements[3]->alias="name";
$elements[4]=new stdClass();
$elements[4]->field="`gse_sportscategory`.`image`";
$elements[4]->sort="1";
$elements[4]->header="Image";
$elements[4]->alias="image";
$elements[5]=new stdClass();
$elements[5]->field="`gse_sportscategory`.`link`";
$elements[5]->sort="1";
$elements[5]->header="Link";
$elements[5]->alias="link";
$elements[6]=new stdClass();
$elements[6]->field="`gse_sportscategory`.`banner`";
$elements[6]->sort="1";
$elements[6]->header="Banner";
$elements[6]->alias="banner";
$elements[7]=new stdClass();
$elements[7]->field="`gse_sportscategory`.`content`";
$elements[7]->sort="1";
$elements[7]->header="Content";
$elements[7]->alias="content";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_sportscategory`");
$this->load->view("json",$data);
}

public function createsportscategory()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createsportscategory";
$data["title"]="Create sportscategory";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$this->load->view("template",$data);
}
public function createsportscategorysubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("image","Image","trim");
$this->form_validation->set_rules("link","Link","trim");
$this->form_validation->set_rules("banner","Banner","trim");
$this->form_validation->set_rules("content","Content","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createsportscategory";
$data["title"]="Create sportscategory";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$order=$this->input->get_post("order");
$status=$this->input->get_post("status");
$name=$this->input->get_post("name");
$image=$this->menu_model->createImage();
$link=$this->input->get_post("link");
//$banner=$this->input->get_post("banner");
$content=$this->input->get_post("content");
    $config['upload_path'] = './uploads/';
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$this->load->library('upload', $config);
						$filename="banner";
						$banner="";
						if (  $this->upload->do_upload($filename))
						{
							$uploaddata = $this->upload->data();
							$banner=$uploaddata['file_name'];
						}
if($this->sportscategory_model->create($order,$status,$name,$image,$link,$banner,$content)==0)
$data["alerterror"]="New sportscategory could not be created.";
else
$data["alertsuccess"]="sportscategory created Successfully.";
$data["redirect"]="site/viewsportscategory";
$this->load->view("redirect",$data);
}
}
public function editsportscategory()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editsportscategory";
$data["title"]="Edit sportscategory";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["before"]=$this->sportscategory_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editsportscategorysubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("image","Image","trim");
$this->form_validation->set_rules("link","Link","trim");
$this->form_validation->set_rules("banner","Banner","trim");
$this->form_validation->set_rules("content","Content","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editsportscategory";
$data["title"]="Edit sportscategory";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["before"]=$this->sportscategory_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$order=$this->input->get_post("order");
$status=$this->input->get_post("status");
$name=$this->input->get_post("name");
$image=$this->menu_model->createImage();
$link=$this->input->get_post("link");
//$banner=$this->input->get_post("banner");
$content=$this->input->get_post("content");
     $config['upload_path'] = './uploads/';
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$this->load->library('upload', $config);
						$filename="banner";
						$banner="";
						if (  $this->upload->do_upload($filename))
						{
							$uploaddata = $this->upload->data();
							$banner=$uploaddata['file_name'];
						}

						if($banner=="")
						{
						$banner=$this->sportscategory_model->getbannerbyid($id);
						   // print_r($image);
							$banner=$banner->banner;
						}
if($this->sportscategory_model->edit($id,$order,$status,$name,$image,$link,$banner,$content)==0)
$data["alerterror"]="New sportscategory could not be Updated.";
else
$data["alertsuccess"]="sportscategory Updated Successfully.";
$data["redirect"]="site/viewsportscategory";
$this->load->view("redirect",$data);
}
}
public function deletesportscategory()
{
$access=array("1");
$this->checkaccess($access);
$this->sportscategory_model->delete($this->input->get("id"));
$data["redirect"]="site/viewsportscategory";
$this->load->view("redirect",$data);
}
public function viewhighlight()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewhighlight";
$data["base_url"]=site_url("site/viewhighlightjson");
$data["title"]="View highlight";
$this->load->view("template",$data);
}
function viewhighlightjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`gse_highlight`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`gse_highlight`.`sportscategory`";
$elements[1]->sort="1";
$elements[1]->header="Sports category";
$elements[1]->alias="sportscategory";
$elements[2]=new stdClass();
$elements[2]->field="`gse_highlight`.`name`";
$elements[2]->sort="1";
$elements[2]->header="Name";
$elements[2]->alias="name";
$elements[3]=new stdClass();
$elements[3]->field="`gse_highlight`.`image`";
$elements[3]->sort="1";
$elements[3]->header="Image";
$elements[3]->alias="image";
$elements[4]=new stdClass();
$elements[4]->field="`gse_highlight`.`link`";
$elements[4]->sort="1";
$elements[4]->header="Link";
$elements[4]->alias="link";
$elements[5]=new stdClass();
$elements[5]->field="`gse_highlight`.`location`";
$elements[5]->sort="1";
$elements[5]->header="Location";
$elements[5]->alias="location";
$elements[6]=new stdClass();
$elements[6]->field="`gse_highlight`.`content`";
$elements[6]->sort="1";
$elements[6]->header="Content";
$elements[6]->alias="content";
$elements[7]=new stdClass();
$elements[7]->field="`gse_highlight`.`videos`";
$elements[7]->sort="1";
$elements[7]->header="Videos";
$elements[7]->alias="videos";
$elements[8]=new stdClass();
$elements[8]->field="`gse_highlight`.`date`";
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
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_highlight`");
$this->load->view("json",$data);
}

public function createhighlight()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createhighlight";
$data["sportscategory"]=$this->sportscategory_model->getdropdown();
$data["title"]="Create highlight";
$this->load->view("template",$data);
}
public function createhighlightsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("sportscategory","Sports category","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("image","Image","trim");
$this->form_validation->set_rules("link","Link","trim");
$this->form_validation->set_rules("location","Location","trim");
$this->form_validation->set_rules("content","Content","trim");
$this->form_validation->set_rules("videos","Videos","trim");
$this->form_validation->set_rules("date","Date","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
    $data["sportscategory"]=$this->sportscategory_model->getdropdown();
$data["page"]="createhighlight";
$data["title"]="Create highlight";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$sportscategory=$this->input->get_post("sportscategory");
$name=$this->input->get_post("name");
$image=$this->menu_model->createImage();
$link=$this->input->get_post("link");
$location=$this->input->get_post("location");
$content=$this->input->get_post("content");
$videos=$this->input->get_post("videos");
$date=$this->input->get_post("date");

$config['upload_path'] = './uploads/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$this->load->library('upload', $config);
				$filename="banner";
				$banner="";
				if (  $this->upload->do_upload($filename))
				{
					$uploaddata = $this->upload->data();
					$banner=$uploaddata['file_name'];
				}
if($this->highlight_model->create($sportscategory,$name,$image,$link,$location,$content,$videos,$date,$banner)==0)
$data["alerterror"]="New highlight could not be created.";
else
$data["alertsuccess"]="highlight created Successfully.";
$data["redirect"]="site/viewhighlight";
$this->load->view("redirect",$data);
}
}
public function edithighlight()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="edithighlight";
$data["page2"]="block/highlightblock";
$data["before1"]=$this->input->get('id');
$data["before2"]=$this->input->get('id');
$data["before3"]=$this->input->get('id');
$data["title"]="Edit highlight";
$data["sportscategory"]=$this->sportscategory_model->getdropdown();
$data["before"]=$this->highlight_model->beforeedit($this->input->get("id"));
$this->load->view("templatewith2",$data);
}
public function edithighlightsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("sportscategory","Sports category","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("image","Image","trim");
$this->form_validation->set_rules("link","Link","trim");
$this->form_validation->set_rules("location","Location","trim");
$this->form_validation->set_rules("content","Content","trim");
$this->form_validation->set_rules("videos","Videos","trim");
$this->form_validation->set_rules("date","Date","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
    $data["sportscategory"]=$this->sportscategory_model->getdropdown();
$data["page"]="edithighlight";
$data["title"]="Edit highlight";
$data["before"]=$this->highlight_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$sportscategory=$this->input->get_post("sportscategory");
$name=$this->input->get_post("name");
$image=$this->menu_model->createImage();
$link=$this->input->get_post("link");
$location=$this->input->get_post("location");
$content=$this->input->get_post("content");
$videos=$this->input->get_post("videos");
$date=$this->input->get_post("date");
$config['upload_path'] = './uploads/';
			 $config['allowed_types'] = 'gif|jpg|png|jpeg';
			 $this->load->library('upload', $config);
			 $filename="banner";
			 $banner="";
			 if (  $this->upload->do_upload($filename))
			 {
				 $uploaddata = $this->upload->data();
				 $banner=$uploaddata['file_name'];
			 }

			 if($banner=="")
			 {
			 $banner=$this->highlight_model->getbannerbyid($id);
					// print_r($image);
				 $banner=$banner->banner;
			 }
if($this->highlight_model->edit($id,$sportscategory,$name,$image,$link,$location,$content,$videos,$date,$banner)==0)
$data["alerterror"]="New highlight could not be Updated.";
else
$data["alertsuccess"]="highlight Updated Successfully.";
$data["redirect"]="site/viewhighlight";
$this->load->view("redirect",$data);
}
}
public function deletehighlight()
{
$access=array("1");
$this->checkaccess($access);
$this->highlight_model->delete($this->input->get("id"));
$data["redirect"]="site/viewhighlight";
$this->load->view("redirect",$data);
}
public function viewpreviousgamegallery()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewpreviousgamegallery";
    $data["page2"]="block/highlightblock";
    $data["before1"]=$this->input->get('id');
$data["before2"]=$this->input->get('id');
$data["before3"]=$this->input->get('id');
$data["base_url"]=site_url("site/viewpreviousgamegalleryjson?id=").$this->input->get('id');
$data["title"]="View previousgamegallery";
$this->load->view("templatewith2",$data);
}
function viewpreviousgamegalleryjson()
{
    $id=$this->input->get('id');
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`gse_previousgamegallery`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`gse_previousgamegallery`.`order`";
$elements[1]->sort="1";
$elements[1]->header="Order";
$elements[1]->alias="order";
$elements[2]=new stdClass();
$elements[2]->field="`gse_previousgamegallery`.`status`";
$elements[2]->sort="1";
$elements[2]->header="Status";
$elements[2]->alias="status";
$elements[3]=new stdClass();
$elements[3]->field="`gse_previousgamegallery`.`highlight`";
$elements[3]->sort="1";
$elements[3]->header="Highlight";
$elements[3]->alias="highlight";
$elements[4]=new stdClass();
$elements[4]->field="`gse_previousgamegallery`.`sportscategory`";
$elements[4]->sort="1";
$elements[4]->header="Sports category";
$elements[4]->alias="sportscategory";
$elements[5]=new stdClass();
$elements[5]->field="`gse_previousgamegallery`.`image`";
$elements[5]->sort="1";
$elements[5]->header="Image";
$elements[5]->alias="image";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_previousgamegallery`","WHERE `gse_previousgamegallery`.`highlight`='$id'");
$this->load->view("json",$data);
}

public function createpreviousgamegallery()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createpreviousgamegallery";
$data["title"]="Create previousgamegallery";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data[ 'sportscategory' ] =$this->sportscategory_model->getdropdown();
$data[ 'highlight' ] =$this->highlight_model->getdropdown();
$this->load->view("template",$data);
}
public function createpreviousgamegallerysubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("highlight","Highlight","trim");
$this->form_validation->set_rules("sportscategory","Sports category","trim");
$this->form_validation->set_rules("image","Image","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createpreviousgamegallery";
$data["title"]="Create previousgamegallery";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
    $data[ 'highlight' ] =$this->highlight_model->getdropdown();
$data[ 'sportscategory' ] =$this->sportscategory_model->getdropdown();
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$order=$this->input->get_post("order");
$status=$this->input->get_post("status");
$highlight=$this->input->get_post("highlight");
$sportscategory=$this->input->get_post("sportscategory");
$image=$this->menu_model->createImage();
if($this->previousgamegallery_model->create($order,$status,$highlight,$sportscategory,$image)==0)
$data["alerterror"]="New previousgamegallery could not be created.";
else
$data["alertsuccess"]="previousgamegallery created Successfully.";
$data["redirect"]="site/viewpreviousgamegallery?id=".$highlight;
$this->load->view("redirect2",$data);
}
}
public function editpreviousgamegallery()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editpreviousgamegallery";
$data[ 'sportscategory' ] =$this->sportscategory_model->getdropdown();
$data["title"]="Edit previousgamegallery";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
    $data[ 'highlight' ] =$this->highlight_model->getdropdown();
$data["before"]=$this->previousgamegallery_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editpreviousgamegallerysubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("highlight","Highlight","trim");
$this->form_validation->set_rules("sportscategory","Sports category","trim");
$this->form_validation->set_rules("image","Image","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editpreviousgamegallery";
$data["title"]="Edit previousgamegallery";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
    $data[ 'highlight' ] =$this->highlight_model->getdropdown();
    $data[ 'sportscategory' ] =$this->sportscategory_model->getdropdown();
$data["before"]=$this->previousgamegallery_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$order=$this->input->get_post("order");
$status=$this->input->get_post("status");
$highlight=$this->input->get_post("highlight");
$sportscategory=$this->input->get_post("sportscategory");
$image=$this->menu_model->createImage();
if($this->previousgamegallery_model->edit($id,$order,$status,$highlight,$sportscategory,$image)==0)
$data["alerterror"]="New previousgamegallery could not be Updated.";
else
$data["alertsuccess"]="previousgamegallery Updated Successfully.";
$data["redirect"]="site/viewpreviousgamegallery?id=".$highlight;
$this->load->view("redirect2",$data);
}
}
public function deletepreviousgamegallery()
{
$access=array("1");
$this->checkaccess($access);
$this->previousgamegallery_model->delete($this->input->get("id"));
$data["redirect"]="site/viewpreviousgamegallery?id=".$this->input->get('highlightid');
$this->load->view("redirect2",$data);
}
public function viewplayer()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewplayer";
$data["base_url"]=site_url("site/viewplayerjson");
$data["title"]="View player";
$this->load->view("template",$data);
}
function viewplayerjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`gse_player`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`gse_player`.`order`";
$elements[1]->sort="1";
$elements[1]->header="Order";
$elements[1]->alias="order";
$elements[2]=new stdClass();
$elements[2]->field="`gse_player`.`status`";
$elements[2]->sort="1";
$elements[2]->header="Status";
$elements[2]->alias="status";
$elements[3]=new stdClass();
$elements[3]->field="`gse_player`.`sportscategory`";
$elements[3]->sort="1";
$elements[3]->header="Sports category";
$elements[3]->alias="sportscategory";
$elements[4]=new stdClass();
$elements[4]->field="`gse_player`.`name`";
$elements[4]->sort="1";
$elements[4]->header="Name";
$elements[4]->alias="name";
$elements[5]=new stdClass();
$elements[5]->field="`gse_player`.`image`";
$elements[5]->sort="1";
$elements[5]->header="Image";
$elements[5]->alias="image";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_player`");
$this->load->view("json",$data);
}

public function createplayer()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createplayer";
$data["title"]="Create player";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
    $data[ 'sportscategory' ] =$this->sportscategory_model->getdropdown();
$this->load->view("template",$data);
}
public function createplayersubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("sportscategory","Sports category","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("image","Image","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createplayer";
$data["title"]="Create player";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data[ 'sportscategory' ] =$this->sportscategory_model->getdropdown();
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$order=$this->input->get_post("order");
$status=$this->input->get_post("status");
$sportscategory=$this->input->get_post("sportscategory");
$name=$this->input->get_post("name");
$image=$this->menu_model->createImage();
if($this->player_model->create($order,$status,$sportscategory,$name,$image)==0)
$data["alerterror"]="New player could not be created.";
else
$data["alertsuccess"]="player created Successfully.";
$data["redirect"]="site/viewplayer";
$this->load->view("redirect",$data);
}
}
public function editplayer()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editplayer";
$data["title"]="Edit player";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data[ 'sportscategory' ] =$this->sportscategory_model->getdropdown();
$data["before"]=$this->player_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editplayersubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("sportscategory","Sports category","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("image","Image","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editplayer";
$data["title"]="Edit player";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data[ 'sportscategory' ] =$this->sportscategory_model->getdropdown();
$data["before"]=$this->player_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$order=$this->input->get_post("order");
$status=$this->input->get_post("status");
$sportscategory=$this->input->get_post("sportscategory");
$name=$this->input->get_post("name");
$image=$this->menu_model->createImage();
if($this->player_model->edit($id,$order,$status,$sportscategory,$name,$image)==0)
$data["alerterror"]="New player could not be Updated.";
else
$data["alertsuccess"]="player Updated Successfully.";
$data["redirect"]="site/viewplayer";
$this->load->view("redirect",$data);
}
}
public function deleteplayer()
{
$access=array("1");
$this->checkaccess($access);
$this->player_model->delete($this->input->get("id"));
$data["redirect"]="site/viewplayer";
$this->load->view("redirect",$data);
}
public function viewclientlogo()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewclientlogo";
$data["base_url"]=site_url("site/viewclientlogojson");
$data["title"]="View clientlogo";
$this->load->view("template",$data);
}
function viewclientlogojson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`gse_clientlogo`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`gse_clientlogo`.`order`";
$elements[1]->sort="1";
$elements[1]->header="Order";
$elements[1]->alias="order";
$elements[2]=new stdClass();
$elements[2]->field="`gse_clientlogo`.`status`";
$elements[2]->sort="1";
$elements[2]->header="Status";
$elements[2]->alias="status";
$elements[3]=new stdClass();
$elements[3]->field="`gse_clientlogo`.`name`";
$elements[3]->sort="1";
$elements[3]->header="Name";
$elements[3]->alias="name";
$elements[4]=new stdClass();
$elements[4]->field="`gse_clientlogo`.`image`";
$elements[4]->sort="1";
$elements[4]->header="Image";
$elements[4]->alias="image";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_clientlogo`");
$this->load->view("json",$data);
}

public function createclientlogo()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createclientlogo";
$data["title"]="Create clientlogo";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$this->load->view("template",$data);
}
public function createclientlogosubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("image","Image","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createclientlogo";
$data["title"]="Create clientlogo";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$order=$this->input->get_post("order");
$status=$this->input->get_post("status");
$name=$this->input->get_post("name");
$image=$this->menu_model->createImage();
if($this->clientlogo_model->create($order,$status,$name,$image)==0)
$data["alerterror"]="New clientlogo could not be created.";
else
$data["alertsuccess"]="clientlogo created Successfully.";
$data["redirect"]="site/viewclientlogo";
$this->load->view("redirect",$data);
}
}
public function editclientlogo()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editclientlogo";
$data["title"]="Edit clientlogo";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["before"]=$this->clientlogo_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editclientlogosubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("image","Image","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editclientlogo";
$data["title"]="Edit clientlogo";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["before"]=$this->clientlogo_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$order=$this->input->get_post("order");
$status=$this->input->get_post("status");
$name=$this->input->get_post("name");
$image=$this->menu_model->createImage();
if($this->clientlogo_model->edit($id,$order,$status,$name,$image)==0)
$data["alerterror"]="New clientlogo could not be Updated.";
else
$data["alertsuccess"]="clientlogo Updated Successfully.";
$data["redirect"]="site/viewclientlogo";
$this->load->view("redirect",$data);
}
}
public function deleteclientlogo()
{
$access=array("1");
$this->checkaccess($access);
$this->clientlogo_model->delete($this->input->get("id"));
$data["redirect"]="site/viewclientlogo";
$this->load->view("redirect",$data);
}
public function viewclientdetail()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewclientdetail";
$data["base_url"]=site_url("site/viewclientdetailjson");
$data["title"]="View clientdetail";
$this->load->view("template",$data);
}
function viewclientdetailjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`gse_clientdetail`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`gse_clientdetail`.`order`";
$elements[1]->sort="1";
$elements[1]->header="Order";
$elements[1]->alias="order";
$elements[2]=new stdClass();
$elements[2]->field="`gse_clientdetail`.`status`";
$elements[2]->sort="1";
$elements[2]->header="Status";
$elements[2]->alias="status";
$elements[3]=new stdClass();
$elements[3]->field="`gse_clientdetail`.`name`";
$elements[3]->sort="1";
$elements[3]->header="Name";
$elements[3]->alias="name";
$elements[4]=new stdClass();
$elements[4]->field="`gse_clientdetail`.`image`";
$elements[4]->sort="1";
$elements[4]->header="Image";
$elements[4]->alias="image";
$elements[5]=new stdClass();
$elements[5]->field="`gse_clientdetail`.`title`";
$elements[5]->sort="1";
$elements[5]->header="Title";
$elements[5]->alias="title";
$elements[6]=new stdClass();
$elements[6]->field="`gse_clientdetail`.`url`";
$elements[6]->sort="1";
$elements[6]->header="Url";
$elements[6]->alias="url";
$elements[7]=new stdClass();
$elements[7]->field="`gse_clientdetail`.`content`";
$elements[7]->sort="1";
$elements[7]->header="Content";
$elements[7]->alias="content";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_clientdetail`");
$this->load->view("json",$data);
}

public function createclientdetail()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createclientdetail";
$data["title"]="Create clientdetail";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$this->load->view("template",$data);
}
public function createclientdetailsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("image","Image","trim");
$this->form_validation->set_rules("title","Title","trim");
$this->form_validation->set_rules("url","Url","trim");
$this->form_validation->set_rules("content","Content","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createclientdetail";
$data["title"]="Create clientdetail";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$order=$this->input->get_post("order");
$status=$this->input->get_post("status");
$name=$this->input->get_post("name");
$image=$this->menu_model->createImage();
$title=$this->input->get_post("title");
$url=$this->input->get_post("url");
$content=$this->input->get_post("content");
      $config['upload_path'] = './uploads/';
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$this->load->library('upload', $config);
						$filename="banner";
						$banner="";
						if (  $this->upload->do_upload($filename))
						{
							$uploaddata = $this->upload->data();
							$banner=$uploaddata['file_name'];
						}


if($this->clientdetail_model->create($order,$status,$name,$image,$title,$url,$content,$banner)==0)
$data["alerterror"]="New clientdetail could not be created.";
else
$data["alertsuccess"]="clientdetail created Successfully.";
$data["redirect"]="site/viewclientdetail";
$this->load->view("redirect",$data);
}
}
public function editclientdetail()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editclientdetail";
$data["title"]="Edit clientdetail";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["before"]=$this->clientdetail_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editclientdetailsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("image","Image","trim");
$this->form_validation->set_rules("title","Title","trim");
$this->form_validation->set_rules("url","Url","trim");
$this->form_validation->set_rules("content","Content","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editclientdetail";
$data["title"]="Edit clientdetail";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["before"]=$this->clientdetail_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$order=$this->input->get_post("order");
$status=$this->input->get_post("status");
$name=$this->input->get_post("name");
$image=$this->menu_model->createImage();
$title=$this->input->get_post("title");
$url=$this->input->get_post("url");
$content=$this->input->get_post("content");
       $config['upload_path'] = './uploads/';
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$this->load->library('upload', $config);
						$filename="banner";
						$banner="";
						if (  $this->upload->do_upload($filename))
						{
							$uploaddata = $this->upload->data();
							$banner=$uploaddata['file_name'];
						}

						if($banner=="")
						{
						$banner=$this->clientdetail_model->getbannerbyid($id);
						   // print_r($image);
							$banner=$banner->banner;
						}
if($this->clientdetail_model->edit($id,$order,$status,$name,$image,$title,$url,$content,$banner)==0)
$data["alerterror"]="New clientdetail could not be Updated.";
else
$data["alertsuccess"]="clientdetail Updated Successfully.";
$data["redirect"]="site/viewclientdetail";
$this->load->view("redirect",$data);
}
}
public function deleteclientdetail()
{
$access=array("1");
$this->checkaccess($access);
$this->clientdetail_model->delete($this->input->get("id"));
$data["redirect"]="site/viewclientdetail";
$this->load->view("redirect",$data);
}
public function viewcareerform()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewcareerform";
$data["base_url"]=site_url("site/viewcareerformjson");
$data["title"]="View careerform";
$this->load->view("template",$data);
}
function viewcareerformjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`gse_careerform`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`gse_careerform`.`name`";
$elements[1]->sort="1";
$elements[1]->header="Name";
$elements[1]->alias="name";
$elements[2]=new stdClass();
$elements[2]->field="`gse_careerform`.`email`";
$elements[2]->sort="1";
$elements[2]->header="Email";
$elements[2]->alias="email";
$elements[3]=new stdClass();
$elements[3]->field="`gse_careerform`.`phone`";
$elements[3]->sort="1";
$elements[3]->header="Phone";
$elements[3]->alias="phone";
$elements[4]=new stdClass();
$elements[4]->field="`gse_careerform`.`resume`";
$elements[4]->sort="1";
$elements[4]->header="Resume";
$elements[4]->alias="resume";
$elements[5]=new stdClass();
$elements[5]->field="`gse_careerform`.`comment`";
$elements[5]->sort="1";
$elements[5]->header="Comment";
$elements[5]->alias="comment";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_careerform`");
$this->load->view("json",$data);
}

public function createcareerform()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createcareerform";
$data["title"]="Create careerform";
$this->load->view("template",$data);
}
public function createcareerformsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("email","Email","trim");
$this->form_validation->set_rules("phone","Phone","trim");
$this->form_validation->set_rules("resume","Resume","trim");
$this->form_validation->set_rules("comment","Comment","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createcareerform";
$data["title"]="Create careerform";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$name=$this->input->get_post("name");
$email=$this->input->get_post("email");
$phone=$this->input->get_post("phone");
$resume=$this->input->get_post("resume");
$comment=$this->input->get_post("comment");
if($this->careerform_model->create($name,$email,$phone,$resume,$comment)==0)
$data["alerterror"]="New careerform could not be created.";
else
$data["alertsuccess"]="careerform created Successfully.";
$data["redirect"]="site/viewcareerform";
$this->load->view("redirect",$data);
}
}
public function editcareerform()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editcareerform";
$data["title"]="Edit careerform";
$data["before"]=$this->careerform_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editcareerformsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("email","Email","trim");
$this->form_validation->set_rules("phone","Phone","trim");
$this->form_validation->set_rules("resume","Resume","trim");
$this->form_validation->set_rules("comment","Comment","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editcareerform";
$data["title"]="Edit careerform";
$data["before"]=$this->careerform_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$name=$this->input->get_post("name");
$email=$this->input->get_post("email");
$phone=$this->input->get_post("phone");
$resume=$this->input->get_post("resume");
$comment=$this->input->get_post("comment");
if($this->careerform_model->edit($id,$name,$email,$phone,$resume,$comment)==0)
$data["alerterror"]="New careerform could not be Updated.";
else
$data["alertsuccess"]="careerform Updated Successfully.";
$data["redirect"]="site/viewcareerform";
$this->load->view("redirect",$data);
}
}
public function deletecareerform()
{
$access=array("1");
$this->checkaccess($access);
$this->careerform_model->delete($this->input->get("id"));
$data["redirect"]="site/viewcareerform";
$this->load->view("redirect",$data);
}
public function viewcareerposition()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewcareerposition";
$data["base_url"]=site_url("site/viewcareerpositionjson");
$data["title"]="View careerposition";
$this->load->view("template",$data);
}
function viewcareerpositionjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`gse_careerposition`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`gse_careerposition`.`name`";
$elements[1]->sort="1";
$elements[1]->header="Name";
$elements[1]->alias="name";
$elements[2]=new stdClass();
$elements[2]->field="`gse_careerposition`.`position`";
$elements[2]->sort="1";
$elements[2]->header="Position";
$elements[2]->alias="position";
$elements[3]=new stdClass();
$elements[3]->field="`gse_careerposition`.`education`";
$elements[3]->sort="1";
$elements[3]->header="Education";
$elements[3]->alias="education";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_careerposition`");
$this->load->view("json",$data);
}

public function createcareerposition()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createcareerposition";
$data["title"]="Create careerposition";
$this->load->view("template",$data);
}
public function createcareerpositionsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("position","Position","trim");
$this->form_validation->set_rules("education","Education","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createcareerposition";
$data["title"]="Create careerposition";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$name=$this->input->get_post("name");
$position=$this->input->get_post("position");
$education=$this->input->get_post("education");
if($this->careerposition_model->create($name,$position,$education)==0)
$data["alerterror"]="New careerposition could not be created.";
else
$data["alertsuccess"]="careerposition created Successfully.";
$data["redirect"]="site/viewcareerposition";
$this->load->view("redirect",$data);
}
}
public function editcareerposition()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editcareerposition";
$data["title"]="Edit careerposition";
$data["before"]=$this->careerposition_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editcareerpositionsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("position","Position","trim");
$this->form_validation->set_rules("education","Education","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editcareerposition";
$data["title"]="Edit careerposition";
$data["before"]=$this->careerposition_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$name=$this->input->get_post("name");
$position=$this->input->get_post("position");
$education=$this->input->get_post("education");
if($this->careerposition_model->edit($id,$name,$position,$education)==0)
$data["alerterror"]="New careerposition could not be Updated.";
else
$data["alertsuccess"]="careerposition Updated Successfully.";
$data["redirect"]="site/viewcareerposition";
$this->load->view("redirect",$data);
}
}
public function deletecareerposition()
{
$access=array("1");
$this->checkaccess($access);
$this->careerposition_model->delete($this->input->get("id"));
$data["redirect"]="site/viewcareerposition";
$this->load->view("redirect",$data);
}



    //old created gse



public function viewcategory()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewcategory";
$data["base_url"]=site_url("site/viewcategoryjson");
$data["title"]="View category";
$this->load->view("template",$data);
}
function viewcategoryjson()
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
$elements[2]->field="`statuses`.`name`";
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
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_category` INNER JOIN `statuses` ON `statuses`.`id`=`gse_category`.`status`");
$this->load->view("json",$data);
}

public function createcategory()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createcategory";
    $data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["title"]="Create category";
$this->load->view("template",$data);
}
public function createcategorysubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("name","Name","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createcategory";
    $data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["title"]="Create category";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$order=$this->input->get_post("order");
$status=$this->input->get_post("status");
$name=$this->input->get_post("name");
$content=$this->input->get_post("content");
if($this->category_model->create($order,$status,$name,$content)==0)
$data["alerterror"]="New category could not be created.";
else
$data["alertsuccess"]="category created Successfully.";
$data["redirect"]="site/viewcategory";
$this->load->view("redirect",$data);
}
}
public function editcategory()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editcategory";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["title"]="Edit category";
$data["before"]=$this->category_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editcategorysubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("name","Name","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editcategory";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["title"]="Edit category";
$data["before"]=$this->category_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$order=$this->input->get_post("order");
$status=$this->input->get_post("status");
$name=$this->input->get_post("name");
$content=$this->input->get_post("content");
if($this->category_model->edit($id,$order,$status,$name,$content)==0)
$data["alerterror"]="New category could not be Updated.";
else
$data["alertsuccess"]="category Updated Successfully.";
$data["redirect"]="site/viewcategory";
$this->load->view("redirect",$data);
}
}
public function deletecategory()
{
$access=array("1");
$this->checkaccess($access);
$this->category_model->delete($this->input->get("id"));
$data["redirect"]="site/viewcategory";
$this->load->view("redirect",$data);
}
public function viewsubscribe()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewsubscribe";
$data["base_url"]=site_url("site/viewsubscribejson");
$data["title"]="View subscribe";
$this->load->view("template",$data);
}
function viewsubscribejson()
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
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_subscribe`");
$this->load->view("json",$data);
}

public function createsubscribe()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createsubscribe";
$data["title"]="Create subscribe";
$this->load->view("template",$data);
}
public function createsubscribesubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("email","Email","trim");
$this->form_validation->set_rules("timestamp","Timestamp","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createsubscribe";
$data["title"]="Create subscribe";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$email=$this->input->get_post("email");
if($this->subscribe_model->create($email,$timestamp)==0)
$data["alerterror"]="New subscribe could not be created.";
else
$data["alertsuccess"]="subscribe created Successfully.";
$data["redirect"]="site/viewsubscribe";
$this->load->view("redirect",$data);
}
}
public function editsubscribe()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editsubscribe";
$data["title"]="Edit subscribe";
$data["before"]=$this->subscribe_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editsubscribesubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("email","Email","trim");
$this->form_validation->set_rules("timestamp","Timestamp","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editsubscribe";
$data["title"]="Edit subscribe";
$data["before"]=$this->subscribe_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$email=$this->input->get_post("email");
$timestamp=$this->input->get_post("timestamp");
if($this->subscribe_model->edit($id,$email,$timestamp)==0)
$data["alerterror"]="New subscribe could not be Updated.";
else
$data["alertsuccess"]="subscribe Updated Successfully.";
$data["redirect"]="site/viewsubscribe";
$this->load->view("redirect",$data);
}
}
public function deletesubscribe()
{
$access=array("1");
$this->checkaccess($access);
$this->subscribe_model->delete($this->input->get("id"));
$data["redirect"]="site/viewsubscribe";
$this->load->view("redirect",$data);
}
public function viewtestimonial()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewtestimonial";
$data["base_url"]=site_url("site/viewtestimonialjson");
$data["title"]="View testimonial";
$this->load->view("template",$data);
}
function viewtestimonialjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`gse_testimonial`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`gse_category`.`name`";
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
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_testimonial` LEFT OUTER JOIN `gse_category` ON `gse_category`.`id`=`gse_testimonial`.`category`");
$this->load->view("json",$data);
}

public function createtestimonial()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createtestimonial";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
     $data['category']=$this->category_model->gettestimonialdropdown();
$data["title"]="Create testimonial";
$this->load->view("template",$data);
}
public function createtestimonialsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("category","Category","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("author","Author","trim");
$this->form_validation->set_rules("image","Image","trim");
$this->form_validation->set_rules("quote","Quote","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createtestimonial";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
 $data['category']=$this->category_model->getdropdown();
$data["title"]="Create testimonial";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$category=$this->input->get_post("category");
$status=$this->input->get_post("status");
$order=$this->input->get_post("order");
$name=$this->input->get_post("name");
$author=$this->input->get_post("author");
//$image=$this->menu_model->createImage();
$quote=$this->input->get_post("quote");
     $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];

                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r);
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }

			}
if($this->testimonial_model->create($category,$status,$order,$name,$author,$image,$quote)==0)
$data["alerterror"]="New testimonial could not be created.";
else
$data["alertsuccess"]="testimonial created Successfully.";
$data["redirect"]="site/viewtestimonial";
$this->load->view("redirect",$data);
}
}
public function edittestimonial()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="edittestimonial";
$data["title"]="Edit testimonial";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
 $data['category']=$this->category_model->gettestimonialdropdown();
$data["before"]=$this->testimonial_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function edittestimonialsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("category","Category","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("author","Author","trim");
$this->form_validation->set_rules("image","Image","trim");
$this->form_validation->set_rules("quote","Quote","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="edittestimonial";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
 $data['category']=$this->category_model->getdropdown();
$data["title"]="Edit testimonial";
$data["before"]=$this->testimonial_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$category=$this->input->get_post("category");
$status=$this->input->get_post("status");
$order=$this->input->get_post("order");
$name=$this->input->get_post("name");
$author=$this->input->get_post("author");
//$image=$this->menu_model->createImage();
$quote=$this->input->get_post("quote");
     $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];

                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r);
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }

			}

if($this->testimonial_model->edit($id,$category,$status,$order,$name,$author,$image,$quote)==0)
$data["alerterror"]="New testimonial could not be Updated.";
else
$data["alertsuccess"]="testimonial Updated Successfully.";
$data["redirect"]="site/viewtestimonial";
$this->load->view("redirect",$data);
}
}
public function deletetestimonial()
{
$access=array("1");
$this->checkaccess($access);
$this->testimonial_model->delete($this->input->get("id"));
$data["redirect"]="site/viewtestimonial";
$this->load->view("redirect",$data);
}
public function viewgetintouch()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewgetintouch";
$data["base_url"]=site_url("site/viewgetintouchjson");
$data["title"]="View getintouch";
$this->load->view("template",$data);
}
function viewgetintouchjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`gse_getintouch`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`gse_category`.`name`";
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
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_getintouch` INNER JOIN `gse_category` ON `gse_category`.`id`=`gse_getintouch`.`category`");
$this->load->view("json",$data);
}

public function creategetintouch()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="creategetintouch";
$data["title"]="Create getintouch";
 $data['category']=$this->category_model->getdropdown();
$this->load->view("template",$data);
}
public function creategetintouchsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("category","Category","trim");
$this->form_validation->set_rules("firstname","First Name","trim");
$this->form_validation->set_rules("lastname","Last Name","trim");
$this->form_validation->set_rules("email","Email","trim");
$this->form_validation->set_rules("phone","Phone","trim");
$this->form_validation->set_rules("timestamp","Timestamp","trim");
$this->form_validation->set_rules("comment","Comment","trim");
$this->form_validation->set_rules("enquiryfor","Enquiry For","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="creategetintouch";
 $data['category']=$this->category_model->getdropdown();
$data["title"]="Create getintouch";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$category=$this->input->get_post("category");
$firstname=$this->input->get_post("firstname");
$lastname=$this->input->get_post("lastname");
$email=$this->input->get_post("email");
$phone=$this->input->get_post("phone");
$comment=$this->input->get_post("comment");
$enquiryfor=$this->input->get_post("enquiryfor");
$location=$this->input->get_post("location");
$noofpeople=$this->input->get_post("noofpeople");
if($this->getintouch_model->create($category,$firstname,$lastname,$email,$phone,$timestamp,$comment,$enquiryfor,$location,$noofpeople)==0)
$data["alerterror"]="New getintouch could not be created.";
else
$data["alertsuccess"]="getintouch created Successfully.";
$data["redirect"]="site/viewgetintouch";
$this->load->view("redirect",$data);
}
}
public function editgetintouch()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editgetintouch";
$data["title"]="Edit getintouch";
 $data['category']=$this->category_model->getdropdown();
$data["before"]=$this->getintouch_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editgetintouchsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("category","Category","trim");
$this->form_validation->set_rules("firstname","First Name","trim");
$this->form_validation->set_rules("lastname","Last Name","trim");
$this->form_validation->set_rules("email","Email","trim");
$this->form_validation->set_rules("phone","Phone","trim");
$this->form_validation->set_rules("timestamp","Timestamp","trim");
$this->form_validation->set_rules("comment","Comment","trim");
$this->form_validation->set_rules("enquiryfor","Enquiry For","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editgetintouch";
$data["title"]="Edit getintouch";
 $data['category']=$this->category_model->getdropdown();
$data["before"]=$this->getintouch_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$category=$this->input->get_post("category");
$firstname=$this->input->get_post("firstname");
$lastname=$this->input->get_post("lastname");
$email=$this->input->get_post("email");
$phone=$this->input->get_post("phone");
$timestamp=$this->input->get_post("timestamp");
$comment=$this->input->get_post("comment");
$enquiryfor=$this->input->get_post("enquiryfor");
$location=$this->input->get_post("location");
$noofpeople=$this->input->get_post("noofpeople");
if($this->getintouch_model->edit($id,$category,$firstname,$lastname,$email,$phone,$timestamp,$comment,$enquiryfor,$location,$noofpeople)==0)
$data["alerterror"]="New getintouch could not be Updated.";
else
$data["alertsuccess"]="getintouch Updated Successfully.";
$data["redirect"]="site/viewgetintouch";
$this->load->view("redirect",$data);
}
}
public function deletegetintouch()
{
$access=array("1");
$this->checkaccess($access);
$this->getintouch_model->delete($this->input->get("id"));
$data["redirect"]="site/viewgetintouch";
$this->load->view("redirect",$data);
}
public function viewdiarycategory()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewdiarycategory";
$data["base_url"]=site_url("site/viewdiarycategoryjson");
$data["title"]="View diarycategory";
$this->load->view("template",$data);
}
function viewdiarycategoryjson()
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
$elements[2]->field="`statuses`.`name`";
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
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_diarycategory` LEFT OUTER JOIN `statuses` ON `statuses`.`id`=`gse_diarycategory`.`status`");
$this->load->view("json",$data);
}

public function creatediarycategory()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="creatediarycategory";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["title"]="Create diarycategory";
$this->load->view("template",$data);
}
public function creatediarycategorysubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("name","Name","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="creatediarycategory";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["title"]="Create diarycategory";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$order=$this->input->get_post("order");
$status=$this->input->get_post("status");
$name=$this->input->get_post("name");
if($this->diarycategory_model->create($order,$status,$name)==0)
$data["alerterror"]="New diarycategory could not be created.";
else
$data["alertsuccess"]="diarycategory created Successfully.";
$data["redirect"]="site/viewdiarycategory";
$this->load->view("redirect",$data);
}
}
public function editdiarycategory()
{
$access=array("1");
$this->checkaccess($access);
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["page"]="editdiarycategory";
$data["title"]="Edit diarycategory";
$data["before"]=$this->diarycategory_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editdiarycategorysubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("name","Name","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editdiarycategory";
$data["title"]="Edit diarycategory";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["before"]=$this->diarycategory_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$order=$this->input->get_post("order");
$status=$this->input->get_post("status");
$name=$this->input->get_post("name");
if($this->diarycategory_model->edit($id,$order,$status,$name)==0)
$data["alerterror"]="New diarycategory could not be Updated.";
else
$data["alertsuccess"]="diarycategory Updated Successfully.";
$data["redirect"]="site/viewdiarycategory";
$this->load->view("redirect",$data);
}
}
public function deletediarycategory()
{
$access=array("1");
$this->checkaccess($access);
$this->diarycategory_model->delete($this->input->get("id"));
$data["redirect"]="site/viewdiarycategory";
$this->load->view("redirect",$data);
}
public function viewdiarysubcategory()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewdiarysubcategory";
$data["base_url"]=site_url("site/viewdiarysubcategoryjson");
$data["title"]="View diarysubcategory";
$this->load->view("template",$data);
}
function viewdiarysubcategoryjson()
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
$elements[3]->field="`gse_diarycategory`.`name`";
$elements[3]->sort="1";
$elements[3]->header="Diary Category";
$elements[3]->alias="diarycategory";
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
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_diarysubcategory` INNER JOIN `gse_diarycategory` ON `gse_diarycategory`.`id`=`gse_diarysubcategory`.`diarycategory`");
$this->load->view("json",$data);
}

public function creatediarysubcategory()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="creatediarysubcategory";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data[ 'diarycategory' ] =$this->diarycategory_model->getdropdown();
$data["title"]="Create diarysubcategory";
$this->load->view("template",$data);
}
public function creatediarysubcategorysubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("category","Category","trim");
$this->form_validation->set_rules("name","Name","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data[ 'diarycategory' ] =$this->diarycategory_model->getdropdown();
$data["page"]="creatediarysubcategory";
$data["title"]="Create diarysubcategory";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$order=$this->input->get_post("order");
$status=$this->input->get_post("status");
$diarycategory=$this->input->get_post("diarycategory");
$name=$this->input->get_post("name");
if($this->diarysubcategory_model->create($order,$status,$diarycategory,$name)==0)
$data["alerterror"]="New diarysubcategory could not be created.";
else
$data["alertsuccess"]="diarysubcategory created Successfully.";
$data["redirect"]="site/viewdiarysubcategory";
$this->load->view("redirect",$data);
}
}
public function editdiarysubcategory()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editdiarysubcategory";
$data["title"]="Edit diarysubcategory";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data[ 'diarycategory' ] =$this->diarycategory_model->getdropdown();
$data["before"]=$this->diarysubcategory_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editdiarysubcategorysubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("category","Category","trim");
$this->form_validation->set_rules("name","Name","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editdiarysubcategory";
$data["title"]="Edit diarysubcategory";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data[ 'diarycategory' ] =$this->diarycategory_model->getdropdown();
$data["before"]=$this->diarysubcategory_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$order=$this->input->get_post("order");
$status=$this->input->get_post("status");
$diarycategory=$this->input->get_post("diarycategory");
$name=$this->input->get_post("name");
if($this->diarysubcategory_model->edit($id,$order,$status,$diarycategory,$name)==0)
$data["alerterror"]="New diarysubcategory could not be Updated.";
else
$data["alertsuccess"]="diarysubcategory Updated Successfully.";
$data["redirect"]="site/viewdiarysubcategory";
$this->load->view("redirect",$data);
}
}
public function deletediarysubcategory()
{
$access=array("1");
$this->checkaccess($access);
$this->diarysubcategory_model->delete($this->input->get("id"));
$data["redirect"]="site/viewdiarysubcategory";
$this->load->view("redirect",$data);
}
public function viewdiaryarticle()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewdiaryarticle";
$data["base_url"]=site_url("site/viewdiaryarticlejson");
$data["title"]="View diaryarticle";
$this->load->view("template",$data);
}
function viewdiaryarticlejson()
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
$elements[2]->field="`gse_diaryarticle`.`diarycategory`";
$elements[2]->sort="1";
$elements[2]->header="Diary Category";
$elements[2]->alias="diarycategory";
$elements[3]=new stdClass();
$elements[3]->field="`gse_diaryarticle`.`diarysubcategory`";
$elements[3]->sort="1";
$elements[3]->header="Diary Sub Category";
$elements[3]->alias="diarysubcategory";
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
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_diaryarticle`");
$this->load->view("json",$data);
}

public function creatediaryarticle()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="creatediaryarticle";
$data["title"]="Create diaryarticle";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data[ 'author' ] =$this->author_model->getdropdown();
$data[ 'diarycategory' ] =$this->diarycategory_model->getdropdown();
$data[ 'diarysubcategory' ] =$this->diarysubcategory_model->getdropdown();
$data[ 'type' ] =$this->diarycategory_model->gettypedropdown();
$this->load->view("template",$data);
}
public function creatediaryarticlesubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("category","Category","trim");
$this->form_validation->set_rules("subcategory","Sub Category","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("image","Image","trim");
$this->form_validation->set_rules("timestamp","Timestamp","trim");
$this->form_validation->set_rules("content","Content","trim");
$this->form_validation->set_rules("date","Date","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="creatediaryarticle";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
    $data[ 'diarycategory' ] =$this->diarycategory_model->getdropdown();
     $data[ 'diarysubcategory' ] =$this->diarysubcategory_model->getdropdown();
$data[ 'type' ] =$this->diarycategory_model->gettypedropdown();
$data["title"]="Create diaryarticle";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$status=$this->input->get_post("status");
$diarycategory=$this->input->get_post("diarycategory");
$author=$this->input->get_post("author");
$diarysubcategory=$this->input->get_post("diarysubcategory");
$name=$this->input->get_post("name");
//$image=$this->menu_model->createImage();
$content=$this->input->get_post("content");
$date=$this->input->get_post("date");
$type=$this->input->get_post("type");
     $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];

                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r);
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }

			}
if($this->diaryarticle_model->create($status,$diarycategory,$diarysubcategory,$name,$image,$timestamp,$content,$date,$type,$author)==0)
$data["alerterror"]="New diaryarticle could not be created.";
else
$data["alertsuccess"]="diaryarticle created Successfully.";
$data["redirect"]="site/viewdiaryarticle";
$this->load->view("redirect",$data);
}
}
public function editdiaryarticle()
{
$access=array("1");
$this->checkaccess($access);
$data["title"]="Edit diaryarticle";
$data["page"]="editdiaryarticle";
$data["page2"]="block/diaryblock";
$data["before1"]=$this->input->get('id');
$data["before2"]=$this->input->get('id');
$data["before3"]=$this->input->get('id');
$data["before4"]=$this->input->get('id');
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data[ 'author' ] =$this->author_model->getdropdown();
$data[ 'diarycategory' ] =$this->diarycategory_model->getdropdown();
 $data[ 'diarysubcategory' ] =$this->diarysubcategory_model->getdropdown();
$data[ 'type' ] =$this->diarycategory_model->gettypedropdown();
$data["before"]=$this->diaryarticle_model->beforeedit($this->input->get("id"));
$data['typecheck']=$data["before"]->type;
$this->load->view("templatewith2",$data);
}
public function editdiaryarticlesubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("category","Category","trim");
$this->form_validation->set_rules("subcategory","Sub Category","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("image","Image","trim");
$this->form_validation->set_rules("timestamp","Timestamp","trim");
$this->form_validation->set_rules("content","Content","trim");
$this->form_validation->set_rules("date","Date","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editdiaryarticle";
$data["title"]="Edit diaryarticle";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data[ 'type' ] =$this->diarycategory_model->gettypedropdown();
 $data[ 'diarysubcategory' ] =$this->diarysubcategory_model->getdropdown();
$data[ 'diarycategory' ] =$this->diarycategory_model->getdropdown();
$data["before"]=$this->diaryarticle_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$status=$this->input->get_post("status");
$diarycategory=$this->input->get_post("diarycategory");
$author=$this->input->get_post("author");
$diarysubcategory=$this->input->get_post("diarysubcategory");
$name=$this->input->get_post("name");
//$image=$this->menu_model->createImage();
$timestamp=$this->input->get_post("timestamp");
$content=$this->input->get_post("content");
$date=$this->input->get_post("date");
$type=$this->input->get_post("type");
      $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];

                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r);
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }

			}
    $id=$this->diaryarticle_model->edit($id,$status,$diarycategory,$diarysubcategory,$name,$image,$timestamp,$content,$date,$type,$author);
if($id==0)
$data["alerterror"]="New diaryarticle could not be Updated.";
else
$data["alertsuccess"]="diaryarticle Updated Successfully.";
$data["redirect"]="site/viewdiaryarticle";
// $data["redirect"]="site/editdiaryarticle?id=".$id;
$this->load->view("redirect",$data);
}
}
public function deletediaryarticle()
{
$access=array("1");
$this->checkaccess($access);
$this->diaryarticle_model->delete($this->input->get("id"));
$data["redirect"]="site/viewdiaryarticle";
$this->load->view("redirect",$data);
}

    // TALENT VIDEOS

    public function viewtalentvideo()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewtalentvideo";
$data["page2"]="block/talentblock";
$data["talent"]=$this->talentdetail_model->getdropdown();
$data["before1"]=$this->input->get('id');
$data["before2"]=$this->input->get('id');
$data["before3"]=$this->input->get('id');
$data["before4"]=$this->input->get('id');
$data["base_url"]=site_url("site/viewtalentvideojson?id=").$this->input->get('id');
$data["title"]="View talent";
$this->load->view("templatewith2",$data);
}
function viewtalentvideojson()
{
    $id=$this->input->get('id');
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`talentvideo`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`talentvideo`.`url`";
$elements[1]->sort="1";
$elements[1]->header="Url";
$elements[1]->alias="url";

$elements[2]=new stdClass();
$elements[2]->field="`talentvideo`.`talent`";
$elements[2]->sort="1";
$elements[2]->header="talent";
$elements[2]->alias="talent";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `talentvideo`","WHERE `talentvideo`.`talent`='$id'");
$this->load->view("json",$data);
}

public function createtalentvideo()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createtalentvideo";
$data["page2"]="block/talentblock";
$data["talent"]=$this->talentdetail_model->getdropdown();
$data["before1"]=$this->input->get('id');
$data["before2"]=$this->input->get('id');
$data["before3"]=$this->input->get('id');
$data["before4"]=$this->input->get('id');
$data["title"]="Create talent";
$this->load->view("templatewith2",$data);
}
public function createtalentvideosubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("content","Content","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["talent"]=$this->talentdetail_model->getdropdown();
$data["page"]="createtalentvideo";
$data["title"]="Create talent";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$url=$this->input->get_post("url");
$talent=$this->input->get_post("talent");
if($this->talent_model->create($url,$talent)==0)
$data["alerterror"]="New talent could not be created.";
else
$data["alertsuccess"]="talent created Successfully.";
$data["redirect"]="site/viewtalentvideo?id=".$talent;
$this->load->view("redirect2",$data);
}
}
public function edittalentvideo()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="edittalentvideo";
$data["page2"]="block/talentblock";
$data["before1"]=$this->input->get('talentid');
$data["talent"]=$this->talentdetail_model->getdropdown();
$data["before2"]=$this->input->get('talentid');
$data["before3"]=$this->input->get('talentid');
$data["before4"]=$this->input->get('talentid');
$data["title"]="Edit talent";
$data["before"]=$this->talent_model->beforeedit($this->input->get("id"));
$this->load->view("templatewith2",$data);
}
public function edittalentvideosubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("content","Content","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["talent"]=$this->talentdetail_model->getdropdown();
$data["page"]="edittalentvideo";
$data["title"]="Edit talent";
$data["before"]=$this->talent_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$url=$this->input->get_post("url");
$talent=$this->input->get_post("talent");
if($this->talent_model->edit($id,$url,$talent)==0)
$data["alerterror"]="New talent could not be Updated.";
else
$data["alertsuccess"]="talent Updated Successfully.";
$data["redirect"]="site/viewtalentvideo?id=".$talent;
$this->load->view("redirect2",$data);
}
}
public function deletetalentvideo()
{
$access=array("1");
$this->checkaccess($access);
$this->talent_model->delete($this->input->get("id"));
$data["redirect"]="site/viewtalentvideo?id=".$this->input->get('talentid');
$this->load->view("redirect2",$data);
}

    public function viewblogvideo()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewblogvideo";
$data["page2"]="block/diaryblock";
$data["before1"]=$this->input->get('id');
$data["before2"]=$this->input->get('id');
$data["before3"]=$this->input->get('id');
$data["before4"]=$this->input->get('id');
$data["base_url"]=site_url("site/viewblogvideojson?id=").$this->input->get('id');
$data["title"]="View blogvideo";
$this->load->view("templatewith2",$data);
}
function viewblogvideojson()
{
$id=$this->input->get('id');
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`gse_blogvideo`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`gse_blogvideo`.`diaryarticle`";
$elements[1]->sort="1";
$elements[1]->header="Diary Article";
$elements[1]->alias="diaryarticle";
$elements[2]=new stdClass();
$elements[2]->field="`gse_blogvideo`.`url`";
$elements[2]->sort="1";
$elements[2]->header="Url";
$elements[2]->alias="url";
$elements[3]=new stdClass();
$elements[3]->field="`gse_blogvideo`.`order`";
$elements[3]->sort="1";
$elements[3]->header="Order";
$elements[3]->alias="order";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_blogvideo`","WHERE `gse_blogvideo`.`diaryarticle`='$id'");
$this->load->view("json",$data);
}

public function createblogvideo()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createblogvideo";
$data["page2"]="block/diaryblock";
$data["before1"]=$this->input->get('id');
$data["before2"]=$this->input->get('id');
$data["before3"]=$this->input->get('id');
$data["before4"]=$this->input->get('id');
$data["diaryarticle"]=$this->diaryarticle_model->getdropdown();
$data["title"]="Create blogvideo";
$this->load->view("templatewith2",$data);
}
public function createblogvideosubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("diaryarticle","Diary Article","trim");
$this->form_validation->set_rules("url","Url","trim");
$this->form_validation->set_rules("order","Order","trim");
$data["diaryarticle"]=$this->diaryarticle_model->getdropdown();
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createblogvideo";
$data["title"]="Create blogvideo";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$diaryarticle=$this->input->get_post("diaryarticle");
$url=$this->input->get_post("url");
$order=$this->input->get_post("order");
if($this->blogvideo_model->create($diaryarticle,$url,$order)==0)
$data["alerterror"]="New blogvideo could not be created.";
else
$data["alertsuccess"]="blogvideo created Successfully.";
$data["redirect"]="site/viewblogvideo?id=".$diaryarticle;
$this->load->view("redirect2",$data);
}
}
public function editblogvideo()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editblogvideo";
$data["diaryarticle"]=$this->diaryarticle_model->getdropdown();
$data["title"]="Edit blogvideo";
$data["before"]=$this->blogvideo_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editblogvideosubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("diaryarticle","Diary Article","trim");
$this->form_validation->set_rules("url","Url","trim");
$this->form_validation->set_rules("order","Order","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["diaryarticle"]=$this->diaryarticle_model->getdropdown();
$data["page"]="editblogvideo";
$data["title"]="Edit blogvideo";
$data["before"]=$this->blogvideo_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$diaryarticle=$this->input->get_post("diaryarticle");
$url=$this->input->get_post("url");
$order=$this->input->get_post("order");
if($this->blogvideo_model->edit($id,$diaryarticle,$url,$order)==0)
$data["alerterror"]="New blogvideo could not be Updated.";
else
$data["alertsuccess"]="blogvideo Updated Successfully.";
$data["redirect"]="site/viewblogvideo?id=".$diaryarticle;
$this->load->view("redirect2",$data);
}
}
public function deleteblogvideo()
{
$access=array("1");
$this->checkaccess($access);
$this->blogvideo_model->delete($this->input->get("id"));
$data["redirect"]="site/viewblogvideo?id=".$this->input->get('diaryarticleid');
$this->load->view("redirect2",$data);
}
public function viewblogimage()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewblogimage";
$data["page2"]="block/diaryblock";
$data["before1"]=$this->input->get('id');
$data["before2"]=$this->input->get('id');
$data["before3"]=$this->input->get('id');
$data["before4"]=$this->input->get('id');
$data["base_url"]=site_url("site/viewblogimagejson?id=").$this->input->get('id');
$data["title"]="View blogimage";
$this->load->view("templatewith2",$data);
}
function viewblogimagejson()
{
    $id=$this->input->get('id');
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`gse_blogimage`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`gse_blogimage`.`diaryarticle`";
$elements[1]->sort="1";
$elements[1]->header="Diary Article";
$elements[1]->alias="diaryarticle";
$elements[2]=new stdClass();
$elements[2]->field="`gse_blogimage`.`image`";
$elements[2]->sort="1";
$elements[2]->header="Image";
$elements[2]->alias="image";
$elements[3]=new stdClass();
$elements[3]->field="`gse_blogimage`.`order`";
$elements[3]->sort="1";
$elements[3]->header="Order";
$elements[3]->alias="order";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_blogimage`","WHERE `gse_blogimage`.`diaryarticle`='$id'");
$this->load->view("json",$data);
}

public function createblogimage()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createblogimage";
$data["page2"]="block/diaryblock";
$data["before1"]=$this->input->get('id');
$data["before2"]=$this->input->get('id');
$data["before3"]=$this->input->get('id');
$data["before4"]=$this->input->get('id');
$data["diaryarticle"]=$this->diaryarticle_model->getdropdown();
$data["title"]="Create blogimage";
$this->load->view("templatewith2",$data);
}
public function createblogimagesubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("diaryarticle","Diary Article","trim");
$this->form_validation->set_rules("image","Image","trim");
$this->form_validation->set_rules("order","Order","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["diaryarticle"]=$this->diaryarticle_model->getdropdown();
$data["page"]="createblogimage";
$data["title"]="Create blogimage";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$diaryarticle=$this->input->get_post("diaryarticle");
//$image=$this->input->get_post("image");
$order=$this->input->get_post("order");
        $image=$this->menu_model->createImage();
if($this->blogimage_model->create($diaryarticle,$image,$order)==0)
$data["alerterror"]="New blogimage could not be created.";
else
$data["alertsuccess"]="blogimage created Successfully.";
$data["redirect"]="site/viewblogimage?id=".$diaryarticle;
$this->load->view("redirect2",$data);
}
}
public function editblogimage()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editblogimage";
$data["title"]="Edit blogimage";
$data["diaryarticle"]=$this->diaryarticle_model->getdropdown();
$data["before"]=$this->blogimage_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editblogimagesubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("diaryarticle","Diary Article","trim");
$this->form_validation->set_rules("image","Image","trim");
$this->form_validation->set_rules("order","Order","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editblogimage";
$data["diaryarticle"]=$this->diaryarticle_model->getdropdown();
$data["title"]="Edit blogimage";
$data["before"]=$this->blogimage_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$diaryarticle=$this->input->get_post("diaryarticle");
//$image=$this->input->get_post("image");
$order=$this->input->get_post("order");
        $image=$this->menu_model->createImage();
if($this->blogimage_model->edit($id,$diaryarticle,$image,$order)==0)
$data["alerterror"]="New blogimage could not be Updated.";
else
$data["alertsuccess"]="blogimage Updated Successfully.";
$data["redirect"]="site/viewblogimage?id=".$diaryarticle;
$this->load->view("redirect2",$data);
}
}
public function deleteblogimage()
{
$access=array("1");
$this->checkaccess($access);
$this->blogimage_model->delete($this->input->get("id"));
$data["redirect"]="site/viewblogimage?id=".$this->input->get('diaryarticleid');
$this->load->view("redirect2",$data);
}
public function viewblogtext()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewblogtext";
$data["page2"]="block/diaryblock";
$data["before1"]=$this->input->get('id');
$data["before2"]=$this->input->get('id');
$data["before3"]=$this->input->get('id');
$data["before4"]=$this->input->get('id');
$data["base_url"]=site_url("site/viewblogtextjson?id=").$this->input->get('id');
$data["title"]="View blogtext";
$this->load->view("templatewith2",$data);
}
function viewblogtextjson()
{
$id=$this->input->get('id');
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`gse_blogtext`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`gse_blogtext`.`diaryarticle`";
$elements[1]->sort="1";
$elements[1]->header="Diary Article";
$elements[1]->alias="diaryarticle";
$elements[2]=new stdClass();
$elements[2]->field="`gse_blogtext`.`content`";
$elements[2]->sort="1";
$elements[2]->header="Content";
$elements[2]->alias="content";
$elements[3]=new stdClass();
$elements[3]->field="`gse_blogtext`.`image`";
$elements[3]->sort="1";
$elements[3]->header="Image";
$elements[3]->alias="image";
$elements[4]=new stdClass();
$elements[4]->field="`gse_blogtext`.`order`";
$elements[4]->sort="1";
$elements[4]->header="Order";
$elements[4]->alias="order";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_blogtext`","WHERE `gse_blogtext`.`diaryarticle`='$id'");
$this->load->view("json",$data);
}

public function createblogtext()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createblogtext";
$data["page2"]="block/diaryblock";
$data["before1"]=$this->input->get('id');
$data["before2"]=$this->input->get('id');
$data["before3"]=$this->input->get('id');
$data["before4"]=$this->input->get('id');
$data["diaryarticle"]=$this->diaryarticle_model->getdropdown();
$data["title"]="Create blogtext";
$this->load->view("templatewith2",$data);
}
public function createblogtextsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("diaryarticle","Diary Article","trim");
$this->form_validation->set_rules("content","Content","trim");
$this->form_validation->set_rules("image","Image","trim");
$this->form_validation->set_rules("order","Order","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["diaryarticle"]=$this->diaryarticle_model->getdropdown();
$data["page"]="createblogtext";
$data["title"]="Create blogtext";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$diaryarticle=$this->input->get_post("diaryarticle");
$content=$this->input->get_post("content");
//$image=$this->input->get_post("image");
$order=$this->input->get_post("order");
    $image=$this->menu_model->createImage();
if($this->blogtext_model->create($diaryarticle,$content,$image,$order)==0)
$data["alerterror"]="New blogtext could not be created.";
else
$data["alertsuccess"]="blogtext created Successfully.";
$data["redirect"]="site/viewblogtext?id=".$diaryarticle;
$this->load->view("redirect2",$data);
}
}
public function editblogtext()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editblogtext";
$data["title"]="Edit blogtext";
$data["diaryarticle"]=$this->diaryarticle_model->getdropdown();
$data["before"]=$this->blogtext_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editblogtextsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("diaryarticle","Diary Article","trim");
$this->form_validation->set_rules("content","Content","trim");
$this->form_validation->set_rules("image","Image","trim");
$this->form_validation->set_rules("order","Order","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editblogtext";
$data["title"]="Edit blogtext";
$data["diaryarticle"]=$this->diaryarticle_model->getdropdown();
$data["before"]=$this->blogtext_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$diaryarticle=$this->input->get_post("diaryarticle");
$content=$this->input->get_post("content");
//$image=$this->input->get_post("image");
$order=$this->input->get_post("order");
    $image=$this->menu_model->createImage();
if($this->blogtext_model->edit($id,$diaryarticle,$content,$image,$order)==0)
$data["alerterror"]="New blogtext could not be Updated.";
else
$data["alertsuccess"]="blogtext Updated Successfully.";
$data["redirect"]="site/viewblogtext?id=".$diaryarticle;
$this->load->view("redirect2",$data);
}
}
public function deleteblogtext()
{
$access=array("1");
$this->checkaccess($access);
$this->blogtext_model->delete($this->input->get("id"));
$data["redirect"]="site/viewblogtext?id=".$this->input->get('diaryarticleid');
$this->load->view("redirect2",$data);
}
    public function updatetypeinarticle()
{
        $id=$this->input->get_post('id');
        $type=$this->input->get_post('type');
        $this->db->query("UPDATE `gse_diaryarticle` SET `showhide`='$type',`type`='$type' WHERE `id`='$id'");
}
     public function viewpreviousgamevideo()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewpreviousgamevideo";
$data["page2"]="block/highlightblock";
$data["before1"]=$this->input->get('id');
$data["before2"]=$this->input->get('id');
$data["before3"]=$this->input->get('id');
$data["before4"]=$this->input->get('id');
$data["base_url"]=site_url("site/viewpreviousgamevideojson?id=").$this->input->get('id');
$data["title"]="View previousgamevideo";
$this->load->view("templatewith2",$data);
}
function viewpreviousgamevideojson()
{
$id=$this->input->get('id');
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`gse_previousgamevideo`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`gse_previousgamevideo`.`highlight`";
$elements[1]->sort="1";
$elements[1]->header="highlight";
$elements[1]->alias="highlight";
$elements[2]=new stdClass();
$elements[2]->field="`gse_previousgamevideo`.`url`";
$elements[2]->sort="1";
$elements[2]->header="Url";
$elements[2]->alias="url";
$elements[3]=new stdClass();
$elements[3]->field="`gse_previousgamevideo`.`order`";
$elements[3]->sort="1";
$elements[3]->header="Order";
$elements[3]->alias="order";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_previousgamevideo`","WHERE `gse_previousgamevideo`.`highlight`='$id'");
$this->load->view("json",$data);
}

public function createpreviousgamevideo()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createpreviousgamevideo";
$data["page2"]="block/highlightblock";
$data["before1"]=$this->input->get('id');
$data["before2"]=$this->input->get('id');
$data["before3"]=$this->input->get('id');
$data["before4"]=$this->input->get('id');
$data["diaryarticle"]=$this->diaryarticle_model->getdropdown();
       $data[ 'highlight' ] =$this->highlight_model->getdropdown();
    $data[ 'sportscategory' ] =$this->sportscategory_model->getdropdown();
$data["title"]="Create previousgamevideo";
$this->load->view("templatewith2",$data);
}
public function createpreviousgamevideosubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("diaryarticle","Diary Article","trim");
$this->form_validation->set_rules("url","Url","trim");
$this->form_validation->set_rules("order","Order","trim");
$data["diaryarticle"]=$this->diaryarticle_model->getdropdown();
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
   $data[ 'highlight' ] =$this->highlight_model->getdropdown();
    $data[ 'sportscategory' ] =$this->sportscategory_model->getdropdown();
$data["page"]="createpreviousgamevideo";
$data["title"]="Create previousgamevideo";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$highlight=$this->input->get_post("highlight");
$sportscategory=$this->input->get_post("sportscategory");
$url=$this->input->get_post("url");
$order=$this->input->get_post("order");
if($this->previousgamevideo_model->create($order,$url,$highlight,$sportscategory)==0)
$data["alerterror"]="New previousgamevideo could not be created.";
else
$data["alertsuccess"]="previousgamevideo created Successfully.";
$data["redirect"]="site/viewpreviousgamevideo?id=".$highlight;
$this->load->view("redirect2",$data);
}
}
public function editpreviousgamevideo()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editpreviousgamevideo";
$data["diaryarticle"]=$this->diaryarticle_model->getdropdown();
   $data[ 'highlight' ] =$this->highlight_model->getdropdown();
    $data[ 'sportscategory' ] =$this->sportscategory_model->getdropdown();
$data["title"]="Edit previousgamevideo";
$data["before"]=$this->previousgamevideo_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editpreviousgamevideosubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("diaryarticle","Diary Article","trim");
$this->form_validation->set_rules("url","Url","trim");
$this->form_validation->set_rules("order","Order","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["diaryarticle"]=$this->diaryarticle_model->getdropdown();
       $data[ 'highlight' ] =$this->highlight_model->getdropdown();
    $data[ 'sportscategory' ] =$this->sportscategory_model->getdropdown();
$data["page"]="editpreviousgamevideo";
$data["title"]="Edit previousgamevideo";
$data["before"]=$this->previousgamevideo_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$highlight=$this->input->get_post("highlight");
$sportscategory=$this->input->get_post("sportscategory");
$url=$this->input->get_post("url");
$order=$this->input->get_post("order");
if($this->previousgamevideo_model->edit($id,$order,$url,$highlight,$sportscategory)==0)
$data["alerterror"]="New previousgamevideo could not be Updated.";
else
$data["alertsuccess"]="previousgamevideo Updated Successfully.";
$data["redirect"]="site/viewpreviousgamevideo?id=".$highlight;
$this->load->view("redirect2",$data);
}
}
public function deletepreviousgamevideo()
{
$access=array("1");
$this->checkaccess($access);
$this->previousgamevideo_model->delete($this->input->get("id"));
$data["redirect"]="site/viewpreviousgamevideo?id=".$this->input->get('highlightid');
$this->load->view("redirect2",$data);
}

//    talent type videos

     public function viewtalenttypevideo()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewtalenttypevideo";
$data["page2"]="block/talentinside";
$data["before1"]=$this->input->get('id');
$data["before2"]=$this->input->get('id');
$data["before3"]=$this->input->get('id');
$data["before4"]=$this->input->get('id');
$data["base_url"]=site_url("site/viewtalenttypevideojson?id=").$this->input->get('id');
$data["title"]="View talenttypevideo";
$this->load->view("templatewith2",$data);
}
function viewtalenttypevideojson()
{
$id=$this->input->get('id');
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`gse_talenttypevideo`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`gse_talenttypevideo`.`talenttype`";
$elements[1]->sort="1";
$elements[1]->header="Talent Type";
$elements[1]->alias="talenttype";
$elements[2]=new stdClass();
$elements[2]->field="`gse_talenttypevideo`.`url`";
$elements[2]->sort="1";
$elements[2]->header="Url";
$elements[2]->alias="url";
$elements[3]=new stdClass();
$elements[3]->field="`gse_talenttypevideo`.`order`";
$elements[3]->sort="1";
$elements[3]->header="Order";
$elements[3]->alias="order";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_talenttypevideo`","WHERE `gse_talenttypevideo`.`talenttype`='$id'");
$this->load->view("json",$data);
}

public function createtalenttypevideo()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createtalenttypevideo";
$data["page2"]="block/talentinside";
$data["before1"]=$this->input->get('id');
$data["before2"]=$this->input->get('id');
$data["before3"]=$this->input->get('id');
$data["before4"]=$this->input->get('id');
$data["talenttype"]=$this->talenttype_model->getdropdown();
$data["title"]="Create talenttypevideo";
$this->load->view("templatewith2",$data);
}
public function createtalenttypevideosubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("talenttype","Diary Article","trim");
$this->form_validation->set_rules("url","Url","trim");
$this->form_validation->set_rules("order","Order","trim");
$data["talenttype"]=$this->talenttype_model->getdropdown();
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createtalenttypevideo";
$data["title"]="Create talenttypevideo";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$talenttype=$this->input->get_post("talenttype");
$url=$this->input->get_post("url");
$order=$this->input->get_post("order");
if($this->talenttypevideo_model->create($talenttype,$url,$order)==0)
$data["alerterror"]="New talenttypevideo could not be created.";
else
$data["alertsuccess"]="talenttypevideo created Successfully.";
$data["redirect"]="site/viewtalenttypevideo?id=".$talenttype;
$this->load->view("redirect2",$data);
}
}
public function edittalenttypevideo()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="edittalenttypevideo";
$data["talenttype"]=$this->talenttype_model->getdropdown();
$data["title"]="Edit talenttypevideo";
$data["before"]=$this->talenttypevideo_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function edittalenttypevideosubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("talenttype","Diary Article","trim");
$this->form_validation->set_rules("url","Url","trim");
$this->form_validation->set_rules("order","Order","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["talenttype"]=$this->talenttype_model->getdropdown();
$data["page"]="edittalenttypevideo";
$data["title"]="Edit talenttypevideo";
$data["before"]=$this->talenttypevideo_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$talenttype=$this->input->get_post("talenttype");
$url=$this->input->get_post("url");
$order=$this->input->get_post("order");
if($this->talenttypevideo_model->edit($id,$talenttype,$url,$order)==0)
$data["alerterror"]="New talenttypevideo could not be Updated.";
else
$data["alertsuccess"]="talenttypevideo Updated Successfully.";
$data["redirect"]="site/viewtalenttypevideo?id=".$talenttype;
$this->load->view("redirect2",$data);
}
}
public function deletetalenttypevideo()
{
$access=array("1");
$this->checkaccess($access);
$this->talenttypevideo_model->delete($this->input->get("id"));
$data["redirect"]="site/viewtalenttypevideo?id=".$this->input->get('talenttypeid');
$this->load->view("redirect2",$data);
}

public function vieweventtype()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="vieweventtype";
$data["page2"]="block/eventblock";
$data["before1"]=$this->input->get('id');
$data["before2"]=$this->input->get('id');
$data["before3"]=$this->input->get('id');
$data["before4"]=$this->input->get('id');
$data["base_url"]=site_url("site/vieweventtypejson?id=").$this->input->get('id');
$data["title"]="View eventtype";
$this->load->view("templatewith2",$data);
}
function vieweventtypejson()
{
    $id=$this->input->get('id');
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`gse_eventvideos`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`gse_eventvideos`.`event`";
$elements[1]->sort="1";
$elements[1]->header="event";
$elements[1]->alias="event";
$elements[2]=new stdClass();
$elements[2]->field="`gse_eventvideos`.`url`";
$elements[2]->sort="1";
$elements[2]->header="Url";
$elements[2]->alias="url";
$elements[3]=new stdClass();
$elements[3]->field="`gse_eventvideos`.`status`";
$elements[3]->sort="1";
$elements[3]->header="Status";
$elements[3]->alias="status";
$elements[4]=new stdClass();
$elements[4]->field="`gse_eventvideos`.`order`";
$elements[4]->sort="1";
$elements[4]->header="Order";
$elements[4]->alias="order";

$elements[5]=new stdClass();
$elements[5]->field="`gse_eventsubtype`.`name`";
$elements[5]->sort="1";
$elements[5]->header="Event Sub Type";
$elements[5]->alias="eventsubtype";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_eventvideos` LEFT OUTER JOIN `gse_eventsubtype` ON `gse_eventsubtype`.`id`=`gse_eventvideos`.`eventsubtype`","WHERE `gse_eventvideos`.`event`='$id'");
$this->load->view("json",$data);
}

public function createeventtype()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createeventtype";
// $data["page2"]="block/eventblock";
// $data["before1"]=$this->input->get('id');
// $data["before2"]=$this->input->get('id');
// $data["before3"]=$this->input->get('id');
// $data["before4"]=$this->input->get('id');
$data["event"]=$this->event_model->getdropdown();
$data["eventsubtype"]=$this->eventsubtype_model->getdropdown();
$data["title"]="Create eventtype";
// $this->load->view("templatewith2",$data);
$this->load->view("template",$data);
}
public function createeventtypesubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("event","Wedding","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("image","Image","trim");
$this->form_validation->set_rules("banner","Banner","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createeventtype";
$data["event"]=$this->event_model->getdropdown();
$data["eventsubtype"]=$this->eventsubtype_model->getdropdown();
$data["title"]="Create eventtype";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$event=$this->input->get_post("event");
$eventsubtype=$this->input->get_post("eventsubtype");
$url=$this->input->get_post("url");
$order=$this->input->get_post("order");
$image=$this->menu_model->createImage();
//$banner=$this->input->get_post("banner");
    $config['upload_path'] = './uploads/';
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$this->load->library('upload', $config);
						$filename="banner";
						$banner="";
						if (  $this->upload->do_upload($filename))
						{
							$uploaddata = $this->upload->data();
							$banner=$uploaddata['file_name'];
						}
if($this->eventtype_model->create($event,$url,$order,$eventsubtype)==0)
$data["alerterror"]="New eventtype could not be created.";
else
$data["alertsuccess"]="eventtype created Successfully.";
$data["redirect"]="site/vieweventtype?id=".$event;
$this->load->view("redirect2",$data);
}
}
public function editeventtype()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editeventtype";
// $data["page2"]="block/eventblock";
// $data["before1"]=$this->input->get('id');
// $data["before2"]=$this->input->get('id');
// $data["before3"]=$this->input->get('id');
// $data["before4"]=$this->input->get('id');
$data["event"]=$this->event_model->getdropdown();
$data["eventsubtype"]=$this->eventsubtype_model->getdropdown();
$data["title"]="Edit eventtype";
$data["before"]=$this->eventtype_model->beforeedit($this->input->get("id"));
// $this->load->view("templatewith2",$data);
$this->load->view("template",$data);
}
public function editeventtypesubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("event","Wedding","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("image","Image","trim");
$this->form_validation->set_rules("banner","Banner","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editeventtype";
$data["event"]=$this->event_model->getdropdown();
$data["eventsubtype"]=$this->eventsubtype_model->getdropdown();
$data["title"]="Edit eventtype";
$data["before"]=$this->eventtype_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$event=$this->input->get_post("event");
$url=$this->input->get_post("url");
$order=$this->input->get_post("order");
$eventsubtype=$this->input->get_post("eventsubtype");
// $image=$this->menu_model->createImage();
// //$banner=$this->input->get_post("banner");
//      $config['upload_path'] = './uploads/';
// 						$config['allowed_types'] = 'gif|jpg|png|jpeg';
// 						$this->load->library('upload', $config);
// 						$filename="banner";
// 						$banner="";
// 						if (  $this->upload->do_upload($filename))
// 						{
// 							$uploaddata = $this->upload->data();
// 							$banner=$uploaddata['file_name'];
// 						}
//
// 						if($banner=="")
// 						{
// 						$banner=$this->eventtype_model->getbannerbyid($id);
// 						   // print_r($image);
// 							$banner=$banner->banner;
// 						}
if($this->eventtype_model->edit($id,$event,$url,$order,$eventsubtype)==0)
$data["alerterror"]="New eventtype could not be Updated.";
else
$data["alertsuccess"]="eventtype Updated Successfully.";
$data["redirect"]="site/vieweventtype?id=".$event;
$this->load->view("redirect2",$data);
}
}
public function deleteeventtype()
{
$access=array("1");
$this->checkaccess($access);
$this->eventtype_model->delete($this->input->get("id"));
$data["redirect"]="site/vieweventtype?id=".$this->input->get("eventid");
$this->load->view("redirect2",$data);
}
public function vieweventsubtype()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="vieweventsubtype";
    $data["page2"]="block/eventblock";
$data["before1"]=$this->input->get('id');
$data["before2"]=$this->input->get('id');
$data["before3"]=$this->input->get('id');
$data["before4"]=$this->input->get('id');
$data["base_url"]=site_url("site/vieweventsubtypejson?id=").$this->input->get('id');
$data["title"]="View eventsubtype";
$this->load->view("templatewith2",$data);
// $this->load->view("template",$data);
}
function vieweventsubtypejson()
{
    $id=$this->input->get('id');
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`gse_eventsubtype`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`gse_eventsubtype`.`event`";
$elements[1]->sort="1";
$elements[1]->header="Wedding";
$elements[1]->alias="event";
$elements[2]=new stdClass();
$elements[2]->field="`gse_eventsubtype`.`name`";
$elements[2]->sort="1";
$elements[2]->header="Name";
$elements[2]->alias="name";
$elements[3]=new stdClass();
$elements[3]->field="`gse_eventsubtype`.`image`";
$elements[3]->sort="1";
$elements[3]->header="Image";
$elements[3]->alias="image";
$elements[4]=new stdClass();
$elements[4]->field="`gse_eventsubtype`.`content`";
$elements[4]->sort="1";
$elements[4]->header="Content";
$elements[4]->alias="content";
$elements[5]=new stdClass();
$elements[5]->field="`gse_eventsubtype`.`order`";
$elements[5]->sort="1";
$elements[5]->header="Order";
$elements[5]->alias="order";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_eventsubtype`","WHERE `gse_eventsubtype`.`event`='$id'");
$this->load->view("json",$data);
}

public function createeventsubtype()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createeventsubtype";
// $data["page2"]="block/eventblock";
// $data["before1"]=$this->input->get('id');
// $data["before2"]=$this->input->get('id');
// $data["before3"]=$this->input->get('id');
// $data["before4"]=$this->input->get('id');
$data["event"]=$this->event_model->getdropdown();
$data["title"]="Create eventsubtype";
// $this->load->view("templatewith2",$data);
$this->load->view("template",$data);
}
public function createeventsubtypesubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("event","Wedding","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("image","Image","trim");
$this->form_validation->set_rules("content","Content","trim");
$this->form_validation->set_rules("videos","Videos","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createeventsubtype";
$data["title"]="Create eventsubtype";
$data["event"]=$this->event_model->getdropdown();
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$event=$this->input->get_post("event");
$name=$this->input->get_post("name");
$order=$this->input->get_post("order");
$image=$this->menu_model->createImage();
$content=$this->input->get_post("content");
$videos=$this->input->get_post("videos");
$releasedate=$this->input->get_post("releasedate");
$location=$this->input->get_post("location");
$config['upload_path'] = './uploads/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$this->load->library('upload', $config);
					$filename="banner";
					$banner="";
					if (  $this->upload->do_upload($filename))
					{
						$uploaddata = $this->upload->data();
						$banner=$uploaddata['file_name'];
					}
if($this->eventsubtype_model->create($event,$name,$image,$content,$order,$releasedate,$location,$banner)==0)
$data["alerterror"]="New eventsubtype could not be created.";
else
$data["alertsuccess"]="eventsubtype created Successfully.";
$data["redirect"]="site/vieweventsubtype?id=".$event;
$this->load->view("redirect2",$data);
}
}
public function editeventsubtype()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editeventsubtype";
// $data["page2"]="block/eventblock";
// $data["before1"]=$this->input->get('id');
// $data["before2"]=$this->input->get('id');
// $data["before3"]=$this->input->get('id');
// $data["before4"]=$this->input->get('id');
$data["event"]=$this->event_model->getdropdown();
$data["title"]="Edit eventsubtype";
$data["before"]=$this->eventsubtype_model->beforeedit($this->input->get("id"));
// $this->load->view("templatewith2",$data);
$this->load->view("template",$data);
}
public function editeventsubtypesubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("event","Wedding","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("image","Image","trim");
$this->form_validation->set_rules("content","Content","trim");
$this->form_validation->set_rules("videos","Videos","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editeventsubtype";
$data["title"]="Edit eventsubtype";
$data["event"]=$this->event_model->getdropdown();
$data["before"]=$this->eventsubtype_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$event=$this->input->get_post("event");
$name=$this->input->get_post("name");
$order=$this->input->get_post("order");
$image=$this->menu_model->createImage();
$content=$this->input->get_post("content");
$videos=$this->input->get_post("videos");
$location=$this->input->get_post("location");
$releasedate=$this->input->get_post("releasedate");
$config['upload_path'] = './uploads/';
			 $config['allowed_types'] = 'gif|jpg|png|jpeg';
			 $this->load->library('upload', $config);
			 $filename="banner";
			 $banner="";
			 if (  $this->upload->do_upload($filename))
			 {
				 $uploaddata = $this->upload->data();
				 $banner=$uploaddata['file_name'];
			 }

			 if($banner=="")
			 {
			 $banner=$this->eventsubtype_model->getbannerbyid($id);
					// print_r($image);
				 $banner=$banner->banner;
			 }
if($this->eventsubtype_model->edit($id,$event,$name,$image,$content,$order,$releasedate,$location,$banner)==0)
$data["alerterror"]="New eventsubtype could not be Updated.";
else
$data["alertsuccess"]="eventsubtype Updated Successfully.";
$data["redirect"]="site/vieweventsubtype?id=".$event;
$this->load->view("redirect2",$data);
}
}
public function deleteeventsubtype()
{
$access=array("1");
$this->checkaccess($access);
$this->eventsubtype_model->delete($this->input->get("id"));
$data["redirect"]="site/vieweventsubtype?id=".$this->input->get("eventid");
$this->load->view("redirect2",$data);
}
public function vieweventgallery()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="vieweventgallery";
$data["page2"]="block/eventblock";
$data["before1"]=$this->input->get('id');
$data["before2"]=$this->input->get('id');
$data["before3"]=$this->input->get('id');
$data["before4"]=$this->input->get('id');
$data["base_url"]=site_url("site/vieweventgalleryjson?id=").$this->input->get('id');
$data["title"]="View eventgallery";
$this->load->view("templatewith2",$data);
// $this->load->view("template",$data);
}
function vieweventgalleryjson()
{
    $id=$this->input->get('id');
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`gse_eventgallery`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`gse_eventgallery`.`event`";
$elements[1]->sort="1";
$elements[1]->header="Wedding";
$elements[1]->alias="event";
$elements[2]=new stdClass();
$elements[2]->field="`gse_eventgallery`.`status`";
$elements[2]->sort="1";
$elements[2]->header="Status";
$elements[2]->alias="status";
$elements[3]=new stdClass();
$elements[3]->field="`gse_eventgallery`.`order`";
$elements[3]->sort="1";
$elements[3]->header="Order";
$elements[3]->alias="order";
$elements[4]=new stdClass();
$elements[4]->field="`gse_eventgallery`.`image`";
$elements[4]->sort="1";
$elements[4]->header="Image";
$elements[4]->alias="image";

$elements[5]=new stdClass();
$elements[5]->field="`gse_eventsubtype`.`name`";
$elements[5]->sort="1";
$elements[5]->header="Event Sub Type";
$elements[5]->alias="eventsubtype";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_eventgallery` LEFT OUTER JOIN `gse_eventsubtype` ON `gse_eventsubtype`.`id`=`gse_eventgallery`.`eventsubtype`","WHERE `gse_eventgallery`.`event`='$id'");
$this->load->view("json",$data);
}

public function createeventgallery()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createeventgallery";
// $data["page2"]="block/eventblock";
// $data["before1"]=$this->input->get('id');
// $data["before2"]=$this->input->get('id');
// $data["before3"]=$this->input->get('id');
// $data["before4"]=$this->input->get('id');
$data["event"]=$this->event_model->getdropdown();
$data["eventsubtype"]=$this->eventsubtype_model->getdropdown();
$data["title"]="Create eventgallery";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
// $this->load->view("templatewith2",$data);
$this->load->view("template",$data);
}
public function createeventgallerysubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("event","Wedding","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("image","Image","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createeventgallery";
$data["title"]="Create eventgallery";
$data["event"]=$this->event_model->getdropdown();
$data["eventsubtype"]=$this->eventsubtype_model->getdropdown();
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$event=$this->input->get_post("event");
$status=$this->input->get_post("status");
$order=$this->input->get_post("order");
$eventsubtype=$this->input->get_post("eventsubtype");

$image=$this->menu_model->createImage();
if($this->eventgallery_model->create($event,$status,$order,$image,$eventsubtype)==0)
$data["alerterror"]="New eventgallery could not be created.";
else
$data["alertsuccess"]="eventgallery created Successfully.";
$data["redirect"]="site/vieweventgallery?id=".$event;
$this->load->view("redirect2",$data);
}
}
public function editeventgallery()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editeventgallery";
// $data["page2"]="block/eventblock";
// $data["before1"]=$this->input->get('id');
// $data["before2"]=$this->input->get('id');
// $data["before3"]=$this->input->get('id');
// $data["before4"]=$this->input->get('id');
$data["event"]=$this->event_model->getdropdown();
$data["eventsubtype"]=$this->eventsubtype_model->getdropdown();
$data["title"]="Edit eventgallery";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["before"]=$this->eventgallery_model->beforeedit($this->input->get("id"));
// $this->load->view("templatewith2",$data);
$this->load->view("template",$data);
}
public function editeventgallerysubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("event","Wedding","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("image","Image","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editeventgallery";
$data["title"]="Edit eventgallery";
$data["event"]=$this->event_model->getdropdown();
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["eventsubtype"]=$this->eventsubtype_model->getdropdown();
$data["before"]=$this->eventgallery_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$event=$this->input->get_post("event");
$status=$this->input->get_post("status");
$order=$this->input->get_post("order");
$eventsubtype=$this->input->get_post("eventsubtype");
$image=$this->menu_model->createImage();
if($this->eventgallery_model->edit($id,$event,$status,$order,$image,$eventsubtype)==0)
$data["alerterror"]="New eventgallery could not be Updated.";
else
$data["alertsuccess"]="eventgallery Updated Successfully.";
$data["redirect"]="site/vieweventgallery?id=".$event;
$this->load->view("redirect2",$data);
}
}
public function deleteeventgallery()
{
$access=array("1");
$this->checkaccess($access);
$this->eventgallery_model->delete($this->input->get("id"));
$data["redirect"]="site/vieweventgallery?id=".$this->input->get("eventid");
$this->load->view("redirect2",$data);
}
public function viewmice()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewmice";
$data["base_url"]=site_url("site/viewmicejson");
$data["title"]="View mice";
$this->load->view("template",$data);
}
function viewmicejson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`gse_mice`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`gse_mice`.`name`";
$elements[1]->sort="1";
$elements[1]->header="Name";
$elements[1]->alias="name";
$elements[2]=new stdClass();
$elements[2]->field="`gse_mice`.`link`";
$elements[2]->sort="1";
$elements[2]->header="Url";
$elements[2]->alias="link";

$elements[3]=new stdClass();
$elements[3]->field="`gse_mice`.`order`";
$elements[3]->sort="1";
$elements[3]->header="Order";
$elements[3]->alias="order";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_mice`");
$this->load->view("json",$data);
}

public function createmice()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createmice";
$data["title"]="Create mice";
$this->load->view("template",$data);
}
public function createmicesubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("name","Name","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createmice";
$data["title"]="Create mice";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$name=$this->input->get_post("name");
$link=$this->input->get_post("link");
$order=$this->input->get_post("order");
$image=$this->menu_model->createImage();
//$banner=$this->input->get_post("banner");
    $config['upload_path'] = './uploads/';
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$this->load->library('upload', $config);
						$filename="banner";
						$banner="";
						if (  $this->upload->do_upload($filename))
						{
							$uploaddata = $this->upload->data();
							$banner=$uploaddata['file_name'];
						}
if($this->mice_model->create($name,$image,$banner,$link,$order)==0)
$data["alerterror"]="New mice could not be created.";
else
$data["alertsuccess"]="mice created Successfully.";
$data["redirect"]="site/viewmice";
$this->load->view("redirect",$data);
}
}
public function editmice()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editmice";
$data["page2"]="block/miceblock";
$data["before1"]=$this->input->get('id');
$data["before2"]=$this->input->get('id');
$data["before3"]=$this->input->get('id');
$data["before4"]=$this->input->get('id');
$data["title"]="Edit mice";
$data["before"]=$this->mice_model->beforeedit($this->input->get("id"));
$this->load->view("templatewith2",$data);
}
public function editmicesubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("name","Name","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editmice";
$data["title"]="Edit mice";
$data["before"]=$this->mice_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$name=$this->input->get_post("name");
$link=$this->input->get_post("link");
$order=$this->input->get_post("name");
$image=$this->menu_model->createImage();
//$banner=$this->input->get_post("banner");
     $config['upload_path'] = './uploads/';
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$this->load->library('upload', $config);
						$filename="banner";
						$banner="";
						if (  $this->upload->do_upload($filename))
						{
							$uploaddata = $this->upload->data();
							$banner=$uploaddata['file_name'];
						}

						if($banner=="")
						{
						$banner=$this->mice_model->getbannerbyid($id);
						   // print_r($image);
							$banner=$banner->banner;
						}
if($this->mice_model->edit($id,$name,$image,$banner,$link,$order)==0)
$data["alerterror"]="New mice could not be Updated.";
else
$data["alertsuccess"]="mice Updated Successfully.";
$data["redirect"]="site/viewmice";
$this->load->view("redirect",$data);
}
}
public function deletemice()
{
$access=array("1");
$this->checkaccess($access);
$this->mice_model->delete($this->input->get("id"));
$data["redirect"]="site/viewmice";
$this->load->view("redirect",$data);
}
public function viewmicesubtype()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewmicesubtype";
    $data["page2"]="block/miceblock";
$data["before1"]=$this->input->get('id');
$data["before2"]=$this->input->get('id');
$data["before3"]=$this->input->get('id');
$data["before4"]=$this->input->get('id');
$data["base_url"]=site_url("site/viewmicesubtypejson?id=").$this->input->get('id');
$data["title"]="View micesubtype";
$this->load->view("templatewith2",$data);
// $this->load->view("template",$data);
}
function viewmicesubtypejson()
{
$id=$this->input->get('id');
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`gse_micesubtype`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`gse_micesubtype`.`mice`";
$elements[1]->sort="1";
$elements[1]->header="mice";
$elements[1]->alias="mice";
$elements[2]=new stdClass();
$elements[2]->field="`gse_micesubtype`.`name`";
$elements[2]->sort="1";
$elements[2]->header="Name";
$elements[2]->alias="name";
$elements[3]=new stdClass();
$elements[3]->field="`gse_micesubtype`.`image`";
$elements[3]->sort="1";
$elements[3]->header="Image";
$elements[3]->alias="image";
$elements[4]=new stdClass();
$elements[4]->field="`gse_micesubtype`.`content`";
$elements[4]->sort="1";
$elements[4]->header="Content";
$elements[4]->alias="content";
$elements[5]=new stdClass();
$elements[5]->field="`gse_micesubtype`.`url`";
$elements[5]->sort="1";
$elements[5]->header="Url";
$elements[5]->alias="url";
$elements[6]=new stdClass();
$elements[6]->field="`gse_micesubtype`.`order`";
$elements[6]->sort="1";
$elements[6]->header="Order";
$elements[6]->alias="order";
// $elements[5]=new stdClass();
// $elements[5]->field="`gse_micesubtype`.`videos`";
// $elements[5]->sort="1";
// $elements[5]->header="Videos";
// $elements[5]->alias="videos";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_micesubtype`","WHERE `gse_micesubtype`.`mice`='$id'");
$this->load->view("json",$data);
}

public function createmicesubtype()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createmicesubtype";
// $data["page2"]="block/miceblock";
// $data["before1"]=$this->input->get('id');
// $data["before2"]=$this->input->get('id');
// $data["before3"]=$this->input->get('id');
// $data["before4"]=$this->input->get('id');
$data["mice"]=$this->mice_model->getdropdown();
$data["title"]="Create micesubtype";
// $this->load->view("templatewith2",$data);
$this->load->view("template",$data);
}
public function createmicesubtypesubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("mice","mice","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("image","Image","trim");
$this->form_validation->set_rules("content","Content","trim");
$this->form_validation->set_rules("videos","Videos","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createmicesubtype";
$data["title"]="Create micesubtype";
$data["mice"]=$this->mice_model->getdropdown();
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$mice=$this->input->get_post("mice");
$name=$this->input->get_post("name");
$url=$this->input->get_post("url");
$order=$this->input->get_post("order");
$image=$this->menu_model->createImage();
$config['upload_path'] = './uploads/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$this->load->library('upload', $config);
					$filename="banner";
					$banner="";
					if (  $this->upload->do_upload($filename))
					{
						$uploaddata = $this->upload->data();
						$banner=$uploaddata['file_name'];
					}
$content=$this->input->get_post("content");
// $videos=$this->input->get_post("videos");
if($this->micesubtype_model->create($mice,$name,$image,$content,$banner,$url,$order)==0)
$data["alerterror"]="New micesubtype could not be created.";
else
$data["alertsuccess"]="micesubtype created Successfully.";
$data["redirect"]="site/viewmicesubtype?id=".$mice;
$this->load->view("redirect2",$data);
}
}
public function editmicesubtype()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editmicesubtype";
// $data["page2"]="block/miceblock";
// $data["before1"]=$this->input->get('id');
// $data["before2"]=$this->input->get('id');
// $data["before3"]=$this->input->get('id');
// $data["before4"]=$this->input->get('id');
$data["mice"]=$this->mice_model->getdropdown();
$data["title"]="Edit micesubtype";
$data["before"]=$this->micesubtype_model->beforeedit($this->input->get("id"));
// $this->load->view("templatewith2",$data);
$this->load->view("template",$data);
}
public function editmicesubtypesubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("mice","Wedding","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("image","Image","trim");
$this->form_validation->set_rules("content","Content","trim");
$this->form_validation->set_rules("videos","Videos","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editmicesubtype";
$data["title"]="Edit micesubtype";
$data["mice"]=$this->mice_model->getdropdown();
$data["before"]=$this->micesubtype_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$mice=$this->input->get_post("mice");
$name=$this->input->get_post("name");
$url=$this->input->get_post("url");
$order=$this->input->get_post("order");
// $image=$this->menu_model->createImage();
$content=$this->input->get_post("content");
// $videos=$this->input->get_post("videos");
$image=$this->menu_model->createImage();
//$banner=$this->input->get_post("banner");
     $config['upload_path'] = './uploads/';
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$this->load->library('upload', $config);
						$filename="banner";
						$banner="";
						if (  $this->upload->do_upload($filename))
						{
							$uploaddata = $this->upload->data();
							$banner=$uploaddata['file_name'];
						}

						if($banner=="")
						{
						$banner=$this->micesubtype_model->getbannerbyid($id);
						   // print_r($image);
							$banner=$banner->banner;
						}
if($this->micesubtype_model->edit($id,$mice,$name,$image,$content,$banner,$url,$order)==0)
$data["alerterror"]="New micesubtype could not be Updated.";
else
$data["alertsuccess"]="micesubtype Updated Successfully.";
$data["redirect"]="site/viewmicesubtype?id=".$mice;
$this->load->view("redirect2",$data);
}
}
public function deletemicesubtype()
{
$access=array("1");
$this->checkaccess($access);
$this->micesubtype_model->delete($this->input->get("id"));
$data["redirect"]="site/viewmicesubtype?id=".$this->input->get("miceid");
$this->load->view("redirect2",$data);
}
public function viewmicegallery()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewmicegallery";
$data["page2"]="block/miceblock";
$data["before1"]=$this->input->get('id');
$data["before2"]=$this->input->get('id');
$data["before3"]=$this->input->get('id');
$data["before4"]=$this->input->get('id');
$data["base_url"]=site_url("site/viewmicegalleryjson?id=").$this->input->get('id');
$data["title"]="View micegallery";
$this->load->view("templatewith2",$data);
}
function viewmicegalleryjson()
{
    $id=$this->input->get('id');
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`gse_micegallery`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`gse_micegallery`.`mice`";
$elements[1]->sort="1";
$elements[1]->header="Mice";
$elements[1]->alias="mice";
$elements[2]=new stdClass();
$elements[2]->field="`gse_micegallery`.`status`";
$elements[2]->sort="1";
$elements[2]->header="Status";
$elements[2]->alias="status";
$elements[3]=new stdClass();
$elements[3]->field="`gse_micegallery`.`order`";
$elements[3]->sort="1";
$elements[3]->header="Order";
$elements[3]->alias="order";
$elements[4]=new stdClass();
$elements[4]->field="`gse_micegallery`.`image`";
$elements[4]->sort="1";
$elements[4]->header="Image";
$elements[4]->alias="image";

$elements[5]=new stdClass();
$elements[5]->field="`gse_micesubtype`.`name`";
$elements[5]->sort="1";
$elements[5]->header="Mice Sub Type";
$elements[5]->alias="micesubtype";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_micegallery` LEFT OUTER JOIN `gse_micesubtype` ON `gse_micesubtype`.`id`=`gse_micegallery`.`micesubtype`","WHERE `gse_micegallery`.`mice`='$id'");
$this->load->view("json",$data);
}

public function createmicegallery()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createmicegallery";
// $data["page2"]="block/miceblock";
// $data["before1"]=$this->input->get('id');
// $data["before2"]=$this->input->get('id');
// $data["before3"]=$this->input->get('id');
// $data["before4"]=$this->input->get('id');
$data["mice"]=$this->mice_model->getdropdown();
$data["micesubtype"]=$this->micesubtype_model->getdropdown();
$data["title"]="Create micegallery";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
// $this->load->view("templatewith2",$data);
$this->load->view("template",$data);
}
public function createmicegallerysubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("mice","Wedding","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("image","Image","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createmicegallery";
$data["title"]="Create micegallery";
$data["mice"]=$this->mice_model->getdropdown();
$data["micesubtype"]=$this->micesubtype_model->getdropdown();
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$mice=$this->input->get_post("mice");
$status=$this->input->get_post("status");
$order=$this->input->get_post("order");
$micesubtype=$this->input->get_post("micesubtype");

$image=$this->menu_model->createImage();
if($this->micegallery_model->create($mice,$status,$order,$image,$micesubtype)==0)
$data["alerterror"]="New micegallery could not be created.";
else
$data["alertsuccess"]="micegallery created Successfully.";
$data["redirect"]="site/viewmicegallery?id=".$mice;
$this->load->view("redirect2",$data);
}
}
public function editmicegallery()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editmicegallery";
// $data["page2"]="block/miceblock";
// $data["before1"]=$this->input->get('id');
// $data["before2"]=$this->input->get('id');
// $data["before3"]=$this->input->get('id');
// $data["before4"]=$this->input->get('id');
$data["mice"]=$this->mice_model->getdropdown();
$data["micesubtype"]=$this->micesubtype_model->getdropdown();
$data["title"]="Edit micegallery";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["before"]=$this->micegallery_model->beforeedit($this->input->get("id"));
// $this->load->view("templatewith2",$data);
$this->load->view("template",$data);
}
public function editmicegallerysubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("mice","Wedding","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("image","Image","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editmicegallery";
$data["title"]="Edit micegallery";
$data["mice"]=$this->mice_model->getdropdown();
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["micesubtype"]=$this->micesubtype_model->getdropdown();
$data["before"]=$this->micegallery_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$mice=$this->input->get_post("mice");
$status=$this->input->get_post("status");
$order=$this->input->get_post("order");
$micesubtype=$this->input->get_post("micesubtype");
$image=$this->menu_model->createImage();
if($this->micegallery_model->edit($id,$mice,$status,$order,$image,$micesubtype)==0)
$data["alerterror"]="New micegallery could not be Updated.";
else
$data["alertsuccess"]="micegallery Updated Successfully.";
$data["redirect"]="site/viewmicegallery?id=".$mice;
$this->load->view("redirect2",$data);
}
}
public function deletemicegallery()
{
$access=array("1");
$this->checkaccess($access);
$this->micegallery_model->delete($this->input->get("id"));
$data["redirect"]="site/viewmicegallery?id=".$this->input->get("miceid");
$this->load->view("redirect2",$data);
}

public function viewmicetype()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewmicetype";
$data["page2"]="block/miceblock";
$data["before1"]=$this->input->get('id');
$data["before2"]=$this->input->get('id');
$data["before3"]=$this->input->get('id');
$data["before4"]=$this->input->get('id');
$data["base_url"]=site_url("site/viewmicetypejson?id=").$this->input->get('id');
$data["title"]="View micetype";
$this->load->view("templatewith2",$data);
}
function viewmicetypejson()
{
    $id=$this->input->get('id');
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`gse_micevideos`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`gse_micevideos`.`mice`";
$elements[1]->sort="1";
$elements[1]->header="mice";
$elements[1]->alias="mice";
$elements[2]=new stdClass();
$elements[2]->field="`gse_micevideos`.`url`";
$elements[2]->sort="1";
$elements[2]->header="Url";
$elements[2]->alias="url";
$elements[3]=new stdClass();
$elements[3]->field="`gse_micevideos`.`status`";
$elements[3]->sort="1";
$elements[3]->header="Status";
$elements[3]->alias="status";
$elements[4]=new stdClass();
$elements[4]->field="`gse_micevideos`.`order`";
$elements[4]->sort="1";
$elements[4]->header="Order";
$elements[4]->alias="order";

$elements[5]=new stdClass();
$elements[5]->field="`gse_micesubtype`.`name`";
$elements[5]->sort="1";
$elements[5]->header="Mice Sub Type";
$elements[5]->alias="micesubtype";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_micevideos` LEFT OUTER JOIN `gse_micesubtype` ON `gse_micesubtype`.`id`=`gse_micevideos`.`micesubtype`","WHERE `gse_micevideos`.`mice`='$id'");
$this->load->view("json",$data);
}

public function createmicetype()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createmicetype";
// $data["page2"]="block/miceblock";
// $data["before1"]=$this->input->get('id');
// $data["before2"]=$this->input->get('id');
// $data["before3"]=$this->input->get('id');
// $data["before4"]=$this->input->get('id');
$data["mice"]=$this->mice_model->getdropdown();
$data["micesubtype"]=$this->micesubtype_model->getdropdown();
$data["title"]="Create micetype";
// $this->load->view("templatewith2",$data);
$this->load->view("template",$data);
}
public function createmicetypesubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("mice","Wedding","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("image","Image","trim");
$this->form_validation->set_rules("banner","Banner","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createmicetype";
$data["mice"]=$this->mice_model->getdropdown();
$data["micesubtype"]=$this->micesubtype_model->getdropdown();
$data["title"]="Create micetype";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$mice=$this->input->get_post("mice");
$micesubtype=$this->input->get_post("micesubtype");
$url=$this->input->get_post("url");
$order=$this->input->get_post("order");
// $image=$this->menu_model->createImage();
// //$banner=$this->input->get_post("banner");
//     $config['upload_path'] = './uploads/';
// 						$config['allowed_types'] = 'gif|jpg|png|jpeg';
// 						$this->load->library('upload', $config);
// 						$filename="banner";
// 						$banner="";
// 						if (  $this->upload->do_upload($filename))
// 						{
// 							$uploaddata = $this->upload->data();
// 							$banner=$uploaddata['file_name'];
// 						}
if($this->micetype_model->create($mice,$url,$order,$micesubtype)==0)
$data["alerterror"]="New micetype could not be created.";
else
$data["alertsuccess"]="micetype created Successfully.";
$data["redirect"]="site/viewmicetype?id=".$mice;
$this->load->view("redirect2",$data);
}
}
public function editmicetype()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editmicetype";
// $data["page2"]="block/miceblock";
// $data["before1"]=$this->input->get('id');
// $data["before2"]=$this->input->get('id');
// $data["before3"]=$this->input->get('id');
// $data["before4"]=$this->input->get('id');
$data["mice"]=$this->mice_model->getdropdown();
$data["micesubtype"]=$this->micesubtype_model->getdropdown();
$data["title"]="Edit micetype";
$data["before"]=$this->micetype_model->beforeedit($this->input->get("id"));
// $this->load->view("templatewith2",$data);
$this->load->view("template",$data);
}
public function editmicetypesubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("mice","Wedding","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("image","Image","trim");
$this->form_validation->set_rules("banner","Banner","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editmicetype";
$data["mice"]=$this->mice_model->getdropdown();
$data["micesubtype"]=$this->micesubtype_model->getdropdown();
$data["title"]="Edit micetype";
$data["before"]=$this->micetype_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$mice=$this->input->get_post("mice");
$url=$this->input->get_post("url");
$order=$this->input->get_post("order");
$micesubtype=$this->input->get_post("micesubtype");
if($this->micetype_model->edit($id,$mice,$url,$order,$micesubtype)==0)
$data["alerterror"]="New micetype could not be Updated.";
else
$data["alertsuccess"]="micetype Updated Successfully.";
$data["redirect"]="site/viewmicetype?id=".$mice;
$this->load->view("redirect2",$data);
}
}
public function deletemicetype()
{
$access=array("1");
$this->checkaccess($access);
$this->micetype_model->delete($this->input->get("id"));
$data["redirect"]="site/viewmicetype?id=".$this->input->get("miceid");
$this->load->view("redirect2",$data);
}

public function viewmediacorner()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewmediacorner";
$data["base_url"]=site_url("site/viewmediacornerjson");
$data["title"]="View mediacorner";
$this->load->view("template",$data);
}
function viewmediacornerjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`gse_mediacorner`.`id`";
$elements[0]->sort="1";
$elements[0]->header="id";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`gse_mediacorner`.`name`";
$elements[1]->sort="1";
$elements[1]->header="name";
$elements[1]->alias="name";
$elements[2]=new stdClass();
$elements[2]->field="`gse_mediacorner`.`image`";
$elements[2]->sort="1";
$elements[2]->header="image";
$elements[2]->alias="image";
$elements[3]=new stdClass();
$elements[3]->field="`gse_mediacorner`.`date`";
$elements[3]->sort="1";
$elements[3]->header="date";
$elements[3]->alias="date";
$elements[4]=new stdClass();
$elements[4]->field="`gse_mediacorner`.`date`";
$elements[4]->sort="1";
$elements[4]->header="date";
$elements[4]->alias="date";
$elements[5]=new stdClass();
$elements[5]->field="`gse_mediacorner`.`medianame`";
$elements[5]->sort="1";
$elements[5]->header="medianame";
$elements[5]->alias="medianame";
$elements[6]=new stdClass();
$elements[6]->field="`gse_mediacorner`.`url`";
$elements[6]->sort="1";
$elements[6]->header="url";
$elements[6]->alias="url";
$elements[7]=new stdClass();
$elements[7]->field="`gse_mediacorner`.`facebook`";
$elements[7]->sort="1";
$elements[7]->header="facebook";
$elements[7]->alias="facebook";
$elements[8]=new stdClass();
$elements[8]->field="`gse_mediacorner`.`twitter`";
$elements[8]->sort="1";
$elements[8]->header="twitter";
$elements[8]->alias="twitter";
$elements[9]=new stdClass();
$elements[9]->field="`gse_mediacorner`.`message`";
$elements[9]->sort="1";
$elements[9]->header="message";
$elements[9]->alias="message";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_mediacorner`");
$this->load->view("json",$data);
}

public function createmediacorner()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createmediacorner";
$data["title"]="Create mediacorner";
$this->load->view("template",$data);
}
public function createmediacornersubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("name","name","trim");
$this->form_validation->set_rules("image","image","trim");
$this->form_validation->set_rules("date","date","trim");
$this->form_validation->set_rules("date","date","trim");
$this->form_validation->set_rules("medianame","medianame","trim");
$this->form_validation->set_rules("url","url","trim");
$this->form_validation->set_rules("facebook","facebook","trim");
$this->form_validation->set_rules("twitter","twitter","trim");
$this->form_validation->set_rules("message","message","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createmediacorner";
$data["title"]="Create mediacorner";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$name=$this->input->get_post("name");
// $image=$this->input->get_post("image");
$date=$this->input->get_post("date");
// $date=$this->input->get_post("date");
$medianame=$this->input->get_post("medianame");
$url=$this->input->get_post("url");
$facebook=$this->input->get_post("facebook");
$twitter=$this->input->get_post("twitter");
$message=$this->input->get_post("message");
$image=$this->menu_model->createImage();
//$banner=$this->input->get_post("banner");

if($this->mediacorner_model->create($name,$image,$date,$medianame,$url,$facebook,$twitter,$message)==0)
$data["alerterror"]="New mediacorner could not be created.";
else
$data["alertsuccess"]="mediacorner created Successfully.";
$data["redirect"]="site/viewmediacorner";
$this->load->view("redirect",$data);
}
}
public function editmediacorner()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editmediacorner";
$data["title"]="Edit mediacorner";
$data["before"]=$this->mediacorner_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editmediacornersubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","id","trim");
$this->form_validation->set_rules("name","name","trim");
$this->form_validation->set_rules("image","image","trim");
$this->form_validation->set_rules("date","date","trim");
$this->form_validation->set_rules("date","date","trim");
$this->form_validation->set_rules("medianame","medianame","trim");
$this->form_validation->set_rules("url","url","trim");
$this->form_validation->set_rules("facebook","facebook","trim");
$this->form_validation->set_rules("twitter","twitter","trim");
$this->form_validation->set_rules("message","message","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editmediacorner";
$data["title"]="Edit mediacorner";
$data["before"]=$this->mediacorner_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$name=$this->input->get_post("name");
// $image=$this->input->get_post("image");
$date=$this->input->get_post("date");
// $date=$this->input->get_post("date");
$medianame=$this->input->get_post("medianame");
$url=$this->input->get_post("url");
$facebook=$this->input->get_post("facebook");
$twitter=$this->input->get_post("twitter");
$message=$this->input->get_post("message");
$image=$this->menu_model->createImage();
if($this->mediacorner_model->edit($id,$name,$image,$date,$medianame,$url,$facebook,$twitter,$message)==0)
$data["alerterror"]="New mediacorner could not be Updated.";
else
$data["alertsuccess"]="mediacorner Updated Successfully.";
$data["redirect"]="site/viewmediacorner";
$this->load->view("redirect",$data);
}
}
public function deletemediacorner()
{
$access=array("1");
$this->checkaccess($access);
$this->mediacorner_model->delete($this->input->get("id"));
$data["redirect"]="site/viewmediacorner";
$this->load->view("redirect",$data);
}
public function viewworldtour()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewworldtour";
$data["base_url"]=site_url("site/viewworldtourjson");
$data["title"]="View worldtour";
$this->load->view("template",$data);
}
function viewworldtourjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`gse_worldtour`.`id`";
$elements[0]->sort="1";
$elements[0]->header="id";
$elements[0]->alias="id";
// $elements[1]=new stdClass();
// $elements[1]->field="`gse_worldtour`.`ispastconcert`";
// $elements[1]->sort="1";
// $elements[1]->header="ispastconcert";
// $elements[1]->alias="ispastconcert";
$elements[2]=new stdClass();
$elements[2]->field="`gse_worldtour`.`type`";
$elements[2]->sort="1";
$elements[2]->header="type";
$elements[2]->alias="type";
$elements[3]=new stdClass();
$elements[3]->field="`gse_worldtour`.`image`";
$elements[3]->sort="1";
$elements[3]->header="image";
$elements[3]->alias="image";
$elements[4]=new stdClass();
$elements[4]->field="`gse_worldtour`.`name`";
$elements[4]->sort="1";
$elements[4]->header="name";
$elements[4]->alias="name";
$elements[5]=new stdClass();
$elements[5]->field="`gse_worldtour`.`location`";
$elements[5]->sort="1";
$elements[5]->header="location";
$elements[5]->alias="location";
$elements[6]=new stdClass();
$elements[6]->field="`gse_worldtour`.`date`";
$elements[6]->sort="1";
$elements[6]->header="date";
$elements[6]->alias="date";
$elements[7]=new stdClass();
$elements[7]->field="`gse_worldtour`.`venue`";
$elements[7]->sort="1";
$elements[7]->header="venue";
$elements[7]->alias="venue";
$elements[8]=new stdClass();
$elements[8]->field="`gse_worldtour`.`content`";
$elements[8]->sort="1";
$elements[8]->header="content";
$elements[8]->alias="content";
$elements[9]=new stdClass();
$elements[9]->field="`gse_worldtour`.`banner`";
$elements[9]->sort="1";
$elements[9]->header="banner";
$elements[9]->alias="banner";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="DESC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_worldtour`");
$this->load->view("json",$data);
}

public function createworldtour()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createworldtour";
$data["type"]=$this->worldtour_model->gettypedropdown();
$data["title"]="Create worldtour";
$this->load->view("template",$data);
}
public function createworldtoursubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("ispastconcert","ispastconcert","trim");
$this->form_validation->set_rules("isupcomingconcert","isupcomingconcert","trim");
$this->form_validation->set_rules("image","image","trim");
$this->form_validation->set_rules("name","name","trim");
$this->form_validation->set_rules("location","location","trim");
$this->form_validation->set_rules("date","date","trim");
$this->form_validation->set_rules("venue","venue","trim");
$this->form_validation->set_rules("content","content","trim");
$this->form_validation->set_rules("banner","banner","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createworldtour";
$data["title"]="Create worldtour";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
// $ispastconcert=$this->input->get_post("ispastconcert");
$type=$this->input->get_post("type");
// $image=$this->input->get_post("image");
$name=$this->input->get_post("name");
$location=$this->input->get_post("location");
$date=$this->input->get_post("date");
$venue=$this->input->get_post("venue");
$content=$this->input->get_post("content");
// $banner=$this->input->get_post("banner");
$image=$this->menu_model->createImage();
//$banner=$this->input->get_post("banner");
    $config['upload_path'] = './uploads/';
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$this->load->library('upload', $config);
						$filename="banner";
						$banner="";
						if (  $this->upload->do_upload($filename))
						{
							$uploaddata = $this->upload->data();
							$banner=$uploaddata['file_name'];
						}
if($this->worldtour_model->create($type,$image,$name,$location,$date,$venue,$content,$banner)==0)
$data["alerterror"]="New worldtour could not be created.";
else
$data["alertsuccess"]="worldtour created Successfully.";
$data["redirect"]="site/viewworldtour";
$this->load->view("redirect",$data);
}
}
public function editworldtour()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editworldtour";
$data["page2"]="block/tourblock";
$data["type"]=$this->worldtour_model->gettypedropdown();
$data["before1"]=$this->input->get('id');
$data["before2"]=$this->input->get('id');
$data["before3"]=$this->input->get('id');
$data["before4"]=$this->input->get('id');
$data["title"]="Edit event";
$data["before"]=$this->worldtour_model->beforeedit($this->input->get("id"));
$this->load->view("templatewith2",$data);
}
public function editworldtoursubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","id","trim");
$this->form_validation->set_rules("ispastconcert","ispastconcert","trim");
$this->form_validation->set_rules("isupcomingconcert","isupcomingconcert","trim");
$this->form_validation->set_rules("image","image","trim");
$this->form_validation->set_rules("name","name","trim");
$this->form_validation->set_rules("location","location","trim");
$this->form_validation->set_rules("date","date","trim");
$this->form_validation->set_rules("venue","venue","trim");
$this->form_validation->set_rules("content","content","trim");
$this->form_validation->set_rules("banner","banner","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editworldtour";
$data["title"]="Edit worldtour";
$data["before"]=$this->worldtour_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
// $ispastconcert=$this->input->get_post("ispastconcert");
$type=$this->input->get_post("type");
// $image=$this->input->get_post("image");
$name=$this->input->get_post("name");
$location=$this->input->get_post("location");
$date=$this->input->get_post("date");
$venue=$this->input->get_post("venue");
$content=$this->input->get_post("content");
// $banner=$this->input->get_post("banner");
$image=$this->menu_model->createImage();
//$banner=$this->input->get_post("banner");
     $config['upload_path'] = './uploads/';
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$this->load->library('upload', $config);
						$filename="banner";
						$banner="";
						if (  $this->upload->do_upload($filename))
						{
							$uploaddata = $this->upload->data();
							$banner=$uploaddata['file_name'];
						}

						if($banner=="")
						{
						$banner=$this->event_model->getbannerbyid($id);
						   // print_r($image);
							$banner=$banner->banner;
						}
if($this->worldtour_model->edit($id,$type,$image,$name,$location,$date,$venue,$content,$banner)==0)
$data["alerterror"]="New worldtour could not be Updated.";
else
$data["alertsuccess"]="worldtour Updated Successfully.";
$data["redirect"]="site/viewworldtour";
$this->load->view("redirect",$data);
}
}
public function deleteworldtour()
{
$access=array("1");
$this->checkaccess($access);
$this->worldtour_model->delete($this->input->get("id"));
$data["redirect"]="site/viewworldtour";
$this->load->view("redirect",$data);
}
public function viewworldtourtype()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewworldtourtype";
$data["page2"]="block/tourblock";
$data["before1"]=$this->input->get('id');
$data["before2"]=$this->input->get('id');
$data["before3"]=$this->input->get('id');
$data["before4"]=$this->input->get('id');
$data["base_url"]=site_url("site/viewworldtourtypejson?id=").$this->input->get('id');
$data["title"]="View worldtourtype";
$this->load->view("templatewith2",$data);
}
function viewworldtourtypejson()
{
    $id=$this->input->get('id');
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`gse_worldtourvideos`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`gse_worldtourvideos`.`worldtour`";
$elements[1]->sort="1";
$elements[1]->header="worldtour";
$elements[1]->alias="worldtour";
$elements[2]=new stdClass();
$elements[2]->field="`gse_worldtourvideos`.`url`";
$elements[2]->sort="1";
$elements[2]->header="Url";
$elements[2]->alias="url";
// $elements[3]=new stdClass();
// $elements[3]->field="`gse_worldtourvideos`.`status`";
// $elements[3]->sort="1";
// $elements[3]->header="Status";
// $elements[3]->alias="status";
$elements[4]=new stdClass();
$elements[4]->field="`gse_worldtourvideos`.`order`";
$elements[4]->sort="1";
$elements[4]->header="Order";
$elements[4]->alias="order";

$elements[5]=new stdClass();
$elements[5]->field="`gse_worldtour`.`name`";
$elements[5]->sort="1";
$elements[5]->header="World Tour";
$elements[5]->alias="name";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_worldtourvideos` LEFT OUTER JOIN `gse_worldtour` ON `gse_worldtour`.`id`=`gse_worldtourvideos`.`worldtour`","WHERE `gse_worldtourvideos`.`worldtour`='$id'");
$this->load->view("json",$data);
}

public function createworldtourtype()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createworldtourtype";
// $data["page2"]="block/tourblock";
// $data["before1"]=$this->input->get('id');
// $data["before2"]=$this->input->get('id');
// $data["before3"]=$this->input->get('id');
// $data["before4"]=$this->input->get('id');
$data["worldtour"]=$this->worldtour_model->getdropdown();
// $data["worldtoursubtype"]=$this->worldtoursubtype_model->getdropdown();
$data["title"]="Create worldtourtype";
// $this->load->view("templatewith2",$data);
$this->load->view("template",$data);
}
public function createworldtourtypesubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("worldtour","Wedding","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("image","Image","trim");
$this->form_validation->set_rules("banner","Banner","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createworldtourtype";
$data["worldtour"]=$this->worldtour_model->getdropdown();
// $data["worldtoursubtype"]=$this->worldtoursubtype_model->getdropdown();
$data["title"]="Create worldtourtype";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$worldtour=$this->input->get_post("worldtour");
$worldtoursubtype=$this->input->get_post("worldtoursubtype");
$url=$this->input->get_post("url");
$order=$this->input->get_post("order");
$image=$this->menu_model->createImage();
//$banner=$this->input->get_post("banner");
    $config['upload_path'] = './uploads/';
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$this->load->library('upload', $config);
						$filename="banner";
						$banner="";
						if (  $this->upload->do_upload($filename))
						{
							$uploaddata = $this->upload->data();
							$banner=$uploaddata['file_name'];
						}
if($this->worldtourtype_model->create($worldtour,$url,$order,$worldtoursubtype)==0)
$data["alerterror"]="New worldtourtype could not be created.";
else
$data["alertsuccess"]="worldtourtype created Successfully.";
$data["redirect"]="site/viewworldtourtype?id=".$worldtour;
$this->load->view("redirect2",$data);
}
}
public function editworldtourtype()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editworldtourtype";
// $data["page2"]="block/tourblock";
// $data["before1"]=$this->input->get('id');
// $data["before2"]=$this->input->get('id');
// $data["before3"]=$this->input->get('id');
// $data["before4"]=$this->input->get('id');
$data["worldtour"]=$this->worldtour_model->getdropdown();
// $data["worldtoursubtype"]=$this->worldtoursubtype_model->getdropdown();
$data["title"]="Edit worldtourtype";
$data["before"]=$this->worldtourtype_model->beforeedit($this->input->get("id"));
// $this->load->view("templatewith2",$data);
$this->load->view("template",$data);
}
public function editworldtourtypesubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("worldtour","Wedding","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("image","Image","trim");
$this->form_validation->set_rules("banner","Banner","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editworldtourtype";
$data["worldtour"]=$this->worldtour_model->getdropdown();
$data["worldtoursubtype"]=$this->worldtoursubtype_model->getdropdown();
$data["title"]="Edit worldtourtype";
$data["before"]=$this->worldtourtype_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$worldtour=$this->input->get_post("worldtour");
$url=$this->input->get_post("url");
$order=$this->input->get_post("order");
$worldtoursubtype=$this->input->get_post("worldtoursubtype");
// $image=$this->menu_model->createImage();
// //$banner=$this->input->get_post("banner");
//      $config['upload_path'] = './uploads/';
// 						$config['allowed_types'] = 'gif|jpg|png|jpeg';
// 						$this->load->library('upload', $config);
// 						$filename="banner";
// 						$banner="";
// 						if (  $this->upload->do_upload($filename))
// 						{
// 							$uploaddata = $this->upload->data();
// 							$banner=$uploaddata['file_name'];
// 						}
//
// 						if($banner=="")
// 						{
// 						$banner=$this->worldtourtype_model->getbannerbyid($id);
// 						   // print_r($image);
// 							$banner=$banner->banner;
// 						}
if($this->worldtourtype_model->edit($id,$worldtour,$url,$order,$worldtoursubtype)==0)
$data["alerterror"]="New worldtourtype could not be Updated.";
else
$data["alertsuccess"]="worldtourtype Updated Successfully.";
$data["redirect"]="site/viewworldtourtype?id=".$worldtour;
$this->load->view("redirect2",$data);
}
}
public function deleteworldtourtype()
{
$access=array("1");
$this->checkaccess($access);
$this->worldtourtype_model->delete($this->input->get("id"));
$data["redirect"]="site/viewworldtourtype?id=".$this->input->get("worldtourid");
$this->load->view("redirect2",$data);
}
public function viewworldtourgallery()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewworldtourgallery";
$data["page2"]="block/tourblock";
$data["before1"]=$this->input->get('id');
$data["before2"]=$this->input->get('id');
$data["before3"]=$this->input->get('id');
$data["before4"]=$this->input->get('id');
$data["base_url"]=site_url("site/viewworldtourgalleryjson?id=").$this->input->get('id');
$data["title"]="View worldtourgallery";
$this->load->view("templatewith2",$data);
// $this->load->view("template",$data);
}
function viewworldtourgalleryjson()
{
$id=$this->input->get('id');
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`gse_worldtourimage`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`gse_worldtourimage`.`worldtour`";
$elements[1]->sort="1";
$elements[1]->header="worldtour";
$elements[1]->alias="worldtour";
$elements[2]=new stdClass();
$elements[2]->field="`gse_worldtourimage`.`image`";
$elements[2]->sort="1";
$elements[2]->header="image";
$elements[2]->alias="image";
// $elements[3]=new stdClass();
// $elements[3]->field="`gse_worldtourimage`.`status`";
// $elements[3]->sort="1";
// $elements[3]->header="Status";
// $elements[3]->alias="status";
$elements[4]=new stdClass();
$elements[4]->field="`gse_worldtourimage`.`order`";
$elements[4]->sort="1";
$elements[4]->header="Order";
$elements[4]->alias="order";
$elements[5]=new stdClass();
$elements[5]->field="`gse_worldtour`.`name`";
$elements[5]->sort="1";
$elements[5]->header="World Tour";
$elements[5]->alias="name";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_worldtourimage` LEFT OUTER JOIN `gse_worldtour` ON `gse_worldtour`.`id`=`gse_worldtourimage`.`worldtour`","WHERE `gse_worldtourimage`.`worldtour`='$id'");
$this->load->view("json",$data);
}

public function createworldtourgallery()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createworldtourgallery";
// $data["page2"]="block/tourblock";
// $data["before1"]=$this->input->get('id');
// $data["before2"]=$this->input->get('id');
// $data["before3"]=$this->input->get('id');
// $data["before4"]=$this->input->get('id');
$data["worldtour"]=$this->worldtour_model->getdropdown();
// $data["worldtoursubgallery"]=$this->worldtoursubgallery_model->getdropdown();
$data["title"]="Create worldtourgallery";
// $this->load->view("templatewith2",$data);
$this->load->view("template",$data);
}
public function createworldtourgallerysubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("worldtour","Wedding","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("image","Image","trim");
$this->form_validation->set_rules("banner","Banner","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createworldtourgallery";
$data["worldtour"]=$this->worldtour_model->getdropdown();
// $data["worldtoursubgallery"]=$this->worldtoursubgallery_model->getdropdown();
$data["title"]="Create worldtourgallery";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$worldtour=$this->input->get_post("worldtour");
// $worldtoursubgallery=$this->input->get_post("worldtoursubgallery");
$url=$this->input->get_post("url");
$order=$this->input->get_post("order");
$image=$this->menu_model->createImage();
//$banner=$this->input->get_post("banner");
    $config['upload_path'] = './uploads/';
						$config['allowed_gallerys'] = 'gif|jpg|png|jpeg';
						$this->load->library('upload', $config);
						$filename="banner";
						$banner="";
						if (  $this->upload->do_upload($filename))
						{
							$uploaddata = $this->upload->data();
							$banner=$uploaddata['file_name'];
						}
if($this->worldtourgallery_model->create($worldtour,$image,$order,$worldtoursubgallery)==0)
$data["alerterror"]="New worldtourgallery could not be created.";
else
$data["alertsuccess"]="worldtourgallery created Successfully.";
$data["redirect"]="site/viewworldtourgallery?id=".$worldtour;
$this->load->view("redirect2",$data);
}
}
public function editworldtourgallery()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editworldtourgallery";
// $data["page2"]="block/tourblock";
// $data["before1"]=$this->input->get('id');
// $data["before2"]=$this->input->get('id');
// $data["before3"]=$this->input->get('id');
// $data["before4"]=$this->input->get('id');
$data["worldtour"]=$this->worldtour_model->getdropdown();
// $data["worldtoursubgallery"]=$this->worldtoursubgallery_model->getdropdown();
$data["title"]="Edit worldtourgallery";
$data["before"]=$this->worldtourgallery_model->beforeedit($this->input->get("id"));
// $this->load->view("templatewith2",$data);
$this->load->view("template",$data);
}
public function editworldtourgallerysubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("worldtour","Wedding","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("image","Image","trim");
$this->form_validation->set_rules("banner","Banner","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editworldtourgallery";
$data["worldtour"]=$this->worldtour_model->getdropdown();
$data["worldtoursubgallery"]=$this->worldtoursubgallery_model->getdropdown();
$data["title"]="Edit worldtourgallery";
$data["before"]=$this->worldtourgallery_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$worldtour=$this->input->get_post("worldtour");
$url=$this->input->get_post("url");
$order=$this->input->get_post("order");
$worldtoursubgallery=$this->input->get_post("worldtoursubgallery");
$image=$this->menu_model->createImage();
//$banner=$this->input->get_post("banner");
     $config['upload_path'] = './uploads/';
						$config['allowed_gallerys'] = 'gif|jpg|png|jpeg';
						$this->load->library('upload', $config);
						$filename="banner";
						$banner="";
						if (  $this->upload->do_upload($filename))
						{
							$uploaddata = $this->upload->data();
							$banner=$uploaddata['file_name'];
						}

						// if($banner=="")
						// {
						// $banner=$this->worldtourgallery_model->getbannerbyid($id);
						//    // print_r($image);
						// 	$banner=$banner->banner;
						// }
if($this->worldtourgallery_model->edit($id,$worldtour,$image,$order,$worldtoursubgallery)==0)
$data["alerterror"]="New worldtourgallery could not be Updated.";
else
$data["alertsuccess"]="worldtourgallery Updated Successfully.";
$data["redirect"]="site/viewworldtourgallery?id=".$worldtour;
$this->load->view("redirect2",$data);
}
}
public function deleteworldtourgallery()
{
$access=array("1");
$this->checkaccess($access);
$this->worldtourgallery_model->delete($this->input->get("id"));
$data["redirect"]="site/viewworldtourgallery?id=".$this->input->get("worldtourid");
$this->load->view("redirect2",$data);
}

public function viewworldtourwallpaper()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewworldtourwallpaper";
$data["page2"]="block/tourblock";
$data["before1"]=$this->input->get('id');
$data["before2"]=$this->input->get('id');
$data["before3"]=$this->input->get('id');
$data["before4"]=$this->input->get('id');
$data["base_url"]=site_url("site/viewworldtourwallpaperjson?id=").$this->input->get('id');
$data["title"]="View worldtourwallpaper";
$this->load->view("templatewith2",$data);
}
function viewworldtourwallpaperjson()
{
$id=$this->input->get('id');
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`gse_worldtourwallpaper`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`gse_worldtourwallpaper`.`worldtour`";
$elements[1]->sort="1";
$elements[1]->header="worldtour";
$elements[1]->alias="worldtour";
$elements[2]=new stdClass();
$elements[2]->field="`gse_worldtourwallpaper`.`image`";
$elements[2]->sort="1";
$elements[2]->header="image";
$elements[2]->alias="image";
// $elements[3]=new stdClass();
// $elements[3]->field="`gse_worldtourwallpaper`.`status`";
// $elements[3]->sort="1";
// $elements[3]->header="Status";
// $elements[3]->alias="status";
$elements[4]=new stdClass();
$elements[4]->field="`gse_worldtourwallpaper`.`order`";
$elements[4]->sort="1";
$elements[4]->header="Order";
$elements[4]->alias="order";
$elements[5]=new stdClass();
$elements[5]->field="`gse_worldtour`.`name`";
$elements[5]->sort="1";
$elements[5]->header="World Tour";
$elements[5]->alias="name";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_worldtourwallpaper` LEFT OUTER JOIN `gse_worldtour` ON `gse_worldtour`.`id`=`gse_worldtourwallpaper`.`worldtour`","WHERE `gse_worldtourwallpaper`.`worldtour`='$id'");
$this->load->view("json",$data);
}

public function createworldtourwallpaper()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createworldtourwallpaper";
// $data["page2"]="block/tourblock";
// $data["before1"]=$this->input->get('id');
// $data["before2"]=$this->input->get('id');
// $data["before3"]=$this->input->get('id');
// $data["before4"]=$this->input->get('id');
$data["worldtour"]=$this->worldtour_model->getdropdown();
// $data["worldtoursubwallpaper"]=$this->worldtoursubwallpaper_model->getdropdown();
$data["title"]="Create worldtourwallpaper";
// $this->load->view("templatewith2",$data);
$this->load->view("template",$data);
}
public function createworldtourwallpapersubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("worldtour","Wedding","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("image","Image","trim");
$this->form_validation->set_rules("banner","Banner","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createworldtourwallpaper";
$data["worldtour"]=$this->worldtour_model->getdropdown();
// $data["worldtoursubwallpaper"]=$this->worldtoursubwallpaper_model->getdropdown();
$data["title"]="Create worldtourwallpaper";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$worldtour=$this->input->get_post("worldtour");
// $worldtoursubwallpaper=$this->input->get_post("worldtoursubwallpaper");
$url=$this->input->get_post("url");
$order=$this->input->get_post("order");
$image=$this->menu_model->createImage();
//$banner=$this->input->get_post("banner");
    $config['upload_path'] = './uploads/';
						$config['allowed_wallpapers'] = 'gif|jpg|png|jpeg';
						$this->load->library('upload', $config);
						$filename="banner";
						$banner="";
						if (  $this->upload->do_upload($filename))
						{
							$uploaddata = $this->upload->data();
							$banner=$uploaddata['file_name'];
						}
if($this->worldtourwallpaper_model->create($worldtour,$image,$order,$worldtoursubwallpaper)==0)
$data["alerterror"]="New worldtourwallpaper could not be created.";
else
$data["alertsuccess"]="worldtourwallpaper created Successfully.";
$data["redirect"]="site/viewworldtourwallpaper?id=".$worldtour;
$this->load->view("redirect2",$data);
}
}
public function editworldtourwallpaper()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editworldtourwallpaper";
// $data["page2"]="block/tourblock";
// $data["before1"]=$this->input->get('id');
// $data["before2"]=$this->input->get('id');
// $data["before3"]=$this->input->get('id');
// $data["before4"]=$this->input->get('id');
$data["worldtour"]=$this->worldtour_model->getdropdown();
// $data["worldtoursubwallpaper"]=$this->worldtoursubwallpaper_model->getdropdown();
$data["title"]="Edit worldtourwallpaper";
$data["before"]=$this->worldtourwallpaper_model->beforeedit($this->input->get("id"));
// $this->load->view("templatewith2",$data);
$this->load->view("template",$data);
}
public function editworldtourwallpapersubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("worldtour","Wedding","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("image","Image","trim");
$this->form_validation->set_rules("banner","Banner","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editworldtourwallpaper";
$data["worldtour"]=$this->worldtour_model->getdropdown();
$data["worldtoursubwallpaper"]=$this->worldtoursubwallpaper_model->getdropdown();
$data["title"]="Edit worldtourwallpaper";
$data["before"]=$this->worldtourwallpaper_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$worldtour=$this->input->get_post("worldtour");
$url=$this->input->get_post("url");
$order=$this->input->get_post("order");
$worldtoursubwallpaper=$this->input->get_post("worldtoursubwallpaper");
$image=$this->menu_model->createImage();
//$banner=$this->input->get_post("banner");
     $config['upload_path'] = './uploads/';
						$config['allowed_wallpapers'] = 'gif|jpg|png|jpeg';
						$this->load->library('upload', $config);
						$filename="banner";
						$banner="";
						if (  $this->upload->do_upload($filename))
						{
							$uploaddata = $this->upload->data();
							$banner=$uploaddata['file_name'];
						}

						// if($banner=="")
						// {
						// $banner=$this->worldtourwallpaper_model->getbannerbyid($id);
						//    // print_r($image);
						// 	$banner=$banner->banner;
						// }
if($this->worldtourwallpaper_model->edit($id,$worldtour,$image,$order,$worldtoursubwallpaper)==0)
$data["alerterror"]="New worldtourwallpaper could not be Updated.";
else
$data["alertsuccess"]="worldtourwallpaper Updated Successfully.";
$data["redirect"]="site/viewworldtourwallpaper?id=".$worldtour;
$this->load->view("redirect2",$data);
}
}
public function deleteworldtourwallpaper()
{
$access=array("1");
$this->checkaccess($access);
$this->worldtourwallpaper_model->delete($this->input->get("id"));
$data["redirect"]="site/viewworldtourwallpaper?id=".$this->input->get("worldtourid");
$this->load->view("redirect2",$data);
}

public function viewmatch()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewmatch";
$data["base_url"]=site_url("site/viewmatchjson");
$data["title"]="View match";
$this->load->view("template",$data);
}
function viewmatchjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`gse_match`.`id`";
$elements[0]->sort="1";
$elements[0]->header="id";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`gse_match`.`team1`";
$elements[1]->sort="1";
$elements[1]->header="team1";
$elements[1]->alias="team1";
$elements[2]=new stdClass();
$elements[2]->field="`gse_match`.`logo1`";
$elements[2]->sort="1";
$elements[2]->header="logo1";
$elements[2]->alias="logo1";
$elements[3]=new stdClass();
$elements[3]->field="`gse_match`.`team2`";
$elements[3]->sort="1";
$elements[3]->header="team2";
$elements[3]->alias="team2";
$elements[4]=new stdClass();
$elements[4]->field="`gse_match`.`logo2`";
$elements[4]->sort="1";
$elements[4]->header="logo2";
$elements[4]->alias="logo2";
$elements[5]=new stdClass();
$elements[5]->field="`gse_match`.`location`";
$elements[5]->sort="1";
$elements[5]->header="location";
$elements[5]->alias="location";
$elements[6]=new stdClass();
$elements[6]->field="`gse_match`.`date`";
$elements[6]->sort="1";
$elements[6]->header="date";
$elements[6]->alias="date";
$elements[7]=new stdClass();
$elements[7]->field="`gse_match`.`time`";
$elements[7]->sort="1";
$elements[7]->header="time";
$elements[7]->alias="time";
$elements[8]=new stdClass();
$elements[8]->field="`gse_match`.`link`";
$elements[8]->sort="1";
$elements[8]->header="link";
$elements[8]->alias="link";
$elements[9]=new stdClass();
$elements[9]->field="`gse_match`.`team1score`";
$elements[9]->sort="1";
$elements[9]->header="team1score";
$elements[9]->alias="team1score";
$elements[10]=new stdClass();
$elements[10]->field="`gse_match`.`team2score`";
$elements[10]->sort="1";
$elements[10]->header="team2score";
$elements[10]->alias="team2score";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_match`");
$this->load->view("json",$data);
}

public function creatematch()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="creatematch";
$data["title"]="Create match";
$this->load->view("template",$data);
}
public function creatematchsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("team1","team1","trim");
// $this->form_validation->set_rules("logo1","logo1","trim");
$this->form_validation->set_rules("team2","team2","trim");
// $this->form_validation->set_rules("logo2","logo2","trim");
$this->form_validation->set_rules("location","location","trim");
$this->form_validation->set_rules("date","date","trim");
$this->form_validation->set_rules("time","time","trim");
$this->form_validation->set_rules("link","link","trim");
$this->form_validation->set_rules("team1score","team1score","trim");
$this->form_validation->set_rules("team2score","team2score","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="creatematch";
$data["title"]="Create match";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$team1=$this->input->get_post("team1");
// $logo1=$this->input->get_post("logo1");
$team2=$this->input->get_post("team2");
// $logo2=$this->input->get_post("logo2");
$location=$this->input->get_post("location");
$date=$this->input->get_post("date");
$time=$this->input->get_post("time");
$link=$this->input->get_post("link");
$team1score=$this->input->get_post("team1score");
$team2score=$this->input->get_post("team2score");
$logo1=$this->menu_model->createImage();
//$banner=$this->input->get_post("banner");
    $config['upload_path'] = './uploads/';
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$this->load->library('upload', $config);
						$filename="logo2";
						$logo2="";
						if (  $this->upload->do_upload($filename))
						{
							$uploaddata = $this->upload->data();
							$logo2=$uploaddata['file_name'];
						}
						$config['upload_path'] = './uploads/';
										$config['allowed_types'] = 'gif|jpg|png|jpeg';
										$this->load->library('upload', $config);
										$filename="banner";
										$banner="";
										if (  $this->upload->do_upload($filename))
										{
											$uploaddata = $this->upload->data();
											$banner=$uploaddata['file_name'];
										}
if($this->match_model->create($team1,$logo1,$team2,$logo2,$location,$date,$time,$link,$team1score,$team2score,$banner)==0)
$data["alerterror"]="New match could not be created.";
else
$data["alertsuccess"]="match created Successfully.";
$data["redirect"]="site/viewmatch";
$this->load->view("redirect",$data);
}
}
public function editmatch()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editmatch";
$data["title"]="Edit match";
$data["before"]=$this->match_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editmatchsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","id","trim");
$this->form_validation->set_rules("team1","team1","trim");
$this->form_validation->set_rules("logo1","logo1","trim");
$this->form_validation->set_rules("team2","team2","trim");
$this->form_validation->set_rules("logo2","logo2","trim");
$this->form_validation->set_rules("location","location","trim");
$this->form_validation->set_rules("date","date","trim");
$this->form_validation->set_rules("time","time","trim");
$this->form_validation->set_rules("link","link","trim");
$this->form_validation->set_rules("team1score","team1score","trim");
$this->form_validation->set_rules("team2score","team2score","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editmatch";
$data["title"]="Edit match";
$data["before"]=$this->match_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$team1=$this->input->get_post("team1");
// $logo1=$this->input->get_post("logo1");
$team2=$this->input->get_post("team2");
// $logo2=$this->input->get_post("logo2");
$location=$this->input->get_post("location");
$date=$this->input->get_post("date");
$time=$this->input->get_post("time");
$link=$this->input->get_post("link");
$team1score=$this->input->get_post("team1score");
$team2score=$this->input->get_post("team2score");
$logo1=$this->menu_model->createImage();
$config['upload_path'] = './uploads/';
			 $config['allowed_types'] = 'gif|jpg|png|jpeg';
			 $this->load->library('upload', $config);
			 $filename="logo2";
			 $logo2="";
			 if (  $this->upload->do_upload($filename))
			 {
				 $uploaddata = $this->upload->data();
				 $logo2=$uploaddata['file_name'];
			 }

			 if($logo2=="")
			 {
			 $logo2=$this->match_model->getlogo2byid($id);
					// print_r($image);
				 $logo2=$logo2->logo2;
			 }
$config['upload_path'] = './uploads/';
			 $config['allowed_types'] = 'gif|jpg|png|jpeg';
			 $this->load->library('upload', $config);
			 $filename="banner";
			 $banner="";
			 if (  $this->upload->do_upload($filename))
			 {
				 $uploaddata = $this->upload->data();
				 $banner=$uploaddata['file_name'];
			 }

			 if($banner=="")
			 {
			 $banner=$this->match_model->getbannerbyid($id);
					// print_r($image);
				 $banner=$banner->banner;
			 }
if($this->match_model->edit($id,$team1,$logo1,$team2,$logo2,$location,$date,$time,$link,$team1score,$team2score,$banner)==0)
$data["alerterror"]="New match could not be Updated.";
else
$data["alertsuccess"]="match Updated Successfully.";
$data["redirect"]="site/viewmatch";
$this->load->view("redirect",$data);
}
}
public function deletematch()
{
$access=array("1");
$this->checkaccess($access);
$this->match_model->delete($this->input->get("id"));
$data["redirect"]="site/viewmatch";
$this->load->view("redirect",$data);
}
public function viewauthor()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewauthor";
$data["base_url"]=site_url("site/viewauthorjson");
$data["title"]="View author";
$this->load->view("template",$data);
}
function viewauthorjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`author`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`author`.`name`";
$elements[1]->sort="1";
$elements[1]->header="Names";
$elements[1]->alias="name";
$elements[2]=new stdClass();
$elements[2]->field="`author`.`image`";
$elements[2]->sort="1";
$elements[2]->header="Image";
$elements[2]->alias="image";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `author`");
$this->load->view("json",$data);
}

public function createauthor()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createauthor";
$data["title"]="Create author";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
    $data[ 'sportscategory' ] =$this->sportscategory_model->getdropdown();
$this->load->view("template",$data);
}
public function createauthorsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("image","Image","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createauthor";
$data["title"]="Create author";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$google=$this->input->get_post("google");
$twitter=$this->input->get_post("twitter");
$facebook=$this->input->get_post("facebook");
$name=$this->input->get_post("name");
$description=$this->input->get_post("description");
$image=$this->menu_model->createImage();
if($this->author_model->create($google,$twitter,$facebook,$name,$image,$description)==0)
$data["alerterror"]="New author could not be created.";
else
$data["alertsuccess"]="author created Successfully.";
$data["redirect"]="site/viewauthor";
$this->load->view("redirect",$data);
}
}
public function editauthor()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editauthor";
$data["title"]="Edit author";
// $data[ 'status' ] =$this->user_model->getstatusdropdown();
// $data[ 'sportscategory' ] =$this->sportscategory_model->getdropdown();
$data["before"]=$this->author_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editauthorsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("image","Image","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editauthor";
$data["title"]="Edit author";
// $data[ 'status' ] =$this->user_model->getstatusdropdown();
// $data[ 'sportscategory' ] =$this->sportscategory_model->getdropdown();
$data["before"]=$this->author_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$google=$this->input->get_post("google");
$twitter=$this->input->get_post("twitter");
$facebook=$this->input->get_post("facebook");
$name=$this->input->get_post("name");
$description=$this->input->get_post("description");
$image=$this->menu_model->createImage();
if($this->author_model->edit($id,$google,$twitter,$facebook,$name,$image,$description)==0)
$data["alerterror"]="New author could not be Updated.";
else
$data["alertsuccess"]="author Updated Successfully.";
$data["redirect"]="site/viewauthor";
$this->load->view("redirect",$data);
}
}
public function deleteauthor()
{
$access=array("1");
$this->checkaccess($access);
$this->author_model->delete($this->input->get("id"));
$data["redirect"]="site/viewauthor";
$this->load->view("redirect",$data);
}
public function viewcomment()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewcomment";
$data["base_url"]=site_url("site/viewcommentjson");
$data["title"]="View comment";
$this->load->view("template",$data);
}
function viewcommentjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`gse_comment`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`gse_comment`.`diaryarticle`";
$elements[1]->sort="1";
$elements[1]->header="Names";
$elements[1]->alias="name";
$elements[2]=new stdClass();
$elements[2]->field="`gse_comment`.`name`";
$elements[2]->sort="1";
$elements[2]->header="Name";
$elements[2]->alias="name";
$elements[3]=new stdClass();
$elements[3]->field="`gse_comment`.`image`";
$elements[3]->sort="1";
$elements[3]->header="Image";
$elements[3]->alias="image";
$elements[4]=new stdClass();
$elements[4]->field="`gse_diaryarticle`.`name`";
$elements[4]->sort="1";
$elements[4]->header="Article Name";
$elements[4]->alias="diaryname";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="DESC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_comment` LEFT OUTER JOIN `gse_diaryarticle` ON `gse_comment`.`diaryarticle`=`gse_diaryarticle`.`id`");
$this->load->view("json",$data);
}

public function createcomment()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createcomment";
$data["title"]="Create comment";
$this->load->view("template",$data);
}
public function createcommentsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("image","Image","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createcomment";
$data["title"]="Create comment";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$google=$this->input->get_post("google");
$twitter=$this->input->get_post("twitter");
$facebook=$this->input->get_post("facebook");
$name=$this->input->get_post("name");
$description=$this->input->get_post("description");
$image=$this->menu_model->createImage();
if($this->comment_model->create($google,$twitter,$facebook,$name,$image,$description)==0)
$data["alerterror"]="New comment could not be created.";
else
$data["alertsuccess"]="comment created Successfully.";
$data["redirect"]="site/viewcomment";
$this->load->view("redirect",$data);
}
}
public function editcomment()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editcomment";
$data["title"]="Edit comment";
// $data[ 'status' ] =$this->user_model->getstatusdropdown();
// $data[ 'sportscategory' ] =$this->sportscategory_model->getdropdown();
$data["before"]=$this->comment_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editcommentsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("image","Image","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editcomment";
$data["title"]="Edit comment";
// $data[ 'status' ] =$this->user_model->getstatusdropdown();
// $data[ 'sportscategory' ] =$this->sportscategory_model->getdropdown();
$data["before"]=$this->comment_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$name=$this->input->get_post("name");
$comment=$this->input->get_post("comment");
// $image=$this->menu_model->createImage();
if($this->comment_model->edit($id,$name,$comment)==0)
$data["alerterror"]="New comment could not be Updated.";
else
$data["alertsuccess"]="comment Updated Successfully.";
$data["redirect"]="site/viewcomment";
$this->load->view("redirect",$data);
}
}
public function deletecomment()
{
	$access=array("1");
	$this->checkaccess($access);
	$this->comment_model->delete($this->input->get("id"));
	$data["redirect"]="site/viewcomment";
	$this->load->view("redirect",$data);
}
}
?>
