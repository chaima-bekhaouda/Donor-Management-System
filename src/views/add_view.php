<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Donor</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="icon" href="favicon.ico">
</head>
<body>

<div class="search-container">
    <h2>Add Donor</h2>
    <form id="add-form" action="add.php" method="post">
        <div class="criteria">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="criteria">
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" required>
        </div>
        <div class="criteria">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="criteria">
            <label for="phone_number">Phone Number:</label>
            <input type="text" id="phone_number" name="phone_number" required>
        </div>
        <div class="criteria">
            <label for="sex">Sex:</label>
            <select id="sex" name="sex" required>
                <option value="M">Male</option>
                <option value="F">Female</option>
                <option value="O">Other</option>
            </select>
        </div>
        <div class="criteria">
            <label for="age">Age:</label>
            <input type="number" id="age" name="age" required>
        </div>
        <div class="criteria">
            <label for="weight">Weight:</label>
            <input type="number" id="weight" name="weight" step="0.1" required>
        </div>
        <div class="criteria">
            <label for="temporary_exclusion">Temporary Exclusion:</label>
            <input type="checkbox" id="temporary_exclusion" name="temporary_exclusion">
        </div>
        <div class="criteria">
            <label for="reason_temporary_exclusion">Reason for Temporary Exclusion:</label>
            <input type="text" id="reason_temporary_exclusion" name="reason_temporary_exclusion">
        </div>
        <div class="criteria">
            <label for="permanent_exclusion">Permanent Exclusion:</label>
            <input type="checkbox" id="permanent_exclusion" name="permanent_exclusion">
        </div>
        <div class="criteria">
            <label for="reason_permanent_exclusion">Reason for Permanent Exclusion:</label>
            <input type="text" id="reason_permanent_exclusion" name="reason_permanent_exclusion">
        </div>
        <div class="criteria">
            <label for="last_blood_donation_date">Last Blood Donation Date:</label>
            <input type="date" id="last_blood_donation_date" name="last_blood_donation_date">
        </div>
        <div class="criteria">
            <label for="last_plasma_donation_date">Last Plasma Donation Date:</label>
            <input type="date" id="last_plasma_donation_date" name="last_plasma_donation_date">
        </div>
        <div class="button-container">
            <button type="submit">Add Donor</button>
        </div>
    </form>
</div>

</body>
</html>