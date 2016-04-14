<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Edit award detail</h4>
</div>
</div>
<div class="row">
<form class='col s12' method='post' action='<?php echo site_url("site/editawarddetailsubmit");?>' enctype= 'multipart/form-data'>
<input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
<div class=" row">
<div class=" input-field col s6">
<?php echo form_dropdown("movie",$movie,set_value('movie',$before->movie));?>
<label>movie</label>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Award ">Award </label>
<input type="text" id="Award " name="award" value='<?php echo set_value('award',$before->award);?>'>
</div>
</div>

<div class="row">
<div class="input-field col s6">
<label for="Award Name">Award Name</label>
<input type="text" id="Award Name" name="awardname" value='<?php echo set_value('awardname',$before->awardname);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Award Receiver">Award Receiver</label>
<input type="text" id="Award Receiver" name="awardreceiver" value='<?php echo set_value('awardreceiver',$before->awardreceiver);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Winner Name">Winner Name</label>
<input type="text" id="Winner Name" name="winnername" value='<?php echo set_value('winnername',$before->winnername);?>'>
</div>
</div>
<div class="row">
<div class="col s6">
<button type="submit" class="btn btn-primary waves-effect waves-light  blue darken-4">Save</button>
<a href='<?php echo site_url("site/viewawarddetail?id=").$this->input->get('movieid'); ?>' class='btn btn-secondary waves-effect waves-light red'>Cancel</a>
</div>
</div>
</form>
</div>
