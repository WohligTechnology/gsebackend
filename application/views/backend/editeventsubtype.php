<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Edit event sub-type</h4>
</div>
</div>
<div class="row">
<form class='col s12' method='post' action='<?php echo site_url("site/editeventsubtypesubmit");?>' enctype= 'multipart/form-data'>
<input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
<div class=" row" style="display:none">
<div class=" input-field col s12 m6">
<?php echo form_dropdown("event",$event,set_value('event',$before->event));?>
<label for="Event">Event</label>
</div>
</div>

<div class="row">
<div class="input-field col s6">
<label for="Name">Name</label>
<input type="text" id="Name" name="name" value='<?php echo set_value('name',$before->name);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Order">Order</label>
<input type="text" id="Order" name="order" value='<?php echo set_value('order',$before->order);?>'>
</div>
</div>
<div class="row">
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
			</div><span style=" display: block;
    padding-top: 30px;">630 X 285</span>
		</div>
		<div class="row">
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
					</div><span style=" display: block;
				padding-top: 30px;">640 X 410</span>
				</div>
<div class="row">
<div class="input-field col s6">
<label for="Content">Content</label>
<textarea name="content" class="materialize-textarea" placeholder="Enter text ..."><?php echo set_value( 'content',$before->content);?></textarea>
</div>
</div>
<div class="row" style="display:none">
<div class="col s12 m6">
<label>Videos</label>
<textarea name="videos" class="materialize-textarea" placeholder="Enter text ..."><?php echo set_value( 'videos',$before->videos);?></textarea>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Release Date">Date</label>
<input type="date" id="Release Date" class="datepicker" name="releasedate" value='<?php echo set_value('releasedate',$before->date);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Location">Location</label>
<input type="text" id="Location" name="location" value='<?php echo set_value('location',$before->location);?>'>
</div>
</div>
<div class="row">
<div class="col s6">
<button type="submit" class="btn btn-primary waves-effect waves-light  blue darken-4">Save</button>
<a href='<?php echo site_url("site/vieweventsubtype?id=").$this->input->get('eventid'); ?>' class='btn btn-secondary waves-effect waves-light red'>Cancel</a>
</div>
</div>
</form>
</div>
