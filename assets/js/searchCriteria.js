/**
 * This function updates the visibility of the remove buttons.
 * If there is only one criteria, the remove button is hidden.
 * Otherwise, all remove buttons are displayed.
 */
function updateRemoveButtons() {
    const criteriaContainers = document.querySelectorAll('.criteria');
    const removeButtons = document.querySelectorAll('.remove-criteria');

    if (criteriaContainers.length === 1) {
        removeButtons[0].style.display = 'none';
    } else {
        removeButtons.forEach(button => button.style.display = 'inline');
    }
}

/**
 * This function handles the click event for the 'Add Criteria' button.
 * It clones the first criteria, clears the input value, and appends it to the criteria container.
 * Then it updates the remove buttons.
 */
document.getElementById('add-criteria').addEventListener('click', function () {
    const container = document.getElementById('criteria-container');
    const newCriteria = document.querySelector('.criteria').cloneNode(true);

    newCriteria.querySelector('input').value = '';
    container.appendChild(newCriteria);

    updateRemoveButtons();
});

/**
 * This function handles the click event for the 'Remove' button in each criteria.
 * It removes the parent criteria of the clicked button and then updates the remove buttons.
 */
document.getElementById('criteria-container').addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-criteria')) {
        e.target.parentElement.remove();
        updateRemoveButtons();
    }
});

// Call the function initially to hide the remove button if there's only one criteria
updateRemoveButtons();