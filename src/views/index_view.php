<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Search</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>

<div class="search-container">
    <h2>Search for Donors</h2>
    <form id="search-form" action="search.php" method="get">
        <div id="criteria-container">
            <div class="criteria">
                <select name="criteria[]">
                    <option value="name">Name</option>
                    <option value="first_name">First Name</option>
                    <option value="email">Email</option>
                    <option value="phone_number">Phone Number</option>
                    <option value="sex">Sex</option>
                    <option value="age">Age</option>
                </select>
                <input type="text" name="value[]" required>
                <button type="button" class="remove-criteria">Remove</button>
            </div>
        </div>
        <div class="button-container">
            <button type="button" id="add-criteria">Add Criteria</button>
            <button type="submit">Search</button>
            <a id="add-donor" href="add.php">Add Donor</a>
        </div>
    </form>
</div>

<script src="../assets/js/searchCriteria.js"></script>
</body>
</html>
