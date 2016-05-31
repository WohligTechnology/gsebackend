<section class="panel">
    <div class="panel-body">
        <ul id="nav-mobile">
            <li><a class="waves-effect waves-light <?php if ($this->uri->segment(2) == 'editGallery') {
    echo 'active';
} ?>" href="<?php echo site_url('site/editdiaryarticle?id=').$before1; ?>">Diary Article Details</a></li>
            
            
            <?php if($typecheck==1){?>
             <li><a class="waves-effect waves-light <?php if ($this->uri->segment(2) == 'viewGalleryImage' || $this->uri->segment(2) == 'editGalleryImage'  || $this->uri->segment(2) == 'createGalleryImage') {
    echo 'active';
} ?>" href="<?php echo site_url('site/viewblogtext?id=').$before2; ?>">Text</a></li>
           
           <?php }?>
            <?php if($typecheck==2){?>
            <li><a class="waves-effect waves-light <?php if ($this->uri->segment(2) == 'viewGalleryImage' || $this->uri->segment(2) == 'editGalleryImage'  || $this->uri->segment(2) == 'createGalleryImage') {
    echo 'active';
} ?>" href="<?php echo site_url('site/viewblogimage?id=').$before3; ?>">Gallery</a></li> 
     <?php }?>
   
    <?php if($typecheck==3){?>
    <li><a class="waves-effect waves-light <?php if ($this->uri->segment(2) == 'viewGalleryImage' || $this->uri->segment(2) == 'editGalleryImage'  || $this->uri->segment(2) == 'createGalleryImage') {
    echo 'active';
} ?>" href="<?php echo site_url('site/viewblogvideo?id=').$before4; ?>">Videos</a></li> 
            <?php }?>
  
        </ul>
    </div>
</section>
