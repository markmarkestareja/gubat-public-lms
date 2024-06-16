<!-- Modal -->
<div class="modal fade" id="editAccount" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel" style="text-align: center;">Edit Account</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="account_settings.php" method="post">
                    <input type="hidden" name="user_ID" value="<?php echo isset($row['user_ID']) ? $row['user_ID'] : ""; ?>">
                    <table class="table">
                        <thead></thead>
                        <tbody>
                            <tr>
                                <th class="row"><strong>First Name:</strong></th>
                                <td><input type="text" name="fName" value="<?php echo isset($row['fName']) ? $row['fName'] : ""; ?>"></td>
                            </tr>
                            <tr>
                                <th class="row"><strong>Middle Initial:</strong></th>
                                <td><input type="text" name="mInitial" value="<?php echo isset($row['mInitial']) ? $row['mInitial'] : ""; ?>"></td>
                            </tr>
                            <tr>
                                <th class="row"><strong>Last Name:</strong></th>
                                <td><input type="text" name="lName" value="<?php echo isset($row['lName']) ? $row['lName'] : ""; ?>"></td>
                            </tr>
                            <tr>
                                <th class="row"><strong>Age:</strong></th>
                                <td><input type="text" name="age" value="<?php echo isset($row['age']) ? $row['age'] : ""; ?>"></td>
                            </tr>
                            <tr>
                                <th class="row"><strong>Gender:</strong></th>
                                <td>
                                    <select name="gender">
                                        <option value="Male" <?php echo (isset($row['gender']) && $row['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                                        <option value="Female" <?php echo (isset($row['gender']) && $row['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                                        <option value="Other" <?php echo (isset($row['gender']) && $row['gender'] == 'Other') ? 'selected' : ''; ?>>Other</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th class="row"><strong>Birthday:</strong></th>
                                <td><input type="date" name="b_date" value="<?php echo isset($row['b_date']) ? $row['b_date'] : ""; ?>"></td>
                            </tr>
                            <tr>
                                <th class="row"><strong>Address:</strong></th>
                                <td><input type="text" name="address" value="<?php echo isset($row['address']) ? $row['address'] : ""; ?>"></td>
                            </tr>
                            <tr>
                                <th class="row"><strong>Contact Number:</strong></th>
                                <td><input type="text" name="contact_num" value="<?php echo isset($row['contact_num']) ? $row['contact_num'] : ""; ?>"></td>
                            </tr>
                            <tr>
                                <th class="row"><strong>Username:</strong></th>
                                <td><input type="text" name="user_email" value="<?php echo isset($row['user_email']) ? $row['user_email'] : ""; ?>"></td>
                            </tr>
                            <tr>
                                <th class="row"><strong>Password:</strong></th>
                                <td><input type="text" name="user_pass" value="<?php echo isset($row['user_pass']) ? $row['user_pass'] : ""; ?>"></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button name="updateAccount" type="submit" class="btn btn-primary">
                            Update Account
                        </button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
