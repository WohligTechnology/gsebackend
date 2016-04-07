<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Create career form</h4>
</div>
<form class='col s12' method='post' action='<?php echo site_url("site/createcareerformsubmit");?>' enctype= 'multipart/form-data'>
<div class="row">
<div class="input-field col s6">
<label for="Name">Name</label>
<input type="text" id="Name" name="name" value='<?php echo set_value('name');?>'>
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
<label for="Resume">Resume</label>
<input type="text" id="Resume" name="resume" value='<?php echo set_value('resume');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s12">
<textarea name="comment" class="materialize-textarea"><?php echo set_value( 'comment');?></textarea>
<label>Comment</label>
</div>
</div>
<div class="row">
<div class="col s12 m6">
<button type="submit" class="btn btn-primary waves-effect waves-light blue darken-4">Save</button>
<a href="<?php echo site_url("site/viewcareerform"); ?>" class="btn btn-secondary waves-effect waves-light red">Cancel</a>
</div>
</div>
</form>
</div>
