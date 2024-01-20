// Add JavaScript to handle the AJAX request
document.getElementById('filterButton').addEventListener('click', function () {
    // Get form data
    var formData = new FormData(document.getElementById('filterForm'));

    // Make AJAX request
    axios.post('/jobs/filter', formData)
        .then(function (response) {
            // Update the results section with the filtered data
            var jobResultsContainers = document.getElementsByClassName('jobResults');
            
            // Clear previous results
            Array.from(jobResultsContainers).forEach(function (container) {
                container.innerHTML = '';
            });

            if (response.data.jobs.length > 0) {
                response.data.jobs.forEach(function (job) {
                    // Create a new row for each job card
                    var row = document.createElement('div');
                    row.className = 'row jobResults';

                    // Create a new job card
                    var jobCard = document.createElement('div');
                    jobCard.className = 'col-md-6 card mx-auto';
                    
                    // Generate the job details URL using the base URL and job ID
                    var jobDetailsUrl = jobDetailsBaseUrl + job.id;

                    // Create the anchor tag with the generated URL
                    jobCard.innerHTML = '<a href="' + jobDetailsUrl + '">' + job.odbor + ' - ' + job.nazov + '</a>' +
                        '<p>Vedúci: ' + job.veduci + '</p>' +
                        '<p>' + limitCharacters(job.popis, 300) + '</p>' + // Limit characters for job description
                        '<p>Stav: ' + job.stav + '</p>';

                    // Append the job card to the row
                    row.appendChild(jobCard);

                    // Append the row to the results container
                    jobResultsContainers[0].appendChild(row);
                });
            } else {
                // Display a message when no jobs are found
                Array.from(jobResultsContainers).forEach(function (container) {
                    var noResultsMessage = document.createElement('p');
                    noResultsMessage.textContent = 'Neboli nájdené žiadne výsledky.';
                    container.appendChild(noResultsMessage);
                });
            }
        })
        .catch(function (error) {
            console.error('Error making AJAX request:', error);

            // Log the server response
            if (error.response) {
                console.error('Server response data:', error.response.data);
                console.error('Server response status:', error.response.status);
                console.error('Server response headers:', error.response.headers);
            }
        });
});

// Function to limit characters in a string
function limitCharacters(str, limit) {
    return str.length > limit ? str.slice(0, limit) + '...' : str;
}
