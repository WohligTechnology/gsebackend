<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Edit match</h4>
</div>
</div>
<div class="row">
<form class='col s12' method='post' action='<?php echo site_url("site/editmatchsubmit");?>' enctype= 'multipart/form-data'>
<input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
<div class="row">
<div class="input-field col s6">
<label for="team1">team1</label>
<input type="text" id="team1" name="team1" value='<?php echo set_value('team1',$before->team1);?>'>
</div>
</div>
<div class="row">
			<div class="file-field input-field col m6 s12">
				<span class="img-center big">
								                    	<?php if($before->logo1 == "") { } else {
									                    ?><img src="<?php echo base_url('uploads')."/".$before->logo1; ?>">
															<?php } ?>
															</span>
				<div class="btn blue darken-4">
					<span>Image1</span>
					<input name="image" type="file" multiple>
				</div>
				<div class="file-path-wrapper">
					<input class="file-path validate" type="text" placeholder="Upload one or more files" value="<?php echo set_value('image',$before->logo1);?>">
				</div>
			</div><span style=" display: block;
    padding-top: 30px;">150 X 150</span>
		</div>
<div class="row">
<div class="input-field col s6">
<label for="team2">team2</label>
<input type="text" id="team2" name="team2" value='<?php echo set_value('team2',$before->team2);?>'>
</div>
</div>
<div class="row">
			<div class="file-field input-field col m6 s12">
				<span class="img-center big">
								                    	<?php if($before->logo2 == "") { } else {
									                    ?><img src="<?php echo base_url('uploads')."/".$before->logo2; ?>">
															<?php } ?>
															</span>
				<div class="btn blue darken-4">
					<span>Image2</span>
					<input name="logo2" type="file" multiple>
				</div>
				<div class="file-path-wrapper">
					<input class="file-path validate" type="text" placeholder="Upload one or more files" value="<?php echo set_value('logo2',$before->logo2);?>">
				</div>
			</div><span style=" display: block;
    padding-top: 30px;">150 X 150</span>
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
    			</div><span style=" display: block;
        padding-top: 30px;">1800 X 440</span>
    		</div>


			   <div class="row">
    			<div class="file-field input-field col m6 s12">
    				<span class="img-center big">
    								                    	<?php if($before->banner1 == "") { } else {
    									                    ?><img src="<?php echo base_url('uploads')."/".$before->banner1; ?>">
    															<?php } ?>
    															</span>
    				<div class="btn blue darken-4">
    					<span>Banner1</span>
    					<input name="banner1" type="file" multiple>
    				</div>
    				<div class="file-path-wrapper">
    					<input class="file-path validate" type="text" placeholder="Upload one or more files" value="<?php echo set_value('banner1',$before->banner1);?>">
    				</div>
    			</div><span style=" display: block;
        padding-top: 30px;">1800 X 440</span>
    		</div>
<div class="row">
<div class="input-field col s6">
<label for="location">location</label>
<input type="text" id="location" name="location" value='<?php echo set_value('location',$before->location);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="stadium">Stadium</label>
<input type="text" id="stadium" name="stadium" value='<?php echo set_value('stadium',$before->stadium);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Release Date">Date</label>
<input type="date" id="Release Date" class="datepicker" name="date" value='<?php echo set_value('date',$before->date);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="time">time</label>
<input type="text" id="time" name="time" value='<?php echo set_value('time',$before->time);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="link">link</label>
<input type="text" id="link" name="link" value='<?php echo set_value('link',$before->link);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="team1score">team1score</label>
<input type="text" id="team1score" name="team1score" value='<?php echo set_value('team1score',$before->team1score);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="team2score">team2score</label>
<input type="text" id="team2score" name="team2score" value='<?php echo set_value('team2score',$before->team2score);?>'>
</div>
</div>
<div class="row">
<div class="col s6">
<button type="submit" class="btn btn-primary waves-effect waves-light  blue darken-4">Save</button>
<a href='<?php echo site_url("site/viewmatch"); ?>' class='btn btn-secondary waves-effect waves-light red'>Cancel</a>
</div>
</div>
</form>
</div>
