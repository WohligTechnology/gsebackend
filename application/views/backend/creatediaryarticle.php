<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Create Diary Article</h4>
</div>
<form class='col s12' method='post' action='<?php echo site_url("site/creatediaryarticlesubmit");?>' enctype= 'multipart/form-data'>
<div class=" row">
<div class=" input-field col s6">
<?php echo form_dropdown("status",$status,set_value('status'));?>
<label>Status</label>
</div>
</div>
<div class=" row">
<div class=" input-field col s6">
<?php echo form_dropdown("diarycategory",$diarycategory,set_value('diarycategory'));?>
<label>Diary Category</label>
</div>
</div>
<div class=" row">
<div class=" input-field col s6">
<?php echo form_dropdown("diarysubcategory",$diarysubcategory,set_value('diarysubcategory'));?>
<label>Diary Sub Category</label>
</div>
</div>
<div class=" row">
<div class=" input-field col s6">
<?php echo form_dropdown("type",$type,set_value('type'));?>
<label>Blog Type</label>
</div>
</div>
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
			</div><span style=" display: block;
    padding-top: 30px;">405 X 390</span>
		</div>
<div class="row">
<div class="input-field col s6">
<textarea name="content" id="some-textarea" class="materialize-textarea" length="400"><?php echo set_value( 'content');?></textarea>
<label>Content</label>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Date">Date</label>
<input type="date" id="Date" name="date" class="datepicker" value='<?php echo set_value('date');?>'>
</div>
</div>
<div class="row">
<div class="col s12 m6">
<button type="submit" class="btn btn-primary waves-effect waves-light blue darken-4">Save</button>
<a href="<?php echo site_url("site/viewdiaryarticle"); ?>" class="btn btn-secondary waves-effect waves-light red">Cancel</a>
</div>
</div>
</form>
</div>
