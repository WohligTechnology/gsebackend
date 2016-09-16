<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Create Upcoming Match</h4>
</div>
<form class='col s12' method='post' action='<?php echo site_url("site/creatematchsubmit");?>' enctype= 'multipart/form-data'>
<div class="row">
<div class="input-field col s6">
<label for="team1">team1</label>
<input type="text" id="team1" name="team1" value='<?php echo set_value('team1');?>'>
</div>
</div>
<div class="row">
			<div class="file-field input-field col m6 s12">
				<div class="btn blue darken-4">
					<span>Image1</span>
					<input name="image" type="file" multiple>
				</div>
				<div class="file-path-wrapper">
					<input class="file-path validate" type="text" placeholder="Upload one or more files" value="<?php echo set_value('image');?>">
				</div>
			</div><span style=" display: block;
    padding-top: 30px;">150 X 150</span>
		</div>

<div class="row">
<div class="input-field col s6">
<label for="team2">team2</label>
<input type="text" id="team2" name="team2" value='<?php echo set_value('team2');?>'>
</div>
</div>
<div class="row">
			<div class="file-field input-field col m6 s12">
				<div class="btn blue darken-4">
					<span>Image2</span>
					<input name="logo2" type="file" multiple>
				</div>
				<div class="file-path-wrapper">
					<input class="file-path validate" type="text" placeholder="Upload one or more files" value="<?php echo set_value('logo2');?>">
				</div>
			</div><span style=" display: block;
    padding-top: 30px;">150 X 150</span>
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
<label for="location">Stadium</label>
<input type="text" id="location" name="location" value='<?php echo set_value('location');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Release Date">Date</label>
<input type="date" id="Release Date" class="datepicker" name="date" value='<?php echo set_value('date');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="time">time</label>
<input type="text" id="time" name="time" value='<?php echo set_value('time');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="link">link</label>
<input type="text" id="link" name="link" value='<?php echo set_value('link');?>'>
</div>
</div>

<div class="row">
<div class="col s12 m6">
<button type="submit" class="btn btn-primary waves-effect waves-light blue darken-4">Save</button>
<a href="<?php echo site_url("site/viewmatch"); ?>" class="btn btn-secondary waves-effect waves-light red">Cancel</a>
</div>
</div>
</form>
</div>
