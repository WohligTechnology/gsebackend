<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Edit get in touch</h4>
</div>
</div>
<div class="row">
<form class='col s12' method='post' action='<?php echo site_url("site/editgetintouchsubmit");?>' enctype= 'multipart/form-data'>
<input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
<div class=" row">
<div class=" input-field col s12 m6">
<?php echo form_dropdown("category",$category,set_value('category',$before->category));?>
<label for="Category">Category</label>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="First Name">First Name</label>
<input type="text" id="First Name" name="firstname" value='<?php echo set_value('firstname',$before->firstname);?>'>
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
<label for="noofpeople">No of people</label>
<input type="text" id="noofpeople" name="noofpeople" value='<?php echo set_value('noofpeople',$before->noofpeople);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="location">Location</label>
<input type="text" id="location" name="location" value='<?php echo set_value('location',$before->location);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="startdate">Start date</label>
<input type="text" id="startdate" name="startdate" value='<?php echo set_value('startdate',$before->startdate);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="enddate">End date</label>
<input type="text" id="enddate" name="enddate" value='<?php echo set_value('enddate',$before->enddate);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Timestamp">Timestamp</label>
<input type="text" id="Timestamp" name="timestamp" value='<?php echo set_value('timestamp',$before->timestamp);?>'>
</div>
</div>
<div class="row">
<div class="col s12 m6">
<label>Comment</label>
<textarea name="comment" placeholder="Enter text ..."><?php echo set_value( 'comment',$before->comment);?></textarea>
</div>
</div>
<div class="row">
<div class="col s12 m6">
<label>Enquiry For</label>
<textarea name="enquiryfor" placeholder="Enter text ..."><?php echo set_value( 'enquiryfor',$before->enquiryfor);?></textarea>
</div>
</div>
<div class="row">
<div class="col s6">
<button type="submit" class="btn btn-primary waves-effect waves-light  blue darken-4">Save</button>
<a href='<?php echo site_url("site/viewgetintouch"); ?>' class='btn btn-secondary waves-effect waves-light red'>Cancel</a>
</div>
</div>
</form>
</div>
