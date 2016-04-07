<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Create award detail</h4>
</div>
<form class='col s12' method='post' action='<?php echo site_url("site/createawarddetailsubmit");?>' enctype= 'multipart/form-data'>
<div class=" row">
<div class=" input-field col s6">
<?php echo form_dropdown("award",$award,set_value('award'));?>
<label>Award</label>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Award Name">Award Name</label>
<input type="text" id="Award Name" name="awardname" value='<?php echo set_value('awardname');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Award Receiver">Award Receiver</label>
<input type="text" id="Award Receiver" name="awardreceiver" value='<?php echo set_value('awardreceiver');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Winner Name">Winner Name</label>
<input type="text" id="Winner Name" name="winnername" value='<?php echo set_value('winnername');?>'>
</div>
</div>
<div class="row">
<div class="col s12 m6">
<button type="submit" class="btn btn-primary waves-effect waves-light blue darken-4">Save</button>
<a href="<?php echo site_url("site/viewawarddetail"); ?>" class="btn btn-secondary waves-effect waves-light red">Cancel</a>
</div>
</div>
</form>
</div>
