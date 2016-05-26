<section class="panel">
    <div class="panel-body">
        <ul id="nav-mobile">
            <li><a class="waves-effect waves-light <?php if ($this->uri->segment(2) == 'editGallery') {
    echo 'active';
} ?>" href="<?php echo site_url('site/editwedding?id=').$before1; ?>">Go to wedding</a></li>
            <li><a class="waves-effect waves-light <?php if ($this->uri->segment(2) == 'viewGalleryImage' || $this->uri->segment(2) == 'editGalleryImage'  || $this->uri->segment(2) == 'createGalleryImage') {
    echo 'active';
} ?>" href="<?php echo site_url('site/viewweddingtype?id=').$before2; ?>"> Videos</a></li> 
      <li><a class="waves-effect waves-light <?php if ($this->uri->segment(2) == 'viewGalleryImage' || $this->uri->segment(2) == 'editGalleryImage'  || $this->uri->segment(2) == 'createGalleryImage') {
    echo 'active';
} ?>" href="<?php echo site_url('site/viewweddingsubtype?id=').$before3; ?>">Sub-Type</a></li>  
   <li><a class="waves-effect waves-light <?php if ($this->uri->segment(2) == 'viewGalleryImage' || $this->uri->segment(2) == 'editGalleryImage'  || $this->uri->segment(2) == 'createGalleryImage') {
    echo 'active';
} ?>" href="<?php echo site_url('site/viewweddinggallery?id=').$before4; ?>">Gallery</a></li> 
         
 
        </ul>
    </div>
</section>
