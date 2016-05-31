<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Create general enquiry</h4>
</div>
<form class='col s12' method='post' action='<?php echo site_url("site/creategeneralenquirysubmit");?>' enctype= 'multipart/form-data'>
<div class="row">
<div class="input-field col s6">
<label for="First Name">First Name</label>
<input type="text" id="First Name" name="firstname" value='<?php echo set_value('firstname');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Middle Name">Middle Name</label>
<input type="text" id="Middle Name" name="middlename" value='<?php echo set_value('middlename');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Last Name">Last Name</label>
<input type="text" id="Last Name" name="lastname" value='<?php echo set_value('lastname');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Company Name">Company Name</label>
<input type="text" id="Company Name" name="companyname" value='<?php echo set_value('companyname');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Email">Email</label>
<input type="email" id="Email" name="email" value='<?php echo set_value('email');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Phone">Phone</label>
<input type="text" id="Phone" name="phone" value='<?php echo set_value('phone');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Web Address">Web Address</label>
<input type="text" id="Web Address" name="webaddress" value='<?php echo set_value('webaddress');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s12">
<textarea name="message" class="materialize-textarea"><?php echo set_value( 'message');?></textarea>
<label>Message</label>
</div>
</div>
<div class="row">
<div class="col s12 m6">
<button type="submit" class="btn btn-primary waves-effect waves-light blue darken-4">Save</button>
<a href="<?php echo site_url("site/viewgeneralenquiry"); ?>" class="btn btn-secondary waves-effect waves-light red">Cancel</a>
</div>
</div>
</form>
</div>
