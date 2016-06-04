<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Create event sub-type</h4>
</div>
<form class='col s12' method='post' action='<?php echo site_url("site/createeventsubtypesubmit");?>' enctype= 'multipart/form-data'>
<div class=" row" style="display:none">
<div class=" input-field col s6">
<?php echo form_dropdown("event",$event,set_value('event',$this->input->get('id')));?>
<label>Event</label>
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
<label for="Name">Order</label>
<input type="text" id="Order" name="order" value='<?php echo set_value('order');?>'>
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
			</div><span style=" display: block;
    padding-top: 30px;">630 X 285</span>
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
				</div>
<div class="row">
<div class="input-field col s6">
<label for="Content">Content</label>
<textarea name="content" class="materialize-textarea"><?php echo set_value( 'content');?></textarea>
</div>
</div>
<div class="row" style="display:none">
<div class="input-field col s12">
<textarea name="videos" class="materialize-textarea"><?php echo set_value( 'videos');?></textarea>
<label>Videos</label>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Release Date">Date</label>
<input type="date" id="Release Date" class="datepicker" name="releasedate" value='<?php echo set_value('releasedate');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Location">Location</label>
<input type="text" id="Location" name="location" value='<?php echo set_value('location');?>'>
</div>
</div>
<div class="row">
<div class="col s12 m6">
<button type="submit" class="btn btn-primary waves-effect waves-light blue darken-4">Save</button>
<a href="<?php echo site_url("site/vieweventsubtype?id=").$this->input->get('id'); ?>" class="btn btn-secondary waves-effect waves-light red">Cancel</a>
</div>
</div>
</form>
</div>
