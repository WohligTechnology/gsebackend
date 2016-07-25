<div class="row">
<div class="col s12">
<div class="row">
<div class="col s12 drawchintantable">
<?php $this->chintantable->createsearch("Videos");?>
<table class="highlight responsive-table">
<thead>
<tr>
<th data-field="id">ID</th>
<?php
if($this->input->get('id') != 2 && $this->input->get('id') != 3)
{
  ?>
<th data-field="weddingsubtype">Wedding Sub Type</th>
<?php
}
?>
<th data-field="name">Url</th>
<th data-field="status">Status</th>
<th data-field="order">Order</th>
<!--<th data-field="image">Image</th>-->
<!--<th data-field="banner">Banner</th>-->
</tr>
</thead>
<tbody>
</tbody>
</table>
</div>
</div>
<?php $this->chintantable->createpagination();?>
<div class="createbuttonplacement"><a class="btn-floating btn-large waves-effect waves-light blue darken-4 tooltipped" href="<?php echo site_url("site/createweddingtype?id=").$this->input->get('id'); ?>"data-position="top" data-delay="50" data-tooltip="Create"><i class="material-icons">add</i></a></div>
</div>
</div>
<script>
function drawtable(resultrow) {
      var image = "<a class='img-center' href='<?php echo base_url('uploads').'/'; ?>" + resultrow.image + "' ><img src='<?php echo base_url('uploads').'/'; ?>" + resultrow.image + "'></a>";
        if (resultrow.image == "") {
            image = "No Receipt Available";
        }
        if(resultrow.status==1){
          resultrow.status="Enable";
      }
      else if(resultrow.status==2){
           resultrow.status="Disable";
      }
return "<tr><td>" + resultrow.id + "</td> <?php if($this->input->get('id') != 2 && $this->input->get('id') != 3) {?> <td>" + resultrow.weddingsubtype + "</td> <?php } ?><td>" + resultrow.name + "</td><td>" + resultrow.status + "</td><td>" + resultrow.order + "</td><td><a class='btn btn-primary btn-xs waves-effect waves-light blue darken-4 z-depth-0 less-pad' href='<?php echo site_url('site/editweddingtype?id=');?>"+resultrow.id+"&weddingid="+resultrow.wedding+"' data-position='top' data-delay='50' data-tooltip='Edit'><i class='fa fa-pencil propericon'></i></a><a class='btn btn-danger btn-xs waves-effect waves-light red pad10 z-depth-0 less-pad' onclick=\"return confirm('Are you sure you want to delete?');\") href='<?php echo site_url('site/deleteweddingtype?id='); ?>"+resultrow.id+"&weddingid="+resultrow.wedding+"' data-position='top' data-delay='50' data-tooltip='Delete'><i class='material-icons propericon'>delete</i></a></td></tr>";
}
generatejquery("<?php echo $base_url;?>");
</script>
