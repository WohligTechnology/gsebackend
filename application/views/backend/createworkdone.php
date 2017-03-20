<div class="row">
<div class="col s12">
    <h4 class="pad-left-15 capitalize">Create Work Done</h4>
</div>
<form class='col s12' method='post' action='<?php echo site_url("site/createworkdonesubmit");?>' enctype= 'multipart/form-data'>
    
    <div class="row">
        <div class="input-field col s6">
            <label for="Phone">title</label>
            <input type="text" id="title" name="title" value='<?php echo set_value('title');?>'>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s6">
            <label for="date">Date</label><br>
            <input type="date" id="date" name="date" value='<?php echo set_value('date');?>'>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s6">
            <label for="City">city</label>
            <input type="text" id="city" name="city" value='<?php echo set_value('city');?>'>
        </div>
    </div>
    <div class=" row">
        <div class=" input-field col s6">
            <?php echo form_dropdown("talenttype",$talenttype,set_value('talenttype'));?>
            <label>Talent Type</label>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s12">
            <textarea name="description" class="materialize-textarea" length="400"><?php echo set_value('description');?></textarea>
            <label>Description</label>
        </div>
    </div>
    <div class="row">
        <div class="file-field input-field col m6 s12">
            <div class="btn blue darken-4">
                <span>Image</span>
                <input name="image" type="file" multiple>
            </div>
            <div class="file-path-wrapper">
                <input class="file-path validate" type="text" placeholder="Upload image" value="<?php echo set_value('image');?>">
            </div>
		</div>
		<span style=" display: block;
		padding-top: 30px;">150 x 150</span>
    </div>
    
    <div class="row">
        <div class="input-field col s6">
            <label for="url">URL</label>
            <input type="text" id="url" name="url" value='<?php echo set_value('url');?>'>
        </div>
    </div>
    
    <div class="row">
        <div class="col s12 m6">
            <button type="submit" class="btn btn-primary waves-effect waves-light blue darken-4">Save</button>
            <a href="<?php echo site_url("site/viewworkdone"); ?>" class="btn btn-secondary waves-effect waves-light red">Cancel</a>
        </div>
    </div>
</form>
</div>
