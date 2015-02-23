<div class="col-md-6">
    <div class="row">
        <div class='col-md-10' style="margin-top: 10px;">
            <div class="row">
                <form method="post" action="<?php echo site_url('group/insertPost')?>">
                    <textarea class="form-control" name="post" rows="4" placeholder="What is on you mind?..."></textarea>
                    <input type="submit" class="btn btn-info" value="Post">
                </form>
            </div>
            <hr>
            <?php foreach($groupposts as $post ):?>
                <div class="row" style="margin-top: 10px;">
                    <i class="glyphicon glyphicon-edit" data-toggle="modal" data-target="#editPost<?php echo $post->id?>" style="cursor: pointer"></i>
                    <a href="<?php echo site_url('timeline/deletePost/'.$post->id);?>" onclick="return confirm('Are you sure to delete the post?')"><i class="glyphicon glyphicon-trash text-danger"></i></a>
                    <div class="col-md-2 poster-image">
                        <img class='img-thumbnail' src="<?=base_url($post->photo)?>">
                    </div>
                    <div class="col-md-9">
                        <p>Published at <?php echo date('M-d, Y h:ia', strtotime($post->time))?></p>
                        <p>Posted by <a href="<?php echo site_url('profile/show/'.$post->userId)?>"><?php echo $post->firstName.' '.$post->lastName?></a></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p><?php echo $post->body?></p>
                    </div>
                </div>
                <h3>Comments</h3>
                <?php foreach($post->comments as $comment):?>
                    <div class="row">
                        <div class="col-md-2 commenter-image">
                            <img class='img-thumbnail' src="<?=base_url($comment->photo)?>">
                        </div>
                        <div class='col-md-10'>
                            <?php if($comment->userId == $this->session->userdata("user_id")):?>
                                <a href="<?php echo site_url('timeline/deleteComment/'.$comment->id)?>" onclick="return confirm('Are you sure to delete this comment?')";><i class="glyphicon glyphicon-trash pull-right text-danger"></i></a>
                            <i style="cursor: pointer;" class="glyphicon glyphicon-edit pull-right" data-toggle="modal" data-target="#editComment<?php echo $comment->id?>" ></i>
                        <?php endif?>
                            <div class="row">
                                <p>Commented by <a href="<?php echo site_url('profile/show/'.$comment->userId)?>"><?php echo $comment->firstName.' '.$comment->lastName?></a>
                                    at <?php echo date('M-d, Y h:ia', strtotime($comment->time))?></p>
                            </div>
                            <div class="row">
                                <p><?php echo $comment->body?></p>
                            </div>
                        </div>
                        <!-- Modal to edit Comment-->
                        <div class="modal fade" id="editComment<?php echo $comment->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Edit Comment</h4>
                                    </div>
                                    <form class="form-horizontal" role="form" method="post" action="<?php echo site_url('group/editComment/'.$comment->id);?>">
                                        <div class="modal-body">
                                            <div>
                                                <label>Comment</label>
                                                <textarea name="comment" rows="10" class="form-control"><?php echo $comment->body;?></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div><!---End of edit Comment---->
                    </div>
                <?php endforeach?>
                <div class="row">
                    Your comment:
                    <form class="form-horizontal" role="form" method="post" action="<?php echo site_url("group/insertComment/".$post->id)?>">
                        <textarea class="form-control" rows="3" name="comment"></textarea>
                        <div class="form-group">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-info">Comment</button>
                            </div>
                        </div>
                    </form>
                </div>
                <hr>
                <!-- Modal to edit Post-->
                <div class="modal fade" id="editPost<?php echo $post->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Edit Post</h4>
                            </div>
                            <form class="form-horizontal" role="form" method="post" action="<?php echo site_url('group/editPost/'.$post->id);?>">
                                <div class="modal-body">
                                    <div>
                                        <label>Post</label>
                                        <textarea name="post" rows="10" class="form-control"><?php echo $post->body;?></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div><!---End of edit Post---->
            <?php endforeach ?>
        </div>
    </div>
    <hr>
</div><!---Timeline ----->
<div class="col-md-4">
    <h2>Members(<?php echo count($members);?>)</h2>
    <div class="row">
        <?php foreach($members as $member):?>
            <div class="col-md-4">
                <img class="img-circle poster-image"
                     <?php if($member->photo == ''){ echo 'src='.base_url().'public/images/user.jpg';} else{ echo 'src='.base_url($member->photo); }?> >
                <a href="<?php echo site_url('profile/show/'.$member->id);?>"><?php echo $member->firstName.' '.$member->lastName?></a>
            </div>
        <?php endforeach ?>
    </div>
</div><!---Network--->
</div>
</div>
