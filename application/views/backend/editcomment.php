<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Edit comment</h4>
</div>
</div>
<div class="row">
<form class='col s12' method='post' action='<?php echo site_url("site/editcommentsubmit");?>' enctype= 'multipart/form-data'>
<input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">

<div class="row">
<div class="input-field col s6">
<label for="Order">Article</label>
<input type="text" id="Article" name="diaryarticle" value='<?php echo set_value('diaryarticle',$before->diaryarticle);?>'>
</div>
</div>
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
									                    ?><img src="<?php echo $before->image; ?>">
															<?php } ?>
															</span>
				<!-- <div class="btn blue darken-4">
					<span>Image</span>
					<input name="image" type="file" multiple>
				</div>
				<div class="file-path-wrapper">
					<input class="file-path validate" type="text" placeholder="Upload one or more files" value="<?php echo set_value('image',$before->image);?>">
				</div> -->
			</div>
			<!-- <span style=" display: block;
	 padding-top: 30px;">310 X 330</span> -->
		</div>
		<div class="row">
		<div class="input-field col s6">
		<textarea name="comment" id="some-textarea" class="materialize-textarea"><?php echo set_value( 'comment',$before->comment);?></textarea>
		<label>Description</label>
		</div>
		</div>

<div class="row">
<div class="col s6">
<button type="submit" class="btn btn-primary waves-effect waves-light  blue darken-4">Save</button>
<a href='<?php echo site_url("site/viewcomment"); ?>' class='btn btn-secondary waves-effect waves-light red'>Cancel</a>
</div>
</div>
</form>
</div>
