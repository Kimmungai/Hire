<?php $__env->startSection('content'); ?>
<!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <a href="#menu-toggle" class="btn btn-success" id="menu-toggle">Menu</a>
                <div class="row">
                <div class="col-lg-12">
                <form id="custom-search-form" class="form-search form-horizontal">
                <!--<div class="input-append span12">
                    <input type="text" class="search-query" placeholder="Search">
                    <button type="submit" class="btn"><i class="glyphicon glyphicon-search"></i></button>
                </div>-->
                </form>
                </div>

                    <div class="col-lg-12">
                        <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <tr>
                                <th>日付</th>
                                <th>依頼者</th>
                                <th>依頼名</th>
                                <th>依頼番号</th>
                                <th>ご開始日時</th>
                                <th>お迎えの場所</th>
                                <th>終了予定日時</th>
                                <th>お送り先の場所</th>
                                <th>状態</th>
                                <th></th>
                            </tr>
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $datum): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($datum['created_at']->format('d/m/Y')); ?></td>
                                <td>user<?php echo e($datum['user_id']); ?></td>
                                <td><?php echo e($datum['order_name']); ?></td>
                                <td>BND<?php echo e($datum['id']); ?></td>
                                <td><?php echo e($datum['pick_up_date']); ?> --- <?php echo e($datum['pick_up_time']); ?></td>
                                <td><?php echo e($datum['pick_up_address']); ?></td>
                                <td><?php echo e($datum['drop_off_date']); ?> --- <?php echo e($datum['drop_off_time']); ?></td>
                                <td><?php echo e($datum['drop_off_address']); ?></td>
                                <?php if($datum['bid_status']): ?>
                                <td>確定</td>
                                <?php else: ?>
                                <td>未確定</td>
                                <?php endif; ?>
                                <td><a href="/admin-order-details/<?php echo e($datum['id']); ?>" class="btn btn-default btn-block btn-sm">内容確認</a></td>
                            </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </table>
                        </div>

                    </div>
                    <div class="col-lg-12">
                        <ul class="pagination pagination-sm">
                          <li><?php echo e($data->links()); ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin-layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>