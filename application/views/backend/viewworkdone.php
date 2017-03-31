<div class="row">
<div class="col s12">
<div class="row">
    <div class="col s12 drawchintantable">
    <?php $this->chintantable->createsearch("Work Done");?>
        <table class="highlight responsive-table">
        <thead>
            <tr>
                <th data-field="id">ID</th>
                <th data-field="title">title</th>
                <th data-field="date">date</th>
                <th data-field="city">city</th>
                <th data-field="description">description</th>
                <th data-field="image">image</th>
                <th data-field="url">url</th>
                <th data-field="talenttype">talenttype</th>
                <!--
                <th data-field="timestamp">Timestamp</th>
                <th data-field="comment">Comment</th>
                <th data-field="enquiryfor">Enquiry For</th>
                -->
            </tr>
        </thead>
        <tbody>
        </tbody>
        </table>
    </div>
</div>
<?php $this->chintantable->createpagination();?>
<div class="createbuttonplacement"><a class="btn-floating btn-large waves-effect waves-light blue darken-4 tooltipped" href="<?php echo site_url("site/createworkdone"); ?>"data-position="top" data-delay="50" data-tooltip="Create"><i class="material-icons">add</i></a></div>
</div>
</div>
<script>
function drawtable(resultrow) {
    var image = "<a class='img-center' href='<?php echo base_url('uploads').'/'; ?>" + resultrow.image + "' ><img src='<?php echo base_url('uploads').'/'; ?>" + resultrow.image + "'></a>";
        if (resultrow.image == "") {
            image = "No Image Available";
        }
return "<tr><td>" + resultrow.id + "</td><td>" + resultrow.title + "</td><td>" + resultrow.date + "</td><td>" + resultrow.city + "</td><td>" + resultrow.description + "</td><td>" + image + "</td><td>" + resultrow.url + "</td><td>" + resultrow.talenttype + "</td><td><a class='btn btn-primary btn-xs waves-effect waves-light blue darken-4 z-depth-0 less-pad' href='<?php echo site_url('site/editworkdone?id=');?>"+resultrow.id+"' data-position='top' data-delay='50' data-tooltip='Edit'><i class='fa fa-pencil propericon'></i></a><a class='btn btn-danger btn-xs waves-effect waves-light red pad10 z-depth-0 less-pad' onclick=\"return confirm('Are you sure you want to delete?');\") href='<?php echo site_url('site/deleteworkdone?id='); ?>"+resultrow.id+"' data-position='top' data-delay='50' data-tooltip='Delete'><i class='material-icons propericon'>delete</i></a></td></tr>";
}
generatejquery("<?php echo $base_url;?>");
</script>
