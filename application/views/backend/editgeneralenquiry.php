<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Edit general enquiry</h4>
</div>
</div>
<div class="row">
<form class='col s12' method='post' action='<?php echo site_url("site/editgeneralenquirysubmit");?>' enctype= 'multipart/form-data'>
<input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
<div class="row">
<div class="input-field col s6">
<label for="First Name">First Name</label>
<input type="text" id="First Name" name="firstname" value='<?php echo set_value('firstname',$before->firstname);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Middle Name">Middle Name</label>
<input type="text" id="Middle Name" name="middlename" value='<?php echo set_value('middlename',$before->middlename);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Last Name">Last Name</label>
<input type="text" id="Last Name" name="lastname" value='<?php echo set_value('lastname',$before->lastname);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Company Name">Company Name</label>
<input type="text" id="Company Name" name="companyname" value='<?php echo set_value('companyname',$before->companyname);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Email">Email</label>
<input type="email" id="Email" name="email" value='<?php echo set_value('email',$before->email);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Phone">Phone</label>
<input type="text" id="Phone" name="phone" value='<?php echo set_value('phone',$before->phone);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Web Address">Web Address</label>
<input type="text" id="Web Address" name="webaddress" value='<?php echo set_value('webaddress',$before->webaddress);?>'>
</div>
</div>
<div class="row">
<div class="col s12 m6">
<label>Message</label>
<textarea name="message" class="materialize-textarea" placeholder="Enter text ..."><?php echo set_value( 'message',$before->message);?></textarea>
</div>
</div>
<div class="row">
<div class="col s6">
<!--<button type="submit" class="btn btn-primary waves-effect waves-light  blue darken-4">Save</button>-->
<a href='<?php echo site_url("site/viewgeneralenquiry"); ?>' class='btn btn-secondary waves-effect waves-light red'>Cancel</a>
</div>
</div>
</form>
</div>
