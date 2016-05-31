<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Create Video</h4>
</div>
<form class='col s12' method='post' action='<?php echo site_url("site/createeventtypesubmit");?>' enctype= 'multipart/form-data'>
<div class=" row" style="display:none">
<div class=" input-field col s6">
<?php echo form_dropdown("event",$event,set_value('event',$this->input->get('id')));?>
<label>Event</label>
</div>
</div>
<div class=" row">
<div class=" input-field col s6">
<?php echo form_dropdown("eventsubtype",$eventsubtype,set_value('eventsubtype'));?>
<label>Event sub type</label>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Name">Url</label>
<input type="text" id="Name" name="url" value='<?php echo set_value('url');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Name">Order</label>
<input type="text" id="Name" name="order" value='<?php echo set_value('order');?>'>
</div>
</div>

<div class="row">
<div class="col s12 m6">
<button type="submit" class="btn btn-primary waves-effect waves-light blue darken-4">Save</button>
<a href="<?php echo site_url("site/vieweventtype?id=").$this->input->get('id'); ?>" class="btn btn-secondary waves-effect waves-light red">Cancel</a>
</div>
</div>
</form>
</div>
