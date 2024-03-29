<?php
session_start();
include 'inc/conn.php';

$edit_state = false;
$itemName = $itemPrice = $category = $qty = $itemDesc  = $subCat = $discount = '';
$itemName_err = $itemPrice_err = $category_err = $qty_err = $itemDesc_err = $subCat_err = $discount_err = '';

// Fetch Data into textbox
if (isset($_GET['edit'])) {
  $id = $_GET['edit'];
  $edit_state = true;
  $getRecord = mysqli_query($conn, "SELECT * FROM item WHERE item_id = $id");
  $storeRecord = mysqli_fetch_array($getRecord);
  $itemName = $storeRecord['item_name'];
  $itemPrice = $storeRecord['item_price'];
  $category = $storeRecord['item_cat'];
  $subCat = $storeRecord['sub_cat'];
  $qty = $storeRecord['item_qty'];
  $itemDesc = $storeRecord['item_desc'];
  $discount = $storeRecord['discount'];
  $newFileName = $storeRecord['item_img'];
}

// Update
if (isset($_POST['update'])) {
  $id = mysqli_real_escape_string($conn, $_POST['id']);
  $itemName = ucwords(mysqli_real_escape_string($conn, $_POST['item_name']));
  $itemPrice = mysqli_real_escape_string($conn, $_POST['price']);
  $category = mysqli_real_escape_string($conn, $_POST['item_cat']);
  $qty = mysqli_real_escape_string($conn, $_POST['qty']);
  $discount = mysqli_real_escape_string($conn, $_POST['disc']);
  $itemDesc = mysqli_real_escape_string($conn, $_POST['item_desc']);
  $subCat = mysqli_real_escape_string($conn, $_POST['sub_cat']);


  // Vars for img-file
  $file = $_FILES['item_img'];
  $fileName = $_FILES['item_img']['name'];
  $fileTmpName = $_FILES['item_img']['tmp_name'];
  $fileSize = $_FILES['item_img']['size'];
  $fileError = $_FILES['item_img']['error'];
  $fileType = $_FILES['item_img']['type'];
  $fileExt = explode('.', $fileName);
  $fileActualExt = strtolower(end($fileExt));
  $allowedExt = array('jpg', 'jpeg', 'png', 'pdf', 'JPG', 'JPEG', 'PDF', 'PNG');

  // File condition block
  if (in_array($fileActualExt, $allowedExt)) {
    if ($fileError === 0) {
      if ($fileSize < 10000000) {
        $random = rand(6000, 8000);
        // $newFileName = $random.$fileActualExt;
        $newFileName = uniqid('', true) . "." . $fileActualExt;
        $fileDestination = 'img/' . $newFileName;

        move_uploaded_file($fileTmpName, $fileDestination);
      } else {
        echo "File is too big";
      }
    } else {
      echo "There was an error uploading file";
    }
  }


  if (empty($itemName)) {
    $itemName_err = "Item name is required";
  }
  if (empty($itemPrice)) {
    $itemPrice_err = "Price is required";
  }
  if ($category === 'none') {
    $category_err = "Please select category";
  }
  if (empty($qty)) {
    $qty_err = "Please enter quantity";
  }
  if ($subCat === 'none') {
    $subCat_err = "Please select sub-category";
  }
  if (empty($discount)) {
    $discount = 0;
  }
  if (empty($itemDesc)) {
    $itemDesc_err = "Item Descripton is required";
  }
  if (!preg_match("/^[0-9.]*$/", $itemPrice)) {
    $itemPrice_err = "Invalid amount";
  }
  if (!preg_match("/^[0-9]*$/", $qty)) {
    $qty_err = "Please insert quantity";
  } else {
    // The error block
    $sql1 = "SELECT * FROM category";
    $result1 = mysqli_query($conn, $sql1);
    while ($row = mysqli_fetch_array($result1)) {
      $cat_id = $row[0];
      $sql = "UPDATE item SET cat_id = '$cat_id' , item_name = '$itemName', item_img = '$newFileName', item_cat = '$category', item_desc = '$itemDesc', item_price = '$itemPrice', item_qty = '$qty', sub_category = '$subCat', discount = '$discount' WHERE item_id = '$id'";
    }
    $result = mysqli_query($conn, $sql);
    // echo $sql;

    // header("Location:view_item.php?updated");
    // exit;
  }
}

