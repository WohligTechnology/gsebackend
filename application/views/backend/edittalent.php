<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Edit talent</h4>
</div>
</div>
<div class="row">
<form class='col s12' method='post' action='<?php echo site_url("site/edittalentsubmit");?>' enctype= 'multipart/form-data'>
<input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
<div class="row">
<div class="input-field col s6">
<label for="Name">Name</label>
<input type="text" id="Name" name="name" value='<?php echo set_value('name',$before->name);?>'>
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
			</div>
			<span style=" display: block;
	 padding-top: 30px;">809 X 517</span>
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
		    padding-top: 30px;">1800 X 440</span>
				</div>
<div class="row">
<div class="input-field col s6">
<label for="Link">Link</label>
<input type="text" id="Link" name="link" value='<?php echo set_value('link',$before->link);?>'>
</div>
</div>
<div class="row">
<div class="col s6">
<button type="submit" class="btn btn-primary waves-effect waves-light  blue darken-4">Save</button>
<a href='<?php echo site_url("site/viewtalent");?>' class='btn btn-secondary waves-effect waves-light red'>Cancel</a>
</div>
</div>
</form>
</div>
