window.openPopup = function openPopup() {
    document.getElementById('popup').classList.remove('hidden');
    document.getElementById('popup').classList.add('block');

    // Prepare payload
    const payload = {
        user_id: userId // Assuming you are using Laravel's authentication and 'id' is the user ID
    };
    let url = window.location.protocol + "//" + location.host.split(":")[0] + '/api/game/play';
    const responseDiv = document.getElementById('apiResponse');

    // Call API and print response
    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(payload)
    })
        .then(response => {
            if (!response.ok) {
                responseDiv.innerHTML = response.statusText
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            const result = data.data.result;
            const state = data.data.state;
            const prize = data.data.prize;

            responseDiv.innerHTML = `
                        <p>Number: ${result}</p>
                        <p>${state}</p>
                        <p>Prize: ${prize}</p>
                    `;
        })
        .catch(error => {
            console.log(error);
        });
}

window.closePopup = function closePopup() {
    document.getElementById('popup').classList.remove('block');
    document.getElementById('popup').classList.add('hidden');
    const historyContainer = document.getElementById('apiResponse');
    historyContainer.innerHTML = '';
}

window.getGameHistory = function getGameHistory() {
    document.getElementById('popup').classList.remove('hidden');
    document.getElementById('popup').classList.add('block');
    const historyContainer = document.getElementById('apiResponse');

    let url = window.location.protocol + "//" + location.host.split(":")[0] + '/api/game/history/' + userId;
    fetch(url)
        .then(response => {
            if (!response.ok) {
                historyContainer.innerHTML = response.statusText
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log('Game history:', data);
            displayGameHistory(data);
        })
        .catch(error => {
            console.error('Error fetching game history:', error);
        });
}

window.displayGameHistory = function displayGameHistory(gameHistory) {
    const historyContainer = document.getElementById('apiResponse');
    historyContainer.innerHTML = ''; // Clear previous content

    if (gameHistory.data.length === 0) {
        historyContainer.innerHTML = '<p>Your history is empty</p>';
        return;
    }

    // Create table element
    const table = document.createElement('table');
    table.classList.add('table-auto', 'border', 'border-collapse', 'w-full');

    // Create table header
    const tableHeader = `
            <thead>
                <tr>
                    <th class="border px-4 py-2">No.</th>
                    <th class="border px-4 py-2">Date</th>
                    <th class="border px-4 py-2">Number</th>
                    <th class="border px-4 py-2">Result</th>
                    <th class="border px-4 py-2">Prize</th>
                </tr>
            </thead>
        `;
    table.innerHTML = tableHeader;

    // Create table body
    const tableBody = document.createElement('tbody');
    gameHistory.data.forEach((game, index) => {
        const result = game.result;
        const state = game.state;
        const prize = game.prize;
        const createdAt = game.date; // Assuming 'created_at' is part of the game history data

        // Create table row
        const row = `
                <tr>
                    <td class="border px-4 py-2">${index + 1}</td>
                    <td class="border px-4 py-2">${createdAt}</td>
                    <td class="border px-4 py-2">${result}</td>
                    <td class="border px-4 py-2">${state}</td>
                    <td class="border px-4 py-2">${prize}</td>
                </tr>
            `;
        tableBody.innerHTML += row;
    });

    table.appendChild(tableBody);
    historyContainer.appendChild(table);
}
