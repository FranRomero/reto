// API endpoint to get the breeds data
const apiUrl = 'https://dogapi.dog/api/v2/breeds';

// Make a GET request using the Fetch API
fetch(apiUrl)
.then(response => {
    if (!response.ok) {
    throw new Error('Network response was not ok');
    }
    return response.json();
})
.then(razas => {
    // Process the retrieved breeds data
    const razasFiltradas = razas.data.filter((raza) => raza.attributes.life.min > 10);
    console.log("Razas filtradas");
    console.log(razasFiltradas);
})
.catch(error => {
    console.error('Error:', error);
});