<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php include 'config.php'; ?>
<?php

$errors=array();

if (isset($_GET['edit'])) {
    $uid=$_GET['edit'];


    $sql = "SELECT * FROM users where `userid`=$uid";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            $_SESSION['useredit'] = array('uname' => $row['uname'],'userid' => $row['userid'], 'password'=> $row['password'], 'email'=>$row['email'], 'address'=>$row['address'], 'age'=>$row['dob'], 'role'=>$row['role']) ;
        }
    } else {
        echo "0 results";
    }
    //$conn->close();

}


if (isset($_POST['submit'])) {

    $id=$_SESSION['useredit']['userid'];
    $uname=isset($_POST['username'])?$_POST['username']:'';
    $email=isset($_POST['email'])?$_POST['email']:'';
    $address=isset($_POST['address'])?$_POST['address']:'';
    $age=isset($_POST['age'])?$_POST['age']:'';
    $role=isset($_POST['role'])?$_POST['role']:'';

    if ($uname=='') {
        $errors[] =array('input'=>'uname', 'msg'=>'User name is required');
    }
    if ($email=='') {
        $errors[] =array('input'=>'email', 'msg'=>'email is required');
    }
    if ($address=='') {
        $errors[] =array('input'=>'address', 'msg'=>'User Address is required');
    }
    if ($age=='') {
        $errors[] =array('input'=>'age', 'msg'=>'User DOB is required');
    }

    if (sizeof($errors)==0) {


        $sql="UPDATE users SET `uname`='".$uname."', `email`='".$email."', `address`='".$address."', `dob`='".$age."', `role`='".$role."' WHERE  `userid`='".$id."' " ;

        if ($conn->query($sql) === true) {
            $sql1= "SELECT * FROM users where `userid`='".$id."'";
            $res = $conn->query($sql1);
            if ($res->num_rows > 0) {
                while ($row = $res->fetch_assoc()) {
                    $_SESSION['useredit'] = array('uname' => $row['uname'],'userid' => $row['userid'], 'password'=> $row['password'], 'email'=>$row['email'], 'address'=>$row['address'], 'age'=>$row['dob'], 'role'=>$row['role']) ;
                    echo '<div class="notification attention png_bg">';
                    echo '<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>';
                    echo '<div>';
                    echo 'User Updated successfully.';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                $errors[]=array('input'=>'form','msg'=>'Invalid Updation');
            }
        } else {
            $errors[] = array('input'=>'form','msg'=>$conn->error);
        }
        //$conn->close();
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

                <h3>Update User</h3>

                <ul class="content-box-tabs">
                    <li><a href="#tab1" >Manage</a></li> <!-- href must be unique and match the id of target div -->
                    <li><a href="#tab2" class="default-tab">Add</a></li>
                </ul>

                <div class="clear"></div>

            </div> <!-- End .content-box-header -->

            <div class="content-box-content">
                <?php
                    echo "<h2>Product Details-</h2>";
                    echo "<b>User ID:</b>"." ".$_SESSION['useredit']['userid'].'<br>' ;
                    echo "<b>User Name:</b>"." ".$_SESSION['useredit']['uname'].'<br>' ;
                    echo "<b>Email:</b>"." ".$_SESSION['useredit']['email'].'<br>' ;
                    echo "<b>DOB:</b>"."    ".$_SESSION['useredit']['age'].'<br>' ;
                    echo "<b>Address:</b>"." ".$_SESSION['useredit']['address'].'<br>' ;
                    echo "<b>Role:</b>"." ".$_SESSION['useredit']['role'].'<br><br>' ;
                    echo "<a href='manageusers.php'>Click here to check the updated user</a><br><br>" ;
                ?>

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

                    <form action="edituser.php" method="post" enctype="multipart/form-data" >

                        <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                            <p>
                                <label>User ID</label>
                                    <input class="text-input small-input" type="text" id="userid" name="userid" value="<?php echo $_SESSION['useredit']['userid']; ?>" disabled />
                            </p>
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
                                <label>Role</label>
                                <input type="text" class="text-input small-input" id="role" name="role"/>
                            </p>

                            <p>
                                <input type="submit" class="button"   name="submit" value="Update User" />
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