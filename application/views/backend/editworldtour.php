<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Edit worldtour</h4>
</div>
</div>
<div class="row">
<form class='col s12' method='post' action='<?php echo site_url("site/editworldtoursubmit");?>' enctype= 'multipart/form-data'>
<input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
<div class="row">
<div class="input-field col s6">
<label for="ispastconcert">ispastconcert</label>
<input type="text" id="ispastconcert" name="ispastconcert" value='<?php echo set_value('ispastconcert',$before->ispastconcert);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="isupcomingconcert">isupcomingconcert</label>
<input type="text" id="isupcomingconcert" name="isupcomingconcert" value='<?php echo set_value('isupcomingconcert',$before->isupcomingconcert);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="image">image</label>
<input type="text" id="image" name="image" value='<?php echo set_value('image',$before->image);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="name">name</label>
<input type="text" id="name" name="name" value='<?php echo set_value('name',$before->name);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="location">location</label>
<input type="text" id="location" name="location" value='<?php echo set_value('location',$before->location);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="date">date</label>
<input type="date" id="date" name="date" value='<?php echo set_value('date',$before->date);?>'>
</div>
</div>
<div class="row">
<div class="col s12 m6">
<label>venue</label>
<textarea name="venue" placeholder="Enter text ..."><?php echo set_value( 'venue',$before->venue);?></textarea>
</div>
</div>
<div class="row">
<div class="col s12 m6">
<label>content</label>
<textarea name="content" placeholder="Enter text ..."><?php echo set_value( 'content',$before->content);?></textarea>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="banner">banner</label>
<input type="text" id="banner" name="banner" value='<?php echo set_value('banner',$before->banner);?>'>
</div>
</div>
<div class="row">
<div class="col s6">
<button type="submit" class="btn btn-primary waves-effect waves-light  blue darken-4">Save</button>
<a href='<?php echo site_url("site/viewworldtour"); ?>' class='btn btn-secondary waves-effect waves-light red'>Cancel</a>
</div>
</div>
</form>
</div>
