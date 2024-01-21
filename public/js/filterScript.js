document.getElementById('filterButton').addEventListener('click', function () {

    var formData = new FormData(document.getElementById('filterForm')); // ziskaj form data
    
    axios.post('/jobs/filter', formData) // AJAX
        .then(function (response) {

            var jobResultsContainers = document.getElementsByClassName('jobResults');
            
            Array.from(jobResultsContainers).forEach(function (container) {
                container.innerHTML = '';
            });

            if (response.data.jobs.length > 0) {
                response.data.jobs.forEach(function (job) {

                    var row = document.createElement('div');
                    row.className = 'row jobResults';

                    var jobCard = document.createElement('div');
                    jobCard.className = 'col-md-6 card mx-auto';

                    // vytvorim URL 
                    var jobDetailsUrl = jobDetailsBaseUrl + job.id;

                    jobCard.innerHTML = '<a href="' + jobDetailsUrl + '">' + job.odbor + ' - ' + job.nazov + '</a>' +
                        '<p>Vedúci: ' + job.veduci + '</p>' +
                        '<p>' + limitCharacters(job.popis, 300) + '</p>' + 
                        '<p>Stav: ' + job.stav + '</p>';

                    row.appendChild(jobCard);
                    jobResultsContainers[0].appendChild(row);
                });
            } else {
                var noResultsMessage = document.createElement('p');
                noResultsMessage.textContent = 'Neboli nájdené žiadne výsledky.';
                jobResultsContainers[0]?.appendChild(noResultsMessage);
            }
        })
        .catch(function (error) {
            console.error('Error making AJAX request:', error);
            if (error.response) {
                console.error('Server response data:', error.response.data);
                console.error('Server response status:', error.response.status);
                console.error('Server response headers:', error.response.headers);
            }
        });
});

function limitCharacters(str, limit) {
    return str.length > limit ? str.slice(0, limit) + '...' : str;
}
