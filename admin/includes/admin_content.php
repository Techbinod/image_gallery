
<div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Admin
                            <small>Subheading</small>
                        </h1>

                        <?php 

                           /*$user = new User();
                           $user->username = "Example_username";
                           $user->password = "Example_password";
                           $user->first_name = "Binod ";
                           $user->last_name = "Thankur";

                           $user->create();
*/

                         $user = new User();

                          $user->username = "Binod Thakur";

                          $user ->save();
                               
                         ?>

                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->