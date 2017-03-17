<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Edit get in touch</h4>
</div>
</div>
<div class="row">
    <form class='col s12' method='post' action='<?php echo site_url("site/editgetintouchmoviesubmit");?>' enctype= 'multipart/form-data'>
        <input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
        
        <div class="row">
            <div class="input-field col s6">
            <label for="Name">Name</label>
            <input type="text" id="Name" name="name" value='<?php echo set_value('name',$before->name);?>'>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
            <label for="Last Name">Last Name</label>
            <input type="text" id="Last Name" name="lastname" value='<?php echo set_value('lastname',$before->lastname);?>'>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
            <label for="Email">Email</label>
            <input type="email" id="Email" name="email" value='<?php echo set_value('email',$before->email);?>'>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" value='<?php echo set_value('title',$before->title);?>'>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m6">
            <label>Message</label>
            <textarea name="message" placeholder="Enter text ..."><?php echo set_value( 'message',$before->message);?></textarea>
            </div>
            
<!--
            <div class="input-field col s12">
            <textarea name="Message" class="materialize-textarea" length="400"><?php echo set_value('message');?></textarea>
            <label>Message</label>
-->
        </div>
        </div>
        <div class="row">
            <div class="col s6">
            <button type="submit" class="btn btn-primary waves-effect waves-light  blue darken-4">Save</button>
            <a href='<?php echo site_url("site/viewgetintouchmovie"); ?>' class='btn btn-secondary waves-effect waves-light red'>Cancel</a>
            </div>
        </div>
    </form>
</div>
