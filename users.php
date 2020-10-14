<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php include 'config.php'; ?>
    <?php


    $errors=array();


    if (isset($_POST['submit'])) {


        $username=isset($_POST['username'])?$_POST['username']:'';
        $password=isset($_POST['password'])?$_POST['password']:'';
        $repassword=isset($_POST['repassword'])?$_POST['repassword']:'';
        $email=isset($_POST['email'])?$_POST['email']:'';
        $address=isset($_POST['address'])?$_POST['address']:'';
        $age=isset($_POST['age'])?$_POST['age']:'';

        if ($password != $repassword) {
            $errors[] =array('input'=>'password', 'msg'=>'password does not match');
        }
        if ($username=='') {
            $errors[] =array('input'=>'username', 'msg'=>'Username is required');
        } else {
            if (!preg_match("/^[a-zA-Z-' ]*$/" ,$username)) {
                $errors[]=array('input'=>'form','msg'=>'Only letters and white space allowed in username') ;

            }
        }
        if ($password=='') {
            $errors[] =array('input'=>'nopassword', 'msg'=>'Password is required');
        }
        if ($email=='') {
            $errors[] =array('input'=>'email', 'msg'=>'email is required');
        } else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[]=array('input'=>'form1','msg'=>'Invalid email format');
            }
        }
        if ($address=='') {
            $errors[] =array('input'=>'address', 'msg'=>'ADDRESS is required');
        }
        if ($age=='') {
            $errors[] =array('input'=>'age', 'msg'=>'DOB is required');
        }

        if (sizeof($errors)==0) {


            $sql = "INSERT INTO users(`uname`,`dob`, `address`, `email`,`password`) VALUES('".$username."', '".$age."', '".$address."', '".$email."', '".$password."'  )" ;

            if ($conn->query($sql) === true) {
                echo '<div class="notification attention png_bg">';
                echo '<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>';
                    echo '<div>';
                        echo 'User added successfully.';
                    echo '</div>';
                echo '</div>';
            } else {
                $errors[] = array('input'=>'form','msg'=>$conn->error);
            }
            $conn->close();
        }
    }

      ?>


    <div id="main-content"> <!-- Main Content Section with everything -->

        <noscript> <!-- Show a notification if the user has disabled javascript -->
            <div class="notification error png_bg">
                <div>
                    Javascript is disabled or is not supported by your browser. Please <a href="http://browsehappy.com/" title="Upgrade to a better browser">upgrade</a> your browser or <a href="http://www.google.com/support/bin/answer.py?answer=23852" title="Enable Javascript in your browser">enable</a> Javascript to navigate the interface properly.
                </div>
            </div>
        </noscript>

        <!-- Page Head -->
        <h2><?php echo 'Welcome'.' '. $_SESSION['userdata']['uname']; ?></h2>
        <p id="page-intro">What would you like to do?</p>


        <div class="clear"></div> <!-- End .clear -->

        <div class="content-box"><!-- Start Content Box -->

            <div class="content-box-header">

                <h3>Add User</h3>

                <ul class="content-box-tabs">
                    <li><a href="#tab1">Manage</a></li> <!-- href must be unique and match the id of target div -->
                    <li><a href="#tab2" class="default-tab">Add</a></li>
                </ul>

                <div class="clear"></div>

            </div> <!-- End .content-box-header -->

            <div class="content-box-content">

                
                <div class="tab-content default-tab" id="tab2">
                    <div class="errors">
                        <?php if(sizeof($errors)>0) : ?>
                            <ul>
                            <?php foreach($errors as $error): ?>
                                <li><?php echo $error['msg']; ?></li>
                            <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>

                    <form action="users.php" method="post">

                        <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->

                            <p>
                                <label>User Name</label>
                                    <input class="text-input small-input" type="text" id="small-input" name="username" />  <!-- Classes for input-notification: success, error, information, attention -->
                            </p>

                            <p>
                                <label>User Email</label>
                                <input class="text-input medium-input datepicker" type="text" id="medium-input" name="email" />
                            </p>

                            <p>
                                <label>Address</label>
                                <textarea  class="text-input large-input" type="text" id="large-input" name="address" ></textarea>
                            </p>

                            <p>
                                <label>Age</label>
                                <input type="date" class="text-input small-input" id="age" name="age"/>
                            </p>

                            <p>
                                <label>Password</label>
                                <input type="password" class="text-input small-input" id="upassword" name="password"/>
                            </p>

                            <p>
                                <label>Re-password</label>
                                <input type="password" class="text-input small-input" id="repassword" name="repassword"/>
                            </p>


                            <p>
                                <input type="submit" class="button"   name="submit" value="Add User" />
                            </p>

                        </fieldset>

                        <div class="clear"></div><!-- End .clear -->

                    </form>

                </div> <!-- End #tab2 -->

            </div> <!-- End .content-box-content -->

        </div> <!-- End .content-box -->

        <div class="clear"></div>


        <!-- Start Notifications --

        <div class="notification attention png_bg">
            <a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
            <div>
                Attention notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero.
            </div>
        </div>

        <div class="notification information png_bg">
            <a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
            <div>
                Information notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero.
            </div>
        </div>

        <div class="notification success png_bg">
            <a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
            <div>
                Success notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero.
            </div>
        </div>

        <div class="notification error png_bg">
            <a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
            <div>
                Error notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero.
            </div>
        </div>

        -- End Notifications -->

        <?php include 'footer.php'; ?>