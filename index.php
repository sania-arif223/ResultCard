<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <title>Result card</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700,400&display=swap" rel="stylesheet">
     <link rel="stylesheet" href="style.css">

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-header">
                        <h2>Result Card Of Student</h2>
                    </div>
                    <div class="card-body">
                        <div class="col-md-7">
                            <form action="" method="GET">
                                <div class="input-group mb-3">
                                    <input type="text" name="search" required  value="" <?php if(isset($_GET['search'])) {echo $_GET['search'];}?> class="form-control" id="searchInput" placeholder="Search by name or Roll No" onkeyup="filterResults()">
                                    <button class="btn btn-primary" type="submit">Search</button>

                                 </div>
                            </form>
                        </div>
                    </div>

                </div>
            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="value">Id</th>
                                    <th class="value">Name</th>
                                    <th class="value">Roll No</th>
                                    <th class="value">Class</th>
                                    <th class="value">Marks</th>
                                    <th class="value">Status</th>
                                </tr>
                            </thead>
                            <tbody id="resultTable">
                                <?php

                                    $con = mysqli_connect("localhost", "root", "", "results_db");
                                    if(isset($_GET['search']))
                                    {
                                        $filtervalues = $_GET['search'];
                                        // Sanitizing the input to prevent SQL injection
                                         // Fetching the results and displaying them
                                        $query = "SELECT * FROM result_std WHERE CONCAT(Student_name,Roll_number) LIKE '%$filtervalues%' ";
                                        $query_run = mysqli_query($con, $query);
                                        if(mysqli_num_rows($query_run) > 0)
                                        {

                                             // Displaying the student data
                                            foreach($query_run as $items)
                                            {
                                                ?>
                                                <tr>
                                                    <td><?= $items['id']; ?></td>
                                                    <td><?= $items['Student_name']; ?></td>
                                                    <td><?= $items['Roll_number']; ?></td>
                                                    <td><?= $items['Class']; ?></td>
                                                    <td><?= $items['Marks']; ?></td>
                                                    <td><?= $items['Status']; ?></td>
                                                </tr>
                                                <?php
                                            }
                                    }
                                        else
                                        {
                                            ?>
                                              <tr>
                                                <td colspan='4'>No records found <br> Please check the Name or Roll number and try again.
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    // else
                                    // {
                                    //     $query = "SELECT * FROM ";
                                    // }
                                // Sample data for demonstration
                                // $result_std = [
                                //     ['id' => '1', 'Student_name' => 'Alice', 'Roll_number' => '1234', 'Class' => 10th ,'marks' => 450, 'Status' => 'Pass'],
                                //     ['id' => '2', 'Student_name' => 'Jhon', 'Roll_number' => '4563', 'Class' => 10th ,'marks' => 420, 'Status' => 'Pass'],
                                //      ['id' => '2', 'Student_name' => 'Harry', 'Roll_number' => '9803', 'Class' => 10th ,'marks' => 220, 'Status' => 'Fail'],
                                //     // Add more students as needed
                                // ];
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>