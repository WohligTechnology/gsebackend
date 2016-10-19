<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Create Mice Type</h4>
</div>
<form class='col s12' method='post' action='<?php echo site_url("site/createmicesubtypesubmit");?>' enctype= 'multipart/form-data'>
<div class=" row" style="display:none">
<div class=" input-field col s6">
<?php echo form_dropdown("mice",$mice,set_value('mice',$this->input->get('id')));?>
<label>Mice</label>
</div>
</div>

<div class="row">
<div class="input-field col s6">
<label for="Name">Name</label>
<input type="text" id="Name" name="name" value='<?php echo set_value('name');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Name">Url</label>
<input type="text" id="Name" name="url" value='<?php echo set_value('url');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Name">Order</label>
<input type="text" id="Name" name="order" value='<?php echo set_value('order');?>'>
</div>
</div>

<div class="row">
<div class="input-field col s6">
<label for="Name">Location</label>
<input type="text" id="Name"  name="location" value='<?php echo set_value('location');?>'>
</div>
</div>

<div class="row">
<div class="input-field col s6">
<label for="Name">Date</label>
<input type="date" id="Name" class="datepicker" name="date" value='<?php echo set_value('date');?>'>
</div>
</div>


<div class=" row">
<div class=" input-field col s6">
<?php echo form_dropdown("status",$status,set_value('status'));?>
<label>Status</label>
</div>
</div>


<div class="row" style="display:block">
			<div class="file-field input-field col m6 s12">
				<div class="btn blue darken-4">
					<span>Image</span>
					<input name="image" type="file" multiple>
				</div>
				<div class="file-path-wrapper">
					<input class="file-path validate" type="text" placeholder="Upload one or more files" value="<?php echo set_value('image');?>">
				</div>
			</div>
			<span style=" display: block;
    padding-top: 30px;">640 X 410</span>
		</div>
<div class="row" style="display:block">
			<div class="file-field input-field col m6 s12">
				<div class="btn blue darken-4">
					<span>Banner</span>
					<input name="banner" type="file" multiple>
				</div>
				<div class="file-path-wrapper">
					<input class="file-path validate" type="text" placeholder="Upload one or more files" value="<?php echo set_value('banner');?>">
				</div>
			</div>
			<span style=" display: block;
		padding-top: 30px;">1802 X 442</span>
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
<a href="<?php echo site_url("site/viewmicesubtype?id=").$this->input->get('id'); ?>" class="btn btn-secondary waves-effect waves-light red">Cancel</a>
</div>
</div>
</form>
</div>
