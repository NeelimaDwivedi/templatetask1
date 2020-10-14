<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php include 'config.php'; ?>
<?php

$errors=array();

if (isset($_GET['edit'])) {
    $uid=$_GET['edit'];


    $sql = "SELECT * FROM category where `categoryid`=$uid";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            $_SESSION['categoryedit'] = array('cname' => $row['categoryname'],'cid' => $row['categoryid'], 'cdescription'=> $row['description']);

        }
    } else {
        echo "0 results";
    }
    //$conn->close();

}


if (isset($_POST['submit'])) {

    $id=$_SESSION['categoryedit']['cid'];
    $cname=isset($_POST['categoryname'])?$_POST['categoryname']:'';
    $cdescription=isset($_POST['categorydetail'])?$_POST['categorydetail']:'';

    if ($cname=='') {
        $errors[] =array('input'=>'cname', 'msg'=>'Category name is required');
    }
    if ($cdescription=='') {
        $errors[] =array('input'=>'description', 'msg'=>'Category Description is required');
    }

    if (sizeof($errors)==0) {


        $sql="UPDATE category SET  `categoryname`='".$cname."', `description`='".$cdescription."' WHERE  `categoryid`='".$id."' " ;

        if ($conn->query($sql) === true) {
            $sql1= "SELECT * FROM category where `categoryid`='".$id."'";
            $res = $conn->query($sql1);
            if ($res->num_rows > 0) {
                while ($row = $res->fetch_assoc()) {
                    $_SESSION['categoryedit'] = array('cname' => $row['categoryname'],'cid' => $row['categoryid'], 'cdescription'=> $row['description']);

                    echo '<div class="notification attention png_bg">';
                    echo '<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>';
                    echo '<div>';
                    echo 'Category Updated successfully.';
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

                <h3>Update Category</h3>

                <ul class="content-box-tabs">
                    <li><a href="#tab1" >Manage</a></li> <!-- href must be unique and match the id of target div -->
                    <li><a href="#tab2" class="default-tab">Add</a></li>
                </ul>

                <div class="clear"></div>

            </div> <!-- End .content-box-header -->

            <div class="content-box-content">
                <?php
                    echo "<h2>Category Details-</h2>";
                    echo "<b>Category ID:</b>"."    ".$_SESSION['categoryedit']['cid'].'<br>' ;
                    echo "<b>Category Name:</b>"." ".$_SESSION['categoryedit']['cname'].'<br>' ;
                    echo "<b>Category Description:</b>"."    ".$_SESSION['categoryedit']['cdescription'].'<br><br>' ;

                    echo "<a href='managecategory.php'>Click here to check the updated category</a><br><br>" ;
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

                    <form action="editcategory.php" method="post" enctype="multipart/form-data" >

                        <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                        <p>
                                <label>Category ID</label>
                                    <input class="text-input small-input" type="text" id="categoryid" name="categoryid" value="<?php echo $_SESSION['categoryedit']['cid']; ?>" disabled />
                            </p>
                            <p>
                                <label>Category Name</label>
                                    <input class="text-input small-input" type="text" id="categoryname" name="categoryname" />
                            </p>

                            <p>
                                <label>Category Detail</label>
                                <textarea class="text-input large-input"  cols="79" rows="15" id="categorydetail" name="categorydetail" ></textarea>
                            </p>

                            <p>
                                <input class="button" type="submit" name="submit" value="Update Category" />
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