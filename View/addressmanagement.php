<div class="container">
    <div class="row profile">
        <div class="col-md-3">
            <div class="profile-sidebar">
                <!-- SIDEBAR USER TITLE -->
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name">
                        {$user->name}
                    </div>
                    <div class="profile-usertitle-job">
                        {$user->email}
                    </div>
                </div>
                <!-- END SIDEBAR USER TITLE -->
                <!-- SIDEBAR MENU -->
                <div class="profile-usermenu">
                    <ul class="nav">
                        <li>
                            <a href="/account">
                                <i class="glyphicon glyphicon-user"></i>
                                Overview </a>
                        </li>
                        <li class="active">
                            <a href="/account/tab=addresses">
                                <i class="glyphicon glyphicon-tags"></i>
                                Address Management </a>
                        </li>
                        <li>
                            <a href="/account/tab=orders">
                                <i class="glyphicon glyphicon-shopping-cart"></i>
                                Orders </a>
                        </li>
                        <li>
                            <a href="/account/tab=wishlist">
                                <i class="glyphicon glyphicon-gift"></i>
                                Wishlist </a>
                        </li>
                    </ul>
                </div>
                <!-- END MENU -->
            </div>
        </div>
        <div class="col-md-9">
            <div class="profile-content">
                <div class="panel">
                    <div class="panel-heading flat-lightblue">
                        <h3 class="panel-title">Address Information</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                {foreach from=$user->getAddresses($user->email) item=add}
                                <div class="panel-group">
                                    <div class="panel">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse"
                                                   href="#collapse{$add['Id']}">{$add['Zipcode']}, {$add['Address']},
                                                    {$add['City']}, {$add['Province']}, {$add['Country']}</a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                {/foreach}
                                <div class="panel-group">
                                    <div class="panel panel-success">
                                        <div class="panel-heading">
                                            <h4 class="panel-title address">
                                                <a data-toggle="collapse"
                                                   href="#collapseNew" style="color: white;"><i class="glyphicon glyphicon-plus"></i> Add new address</a>
                                            </h4>
                                        </div>
                                        <div id="collapseNew" class="panel-collapse collapse">
                                            <ul class="list-group">
                                                <form action="/account" name="form" id="form" class="form-horizontal"
                                                      enctype="multipart/form-data"
                                                      method="POST">
                                                    <li class="list-group-item address"><input id="zipcode" type="text" class="form-control" name="zipcode" placeholder="Zipcode"></li>
                                                    <li class="list-group-item address"><input id="address" type="text" class="form-control" name="address" placeholder="Address"></li>
                                                    <li class="list-group-item address"><input id="city" type="text" class="form-control" name="city" placeholder="City"></li>
                                                    <li class="list-group-item address"><input id="state" type="text" class="form-control" name="state" placeholder="State"></li>
                                                    <li class="list-group-item address"><input id="country" type="text" class="form-control" name="country" placeholder="Country"></li>
                                                    <li class="list-group-item address"><button class="btn btn-success" type="submit">Submit</button></li>
                                                </form>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>