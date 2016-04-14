<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Create Video </h4>
</div>
<form class='col s12' method='post' action='<?php echo site_url("site/createtalentvideosubmit");?>' enctype= 'multipart/form-data'>
<div class="row">
<div class="input-field col s6">
<label for="url">Url</label>
<input type="text" id="url" name="url" value='<?php echo set_value('url');?>'>
</div>
</div>
<div class=" row"  style="display:none">
<div class=" input-field col s6">
<?php echo form_dropdown("talent",$talent,set_value('talent',$this->input->get('id')));?>
<label>talent</label>
</div>
</div>
<div class="row">
<div class="col s12 m6">
<button type="submit" class="btn btn-primary waves-effect waves-light blue darken-4">Save</button>
<a href="<?php echo site_url("site/viewtalentvideo?id=").$this->input->get('id'); ?>" class="btn btn-secondary waves-effect waves-light red">Cancel</a>
</div>
</div>
</form>
</div>
