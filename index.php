<!DOCTYPE html>
<html>
  <head>
    <title>Service Hub - Garage Management Software</title>
  </head>
  <body>
    <h1>Service Hub - Garage Management Software</h1>
   
    <!-- Customer Management -->
    <h2>Customer Management</h2>
    <form method="POST" action="add_customer.php">
      <label for="name">Name:</label>
      <input type="text" id="name" name="name"><br><br>
      <label for="phone">Phone:</label>
      <input type="text" id="phone" name="phone"><br><br>
      <label for="vehicle">Vehicle:</label>
      <input type="text" id="vehicle" name="vehicle"><br><br>
      <input type="submit" value="Add Customer">
    </form>
   
    <!-- Appointment Scheduling -->
    <h2>Appointment Scheduling</h2>
    <form method="POST" action="schedule_appointment.php">
      <label for="customer">Customer:</label>
      <select id="customer" name="customer">
        <option value="">Select a customer</option>
        <?php
          // Connect to database
          $conn = new mysqli("localhost", "username", "password", "garage");

          // Check for errors
          if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }

          // Fetch customers from database
          $sql = "SELECT id, name FROM customers";
          $result = $conn->query($sql);

          // Display customer options
          if ($result) {
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo "<option value=\"" . $row["id"] . "\">" . $row["name"] . "</option>";
              }
            } else {
              echo "<option value=\"\">No customers found</option>";
            }
          } else {
            echo "<option value=\"\">Error fetching customers</option>";
          }

          // Close database connection
          $conn->close();
        ?>
      </select><br><br>
      <label for="date">Date:</label>
      <input type="date" id="date" name="date"
             min="<?php echo date("Y-m-d", strtotime("next Monday")); ?>"
             max="<?php echo date("Y-m-d", strtotime("next Friday")); ?>"><br><br>
      <label for="time">Time:</label>
      <input type="time" id="time" name="time" min="09:00" max="15:00"><br><br>
      <input type="submit" value="Schedule Appointment">
    </form>
   
    <!-- Inventory Management -->
    <h2>Inventory Management</h2>
    <table>
      <tr>
        <th>Item</th>
        <th>Quantity</th>
      </tr>
      <?php
        // Connect to database
        $conn = new mysqli("localhost", "username", "password", "garage");

        // Check for errors
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        // Fetch inventory items from database
        $sql = "SELECT * FROM inventory";
        $result = $conn->query($sql);

        // Display inventory items
        if ($result) {
  while ($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row["item"] . "</td><td>" . $row["quantity"] . "</td></tr>";
  }
}