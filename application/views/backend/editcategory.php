<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Edit Category</h4>
</div>
</div>
<div class="row">
<form class='col s12' method='post' action='<?php echo site_url("site/editcategorysubmit");?>' enctype= 'multipart/form-data'>
<input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
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
<div class=" row">
<div class=" input-field col s12 m6">
<?php echo form_dropdown("status",$status,set_value('status',$before->status));?>
<label for="Status">Status</label>
</div>
</div>
<div class="row">
<div class="col s12 m6">
<label>Content</label>
<textarea name="content" id="some-textarea" class="materialize-textarea" placeholder="Enter text ..."><?php echo set_value( 'content',$before->content);?></textarea>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Hashtag">Hashtag</label>
<input type="text" id="Hashtag" name="hashtag" value='<?php echo set_value('hashtag',$before->hashtag);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Facebook">Facebook</label>
<input type="text" id="Facebook" name="facebook" value='<?php echo set_value('facebook',$before->facebook);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Twitter">Twitter</label>
<input type="text" id="Twitter" name="twitter" value='<?php echo set_value('twitter',$before->twitter);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Instagram">Instagram</label>
<input type="text" id="instagram" name="instagram" value='<?php echo set_value('instagram',$before->instagram);?>'>
</div>
</div>
<div class="row">
<div class="col s6">
<button type="submit" class="btn btn-primary waves-effect waves-light  blue darken-4">Save</button>
<a href='<?php echo site_url("site/viewcategory"); ?>' class='btn btn-secondary waves-effect waves-light red'>Cancel</a>
</div>
</div>
</form>
</div>
