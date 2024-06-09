<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Donors</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>

<div class="search-container">
    <h2>Search Results</h2>
    <div class="donor-list">
        <?php if (empty($donors)): ?>
            <p>No donors found</p>
        <?php endif; ?>
        <?php foreach ($donors as $donor): ?>
            <div class="donor-item">
                <a href="donor_details.php?id=<?= $donor->getId() ?>">
                    <?= $donor->getName() ?>
                    <?= $donor->getFirstName() ?>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>