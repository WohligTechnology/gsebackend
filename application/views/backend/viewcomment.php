<div class="row">
<div class="col s12">
<div class="row">
<div class="col s12 drawchintantable">
<?php $this->chintantable->createsearch("Comments");?>
<table class="highlight responsive-table">
<thead>
<tr>
<th data-field="id">ID</th>

<th data-field="diaryname">Article Name</th>
<th data-field="name">Name</th>
<th data-field="image">Image</th>
<!-- <th data-field="order">Order</th> -->
<!-- <th data-field="status">Status</th> -->
</tr>
</thead>
<tbody>
</tbody>
</table>
</div>
</div>
<?php $this->chintantable->createpagination();?>
<!-- <div class="createbuttonplacement"><a class="btn-floating btn-large waves-effect waves-light blue darken-4 tooltipped" href="<?php echo site_url("site/createcomment"); ?>"data-position="top" data-delay="50" data-tooltip="Create"><i class="material-icons">add</i></a></div> -->
</div>
</div>
<script>
function drawtable(resultrow) {
      var image = "<a class='img-center' href='<?php echo base_url('uploads').'/'; ?>" + resultrow.image + "' ><img src='" + resultrow.image + "'></a>";
        if (resultrow.image == "") {
            image = "No Receipt Available";
        }
     if(resultrow.status==1){
        resultrow.status="Enable";
    }
    else if(resultrow.status==2){
         resultrow.status="Disable";
    }
return "<tr><td>" + resultrow.id + "</td><td>" + resultrow.diaryname + "</td><td>" + resultrow.name + "</td><td>" + image + "</td><td><a class='btn btn-primary btn-xs waves-effect waves-light blue darken-4 z-depth-0 less-pad' href='<?php echo site_url('site/editcomment?id=');?>"+resultrow.id+"' data-position='top' data-delay='50' data-tooltip='Edit'><i class='fa fa-pencil propericon'></i></a><a class='btn btn-danger btn-xs waves-effect waves-light red pad10 z-depth-0 less-pad' onclick=\"return confirm('Are you sure you want to delete?');\") href='<?php echo site_url('site/deletecomment?id='); ?>"+resultrow.id+"' data-position='top' data-delay='50' data-tooltip='Delete'><i class='material-icons propericon'>delete</i></a></td></tr>";
}
generatejquery("<?php echo $base_url;?>");
</script>