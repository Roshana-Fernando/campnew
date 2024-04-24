<?php
      require 'config.php';

        if(!isset($_SESSION['email'])){
            header('location: ../login/login.php');
        }

        $email = $_SESSION['email'];
        $sql = "SELECT d_id FROM driver WHERE email = '$email'";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $driverId = $row['d_id']; 
         } else {
                // If user is not found, return an error message
                $response = array('status' => 'error', 'message' => 'User not found.');
                echo json_encode($response);
                exit(); // Stop script execution
            }
// Sample function to get bookings related to a specific driver
function getBookingsForDriver($driverId) {
    // Database connection
    require 'config.php';
    // SQL query to fetch bookings for the driver
    $sq = "SELECT * FROM bookings WHERE d_id = $driverId";
    // Execute query
    $reslt = mysqli_query($con, $sq);

    // Check if there are any results
   
    if (mysqli_num_rows($reslt) > 0) {
        // Return the result set
        return $reslt;
    } else {
        // If no bookings found, return null or an empty array as per your requirement
        return null;
    }

    // Close connection
    mysqli_close($con);
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Bookings</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="../css/Driver/admin.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 
    <style>
        .ad{
            margin-left:50px;
            margin-top: 30px;
        }
        .button-container {
      display: flex;
      gap: 10px;
    }

    .accept-button, .cancel-button, .confirmed-button, .completed-button, .cancelled-button{
      padding: 5px 10px;
      border: none;
      cursor: pointer;
      border-radius: 5px;
      font-size: 14px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
    }

    .accept-button {
      background-color: #4caf50;
      color: white;
    }
    .confirmed-button{
        background-color: #4caf50;
        color: white;
    }
    .cancel-button {
      background-color: #f44336;
      color: white;
    }
    .completed-button{
        background-color:  #446a9c;
      color: white;
    }
    .cancelled-button{
        background-color: #f44336;
      color: white;
    }
    .details .recentOrders {
  position: relative;
  display: grid;
  min-height: 200px;
  background: var(--white);
  padding: 20px;
  box-shadow: 0 7px 25px rgba(0, 0, 0, 0.08);
  border-radius: 20px;
}
    </style>
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            
        <?php include 'driver_sb.php'; ?>
                
        </div>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="search">
                    <label>
                        <input type="text" id="gfg" placeholder="Search here">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>

                <div class="user">
                    <img src="images/customer01.jpg" alt="">
                </div>
            </div>
           

            <!-- ================ Order Details List ================= -->
            <div class="ad">
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>Bookings </h2>
                        <a href="#" class="btn">View All</a>
                    </div>

                    <table>
                        <thead>
                        
                            <tr>
                                <td>Name</td>
                                <td>User ID</td>
                                <td>Contact</td>
                                <td>Date</td>
                                <td>Time</td>
                                <td>Pick-up </td>
                                <td>Drop-off </td>
                                <td>Adults</td>
                                <td>Children</td>
                                <td>Status</td>
                            </tr>
                        </thead>

                        <tbody id="geeks">
                        <?php
                // Assuming $driverId contains the driver's ID (you need to retrieve this from somewhere)
                // Example ID, replace with actual driver ID
                $bookings = getBookingsForDriver($driverId);

                if ($bookings) {
                    while ($row = mysqli_fetch_assoc($bookings)) {
                         
                        echo "<tr>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['UserId'] . "</td>";
                        echo "<td>" . $row['contact'] . "</td>";
                        echo "<td>" . $row['booking_date'] . "</td>";
                        echo "<td>" . $row['booking_time'] . "</td>";
                        echo "<td>" . $row['pickup_location'] . "</td>";
                        echo "<td>" . $row['dropoff_location'] . "</td>";
                        echo "<td>" . $row['adults'] . "</td>";
                        echo "<td>" . $row['children'] . "</td>";
                        echo "<td>";
                        if ($row['booking_status'] == 0) { // Pending
                            echo "<form id='form_accept_" . $row['booking_id'] . "' action='update_booking.php' method='POST'>";
                            echo "<input type='hidden' name='id' value='" . $row['booking_id'] . "'>";
                            echo "<input type='hidden' name='status' value='1'>"; // Change status to Confirmed
                            echo "<button type='button' id='accept_button_" . $row['booking_id'] . "' class='accept-button' onclick='acceptBooking(" . $row['booking_id'] . ")'>Accept</button>";
                            echo "<button type='button' class='cancel-button' onclick='cancelBooking(" . $row['booking_id'] . ")'>Cancel</button>";
                            echo "</form>";
                        } elseif ($row['booking_status'] == 1) { // Confirmed
                            echo "<button class='confirmed-button' id='confirm_button_" . $row['booking_id'] . "' onclick='markCompleted(" . $row['booking_id'] . ")'>Confirmed</button>";
                            echo "<button type='button' class='cancel-button' onclick='cancelBooking(" . $row['booking_id'] . ")'>Cancel</button>";
                        } elseif ($row['booking_status'] == 2) { // Completed
                            echo "<button class='completed-button' disabled>Completed</button>";
                        } elseif ($row['booking_status'] == 3) { // Cancelled
                            echo "<button class='cancelled-button' disabled>Cancelled</button>";
                        }
                        
                        echo "</td>";
                
                
                        // Add more columns as needed
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No bookings found for this driver.</td></tr>";
                }
                ?>
                        </tbody>
                    </table>
                    <script>
function acceptBooking(id) {
    if (confirm("Are you sure you want to mark this booking as confirmed?")) {
    $.ajax({
        url: 'update_booking.php',
        method:"POST",
        data: { id: id, status: 1 }, // Change status to 1 (Confirmed)
        dataType:"json",
        success: function(response) {
            if (response.success) {
                // Update the button text and class
                $('#accept_button_' + id).text('Confirmed').removeClass('accept-button').addClass('confirmed-button').prop('onclick', null).off('click');
                $('#cancel_button_' + id).remove(); // Remove the cancel button
                alert('Booking confirmed');
            } else {
                alert('Failed to confirm booking');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error: ' + error);
            alert('An error occurred while confirming booking');
        }
    });
}
}


function markCompleted(id) {
    $.ajax({
        url: 'update_booking.php',
        method:"POST",
        data: { id: id, status: 2 }, // Change status to 2 (Completed)
        dataType:"json",
        success: function(response) {
            if (response.success) {
                $('#booking_' + id + '_button').text('Completed').removeClass('confirmed-button').addClass('completed-button').prop('disabled', true);
                alert('Booking marked as completed');
            } else {
                alert('Failed to mark booking as completed');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error: ' + error);
            alert('An error occurred while marking booking as completed');
        }
    });
}


function cancelBooking(id) {
    if (confirm("Are you sure you want to cancel?")) {
    $.ajax({
        url: 'update_booking.php',
        method:"POST",
        data: { id: id, status: 3 }, // Change status to 3 (Cancelled)
        dataType:"json",
        success: function(response) {
            if (response.success) {
                $('#booking_' + id + '_button').text('Cancelled').removeClass('accept-button').removeClass('confirmed-button').addClass('cancelled-button').prop('disabled', true);
                alert('Booking cancelled');
            } else {
                alert('Failed to cancel booking');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error: ' + error);
            alert('An error occurred while cancelling booking');
        }
    });
}
}
</script>
                </div>
                </div>

                <script>
        $(document).ready(function () {
            $("#gfg").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#geeks tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
    <!-- ====== ionicons ======= -->
</body>

</html>