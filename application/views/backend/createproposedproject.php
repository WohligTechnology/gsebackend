<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Create proposed project</h4>
</div>
<form class='col s12' method='post' action='<?php echo site_url("site/createproposedprojectsubmit");?>' enctype= 'multipart/form-data'>
<div class="row">
<div class="input-field col s6">
<label for="Name">Name</label>
<input type="text" id="Name" name="name" value='<?php echo set_value('name');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Company">Company</label>
<input type="text" id="Company" name="company" value='<?php echo set_value('company');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Web Address">Web Address</label>
<input type="text" id="Web Address" name="webaddress" value='<?php echo set_value('webaddress');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Country">Country</label>
<input type="text" id="Country" name="country" value='<?php echo set_value('country');?>'>
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
<label for="Email">Email</label>
<input type="email" id="Email" name="email" value='<?php echo set_value('email');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Question 1 Ans">Question 1 Ans</label>
<input type="text" id="Question 1 Ans" name="question1ans" value='<?php echo set_value('question1ans');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Question 2 Ans">Question 2 Ans</label>
<input type="text" id="Question 2 Ans" name="question2ans" value='<?php echo set_value('question2ans');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Question 3 Ans">Question 3 Ans</label>
<input type="text" id="Question 3 Ans" name="question3ans" value='<?php echo set_value('question3ans');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s12">
<textarea name="content" id="some-textarea" class="materialize-textarea"><?php echo set_value( 'content');?></textarea>
<label>Content</label>
</div>
</div>
<div class="row">
<div class="col s12 m6">
<button type="submit" class="btn btn-primary waves-effect waves-light blue darken-4">Save</button>
<a href="<?php echo site_url("site/viewproposedproject"); ?>" class="btn btn-secondary waves-effect waves-light red">Cancel</a>
</div>
</div>
</form>
</div>
