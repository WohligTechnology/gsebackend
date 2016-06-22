<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Create Author</h4>
</div>
<form class='col s12' method='post' action='<?php echo site_url("site/createauthorsubmit");?>' enctype= 'multipart/form-data'>
<div class="row">
<div class="input-field col s6">
<label for="Name">Name</label>
<input type="text" id="Name" name="name" value='<?php echo set_value('name');?>'>
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
			<span style=" display: block;
	 padding-top: 30px;">315 X 310</span>
		</div>
		<div class="row">
		<div class="input-field col s6">
		<textarea name="description" id="some-textarea" class="materialize-textarea"><?php echo set_value( 'description');?></textarea>
		<label>Description</label>
		</div>
		</div>
		<div class="row">
		<div class="input-field col s6">
		<label for="Order">Facebook</label>
		<input type="text" id="Facebook" name="facebook" value='<?php echo set_value('facebook');?>'>
		</div>
		</div>
		<div class="row">
		<div class="input-field col s6">
		<label for="Order">Twitter</label>
		<input type="text" id="Twitter" name="twitter" value='<?php echo set_value('twitter');?>'>
		</div>
		</div>
		<div class="row">
		<div class="input-field col s6">
		<label for="Order">Google</label>
		<input type="text" id="Google" name="google" value='<?php echo set_value('google');?>'>
		</div>
		</div>
<div class="row">
<div class="col s12 m6">
<button type="submit" class="btn btn-primary waves-effect waves-light blue darken-4">Save</button>
<a href="<?php echo site_url("site/viewauthor"); ?>" class="btn btn-secondary waves-effect waves-light red">Cancel</a>
</div>
</div>
</form>
</div>
