<!-- Modal -->
<div class="modal fade" id="issueBook" tabindex="-1" aria-labelledby="issueBookLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Transaction Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="issue.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                        <div class="form-group">
                            <label for="lib_num">Enter Borrower's Library Number</label>
                            <input type="text" class="form-control mb-2" id="lib_num" name="lib_num" required>
                        </div>
                        <div class="form-group">
                            <label for="ISBN">Enter ISBN</label>
                            <input type="text" class="form-control mb-2" id="ISBN" name="ISBN" required>
                            <button type="button" id="fetchBookDetails" class="btn btn-primary">Show Book Details</button>
                        </div>
                    <div class="form-group mb-3">
                    <div id="bookDetails"></div>
                    <div class="form-group">
                        <label for="due_date">Due Date:</label>
                        <input type="date" id="due_date" name="due_date" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button name="add_book" type="submit" class="btn btn-primary">Issue Book</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#fetchBookDetails').click(function() {
            var ISBN = $('#ISBN').val();
            $.ajax({
                url: 'fetch_book_details.php', // URL to your PHP script that fetches book details
                type: 'POST',
                data: { ISBN: ISBN },
                success: function(response) {
                    $('#bookDetails').html(response);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
