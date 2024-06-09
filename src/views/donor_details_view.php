<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Details</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="icon" href="favicon.ico">
</head>
<body>

<div class="search-container">
    <h2>Donor Details</h2>
    <div class="donor-details">
        <p><strong>Name:</strong> <?= $donor->getName() ?></p>
        <p><strong>First Name:</strong> <?= $donor->getFirstName() ?></p>
        <p><strong>Email:</strong> <?= $donor->getEmail() ?></p>
        <p><strong>Phone Number:</strong> <?= $donor->getPhoneNumber() ?></p>
        <p><strong>Sex:</strong> <?= $donor->getSex() ?></p>
        <p><strong>Age:</strong> <?= $donor->getAge() ?></p>
        <p><strong>Weight:</strong> <?= $donor->getWeight() ?></p>
        <p><strong>Temporary Exclusion:</strong> <?= $donor->getTemporaryExclusion() ? 'Yes' : 'No' ?></p>
        <p><strong>Reason for Temporary Exclusion:</strong> <?= $donor->getReasonTemporaryExclusion() ?></p>
        <p><strong>Permanent Exclusion:</strong> <?= $donor->getPermanentExclusion() ? 'Yes' : 'No' ?></p>
        <p><strong>Reason for Permanent Exclusion:</strong> <?= $donor->getReasonPermanentExclusion() ?></p>
        <p><strong>Last Blood Donation Date:</strong> <?= $donor->getLastBloodDonationDate() ?></p>
        <p><strong>Last Plasma Donation Date:</strong> <?= $donor->getLastPlasmaDonationDate() ?></p>
        <p><strong>Can donate blood:</strong>
            <span
                class="<?= $donorCanDonate ? 'green' : 'red' ?>"><?= $donorCanDonate ? 'Yes' : 'No' ?>
            </span>
        </p>
    </div>
    <div class="button-container">
        <a href="index.php">Back to Search</a>
    </div>
</div>

<script src="../assets/js/confetti.js"></script>
</body>
</html>