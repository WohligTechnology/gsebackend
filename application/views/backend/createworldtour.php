<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Create worldtour</h4>
</div>
<form class='col s12' method='post' action='<?php echo site_url("site/createworldtoursubmit");?>' enctype= 'multipart/form-data'>
<div class="row">
<div class="input-field col s6">
<label for="ispastconcert">ispastconcert</label>
<input type="text" id="ispastconcert" name="ispastconcert" value='<?php echo set_value('ispastconcert');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="isupcomingconcert">isupcomingconcert</label>
<input type="text" id="isupcomingconcert" name="isupcomingconcert" value='<?php echo set_value('isupcomingconcert');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="image">image</label>
<input type="text" id="image" name="image" value='<?php echo set_value('image');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="name">name</label>
<input type="text" id="name" name="name" value='<?php echo set_value('name');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="location">location</label>
<input type="text" id="location" name="location" value='<?php echo set_value('location');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="date">date</label>
<input type="date" id="date" name="date" value='<?php echo set_value('date');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s12">
<textarea name="venue" class="materialize-textarea" length="400"><?php echo set_value( 'venue');?></textarea>
<label>venue</label>
</div>
</div>
<div class="row">
<div class="input-field col s12">
<textarea name="content" class="materialize-textarea" length="400"><?php echo set_value( 'content');?></textarea>
<label>content</label>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="banner">banner</label>
<input type="text" id="banner" name="banner" value='<?php echo set_value('banner');?>'>
</div>
</div>
<div class="row">
<div class="col s12 m6">
<button type="submit" class="btn btn-primary waves-effect waves-light blue darken-4">Save</button>
<a href="<?php echo site_url("site/viewworldtour"); ?>" class="btn btn-secondary waves-effect waves-light red">Cancel</a>
</div>
</div>
</form>
</div>
