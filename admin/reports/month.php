<?php
include '../../includes/config.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>One Month Report</title>
</head>
<body>
    <h3>Popularity of Books in past month</h3>
    <table width="94%" align="center">
        <thead>
            <tr>
                <th align="left">Title</th>
                <th align="left">Number of Borrow</th>
            </tr>
        </thead>
        <?php
        // Calculate the date one month from now
        $one_month_ago = date('Y-m-d', strtotime('-1 month'));

        // Modify the SQL query to select the book ID and count the occurrences in the transaction table
        $query = mysqli_query($conn, "SELECT ISBN, COUNT(*) AS borrow_count 
                        FROM transaction 
                        WHERE status IN ('borrowed', 'returned') 
                        AND date_borrowed >= '$one_month_ago' 
                        GROUP BY ISBN 
                        ORDER BY borrow_count DESC");

        while ($row = mysqli_fetch_assoc($query)) {
            $book_id = $row['ISBN'];
            $borrow_count = $row['borrow_count'];

            // Retrieve the book title using the book ID
            $book_query = mysqli_query($conn, "SELECT bk_title FROM book WHERE ISBN = '$book_id'");
            if ($book_query && mysqli_num_rows($book_query) > 0) {
                $book_row = mysqli_fetch_assoc($book_query);
                $bk_title = $book_row['bk_title'];
            } else {
                $bk_title = "Title Not Found"; // Or any default value you prefer
            }
            ?>
            <tr>
                <td width="35%" valign="top">
                    <?php echo $bk_title; ?> <br>
                </td>
                <td width="30%" valign="top">
                    <?php echo $borrow_count; ?> <br>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
