<?php $__env->startSection('content'); ?>
<div class="hero">
    <h2>一括見積もりシステム</h2>
</div>
<ol class="breadcrumb">
    <li class="current"><a href="/">トップ</a></li>
</ol>

<div class="row">
  <div class="col-lg-3 col-sm-6 text-center mb-4">
    <img class="img-circle img-fluid d-block mx-auto" src="http://placehold.it/200x200" alt="">&nbsp;&nbsp;
    <span style="font-size:1.5em;line-height:200px;" class="fa fa-arrow-right hidden-xs pull-right"></span>
    <h3><i class="fa fa-edit"></i> 登録
      <small><i class="fa fa-check-circle text-success"></i></small>
    </h3>
    <p>What does this team member to? Keep it short! This is also a great spot for social links!</p>
  </div>
  <div class="col-lg-3 col-sm-6 text-center mb-4">
    <img class="img-circle img-fluid d-block mx-auto" src="http://placehold.it/200x200" alt="">&nbsp;&nbsp;
    <span style="font-size:1.5em;line-height:200px;" class="fa fa-arrow-right hidden-xs pull-right"></span>
    <h3><i class="fa fa-user"></i> 承認
      <small></small>
    </h3>
    <p>What does this team member to? Keep it short! This is also a great spot for social links!</p>
  </div>
  <div class="col-lg-3 col-sm-6 text-center mb-4">
    <img class="img-circle img-fluid d-block mx-auto" src="http://placehold.it/200x200" alt="">&nbsp;&nbsp;
    <span style="font-size:1.5em;line-height:200px;" class="fa fa-arrow-right hidden-xs pull-right"></span>
    <h3><i class="fa fa-bell"></i> 入札
      <small></small>
    </h3>
    <p>What does this team member to? Keep it short! This is also a great spot for social links!</p>
  </div>
  <div class="col-lg-3 col-sm-6 text-center mb-4">
    <img class="img-circle img-fluid d-block mx-auto" src="http://placehold.it/200x200" alt="">
    <h3><i class="fa fa-briefcase"></i> 同意して配信する
      <small></small>
    </h3>
    <p>What does this team member to? Keep it short! This is also a great spot for social links!</p>
  </div>
</div>

<ul class="top-main">
    <li><a class="add" href="/company_order_view_all"><i class="fa fa-list" aria-hidden="true"></i>依頼一覧</a></li>
    <!--<li><a href="#"><i class="fa fa-question-circle" aria-hidden="true"></i>よくある質問</a></li>
    <li><a href="#"><i class="fa fa-info-circle" aria-hidden="true"></i>サービス流れ</a></li>-->
</ul>
<!-- last 3 orders this company bid on -->
<?php if(count($pending_orders)): ?>
<h3>保留中の注文</h3>
<?php $count=0;?>
<div class="all-orders">
<?php $__currentLoopData = $pending_orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client_datum): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <?php if($count==3){break;}?>
    <div class="bid-card">
        <div class="part">
            <small>日付:</small>
            <p><?php echo e($client_datum['created_at']->format('Y/m/d')); ?></p>
        </div>
        <div class="part">
            <small>依頼名:</small>
            <p><?php echo e($client_datum['order_name']); ?></p>
        </div>

        <div class="part">
            <small>状態:</small>
            <?php if($client_datum['bid_status']): ?>
              <p>確認済み</p>
            <?php else: ?>
              <p>保留</p>
            <?php endif; ?>
        </div>
    </div>
    <?php $count++;?>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<hr>
<?php endif; ?>
<h3>最新提供履歴</h3>
<div class="all-orders">
  <?php $count=0;?>
<?php $__currentLoopData = $client_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client_datum): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="bid-card">
        <div class="part">
            <small>日付:</small>
            <p><?php echo e($client_datum['created_at']->format('Y/m/d')); ?></p>
        </div>
        <div class="part">
            <small>依頼名:</small>
            <p><?php echo e($client_datum['order_name']); ?></p>
        </div>
        <div class="part">
            <small>提供した会社数:</small>
            <p><?php echo $num_companies_bidding[$count]; ?></p>
        </div>
        <div class="part">
            <small>平均金額:</small>
            <p class="price"><?php  $summed_bid_price=0;
            foreach($client_datum['bid'] as $bid_price){ $summed_bid_price += doubleval($bid_price['price']);}
            $number_of_bids=count($client_datum['bid']);if($number_of_bids==0){$number_of_bids=1;}
            $average_bid_price=$summed_bid_price/$number_of_bids;?>
            ¥<?php echo e(number_format($average_bid_price,2)); ?></p>
        </div>
        <div class="part">
            <small>状態:</small>
            <?php if($client_datum['bid_status']): ?>
              <p>確定</p>
            <?php else: ?>
              <p>未確定</p>
            <?php endif; ?>
        </div>
        <div class="part">
            <a href="/company_order_view/<?php echo e($client_datum['id']); ?>" class="details">内容見る</a>
        </div>
    </div>
    <?php $count++;?>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<div class="col-lg-12">
    <ul class="pagination pagination-sm" style="list-style-type:none">
    <?php echo e($client_data->links()); ?>

    </ul>
</div>
</div><!-- container end -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.hire_company', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>