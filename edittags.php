<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php include 'config.php'; ?>
<?php

$errors=array();

if (isset($_GET['edit'])) {
    $uid=$_GET['edit'];


    $sql = "SELECT * FROM tags where `tagid`=$uid";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            $_SESSION['tagedit'] = array('tagname' => $row['tagname'],'tagid' => $row['tagid'] );

        }
    } else {
        echo "0 results";
    }
    //$conn->close();

}


if (isset($_POST['submit'])) {

    $id=$_SESSION['tagedit']['tagid'];
    $tagname=isset($_POST['tagname'])?$_POST['tagname']:'';

    if ($tagname=='') {
        $errors[] =array('input'=>'tagname', 'msg'=>'Tag name is required');
    }


    if (sizeof($errors)==0) {


        $sql="UPDATE tags SET  `tagname`='".$tagname."' WHERE  `tagid`='".$id."' " ;

        if ($conn->query($sql) === true) {
            $sql1= "SELECT * FROM tags where `tagid`='".$id."'";
            $res = $conn->query($sql1);
            if ($res->num_rows > 0) {
                while ($row = $res->fetch_assoc()) {
                    $_SESSION['tagedit'] = array('tagname' => $row['tagname'],'tagid' => $row['tagid'] );

                    echo '<div class="notification attention png_bg">';
                    echo '<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>';
                    echo '<div>';
                    echo 'Tag Updated successfully.';
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

                <h3>Update Tag</h3>

                <ul class="content-box-tabs">
                    <li><a href="#tab1" >Manage</a></li> <!-- href must be unique and match the id of target div -->
                    <li><a href="#tab2" class="default-tab">Add</a></li>
                </ul>

                <div class="clear"></div>

            </div> <!-- End .content-box-header -->

            <div class="content-box-content">
                <?php
                    echo "<h2>Tag Details-</h2>";
                    echo "<b>Tag ID:</b>"."    ".$_SESSION['tagedit']['tagid'].'<br>' ;
                    echo "<b>Tag Name:</b>"." ".$_SESSION['tagedit']['tagname'].'<br><br>' ;

                    echo "<a href='managetags.php'>Click here to check the updated Tag</a><br><br>" ;
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

                    <form action="edittags.php" method="post" enctype="multipart/form-data" >

                        <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                        <p>
                             <label>Tag ID</label>
                                 <input class="text-input small-input" type="text" id="tagid" value="<?php echo $_SESSION['tagedit']['tagid']; ?>" name="tagid" disabled />
                         </p>
                         <p>
                             <label>Tag Name</label>
                                 <input class="text-input small-input" type="text" id="tagname" name="tagname" />
                         </p>

                         <p>
                             <input class="button" type="submit" name="submit" value="Update Tag" />
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