document.getElementById('pridajPouzivatelaBtn').addEventListener('click', function() {
    const data = {
        first_name: 'Meno',
        last_name: 'Priezvisko',
        username: 'meno.priezvisko',
        password: 'tajneHeslo',
        user_type: 'user',
    };

    fetch('/add-new-user', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': 'tu_musite_pridat_csrf_token_ako_hlavicku', // Ak používate CSRF ochranu
        },
        body: JSON.stringify(data),
    })
    .then(response => response.json())
    .then(data => {
        console.log('Úspešne pridaný nový používateľ:', data);
    })
    .catch((error) => {
        console.error('Chyba pri pridávaní nového používateľa:', error);
    });
});