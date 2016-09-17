<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Edit author</h4>
</div>
</div>
<div class="row">
<form class='col s12' method='post' action='<?php echo site_url("site/editauthorsubmit");?>' enctype= 'multipart/form-data'>
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
	 padding-top: 30px;">315 X 310</span>
		</div>
		<div class="row">
		<div class="input-field col s6">
		<textarea name="description" id="some-textarea" class="materialize-textarea"><?php echo set_value( 'description',$before->description);?></textarea>
		<label>Description</label>
		</div>
		</div>
		<div class="row">
		<div class="input-field col s6">
		<label for="Order">Order</label>
		<input type="text" id="Order" name="order" value='<?php echo set_value('order',$before->order);?>'>
		</div>
		</div>
		<div class=" row">
		<div class=" input-field col s12 m6">
		<?php echo form_dropdown("status",$status,set_value('status',$before->status));?>
		<label for="Status">Status</label>
		</div>
		</div>
		<div class="row">
		<div class="input-field col s6">
		<label for="Order">Facebook</label>
		<input type="text" id="Facebook" name="facebook" value='<?php echo set_value('facebook',$before->facebook);?>'>
		</div>
		</div>
		<div class="row">
		<div class="input-field col s6">
		<label for="Order">Twitter</label>
		<input type="text" id="Twitter" name="twitter" value='<?php echo set_value('twitter',$before->twitter);?>'>
		</div>
		</div>
		<div class="row">
		<div class="input-field col s6">
		<label for="Order">Google</label>
		<input type="text" id="Google" name="google" value='<?php echo set_value('google',$before->google);?>'>
		</div>
		</div>
<div class="row">
<div class="col s6">
<button type="submit" class="btn btn-primary waves-effect waves-light  blue darken-4">Save</button>
<a href='<?php echo site_url("site/viewauthor"); ?>' class='btn btn-secondary waves-effect waves-light red'>Cancel</a>
</div>
</div>
</form>
</div>
