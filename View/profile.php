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
                        <li class="active">
                            <a href="/account">
                                <i class="glyphicon glyphicon-user"></i>
                                Overview </a>
                        </li>
                        <li>
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
                        <h3 class="panel-title">Profile Information</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class=" col-md-9 col-lg-9 ">
                                <table class="table table-user-information">
                                    <tbody>
                                    <tr>
                                        <td>Name:</td>
                                        <td>{$user->name}</td>
                                    </tr>
                                    <tr>
                                        <td>E-Mail Address</td>
                                        <td>{$user->email}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>