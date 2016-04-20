<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Edit movie detail</h4>
</div>
</div>
<div class="row">
<form class='col s12' method='post' action='<?php echo site_url("site/editmoviedetailsubmit");?>' enctype= 'multipart/form-data'>
<input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
<div class=" row">
<div class=" input-field col s12 m6">
<?php echo form_dropdown("isupcoming",$isupcoming,set_value('isupcoming',$before->isupcoming));?>
<label for="Is upcoming">Is upcoming</label>
</div>
</div>
<div class=" row">
<div class=" input-field col s12 m6">
<?php echo form_dropdown("isreleased",$isreleased,set_value('isreleased',$before->isreleased));?>
<label for="Is released">Is released</label>
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
		</div>
<div class="row">
			<div class="file-field input-field col m6 s12">
				<span class="img-center big">
								                    	<?php if($before->banner == "") { } else {
									                    ?><img src="<?php echo base_url('uploads')."/".$before->banner; ?>">
															<?php } ?>
															</span>
				<div class="btn blue darken-4">
					<span>Banner</span>
					<input name="banner" type="file" multiple>
				</div>
				<div class="file-path-wrapper">
					<input class="file-path validate" type="text" placeholder="Upload one or more files" value="<?php echo set_value('banner',$before->banner);?>">
				</div>
			</div>
		</div>
		<h4 class="title-sub">ABOUT THE MOVIE</h4>
		<div class="row">
<div class="col s12 m6">
<label>Synopsis</label>
<textarea name="synopsis" class="materialize-textarea" placeholder="Enter text ..."><?php echo set_value( 'synopsis',$before->synopsis);?></textarea>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Release Date">Release Date</label>
<input type="date" id="Release Date" class="datepicker" name="releasedate" value='<?php echo set_value('releasedate',$before->releasedate);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Imdb">Check this movie out on IMDb</label>
<input type="text" id="Imdb" name="imdb" value='<?php echo set_value('imdb',$before->imdb);?>'>
</div>
</div>
	<h4 class="title-sub">CAST & CREW</h4>
<div class="row">
<div class="input-field col s6">
<label for="Producer">Producer</label>
<input type="text" id="Producer" name="producer" value='<?php echo set_value('producer',$before->producer);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Director">Director</label>
<input type="text" id="Director" name="director" value='<?php echo set_value('director',$before->director);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Cast">Cast</label>
<input type="text" id="Cast" name="cast" value='<?php echo set_value('cast',$before->cast);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Music">Music</label>
<input type="text" id="Music" name="music" value='<?php echo set_value('music',$before->music);?>'>
</div>
</div>

<div class="row" style="display:none">
<div class="col s12 m6">
<label>Videos</label>
<textarea name="videos" class="materialize-textarea" placeholder="Enter text ..."><?php echo set_value( 'videos',$before->videos);?></textarea>
</div>
</div>

<div class="row">
<div class="col s6">
<button type="submit" class="btn btn-primary waves-effect waves-light  blue darken-4">Save</button>
<a href='<?php echo site_url("site/viewmoviedetail"); ?>' class='btn btn-secondary waves-effect waves-light red'>Cancel</a>
</div>
</div>
</form>
</div>
