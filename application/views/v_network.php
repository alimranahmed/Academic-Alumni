
<div class="col-md-8">
    <!----Friend Request----->
    <div class="row">
        <div class="panel panel-info">
          <div class="panel-heading">Request(<?php echo count($requests)?>)</div>
          <div class="panel-body">
            <?php foreach($requests as $sender):?>
                <div class="col-md-3">
                    <img class="img-circle poster-image" src="<?php echo base_url($sender->photo)?>"><br>
                    <a href="<?php echo site_url("profile/show/".$sender->id)?>"><?php echo $sender->firstName.' '.$sender->lastName;?></a><br>
                    <a href="<?php echo site_url('network/setRequest/?sender='.$sender->id."&status=accepted")?>" class="btn btn-success">Accept</a>
                    <a href="<?php echo site_url('network/setRequest/?sender='.$sender->id."&status=rejected")?>" class="btn btn-danger">Reject</a>
                </div>
            <?php endforeach?>
          </div>
        </div>
    </div><!----End of friend request--->
    <!---Friend list----->
    <div class="row">
        <div class="panel panel-info">
            <div class="panel-heading">My Network(<?php echo count($friends)?>)</div>
            <div class="panel-body">
                <?php foreach($friends as $friend):?>
                <div class="col-md-3">
                    <img class="img-circle poster-image" src="<?php echo base_url($friend->photo)?>"><br>
                    <a href="<?php echo site_url('profile/show/'.$friend->id);?>"><?php echo $friend->firstName.' '.$friend->lastName?></a>
                </div>
                <?php endforeach ?>
            </div>
        </div>
    </div><!----End of friend list--->
<div col-md-2>
</div><!---Empty right side--->
</div>
</div>
