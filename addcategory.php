<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php include 'config.php'; ?>
<?php


$errors=array();


if (isset($_POST['submit'])) {



    $categoryid=isset($_POST['categoryid'])?$_POST['categoryid']:'';
    $categoryname=isset($_POST['categoryname'])?$_POST['categoryname']:'';
    $categorydetail=isset($_POST['categorydetail'])?$_POST['categorydetail']:'';


    if ($categoryid=='') {
        $errors[] =array('input'=>'cid', 'msg'=>'Category ID is required');
    }
    if ($categoryname=='') {
        $errors[] =array('input'=>'cname', 'msg'=>'Category name is required');
    }
    if ($categorydetail=='') {
        $errors[] =array('input'=>'cdetail', 'msg'=>'Category detail is required');
    }

    if (sizeof($errors)==0) {


        $sql = "INSERT INTO category(`categoryid`, `categoryname`,`description`) VALUES('".$categoryid."', '".$categoryname."', '".$categorydetail."' )" ;

        if ($conn->query($sql) === true) {
            echo '<div class="notification attention png_bg">';
            echo '<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>';
                echo '<div>';
                    echo 'Category added successfully.';
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

                <h3>Add Category</h3>

                <ul class="content-box-tabs">
                    <li><a href="#tab1" >Manage</a></li> <!-- href must be unique and match the id of target div -->
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


                    <form action="addcategory.php" method="post">

                        <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                            <p>
                                <label>Category ID</label>
                                    <input class="text-input small-input" type="text" id="categoryid" name="categoryid" />
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
                                <input class="button" type="submit" name="submit" value="Add Category" />
                            </p>

                        </fieldset>

                        <div class="clear"></div><!-- End .clear -->

                    </form>

                </div> <!-- End #tab2 -->

            </div> <!-- End .content-box-content -->

        </div> <!-- End .content-box -->

        <div class="content-box column-left">

            <div class="content-box-header">

                <h3>Content box left</h3>

            </div> <!-- End .content-box-header -->

            <div class="content-box-content">

                <div class="tab-content default-tab">

                    <h4>Maecenas dignissim</h4>
                    <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed in porta lectus. Maecenas dignissim enim quis ipsum mattis aliquet. Maecenas id velit et elit gravida bibendum. Duis nec rutrum lorem. Donec egestas metus a risus euismod ultricies. Maecenas lacinia orci at neque commodo commodo.
                    </p>

                </div> <!-- End #tab3 -->

            </div> <!-- End .content-box-content -->

        </div> <!-- End .content-box -->

        <div class="content-box column-right closed-box">

            <div class="content-box-header"> <!-- Add the class "closed" to the Content box header to have it closed by default -->

                <h3>Content box right</h3>

            </div> <!-- End .content-box-header -->

            <div class="content-box-content">

                <div class="tab-content default-tab">

                    <h4>This box is closed by default</h4>
                    <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed in porta lectus. Maecenas dignissim enim quis ipsum mattis aliquet. Maecenas id velit et elit gravida bibendum. Duis nec rutrum lorem. Donec egestas metus a risus euismod ultricies. Maecenas lacinia orci at neque commodo commodo.
                    </p>

                </div> <!-- End #tab3 -->

            </div> <!-- End .content-box-content -->

        </div> <!-- End .content-box -->
        <div class="clear"></div>


        <!-- Start Notifications -->
        <!---
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
        </div>---->

        <!-- End Notifications -->

        <?php include 'footer.php'; ?>