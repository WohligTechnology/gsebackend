<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Create mice</h4>
</div>
<form class='col s12' method='post' action='<?php echo site_url("site/createmicesubmit");?>' enctype= 'multipart/form-data'>
<div class="row">
<div class="input-field col s6">
<label for="Name">Name</label>
<input type="text" id="Name" name="name" value='<?php echo set_value('name');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Link">Url</label>
<input type="text" id="Link" name="link" value='<?php echo set_value('link');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Order">Order</label>
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
    padding-top: 30px;">566 x 320</span>
		</div>
<div class="row">
			<div class="file-field input-field col m6 s12">
				<div class="btn blue darken-4">
					<span>Banner</span>
					<input name="banner" type="file" multiple>
				</div>
				<div class="file-path-wrapper">
					<input class="file-path validate" type="text" placeholder="Upload one or more files" value="<?php echo set_value('banner');?>">
				</div>
			</div><span style=" display: block;
    padding-top: 30px;">1800 X 440</span>
		</div>
		<div class="row">
		<div class="input-field col s6">
		<label for="Hashtag">Hashtag</label>
		<input type="text" id="Hashtag" name="hashtag" value='<?php echo set_value('hashtag');?>'>
		</div>
		</div>
		<div class="row">
		<div class="input-field col s6">
		<label for="Facebook">Facebook</label>
		<input type="text" id="Facebook" name="facebook" value='<?php echo set_value('facebook');?>'>
		</div>
		</div>
		<div class="row">
		<div class="input-field col s6">
		<label for="Twitter">Twitter</label>
		<input type="text" id="Twitter" name="twitter" value='<?php echo set_value('twitter');?>'>
		</div>
		</div>
		<div class="row">
		<div class="input-field col s6">
		<label for="Instagram">Instagram</label>
		<input type="text" id="instagram" name="instagram" value='<?php echo set_value('instagram');?>'>
		</div>
		</div>
<div class="row">
<div class="col s12 m6">
<button type="submit" class="btn btn-primary waves-effect waves-light blue darken-4">Save</button>
<a href="<?php echo site_url("site/viewmice"); ?>" class="btn btn-secondary waves-effect waves-light red">Cancel</a>
</div>
</div>
</form>
</div>
