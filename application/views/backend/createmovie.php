<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Create Video </h4>
</div>
<form class='col s12' method='post' action='<?php echo site_url("site/createmoviesubmit");?>' enctype= 'multipart/form-data'>
<div class="row">
<div class="input-field col s6">
<label for="content">Url</label>
<input type="text" id="content" name="content" value='<?php echo set_value('content');?>'>
</div>
</div>
<div class=" row"  style="display:none">
<div class=" input-field col s6">
<?php echo form_dropdown("movie",$movie,set_value('movie',$this->input->get('id')));?>
<label>movie</label>
</div>
</div>
<div class="row">
<div class="col s12 m6">
<button type="submit" class="btn btn-primary waves-effect waves-light blue darken-4">Save</button>
<a href="<?php echo site_url("site/viewmovie?id=").$this->input->get('id'); ?>" class="btn btn-secondary waves-effect waves-light red">Cancel</a>
</div>
</div>
</form>
</div>
