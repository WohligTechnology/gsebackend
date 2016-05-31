<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Edit mediacorner</h4>
</div>
</div>
<div class="row">
<form class='col s12' method='post' action='<?php echo site_url("site/editmediacornersubmit");?>' enctype= 'multipart/form-data'>
<input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
<div class="row">
<div class="input-field col s6">
<label for="name">name</label>
<input type="text" id="name" name="name" value='<?php echo set_value('name',$before->name);?>'>
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
			</div><span style=" display: block;
    padding-top: 30px;">540 X 320</span>
		</div>
<div class="row">
<div class="input-field col s6">
<!-- <label for="date">date</label> -->
<input type="date" id="date" name="date" value='<?php echo set_value('date',$before->date);?>'>
</div>
</div>

<div class="row">
<div class="input-field col s6">
<label for="medianame">medianame</label>
<input type="text" id="medianame" name="medianame" value='<?php echo set_value('medianame',$before->medianame);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="url">url</label>
<input type="text" id="url" name="url" value='<?php echo set_value('url',$before->url);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="facebook">facebook</label>
<input type="text" id="facebook" name="facebook" value='<?php echo set_value('facebook',$before->facebook);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="twitter">twitter</label>
<input type="text" id="twitter" name="twitter" value='<?php echo set_value('twitter',$before->twitter);?>'>
</div>
</div>
<div class="row">
<div class="col s12 m6">
<label>message</label>
<textarea id="some-textarea" name="message" placeholder="Enter text ..."><?php echo set_value( 'message',$before->message);?></textarea>
</div>
</div>
<div class="row">
<div class="col s6">
<button type="submit" class="btn btn-primary waves-effect waves-light  blue darken-4">Save</button>
<a href='<?php echo site_url("site/viewmediacorner"); ?>' class='btn btn-secondary waves-effect waves-light red'>Cancel</a>
</div>
</div>
</form>
</div>
