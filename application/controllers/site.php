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
if($this->category_model->create($order,$status,$name)==0)
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
if($this->category_model->edit($id,$order,$status,$name)==0)
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
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `gse_testimonial` INNER JOIN `gse_category` ON `gse_category`.`id`=`gse_testimonial`.`category`");
$this->load->view("json",$data);
}

public function createtestimonial()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createtestimonial";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
     $data['category']=$this->category_model->getdropdown();
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
//$image=$this->input->get_post("image");
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
 $data['category']=$this->category_model->getdropdown();
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
//$image=$this->input->get_post("image");
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
if($this->getintouch_model->create($category,$firstname,$lastname,$email,$phone,$timestamp,$comment,$enquiryfor)==0)
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
if($this->getintouch_model->edit($id,$category,$firstname,$lastname,$email,$phone,$timestamp,$comment,$enquiryfor)==0)
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
    $data[ 'diarycategory' ] =$this->diarycategory_model->getdropdown();
    $data[ 'diarysubcategory' ] =$this->diarysubcategory_model->getdropdown();
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
$data["title"]="Create diaryarticle";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$status=$this->input->get_post("status");
$diarycategory=$this->input->get_post("diarycategory");
$diarysubcategory=$this->input->get_post("diarysubcategory");
$name=$this->input->get_post("name");
//$image=$this->input->get_post("image");
$content=$this->input->get_post("content");
$date=$this->input->get_post("date");
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
if($this->diaryarticle_model->create($status,$diarycategory,$diarysubcategory,$name,$image,$timestamp,$content,$date)==0)
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
$data["page"]="editdiaryarticle";
$data["title"]="Edit diaryarticle";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data[ 'diarycategory' ] =$this->diarycategory_model->getdropdown();
 $data[ 'diarysubcategory' ] =$this->diarysubcategory_model->getdropdown();
$data["before"]=$this->diaryarticle_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
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
$diarysubcategory=$this->input->get_post("diarysubcategory");
$name=$this->input->get_post("name");
//$image=$this->input->get_post("image");
$timestamp=$this->input->get_post("timestamp");
$content=$this->input->get_post("content");
$date=$this->input->get_post("date");
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
if($this->diaryarticle_model->edit($id,$status,$diarycategory,$diarysubcategory,$name,$image,$timestamp,$content,$date)==0)
$data["alerterror"]="New diaryarticle could not be Updated.";
else
$data["alertsuccess"]="diaryarticle Updated Successfully.";
$data["redirect"]="site/viewdiaryarticle";
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

}
?>
