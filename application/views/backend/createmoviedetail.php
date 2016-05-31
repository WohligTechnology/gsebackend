<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Create Movie detail</h4>
</div>
<form class='col s12' method='post' action='<?php echo site_url("site/createmoviedetailsubmit");?>' enctype= 'multipart/form-data'>
<div class=" row">
<div class=" input-field col s6">
<?php echo form_dropdown("isupcoming",$isupcoming,set_value('isupcoming'));?>
<label>Is upcoming</label>
</div>
</div>
<div class=" row">
<div class=" input-field col s6">
<?php echo form_dropdown("isreleased",$isreleased,set_value('isreleased'));?>
<label>Is released</label>
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
			</div>
			 <span style=" display: block;
    padding-top: 30px;">260 X 370</span>
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
			</div>
			 <span style=" display: block;
    padding-top: 30px;">1800 X 440</span>
		</div>

<h4 class="title-sub">ABOUT THE MOVIE</h4>
<div class="row">
<div class="input-field col s6">
<textarea name="synopsis" class="materialize-textarea"><?php echo set_value( 'synopsis');?></textarea>
<label>Synopsis</label>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Release Date">Release Date</label>
<input type="date" id="Release Date" class="datepicker" name="releasedate" value='<?php echo set_value('releasedate');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Imdb">Check this movie out on IMDb</label>
<input type="text" id="Imdb" name="imdb" value='<?php echo set_value('imdb');?>'>
</div>
</div>
<h4 class="title-sub">CAST & CREW</h4>
<div class="row">
<div class="input-field col s6">
<label for="Producer">Producer</label>
<input type="text" id="Producer" name="producer" value='<?php echo set_value('producer');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Director">Director</label>
<input type="text" id="Director" name="director" value='<?php echo set_value('director');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Cast">Cast</label>
<input type="text" id="Cast" name="cast" value='<?php echo set_value('cast');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Music">Music</label>
<input type="text" id="Music" name="music" value='<?php echo set_value('music');?>'>
</div>
</div>
<div class="row" style="display:none">
<div class="input-field col s6">
<textarea name="videos" class="materialize-textarea"><?php echo set_value( 'videos');?></textarea>
<label>Videos</label>
</div>
</div>

<div class="row">
<div class="col s12 m6">
<button type="submit" class="btn btn-primary waves-effect waves-light blue darken-4">Save</button>
<a href="<?php echo site_url("site/viewmoviedetail"); ?>" class="btn btn-secondary waves-effect waves-light red">Cancel</a>
</div>
</div>
</form>
</div>
