<section class="panel">
    <div class="panel-body">
        <ul id="nav-mobile">
            <li><a class="waves-effect waves-light <?php if ($this->uri->segment(2) == 'editGallery') {
    echo 'active';
} ?>" href="<?php echo site_url('site/editaward?id=').$before1; ?>">Go to award</a></li>
            <li><a class="waves-effect waves-light <?php if ($this->uri->segment(2) == 'viewGalleryImage' || $this->uri->segment(2) == 'editGalleryImage'  || $this->uri->segment(2) == 'createGalleryImage') {
    echo 'active';
} ?>" href="<?php echo site_url('site/viewawarddetail?id=').$before2; ?>">Award Detail</a></li> 
         
 
        </ul>
    </div>
</section>
