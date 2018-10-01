<!-- Main Content -->
<?php $__env->startSection('content'); ?>
<!--<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">パスワードをリセット</div>
                <div class="panel-body">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>

                    <form class="form-horizontal" role="form" method="POST" action="<?php echo e(url('/password/email')); ?>">
                        <?php echo e(csrf_field()); ?>


                        <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" required>

                                <?php if($errors->has('email')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Send Password Reset Link
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>-->
<div class="hero">
    <h2>パスワードをリセット</h2>
</div>
<div class="form-register" ng-controller="ConfirmCtrl">
            <h2> パスワードをリセット </h2>
            <?php if(session('status')): ?>
                <div class="alert alert-success">
                    <?php echo e(session('status')); ?>

                </div>
            <?php endif; ?>
            <form role="form" method="POST" action="<?php echo e(url('/password/email')); ?>">
              <?php echo e(csrf_field()); ?>

                <!-- Password input -->
            <div class="full">
                <label> メールアドレス </label>
                <input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" required>
                        <?php if($errors->has('email')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('email')); ?></strong>
                            </span>
                        <?php endif; ?>
                </div>
                <!-- Password check -->
            <div class="full">
                <button type="submit" class="submit">リセット</button>
            </div>
            </form>
        </div>
      </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.registering', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>