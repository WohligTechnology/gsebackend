<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Create worldtour</h4>
</div>
<form class='col s12' method='post' action='<?php echo site_url("site/createworldtoursubmit");?>' enctype= 'multipart/form-data'>
  <div class=" row">
  <div class=" input-field col s6">
  <?php echo form_dropdown("type",$type,set_value('type'));?>
  <label>Type</label>
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
    padding-top: 30px;">540 X 320</span>
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
		
<div class=" row">
<div class=" input-field col s6">
<?php echo form_dropdown("status",$status,set_value('status'));?>
<label>Status</label>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="name">name</label>
<input type="text" id="name" name="name" value='<?php echo set_value('name');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="location">location</label>
<input type="text" id="location" name="location" value='<?php echo set_value('location');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="order">Order</label>
<input type="text" id="order" name="order" value='<?php echo set_value('order');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<!-- <label for="date">date</label> -->
<input type="date" id="date" name="date" value='<?php echo set_value('date');?>'>
</div>
</div>
<div class="row">
  <label>venue</label>
<div class="input-field col s12">
<textarea id="some-textarea" name="venue" class="materialize-textarea" length="400"><?php echo set_value( 'venue');?></textarea>

</div>
</div>
<div class="row">
  <label>content</label>
<div class="input-field col s12">
<textarea id="some-textarea" name="content" class="materialize-textarea" length="400"><?php echo set_value( 'content');?></textarea>

</div>
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
<a href="<?php echo site_url("site/viewworldtour"); ?>" class="btn btn-secondary waves-effect waves-light red">Cancel</a>
</div>
</div>
</form>
</div>
