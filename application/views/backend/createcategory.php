<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Create Category</h4>
</div>
<form class='col s12' method='post' action='<?php echo site_url("site/createcategorysubmit");?>' enctype= 'multipart/form-data'>
<div class="row">
<div class="input-field col s6">
<label for="Name">Name</label>
<input type="text" id="Name" name="name" value='<?php echo set_value('name');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Order">Order</label>
<input type="text" id="Order" name="order" value='<?php echo set_value('order');?>'>
</div>
</div>
<div class=" row">
<div class=" input-field col s6">
<?php echo form_dropdown("status",$status,set_value('status'));?>
<label>Status</label>
</div>
</div>
<div class="row">
<div class="input-field col s12">
<textarea name="content" id="some-textarea" class="materialize-textarea"><?php echo set_value( 'content');?></textarea>
<label>Content</label>
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
<a href="<?php echo site_url("site/viewcategory"); ?>" class="btn btn-secondary waves-effect waves-light red">Cancel</a>
</div>
</div>
</form>
</div>
