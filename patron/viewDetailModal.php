<!----Modal: Modal Fade, to Input Fields----->
<div class="modal fade" id="viewDetail" tabindex="1" aria-labelledby="viewDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBookModalLabel">Book Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="book.php" method="POST">
                    <div class="form-group">
                        <label for="isbn">ISBN</label>
                        <input type="text" class="form-control" id="isbn" name="ISBN" readonly
                            value="<?php echo isset($row) ? $row['ISBN'] : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="bk_title" name="bk_title" readonly
                            value="<?php echo isset($row) ? $row['bk_title'] : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="author">Author</label>
                        <input type="text" class="form-control" id="author" name="author" readonly
                            value="<?php echo isset($row) ? $row['author'] : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="edition">Edition</label>
                        <input type="text" class="form-control" id="edition" name="edition" readonly
                            value="<?php echo isset($row) ? $row['edition'] : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="copies">Available Copies</label>
                        <input type="number" class="form-control" id="copies" name="copies" readonly
                            value="<?php echo isset($row) ? $row['copies'] : ''; ?>">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
