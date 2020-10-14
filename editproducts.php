<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php include 'config.php'; ?>
<?php

$errors=array();

if (isset($_GET['edit'])) {
    $uid=$_GET['edit'];


    $sql = "SELECT * FROM products where `pid`=$uid";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            $_SESSION['productedit'] = array('pname' => $row['pname'],'pid' => $row['pid'], 'pimage'=> $row['pimage'], 'pprice'=>$row['pprice'], 'category'=>$row['category'], 'tag'=>$row['tag'] , 'pdescription'=>$row['description'] );

        }
    } else {
        echo "0 results";
    }
    //$conn->close();

}


if (isset($_POST['submit'])) {

    $id=$_SESSION['productedit']['pid'];
    $imagename = isset($_FILES['image']['name'])?$_FILES['image']['name']:'';
    $imagetmpname = $_FILES['image']['tmp_name'];
    $folder="upld/".$imagename;
    move_uploaded_file($imagetmpname, $folder);

    $pname=isset($_POST['pname'])?$_POST['pname']:'';
    $pprice=isset($_POST['pprice'])?$_POST['pprice']:'';
    $pcategory=isset($_POST['dropdown'])?$_POST['dropdown']:'';
    $checkbox1=isset($_POST['q1'])?$_POST['q1']:'';
    $ptag="";
    foreach($checkbox1 as $chk1)
       {
          $ptag .= $chk1.",";
       }
    $pdescription=isset($_POST['pdescription'])?$_POST['pdescription']:'';

    if ($pname=='') {
        $errors[] =array('input'=>'productname', 'msg'=>'Product name is required');
    }
    if ($pprice=='') {
        $errors[] =array('input'=>'productprice', 'msg'=>'Price is required');
    }
    if ($pcategory=='') {
        $errors[] =array('input'=>'pcategory', 'msg'=>'Product category is required');
    }
    if ($imagename=='') {
        $errors[] =array('input'=>'image', 'msg'=>'image is required');
    }
    if ($ptag=='') {
        $errors[] =array('input'=>'tag', 'msg'=>'Tag is required');
    }
    if ($pdescription=='') {
        $errors[] =array('input'=>'description', 'msg'=>'Product Description is required');
    }

    if (sizeof($errors)==0) {


        $sql="UPDATE products SET `pimage`='".$folder."', `pname`='".$pname."', `pprice`='".$pprice."', `category`='".$pcategory."', `tag`='".$ptag."', `description`='".$pdescription."' WHERE  `pid`='".$id."' " ;

        if ($conn->query($sql) === true) {
            $sql1= "SELECT * FROM products where `pid`='".$id."'";
            $res = $conn->query($sql1);
            if ($res->num_rows > 0) {
                while ($row = $res->fetch_assoc()) {
                    $_SESSION['productedit'] = array('pname' => $row['pname'],'pid' => $row['pid'], 'pimage'=> $row['pimage'], 'pprice'=>$row['pprice'], 'category'=>$row['category'], 'tag'=>$row['tag'] , 'pdescription'=>$row['description'] );

                    echo '<div class="notification attention png_bg">';
                    echo '<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>';
                    echo '<div>';
                    echo 'Product Updated successfully.';
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

                <h3>Update Product</h3>

                <ul class="content-box-tabs">
                    <li><a href="#tab1" >Manage</a></li> <!-- href must be unique and match the id of target div -->
                    <li><a href="#tab2" class="default-tab">Add</a></li>
                </ul>

                <div class="clear"></div>

            </div> <!-- End .content-box-header -->

            <div class="content-box-content">
                <?php
                    echo "<h2>Product Details-</h2>";
                    echo "<image src='".$_SESSION['productedit']['pimage']."'><br>";
                    echo "<b>Product ID:</b>"." ".$_SESSION['productedit']['pid'].'<br>' ;
                    echo "<b>Product Name:</b>"." ".$_SESSION['productedit']['pname'].'<br>' ;
                    echo "<b>Product Price:</b>"." ".$_SESSION['productedit']['pprice'].'<br>' ;
                    echo "<b>Product Category:</b>"." ".$_SESSION['productedit']['category'].'<br>' ;
                    echo "<b>Product Tag:</b>"."    ".$_SESSION['productedit']['tag'].'<br>' ;
                    echo "<b>Product Description:</b>"." ".$_SESSION['productedit']['pdescription'].'<br><br>' ;
                    echo "<a href='manageproducts.php'>Click here to check the updated product</a><br><br>" ;
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

                    <form action="editproducts.php" method="post" enctype="multipart/form-data" >

                        <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                            <p>
                                <label>Product ID</label>
                                <input class="text-input medium-input datepicker" type="text" value="<?php echo $_SESSION['productedit']['pid']; ?>" id="pid" name="pid" disabled />
                            </p>
                            <p>
                                <label>Product Image</label>
                                    <input class='text-input small-input' type='file' id='productimage'   name='image'   /> <!-- Classes for input-notification: success, error, information, attention -->
                            </p>

                            <p>
                                <label>Product Name</label>
                                <input class="text-input medium-input datepicker" type="text"  id="pname" name="pname" />
                            </p>

                            <p>
                                <label>Price</label>
                                <input class="text-input small-input" type="text" id="pprice" name="pprice" />
                            </p>
                            <?php
                                $sql = "SELECT * FROM category";
                                $result = $conn->query($sql);
                            ?>
                            <p>

                                <label>Category</label>
                                <select name="dropdown" class="small-input">
                                <?php while ($row = $result->fetch_assoc()) {
                                    echo '<option  value="'.$row['categoryname'].'">'.$row['categoryname'].'</option>' ;
                                }
                                ?>
                                </select>

                            </p>
                            <?php
                                $sql = "SELECT * FROM tags";
                                $result = $conn->query($sql);
                            ?>
                            <p>
                                <label>Tags</label>
                                <?php while ($row = $result->fetch_assoc()) {
                                    echo '<input type="checkbox" value="'.$row['tagname'].'" name="q1[]" />'.$row['tagname'] ;
                                }
                                ?>
                            </p>

                            <p>
                                <label>Description</label>
                                <textarea class="text-input large-input" cols="79" rows="5"  id="pdescription" name="pdescription" ></textarea>
                            </p>

                            <p>
                                <input type="submit" class="button"  name="submit" value="Update Product" />
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