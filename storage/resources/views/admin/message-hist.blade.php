@extends('layouts.admin-layout')

@section('content')
<!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <a href="#menu-toggle" class="btn btn-success" id="menu-toggle">Menu</a>
                <div class="row">
                <div class="col-lg-12">
                <form id="custom-search-form" class="form-search form-horizontal">
                <div class="input-append span12">
                    <input type="text" class="search-query" placeholder="Search by email">
                    <button type="submit" class="btn"><i class="glyphicon glyphicon-search"></i></button>
                </div>
                </form>
                </div>

                    <div class="col-lg-12">
                        <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <tr>
                                <th>ID</th>
                                <th>Email</th>
                                <th>会社名</th>
                                <th>担当者名</th>
                                <th>最新メッセージ</th>
                                <th></th>
                            </tr>
                            <tr>
                              <?php $count=0;
                               while ($count <= count($client_data)){?>
                                <td>user345</td>
                                <td>myemail@mail.com</td>
                                <td>株式会社1</td>
                                <td>山田太郎</td>
                                <td>2017.09.02</td>
                                <td><a href="admin-message-details" class="btn btn-default btn-block btn-sm">履歴見る</a></td>
                                <?php $count++;}?>
                            </tr>
                            <tr>
                                <td>user365</td>
                                <td>email@mail.com</td>
                                <td>株式会社2</td>
                                <td>山田太郎</td>
                                <td>2017.09.02</td>
                                <td><a href="admin-message-details" class="btn btn-default btn-block btn-sm">履歴見る</a></td>
                            </tr>
                            <tr>
                                <td>user853</td>
                                <td>myemail@mail.com</td>
                                <td>株式会社3</td>
                                <td>山田太郎</td>
                                <td>2017.09.02</td>
                                <td><a href="admin-message-details" class="btn btn-default btn-block btn-sm">履歴見る</a></td>
                            </tr>
                        </table>
                        </div>

                    </div>
                    <div class="col-lg-12">
                        <ul class="pagination pagination-sm">
                        <li><a href="#" class="disabled"><i class="glyphicon glyphicon-chevron-left"></i></a></li>
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#"><i class="glyphicon glyphicon-chevron-right"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
@endsection
