<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Edit Diary Article</h4>
</div>
</div>
<div class="row">
<form class='col s12' method='post' action='<?php echo site_url("site/editdiaryarticlesubmit");?>' enctype= 'multipart/form-data'>
<input type="hidden" id="normal-field" class="form-control id" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
<div class=" row">
<div class=" input-field col s12 m6">
<?php echo form_dropdown("status",$status,set_value('status',$before->status));?>
<label for="Status">Status</label>
</div>
</div>
<div class=" row">
<div class=" input-field col s12 m6">
<?php echo form_dropdown("diarycategory",$diarycategory,set_value('diarycategory',$before->diarycategory));?>
<label for="Diary Category">Diary Category</label>
</div>
</div>
<div class=" row">
<div class=" input-field col s12 m6">
<?php echo form_dropdown("author",$author,set_value('author',$before->author));?>
<label for="Diary Category">Author</label>
</div>
</div>
<div class=" row">
<div class=" input-field col s12 m6">
<?php echo form_dropdown("diarysubcategory",$diarysubcategory,set_value('diarysubcategory',$before->diarysubcategory));?>
<label for="Diary Sub Category">Diary Sub Category</label>
</div>
</div>
<div class=" row">
<div class=" input-field col s6">
<?php echo form_dropdown("type",$type,set_value('type',$before->type),'id=dropdown_selector');?>
<label>Blog Type</label>
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
			</div><span style=" display: block;
    padding-top: 30px;">800 x 694</span>
		</div>
<!-- <div class="row">
<div class="input-field col s6">
<label for="Timestamp">Timestamp</label>
<input type="text" id="Timestamp" name="timestamp" value='<?php echo set_value('timestamp',$before->timestamp);?>'>
</div>
</div> -->
<div class="row">
<div class="col s12 m6">
<label>Content</label>
<textarea name="content" id="some-textarea" placeholder="Enter text ..."><?php echo set_value( 'content',$before->content);?></textarea>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Date">Date</label>
<input type="date" id="Date" name="date" class="datepicker" value='<?php echo set_value('date',$before->date);?>'>
</div>
</div>
<div class="row">
<div class="col s6">
<button type="submit" class="btn btn-primary waves-effect waves-light  blue darken-4">Save</button>
<a href='<?php echo site_url("site/viewdiaryarticle"); ?>' class='btn btn-secondary waves-effect waves-light red'>Cancel</a>
</div>
</div>
</form>
</div>
<script>
    $(document).ready( function ()
{
         var type=$('#dropdown_selector').val();
          $.ajax({ url: '<?php echo site_url("site/updatetypeinarticle");?>',
         data: {id: $('.id').val(),type : type },
         type: 'post',
         success: function(output) {}
                  	});

//        if chanegs made
	$('#dropdown_selector').change(function()
	{
        var type=$('#dropdown_selector').val();
          $.ajax({ url: '<?php echo site_url("site/updatetypeinarticle");?>',
         data: {id: $('.id').val(),type : type },
         type: 'post',
         success: function(output) {

                  }
	});
     location.reload();

});

});
</script>
