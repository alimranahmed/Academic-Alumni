
<div class="col-md-8">
    <div class="row">
        <div class="panel panel-info">
          <div class="panel-heading">Found(<?php echo count($searchResults);?>)</div>
          <div class="panel-body">
              <?php foreach($searchResults as $user):?>
                  <div class="col-md-3">
                      <img class="img-circle poster-image" src="<?=base_url($user->photo)?>"><br>
                      <a href="<?php echo site_url('profile/show').'/'.$user->id?>"><?php echo $user->firstName." ".$user->lastName?></a>
                      <?php if($this->session->userdata("user_id")!=$user->id):?>
                        <?php if(!in_array($user->id, $friendsId)):?>
                            <a href="<?php echo site_url("network/sendRequest/".$user->id)?>"><div class="btn btn-success">Add As Friend</div></a>
                        <?php else: ?>
                            <br><div class="btn btn-success"><i class="glyphicon glyphicon-ok"></i> Friend</div>
                        <?php endif ?>
                      <?php endif ?>
                      <?php if(in_array($user->id, $friendsId))?>
                  </div>
              <?php endforeach?>
          </div>
    </div>
</div><!----Profile content--->
<div col-md-2>
</div><!---Empty right side--->
</div>
</div>
