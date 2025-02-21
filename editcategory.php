<?php $page_title = "Edit Category"; ?>
<?php include("includes/header.php"); ?>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <?php
      if (isset($_POST['category_id']) || isset($_SESSION['category_id'])) {
          $id = isset($_POST['category_id']) ? $_POST['category_id'] : $_SESSION['category_id'];
          unset($_SESSION['category_id']);

          $category = getbyid("category", $id);

          if (mysqli_num_rows($category) > 0) {
              $data = mysqli_fetch_array($category);
      ?>
      <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
          <h4 class="font-weight-bold">Edit Category</h4>
        </div>
        <div class="card-body">
          <form action="categorycode.php" method="POST">
            <input type="hidden" name="category_id" value="<?php echo $data['ID']; ?>">
            <div class="row">
              <!-- Category Name -->
              <div class="col-md-12 mb-3">
                <label for="name"><strong>Category Name</strong></label>
                <input type="text" id="name" class="form-control" name="name" value="<?php echo htmlspecialchars($data['Cate_Name']); ?>" placeholder="Enter Category Name" required>
              </div>
              <!-- Category Description -->
              <div class="col-md-12 mb-3">
                <label for="description"><strong>Description</strong></label>
                <textarea id="description" rows="4" class="form-control" name="description" placeholder="Enter Category Description"><?php echo htmlspecialchars($data['Cate_Description']); ?></textarea>
              </div>
              <!-- Status Checkbox -->
              <div class="col-md-12 mb-3">
                <div class="form-check">
                  <input type="checkbox" id="status" class="form-check-input" name="status" <?php echo $data['Cate_Status'] ? "checked" : ""; ?>>
                  <label class="form-check-label" for="status"><strong>Active</strong></label>
                </div>
              </div>
            </div>
            <!-- Action Buttons -->
            <div class="d-flex justify-content-between mt-4">
              <button type="submit" name="updatecategorybtn" class="btn btn-success">
                <i class="fa fa-check-circle"></i> Save
              </button>
              <a href="categories.php" class="btn btn-secondary">
                <i class="fa fa-angle-double-left"></i> Return
              </a>
            </div>
            <!-- Feedback Message -->
            <?php
            if (isset($_SESSION['message'])) {
                $message = $_SESSION['message'];
                echo "<div class='alert alert-info mt-3'>$message</div>";
                unset($_SESSION['message']);
            }
            ?>
          </form>
        </div>
      </div>
      <?php
          } else {
              echo "<div class='alert alert-warning text-center'>Category not found</div>";
          }
      } else {
          echo "<div class='alert alert-danger text-center'>ID is missing from the request!</div>";
      }
      ?>
    </div>
  </div>
</div>

<?php include("includes/footer.php"); ?>
<?php include("includes/scripts.php"); ?>
