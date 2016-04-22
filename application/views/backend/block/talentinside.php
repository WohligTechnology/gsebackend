<section class="panel">
    <div class="panel-body">
        <ul id="nav-mobile">
            <li><a class="waves-effect waves-light <?php if ($this->uri->segment(2) == 'editGallery') {
    echo 'active';
} ?>" href="<?php echo site_url('site/edittalenttype?id=').$before1; ?>">Go To Talent Type</a></li>
   
    
      <li><a class="waves-effect waves-light <?php if ($this->uri->segment(2) == 'editGallery') {
    echo 'active';
} ?>" href="<?php echo site_url('site/viewtalenttypegallery?id=').$before1; ?>">Gallery</a></li>
   
    
      <li><a class="waves-effect waves-light <?php if ($this->uri->segment(2) == 'editGallery') {
    echo 'active';
} ?>" href="<?php echo site_url('site/viewtalenttypevideo?id=').$before1; ?>">Videos</a></li>
       
         
 
        </ul>
    </div>
</section>
