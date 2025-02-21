<?php $page_title = "Edit Product"; ?>
<?php include("includes/header.php"); ?>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <?php
      if (isset($_POST['product_id']) || isset($_SESSION['product_id'])) {
        $id = isset($_POST['product_id']) ? $_POST['product_id'] : $_SESSION['product_id'];
        unset($_SESSION['product_id']);
        
        $product = getbyid("product", $id);

        if (mysqli_num_rows($product) > 0) {
          $product_row = mysqli_fetch_array($product);
      ?>
          <div class="card shadow-lg">
            <div class="card-header bg-primary text-white text-center">
              <h4 class="font-weight-bold">Edit Product</h4>
            </div>
            <div class="card-body">
              <form action="productcode.php" method="POST" enctype="multipart/form-data">
                <div class="row">
                  <!-- Categories Dropdown -->
                  <div class="col-md-12 mb-3">
                    <label for="category_id"><strong>Category</strong></label>
                    <?php
                    $category_query = "SELECT * FROM category WHERE Cate_Status = 1";
                    $category_result = mysqli_query($dataconnection, $category_query);
                    if (mysqli_num_rows($category_result) > 0) {
                    ?>
                      <select name="category_id" id="category_id" class="form-control border border-dark" required>
                        <option value="">--- Select Category ---</option>
                        <?php foreach ($category_result as $category) { ?>
                          <option value="<?php echo $category['ID']; ?>" <?php echo $category['ID'] == $product_row['Category_ID'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($category['Cate_Name']); ?>
                          </option>
                        <?php } ?>
                      </select>
                    <?php
                    } else {
                      echo "<div class='alert alert-warning'>No categories available</div>";
                    }
                    ?>
                  </div>

                  <!-- Product Name -->
                  <div class="col-md-6 mb-3">
                    <label for="name"><strong>Product Name</strong></label>
                    <input type="hidden" name="product_id" value="<?php echo $product_row['ID']; ?>">
                    <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($product_row['Pro_Name']); ?>" placeholder="Enter Product Name" required>
                  </div>

                  <!-- Product Description -->
                  <div class="col-md-12 mb-3">
                    <label for="description"><strong>Description</strong></label>
                    <textarea id="description" name="description" class="form-control" rows="4" placeholder="Enter Product Description"><?php echo htmlspecialchars($product_row['Pro_Description']); ?></textarea>
                  </div>

                  <!-- Product Price -->
                  <div class="col-md-6 mb-3">
                    <label for="price"><strong>Price</strong></label>
                    <input type="number" id="price" name="price" class="form-control" step="0.01" min="0" value="<?php echo $product_row['Pro_Price']; ?>" placeholder="Enter Product Price" required>
                  </div>

                  <!-- Product Image -->
                  <div class="col-md-6 mb-3">
                    <label for="image"><strong>Image</strong></label>
                    <input type="hidden" name="Old_Image" value="<?php echo htmlspecialchars($product_row['Pro_Image']); ?>">
                    <input type="file" id="image" name="image" class="form-control">
                  </div>

                  <!-- Product Status -->
                  <div class="col-md-6 mb-3">
                    <div class="form-check mt-4">
                      <input type="checkbox" id="status" name="status" class="form-check-input" <?php echo $product_row['Pro_Status'] ? "checked" : ""; ?>>
                      <label for="status" class="form-check-label"><strong>Active</strong></label>
                    </div>
                  </div>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex justify-content-between mt-4">
                  <button type="submit" name="updateproductbtn" class="btn btn-success">
                    <i class="fa fa-check-circle"></i> Save
                  </button>
                  <a href="products.php" class="btn btn-secondary">
                    <i class="fa fa-angle-double-left"></i> Return
                  </a>
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
      <?php
        } else {
          echo "<div class='alert alert-danger text-center'>Product not found.</div>";
        }
      } else {
        echo "<div class='alert alert-danger text-center'>Product ID is missing.</div>";
      }
      ?>
    </div>
  </div>
</div>

<?php include("includes/footer.php"); ?>
<?php include("includes/scripts.php"); ?>
