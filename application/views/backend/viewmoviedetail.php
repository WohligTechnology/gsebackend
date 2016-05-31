<div class="row">
<div class="col s12">
<div class="row">
<div class="col s12 drawchintantable">
<?php $this->chintantable->createsearch("Movie Detail");?>
<table class="highlight responsive-table">
<thead>
<tr>
<th data-field="id">ID</th>
<!--
<th data-field="isupcoming">Is upcoming</th>
<th data-field="isreleased">Is released</th>
-->
<th data-field="name">Name</th>
<th data-field="banner">Banner</th>
<th data-field="imdb">Imdb</th>
<!--
<th data-field="producer">Producer</th>
<th data-field="director">Director</th>
<th data-field="cast">Cast</th>
<th data-field="music">Music</th>
<th data-field="synopsis">Synopsis</th>
<th data-field="videos">Videos</th>
-->
<th data-field="releasedate">Release Date</th>
</tr>
</thead>
<tbody>
</tbody>
</table>
</div>
</div>
<?php $this->chintantable->createpagination();?>
<div class="createbuttonplacement"><a class="btn-floating btn-large waves-effect waves-light blue darken-4 tooltipped" href="<?php echo site_url("site/createmoviedetail"); ?>"data-position="top" data-delay="50" data-tooltip="Create"><i class="material-icons">add</i></a></div>
</div>
</div>
<script>
function drawtable(resultrow) {
    var banner = "<a class='img-center' href='<?php echo base_url('uploads').'/'; ?>" + resultrow.banner + "' ><img src='<?php echo base_url('uploads').'/'; ?>" + resultrow.banner + "'></a>";
        if (resultrow.banner == "") {
            banner = "No Receipt Available";
        }
return "<tr><td>" + resultrow.id + "</td><td>" + resultrow.name + "</td><td>" + banner + "</td><td>" + resultrow.imdb + "</td><td>" + resultrow.releasedate + "</td><td><a class='btn btn-primary btn-xs waves-effect waves-light blue darken-4 z-depth-0 less-pad' href='<?php echo site_url('site/editmoviedetail?id=');?>"+resultrow.id+"' data-position='top' data-delay='50' data-tooltip='Edit'><i class='fa fa-pencil propericon'></i></a><a class='btn btn-danger btn-xs waves-effect waves-light red pad10 z-depth-0 less-pad' onclick=\"return confirm('Are you sure you want to delete?');\") href='<?php echo site_url('site/deletemoviedetail?id='); ?>"+resultrow.id+"' data-position='top' data-delay='50' data-tooltip='Delete'><i class='material-icons propericon'>delete</i></a></td></tr>";
}
generatejquery("<?php echo $base_url;?>");
</script>
