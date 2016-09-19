<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Edit career form</h4>
</div>
</div>
<div class="row">
<form class='col s12' method='post' action='<?php echo site_url("site/editcareerformsubmit");?>' enctype= 'multipart/form-data'>
<input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
<div class="row">
<div class="input-field col s6">
<label for="Name">Name</label>
<input type="text" id="Name" name="name" value='<?php echo set_value('name',$before->name);?>'>
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
<label for="Resume">Resume</label>
<input type="text" id="Resume" name="resume" value='<?php echo set_value('resume',$before->resume);?>'>
</div>
</div>
<div class="row">
<div class="col s12 m6">
<label>Comment</label>
<textarea name="comment" class="materialize-textarea" placeholder="Enter text ..."><?php echo set_value( 'comment',$before->comment);?></textarea>
</div>
</div>
<div class="row">
<div class="col s12 m6">
<label>Address</label>
<textarea name="address" class="materialize-textarea" placeholder="Enter text ..."><?php echo set_value( 'address',$before->address);?></textarea>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="category">category</label>
<input type="text" id="category" name="category" value='<?php echo set_value('category',$before->category);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="dob">Dob</label>
<input type="text" id="dob" name="dob" value='<?php echo set_value('dob',$before->dob);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="expectedctc">Expected ctc</label>
<input type="text" id="expectedctc" name="expectedctc" value='<?php echo set_value('expectedctc',$before->expectedctc);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="github">Git Hub</label>
<input type="text" id="github" name="github" value='<?php echo set_value('github',$before->github);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="linkedin">linkedin</label>
<input type="text" id="linkedin" name="linkedin" value='<?php echo set_value('linkedin',$before->linkedin);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="otherwebsite">Other website</label>
<input type="text" id="otherwebsite" name="otherwebsite" value='<?php echo set_value('otherwebsite',$before->otherwebsite);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="portfolio">Portfolio</label>
<input type="text" id="portfolio" name="portfolio" value='<?php echo set_value('portfolio',$before->portfolio);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="postcode">Post code</label>
<input type="text" id="postcode" name="postcode" value='<?php echo set_value('postcode',$before->postcode);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="salary">Salary</label>
<input type="text" id="salary" name="salary" value='<?php echo set_value('salary',$before->salary);?>'>
</div>
</div>
<div class="row">
<div class="col s6">
<button type="submit" class="btn btn-primary waves-effect waves-light  blue darken-4">Save</button>
<a href='<?php echo site_url("site/viewcareerform"); ?>' class='btn btn-secondary waves-effect waves-light red'>Cancel</a>
</div>
</div>
</form>
</div>
