<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Edit Mice Type</h4>
</div>
<form class='col s12' method='post' action='<?php echo site_url("site/editmicesubtypesubmit");?>' enctype= 'multipart/form-data'>
	<input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
<div class=" row" style="display:none">
<div class=" input-field col s12 m6">
<?php echo form_dropdown("mice",$mice,set_value('mice',$before->mice));?>
<label for="mice">mice</label>
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


<div class=" row">
<div class=" input-field col s12 m6">
<?php echo form_dropdown("status",$status,set_value('status',$before->status));?>
<label for="Status">Status</label>
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
    padding-top: 30px;">640 X 410</span>
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
		    padding-top: 30px;">1802 X 442</span>
				</div>
		<div class="row">
		<div class="input-field col s12">
		<textarea name="content" id="some-textarea" class="materialize-textarea"><?php echo set_value( 'content',$before->content);?></textarea>
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
