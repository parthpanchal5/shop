<?php
include 'inc/header.php';
include 'inc/conn.php';
?>


<!--Main navbar -->
<?php include 'inc/mainnav.php'; ?>

<!--Content area-->
<div class="container-fluid" style="margin: 15px 10px 10px 10px;">

  <div class="row animated fadeIn">
    <div class="col s12 m12 l6 xl6">
      <div class="card">

        <?php if (isset($_GET['pid'])) {
          $productId = mysqli_real_escape_string($conn, $_GET['pid']);
          $sql = "SELECT * FROM item WHERE item_id = $productId";
          $result = mysqli_query($conn, $sql);
        }
        while ($row = mysqli_fetch_array($result)) { ?>

          <form action="cart.php?action=add&pid=<?php echo $row[0]; ?>" method="POST">

            <div class="card-image">
              <img src="admin/img/<?php echo $row[3]; ?>" alt="<?php echo $row[2]; ?>" class="materialboxed responsive-img" data-caption="<?php echo $row[2]; ?>">
            </div>
            <div class="card-action">
              <div class="row">
                <!-- For Mobile and tablet -->
                <div class="col s12 m12 l12 xl12  hide-on-large-only	show-on-medium-and-down">

                  <?php if ($row[7] <= 4) : ?>

                    <a href='#' class='btn btn-small blue darken-1 left'>Notify me <i class='fa fa-bell fa-1x' style='font-size: 15px; margin-left: 10px;'></i></a>

                  <?php else : ?>

                    <button type="submit" name="add_to_cart" class="btn btn-medium amber darken-2" style="font-family: 'Poppins', sans-serif !important; ">Add to cart <i class="fa fa-shopping-cart" style="font-size: 16px;"></i></button>
                    <a href='cart.php?pid=<?php echo $row[0]; ?>' target='_blank' class='btn btn-medium amber darken-4 right'>Buy now <i class='fas fa-bolt' style="font-size: 16px;"></i></a>

                  <?php endif; ?>

                </div>
                <!-- For Desktop and laptop -->
                <div class="col s12 m12 l12 xl12  show-on-large-only	hide-on-med-and-down">

                  <?php if ($row[7] <= 4) : ?>

                    <a href='#' class='btn btn-large blue darken-1 left'>Notify me <i class='fa fa-bell fa-1x' style='font-size: 15px; margin-left: 10px;'></i></a>

                  <?php else : ?>

                    <button type="submit" name="add_to_cart" class="btn btn-large orange darken-2" style="font-family: 'Poppins', sans-serif !important; ">Add to cart <i class="fa fa-shopping-cart" style="font-size: 16px;"></i></button>
                    <button type="submit" name="buy_now" class="btn btn-large amber darken-2 right" style="font-family: 'Poppins', sans-serif !important; ">Buy now <i class="fa fa-bolt" style="font-size: 16px;"></i></button>

                  <?php endif; ?>

                </div>
              </div>
            </div>
        </div>
      </div>
      <div class="col s12 m12 l6 xl6">

        <?php echo $errorImg; ?>

        <div class="card-panel animated fadeIn">
          <table class="table striped">
            <tr>
              <th colspan="2">
                <h5><?php echo $row[2]; ?></h5>
              </th>
            </tr>
            <tr>
              <th class="left">Description: </th>
              <td style="text-align:left;"><?php echo $row[5]; ?></td>
            </tr>
            <tr>
              <th class="left">Price:</th>

              <?php if (!empty($row[9]) && $row[9] > 0) : ?>

                <td><a class="tooltipped black-text rounded" data-position="right" data-tooltip='Original Price: <?php echo number_format($row[6]); ?><i style="margin-left: 3px;" class="fas fa-rupee-sign"></i> <br> Discount: <?php echo $row[9] . "%"; ?>'><span class="black-text"><?php $sp = $row[6] - ($row[6] * ($row[9] / 100));
                                                                                                                                                                                                                                                                                        echo number_format($sp); ?></span><i style="margin-left: 3px;" class="fas fa-rupee-sign"></i><br> <del class="grey-text"><?php echo number_format($row[6]); ?> <i style="margin-left: 3px;" class="fas fa-rupee-sign"></i> </del> </a></td>

              <?php else : ?>

                <td><a class="tooltipped black-text rounded" data-position="right" data-tooltip="No Discounts Available"><?php echo $row[6]; ?></a> <i class="fas fa-rupee-sign"></i></td>

              <?php endif; ?>

            </tr>
            <tr>
              <th class="left">Category: </th>
              <td><?php echo $row[4]; ?><br></td>
            </tr>
            <tr>
              <th class="left">Ratings: </th>
              <td>
                <a class="tooltipped black-text rounded" data-position="right" data-tooltip="Total Ratings: 4.5"><i class="fa fa-star amber-text darken-4"></i><span style="margin-left: 8px;">4.5</span></a>
              </td>
            </tr>
            <tr>
              <th class="left">Availability: </th>

              <?php include 'range.php'; ?>

            </tr>

            <?php if ($row[7] > 4) : ?>

              <tr>
                <th class="left">Qty: </th>
                <td>
                  <input type="number" min="1" max="5" value="1" name="quantity">
                </td>
              </tr>

            <?php endif; ?>

            <tr>
              <input type="hidden" name="hidden_name" value="<?php echo $row['item_name']; ?>">
              <input type="hidden" name="hidden_price" value="<?php echo $row['item_price']; ?>">
              <input type="hidden" name="hidden_img" value="<?php echo $row['item_img']; ?>">
              <input type="hidden" name="hidden_discount" value="<?php echo $row['discount']; ?>">
            </tr>
            </form>
          </table>
        </div>

      <?php  } ?>

    </div>

    <!--Rating & Review Panel  -->
    <div class="col s12 m12 xl6 right">
      <div class="card-panel">
        <div class="card-title">
          <h5>Ratings & Review</h5>
        </div>
        <hr>
        <div class="card-content">
          <table class="table">
            <tbody>
              <tr>
                <td class="left-align"><span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam cumque eius voluptas at ipsum provident blanditiis, labore neque quo non! At! <br> <span class=" grey-text" style="margin-top: 20px;">-By Parth Panchal <a class="tooltipped black-text rounded" style="margin-left: 10px;" data-position="right" data-tooltip="Ratings: 4.5"><i class="amber-text darken-4 fa fa-star"></i><span style="margin-left: 8px;">4.5</span></a></span></span></td>
              </tr>
              <tr>
                <td class="left-align"><span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam cumque eius voluptas at ipsum provident blanditiis, labore neque quo non! At! <br> <span class=" grey-text">-By Parth Panchal <a class="tooltipped black-text rounded" style="margin-left: 10px;" data-position="right" data-tooltip="Ratings: 4.5"><i class="amber-text darken-4 fa fa-star"></i><span style="margin-left: 8px;">4.5</span></a></span></span></td>
              </tr>
              <tr>
                <td class="left-align"><span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam cumque eius voluptas at ipsum provident blanditiis, labore neque quo non! At! <br> <span class=" grey-text">-By Parth Panchal <a class="tooltipped black-text rounded" style="margin-left: 10px;" data-position="right" data-tooltip="Ratings: 4.5"><i class="amber-text darken-4 fa fa-star"></i><span style="margin-left: 8px;">4.5</span></a></span></span></td>
              </tr>
              <tr>
                <td class="left-align"><span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam cumque eius voluptas at ipsum provident blanditiis, labore neque quo non! At! <br> <span class=" grey-text">-By Parth Panchal <a class="tooltipped black-text rounded" style="margin-left: 10px;" data-position="right" data-tooltip="Ratings: 4.5"><i class="amber-text darken-4 fa fa-star"></i><span style="margin-left: 8px;">4.5</span></a></span></span></td>
              </tr>
              <tr>
                <td class="left-align"><span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam cumque eius voluptas at ipsum provident blanditiis, labore neque quo non! At! <br> <span class=" grey-text">-By Parth Panchal <a class="tooltipped black-text rounded" style="margin-left: 10px;" data-position="right" data-tooltip="Ratings: 4.5"><i class="amber-text darken-4 fa fa-star"></i><span style="margin-left: 8px;">4.5</span></a></span></span></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>


  <?php include 'inc/footer.php'; ?>