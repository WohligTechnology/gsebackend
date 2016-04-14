<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Edit Video</h4>
</div>
</div>
<div class="row">
<form class='col s12' method='post' action='<?php echo site_url("site/edittalentvideosubmit");?>' enctype= 'multipart/form-data'>
<input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
<div class="row">
<div class="input-field col s6">
<label for="url">Url</label>
<input type="text" id="url" name="url" value='<?php echo set_value('url',$before->url);?>'>
</div>
</div>
<div class=" row" style="display:none">
<div class=" input-field col s6">
<?php echo form_dropdown("talent",$talent,set_value('talent',$before->talent));?>
<label>Talent</label>
</div>
</div>
<div class="row">
<div class="col s6">
<button type="submit" class="btn btn-primary waves-effect waves-light  blue darken-4">Save</button>
<a href='<?php echo site_url("site/viewtalentvideo?id=").$this->input->get('talentid'); ?>' class='btn btn-secondary waves-effect waves-light red'>Cancel</a>
</div>
</div>
</form>
</div>