?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/horizonnav.php'; ?>
<div class="container-fluid">
  <h3 class="center" style="margin-top: 1em;">Edit items</h3>
  <div class="row">
    <div class="col s12 m2 l2"></div>
    <div class="col s12 m12 l8">
      <div class="card animated fadeIn">
        <div class="card-content">
          <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
            <div class="row">
              <div class="input-field col s6">
                <input type="text" name="item_name" autocomplete="off" id="name" value="<?php echo $itemName; ?>" autofocus>
                <label for="item_name">Item name</label>
                <span class="red-text animated fadeIn"><?php echo $itemName_err; ?></span>
              </div>
              <div class="input-field col s6">
                <input type="text" name="price" autocomplete="off" id="price" value="<?php echo $itemPrice; ?>">
                <label for="price">Item Price</label>
                <span class="red-text animated fadeIn"><?php echo $itemPrice_err; ?></span>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m12 l6 xl6">
                <select name="item_cat" class="browser-default">
                  <option value="none" selected>Category</option>

                  <?php $sql = "SELECT COUNT(*) AS `Rows`, `cat_name` FROM `category` GROUP BY `cat_name` ORDER BY `cat_name`";
                  $result = mysqli_query($conn, $sql);
                  while ($row = mysqli_fetch_array($result)) { ?>

                    <option class="blue-text" value="<?php echo $row[1]; ?>"><?php echo $row[1]; ?></option>

                  <?php } ?>

                </select>
                <span class="red-text animated fadeIn"><?php echo $category_err; ?></span>
              </div>
              <div class="input-field col s12 m12 l6 xl6">
                <select name="sub_cat" class="browser-default">
                  <option value="none" selected>Sub-Category</option>

                  <?php $sql = "SELECT * FROM category ORDER BY `sub_cat_name` ASC";
                  $result = mysqli_query($conn, $sql);
                  while ($row = mysqli_fetch_array($result)) { ?>

                    <option class="blue-text" value="<?php echo $row[2]; ?>"><?php echo $row[2]; ?></option>

                  <?php } ?>

                </select>
                <span class="red-text animated fadeIn"><?php echo $subCat_err; ?></span>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s6">
                <input type="text" name="qty" id="qty" value="<?php echo $qty; ?>">
                <label for="qty">Quantity</label>
                <span class="red-text"><?php echo $qty_err; ?></span>
              </div>
              <div class="input-field col s6">
                <input type="text" name="disc" id="discount" value="<?php echo $discount; ?>">
                <label for="discount">Discount (%)</label>
                <span class="red-text"><?php echo $discount_err; ?></span>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <textarea id="item_desc" name="item_desc" class="materialize-textarea <?php echo (!empty($catDesc_err)) ? 'invalid' : ''; ?>" autocomplete="off"><?php echo $itemDesc; ?></textarea>
                <label for="item_desc">Item Description</label>
                <span class="red-text animated fadeIn"><?php echo $itemDesc_err; ?></span>
              </div>
            </div>
            <div class="row">
              <p style="margin-bottom: 10px; margin-left: 10px;">Uploaded Image: </p>
              <div class="col s12 m12 l12">
                <img src="img/<?php echo $storeRecord['item_img']; ?>" alt="<?php echo $storeRecord['item_name']; ?>" data-caption="<?php echo $storeRecord['item_name']; ?>" class="materialboxed" width="320">
              </div>
            </div>
            <div class="row">
              <div class="file-field input-field col s12 l12 m12 xl12">
                <div class="btn right btn-small blue lighten-1 rounded" style="border-radius: 50px !important;">
                  <span>Upload <i class="fa fa-upload fa-1x"></i></span>
                  <input type="file" name="item_img">
                </div>
                <div class="file-path-wrapper">
                  <input class="file-path validate" name="img-name" value="<?php echo $newFileName; ?>" type="text">
                </div>
              </div>
            </div>

            <?php if ($edit_state == true) : ?>

              <input type="hidden" name="id" value="<?php echo $id; ?>">
              <input type="submit" value="Update" name="update" class="btn blue btn-large">

            <?php endif; ?>

          </form>
        </div>
      </div>
    </div>
    <div class="col s12 m2 l2"></div>
  </div>
</div>
<?php include 'inc/footer.php'; ?>