<?php
/* @var $this RequestCommentsController */
/* @var $data RequestComments */
/* @var $user Users*/

?>
<ul class="recent-posts">
    <li>
        <div class="user-thumb">
            <?php if(empty($data->user->image))
                    $avatarPath = Yii::app()->request->baseUrl . '/img/demo/av3.jpg';
                  else
                      $avatarPath = Yii::app()->baseUrl.'/uploads/'.$data->user->image->path;
            echo CHtml::image($avatarPath, 'User', array('width' =>'40', 'height' => '40'))?>
        </div>
        <div class="article-post">

            <div class="view" id="view_<?php echo $data->id ?>">
        <span class="user-info">
            <?php  echo 'By: ' . CHtml::link(
                $data->user->login,
                array('users/view', 'id' => $data->user_id)
            ) . ' on ' . CHtml::encode($data->date);?><br>
        </span>

                <p>
                    <?php echo CHtml::encode($data->comment); ?>
                </p>

                <div class="editcomment_<?php echo $data->id ?>">

                </div>

                <?php echo CHtml::link(
                    'Редактировать',
                    '',
                    array('class' => 'btn_update_comments btn btn-primary btn-mini', 'id' => "eit_{$data->id}")
                )?>
                <?php echo CHtml::link(
                    'Удалить',
                    '',
                    array('class' => 'btn_delete_comments btn btn-danger btn-mini', 'id' => "dit_{$data->id}")
                )?>
                <?php echo CHtml::link(
                    'Отмена',
                    '',
                    array('class' => 'btn_cancel btn btn-warning btn-mini', 'id' => "cit_{$data->id}",'style'=>'display:none')
                )?>
            </div>
        </div>
    </li>
</ul>