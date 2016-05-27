<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Edit Video</h4>
</div>
</div>
<div class="row">
<form class='col s12' method='post' action='<?php echo site_url("site/editeventtypesubmit");?>' enctype= 'multipart/form-data'>
<input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
<div class=" row" style="display:none">
<div class=" input-field col s12 m6">
<?php echo form_dropdown("event",$event,set_value('event',$before->event));?>
<label for="Event">Event</label>
</div>
</div>
<div class=" row">
<div class=" input-field col s12 m6">
<?php echo form_dropdown("eventsubtype",$eventsubtype,set_value('eventsubtype',$before->eventsubtype));?>
<label for="Event Sub Type">Event Sub Type</label>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Name">Url</label>
<input type="text" id="Name" name="url" value='<?php echo set_value('url',$before->url);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Name">Order</label>
<input type="text" id="Name" name="order" value='<?php echo set_value('order',$before->order);?>'>
</div>
</div>
<div class="row" style="display:none">
			<div class="file-field input-field col m6 s12">
				<span class="img-center big">
								                    	<?php if($before->image == "") { } else {
									                    ?><img src="<?php echo base_url('uploads')."/".$before->image; ?>">
															<?php } ?>
															</span>
				<div class="btn blue darken-4">
					<span>Image</span>
					<input name="image" type="file" multiple>
				</div>
				<div class="file-path-wrapper">
					<input class="file-path validate" type="text" placeholder="Upload one or more files" value="<?php echo set_value('image',$before->image);?>">
				</div>
			</div>
		</div>
<div class="row" style="display:none">
			<div class="file-field input-field col m6 s12">
				<span class="img-center big">
								                    	<?php if($before->banner == "") { } else {
									                    ?><img src="<?php echo base_url('uploads')."/".$before->banner; ?>">
															<?php } ?>
															</span>
				<div class="btn blue darken-4">
					<span>Banner</span>
					<input name="banner" type="file" multiple>
				</div>
				<div class="file-path-wrapper">
					<input class="file-path validate" type="text" placeholder="Upload one or more files" value="<?php echo set_value('banner',$before->banner);?>">
				</div>
			</div>
		</div>
<div class="row">
<div class="col s6">
<button type="submit" class="btn btn-primary waves-effect waves-light  blue darken-4">Save</button>
<a href='<?php echo site_url("site/vieweventtype?id=").$this->input->get('eventid'); ?>' class='btn btn-secondary waves-effect waves-light red'>Cancel</a>
</div>
</div>
</form>
</div>