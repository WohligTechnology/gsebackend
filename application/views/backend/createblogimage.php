<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Create blog image</h4>
</div>
<form class='col s12' method='post' action='<?php echo site_url("site/createblogimagesubmit");?>' enctype= 'multipart/form-data'>
<div class=" row" style="display:none">
<div class=" input-field col s6">
<?php echo form_dropdown("diaryarticle",$diaryarticle,set_value('diaryarticle',$this->input->get('id')));?>
<label>Diary Article</label>
</div>
</div>
<div class="row">
			<div class="file-field input-field col m6 s12">
				<div class="btn blue darken-4">
					<span>Image</span>
					<input name="image" type="file" multiple>
				</div>
				<div class="file-path-wrapper">
					<input class="file-path validate" type="text" placeholder="Upload one or more files" value="<?php echo set_value('image');?>">
				</div>
			</div>
		</div>
<div class="row">
<div class="input-field col s6">
<label for="Order">Order</label>
<input type="text" id="Order" name="order" value='<?php echo set_value('order');?>'>
</div>
</div>
<div class="row">
<div class="col s12 m6">
<button type="submit" class="btn btn-primary waves-effect waves-light blue darken-4">Save</button>
<a href="<?php echo site_url("site/viewblogimage?id=").$this->input->get('id'); ?>" class="btn btn-secondary waves-effect waves-light red">Cancel</a>
</div>
</div>
</form>
</div>
