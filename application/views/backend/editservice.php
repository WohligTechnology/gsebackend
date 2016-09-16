<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Edit service</h4>
</div>
</div>
<div class="row">
<form class='col s12' method='post' action='<?php echo site_url("site/editservicesubmit");?>' enctype= 'multipart/form-data'>
<input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
<div class="row">
<div class="input-field col s6">
<label for="Name">Name</label>
<input type="text" id="Name" name="name" value='<?php echo set_value('name',$before->name);?>'>
</div>
</div>
<div class="row">
<div class="col s12 m6">
<label>Content</label>
<textarea name="content" id="some-textarea" class="materialize-textarea" placeholder="Enter text ..."><?php echo set_value( 'content',$before->content);?></textarea>
</div>
</div>
<div class=" row">
<div class=" input-field col s6">
<?php echo form_dropdown("type",$type,set_value('type',$before->type));?>
<label>Type</label>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="order">Order</label>
<input type="text" id="order" name="order" value='<?php echo set_value('order',$before->order);?>'>
</div>
</div>
<div class="row">
<div class="col s6">
<button type="submit" class="btn btn-primary waves-effect waves-light  blue darken-4">Save</button>
<a href='<?php echo site_url("site/viewservice"); ?>' class='btn btn-secondary waves-effect waves-light red'>Cancel</a>
</div>
</div>
</form>
</div>
