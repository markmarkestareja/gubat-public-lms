<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Catalog</title>
            <!-- Bootstrap -->
        <!-- jQuery (necessary for Bootstrap’s JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="../style/js/bootstrap.min.js"></script>
        <script src="../style/js/bootstrap.bundle.min.js"></script>
        <link href="../style/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="../style/css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    </head>
    <body class="sb-nav-fixed">
    <?php include '../includes/topnav_patron.php'?>
        <div id="layoutSidenav">

            <!----SideNav---->

            <?php include '../includes/sidenav.php';?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Library Catalog</h1>
                    
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Catalog</li>
                        </ol>

                        <div class="container">

                        <div class="row">
                        <div class="col-sm-12">
                            <button class="btn btn-danger">New Catalog</button>
                            <button class="btn btn-primary">Subjects</button>
                            <button class="btn btn-warning">Authors</button>
                            <button class="btn btn-success">Lists</button>
                            <div class="btn-group">
                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Sort
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item sort-option" href="#" data-sort="newest">Newest</a>
                                    <a class="dropdown-item sort-option" href="#" data-sort="oldest">Oldest</a>
                                    <a class="dropdown-item sort-option" href="#" data-sort="title">Title</a>
                                    <a class="dropdown-item sort-option" href="#" data-sort="author">Author</a>
                                </div>
                            </div>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Reports
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item report-option" href="#" data-report="byTitle">By Title</a>
                                    <a class="dropdown-item report-option" href="#" data-report="byAuthor">By Author</a>
                                    <a class="dropdown-item report-option" href="#" data-report="byAuthor">By Location, Cell Number</a>
                                    <a class="dropdown-item report-option" href="#" data-report="byAuthor">Custom Report</a>
                                    <a class="dropdown-item report-option" href="#" data-report="byAuthor">New Records by Month</a>
                                    <a class="dropdown-item report-option" href="#" data-report="byAuthor">Catalog Circulation by Month</a>
                                    <a class="dropdown-item report-option" href="#" data-report="byAuthor">Top Circulation Title</a>
                                    <a class="dropdown-item report-option" href="#" data-report="byAuthor">Never Circulated Title</a>
                                    <a class="dropdown-item report-option" href="#" data-report="byAuthor">Reserves by Release Date</a>
                                    <a class="dropdown-item report-option" href="#" data-report="byAuthor">Library Summary</a>
                                    <!-- Add more reports as needed -->
                                </div>
                            </div>
                            
                    </div>
                    <form action="catalog.php" class="form-horizontal" name="form1" method="GET">
                    <br>
                        <div class="form-group">
                            <div class="row">
                            <div class="col-sm-3">
                            <select name="cat_field_name" id="select_menu" class="form-control">
                                <option value='All Fields' selected>All Fields</option>
                                <option value='All Fields'>All Fields</option>
                                <option value='Title'>Title</option>
                                <option value='Title Begins With'>Title Begins With</option>
                                <option value='Author'>Author</option>
                                <option value='Author Begins With'>Author Begins With</option>
                                <option value='Subject'>Subject</option>
                                <option value='Subject Begins With'>Subject Begins With</option>
                                <option value='Series'>Series</option>
                                <option value='Publication Date'>Publication Date</option>
                                <option value='ISBN'>ISBN</option>
                                <option value='ISSN'>ISSN</option>
                                <option value='Target Audience'>Target Audience</option>
                                <option value='Reading Level'>Reading Level</option>
                                <option value='Modified'>Modification</option>
                                <option disabled>-------------------</option>
                                <option value='Barcode'>Barcode</option>
                                <option value='Call Number'>Call Number</option>
                                <option value='Location'>Location</option>
                                <option value='Branch'>Branch</option>
                                <option value='Collection'>Collection</option>
                                <option value='Status'>Status</option>
                                <option disabled>-------------------</option>
                                <option value='List'>List</option>
                            </select>
                            </div>
                            &nbsp;
                            <div class="col-sm-4">
                                <input type="text" name="term" id="term" placeholder="" class="form-control" autofocus="autofocus" onfocus="this.select()" value="">
                                <input type="hidden" name="command" value="search">
                            </div>
                            &nbsp;
                            <div class="col-sm-4"> <!-- Adjusted grid class and added text-right class -->
                                <input type="hidden" name="command" value="search">
                                <button type="submit" class="btn btn-primary btn-xl " name="button" value="search">Search</button>  &nbsp; &nbsp;
                                <button type="submit" class="btn btn-standard btn-xl" name="button" value="clear">Clear</button>
                                &nbsp; <a href="catalog.php?adv=on">Advanced Search</a>
                            </div>
                        </div>
                    </form>



                    <!----Tables----->
                    </div>

                    <div class="table-responsive">
                            <div class="col">
                    <div class=row>
	                <div class=col-sm-5> Showing 1 to 1 of 1 sort by Newest </div>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ISBN</th>
                                            <th>Title</th>
                                            <th>Name</th>
                                            <th>Publisher</th>
                                            <th>Author</th>
                                            <th>Publisher Date</th>
                                            <th>Edition</th>
                                            <th>Copies</th>
                                            <th>Cost</th>
                                            <th>Date Acquired</th>
                                            <th>Purchased From</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <!----Retrive Data---->
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <!--End--->
                <?php include 'footer.php'; ?>
            </div>
        </div>
        <?php include 'footer.php'; ?>


        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../style/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="../style/assets/demo/chart-area-demo.js"></script>
        <script src="../style/assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="../style/js/datatables-simple-demo.js"></script>

    </body>
</html>
