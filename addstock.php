<?php $page_title = "Add Products' Stock"; ?>
<?php include("includes/header.php"); ?>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
          <h4 class="font-weight-bold">Add Products' Stocks</h4>
        </div>
        <div class="card-body">
          <form action="stockcode.php" method="POST">
            <div class="row">
              <!-- Categories Dropdown -->
              <div class="col-md-12 mb-3">
                <label for="cate"><strong>Categories</strong></label>
                <?php
                $Cate = isset($_GET['cate']) ? $_GET['cate'] : '';
                $category_query = "SELECT * FROM category WHERE Cate_Status = 1";
                $category_result = mysqli_query($dataconnection, $category_query);
                if (mysqli_num_rows($category_result) > 0) {
                ?>
                  <select name="category_id" id="cate" class="form-control border border-dark" required onchange="Pro()">
                    <option value="">--- Select Categories ---</option>
                    <?php
                    foreach ($category_result as $data) {
                    ?>
                      <option value="<?php echo $data['ID']; ?>" <?php echo $data['ID'] == $Cate ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($data['Cate_Name']); ?>
                      </option>
                    <?php } ?>
                  </select>
                <?php
                } else {
                  echo "<div class='alert alert-warning'>No categories available</div>";
                }
                ?>
              </div>

              <!-- Products Dropdown -->
              <?php if ($Cate) { ?>
                <div class="col-md-12 mb-3">
                  <label for="product_id"><strong>Products' Name</strong></label>
                  <?php
                  $product_query = "SELECT product.ID AS ID, product.Pro_Name AS PName FROM product, category WHERE product.Category_ID = category.ID AND category.ID = '$Cate'";
                  $product_result = mysqli_query($dataconnection, $product_query);
                  if (mysqli_num_rows($product_result) > 0) {
                  ?>
                    <select name="product_id" id="product_id" class="form-control border border-dark" required>
                      <option value="">--- Select Products ---</option>
                      <?php
                      foreach ($product_result as $pro) {
                      ?>
                        <option value="<?php echo $pro['ID']; ?>"><?php echo htmlspecialchars($pro['PName']); ?></option>
                      <?php } ?>
                    </select>
                  <?php
                  } else {
                    echo "<div class='alert alert-warning'>No products available</div>";
                  }
                  ?>
                </div>
              <?php } ?>

              <!-- Size Dropdown -->
              <div class="col-md-6 mb-3">
                <label for="stock_size"><strong>Size</strong></label>
                <select name="stock_size" id="stock_size" class="form-control border border-dark" required>
                  <option value="">--- Select Size ---</option>
                  <?php
                  $size_query = getalldata("size");
                  if (mysqli_num_rows($size_query) > 0) {
                    foreach ($size_query as $size) {
                  ?>
                      <option value="<?php echo $size['EUsize']; ?>"><?php echo $size['EUsize']; ?></option>
                  <?php
                    }
                  }
                  ?>
                </select>
              </div>

              <!-- Quantity Input -->
              <div class="col-md-6 mb-3">
                <label for="quantity"><strong>Quantity</strong></label>
                <input type="number" id="quantity" name="quantity" class="form-control" placeholder="Enter Product Quantity" required min="1" style="border: 1px solid;">
              </div>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex justify-content-between mt-4">
              <button type="submit" name="addstockbtn" class="btn btn-success"><i class="fa fa-check-circle"></i> Save</button>
              <a href="stocks.php?id=<?php echo $_SESSION['AID']; ?>" class="btn btn-light"><i class="fa fa-angle-double-left"></i> Return</a>
            </div>

            <!-- Feedback Message -->
            <?php if (isset($_SESSION['message'])) { ?>
              <div class="alert alert-info mt-3">
                <?php
                echo htmlspecialchars($_SESSION['message']);
                unset($_SESSION['message']);
                ?>
              </div>
            <?php } ?>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  function Pro() {
    var Cate = document.getElementById("cate").value;
    self.location = "addstock.php?id=<?php echo $_SESSION['AID']; ?>&cate=" + Cate;
  }
</script>

<?php include("includes/footer.php"); ?>
<?php include("includes/scripts.php"); ?>
