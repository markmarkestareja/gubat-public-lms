<!-- Modal -->
<div class="modal fade" id="editPatron" tabindex="-1" aria-labelledby="editPatronLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Transaction Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="patron.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                    <label for="fName">First Name</label>
                    <input type="text" class="form-control" id="fName" name="fName" 
                    required value="<?php echo isset($patron) ? $patron['fName'] : ''; ?>">
                </div>


                <div class="form-group">
                    <label for="mInitial">Middle Initial</label>
                    <input type="text" class="form-control" id="mInitial" name="mInitial" 
                    required value="<?php echo isset($patron) ? $patron['mInitial'] : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="lName">Last Name</label>
                    <input type="text" class="form-control" id="lName" name="lName" 
                    required value="<?php echo isset($patron) ? $patron['lName'] : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="user_email">Username</label>
                    <input type="text" class="form-control" id="user_email" name="user_email" 
                    required value="<?php echo isset($patron) ? $patron['user_email'] : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="user_pass">Password</label>
                    <input type="text" class="form-control" id="user_pass" name="user_pass" 
                    required value="<?php echo isset($patron) ? $patron['user_pass'] : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select class="form-control" id="gender" name="gender" required>
                        <option value="male" <?php echo (isset($patron) && $patron['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                        <option value="female" <?php echo (isset($patron) && $patron['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="age">Age</label>
                    <input type="text" class="form-control" id="age" name="age" 
                    required value="<?php echo isset($patron) ? $patron['age'] : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="b_date">Birth Date</label>
                    <input type="date" class="form-control" id="b_date" name="b_date" 
                    required value="<?php echo isset($patron) ? $patron['b_date'] : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" 
                    required value="<?php echo isset($patron) ? $patron['address'] : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="contact_num">Contact Number</label>
                    <input type="text" class="form-control" id="contact_num" name="contact_num" 
                    required value="<?php echo isset($patron) ? $patron['contact_num'] : ''; ?>">
                </div>

                <div class="form-group" style="display: none;">
                    <label for="type">Type</label>
                    <input type="text" class="form-control" id="type" name="type" required value="Patron">
                </div>

                <!-- Hidden input for user_id -->
                <input type="hidden" name="user_ID" value="<?php echo isset($patron) ? $patron['user_ID'] : ''; ?>">

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button name="edit_patron" type="submit" class="btn btn-primary">
                        <?php echo isset($row) ? 'Update' : 'Confirm'; ?> 
                    </button>
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

