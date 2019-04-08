<h2> <?= $title; ?> </h2>

<?php echo validation_errors(); ?>

<?php echo form_open('categories/create'); ?>
    <div class="form-group">
        <label for="category_name">Category</label>
        <input type="text" class="form-control" name="category_name" placeholder="Enter Category">
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-default">SUBMIT</button>
    </div>
</form>
