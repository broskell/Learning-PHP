<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>India State & City Filter</title>
    <style>
        body { font-family: sans-serif; padding: 20px; background-color: #f4f4f9; }
        .container { max-width: 400px; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        select { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 4px; }
        label { font-weight: bold; }
    </style>
</head>
<body>

<div class="container">
    <h2>Location Selector</h2>
    
    <label for="state">State</label>
    <select id="state" onchange="filterCities()">
        <option value="">-- All States --</option>
    </select>

    <label for="city">City</label>
    <select id="city">
        <option value="">-- Select City --</option>
    </select>
</div>

<script>
    // Using a reliable public data source for Indian States and Cities
    const dataSource = "https://raw.githubusercontent.com/sab99r/Indian-States-And-Districts/master/states-and-districts.json";
    
    let locationData = {};

    // 1. Fetch data from the API/JSON source
    async function loadData() {
        try {
            const response = await fetch(dataSource);
            const data = await response.json();
            locationData = data.states;
            populateStates();
            filterCities(); // Initial load to show all cities
        } catch (error) {
            console.error("Error loading location data:", error);
        }
    }

    // 2. Populate the State Dropdown
    function populateStates() {
        const stateSelect = document.getElementById('state');
        locationData.forEach(item => {
            let option = document.createElement('option');
            option.value = item.state;
            option.textContent = item.state;
            stateSelect.appendChild(option);
        });
    }

    // 3. Filter Cities based on State selection
    function filterCities() {
        const stateSelect = document.getElementById('state').value;
        const citySelect = document.getElementById('city');
        
        // Clear existing options
        citySelect.innerHTML = '<option value="">-- Select City --</option>';

        if (stateSelect) {
            // Find the specific state and show its cities (districts)
            const selectedStateObj = locationData.find(s => s.state === stateSelect);
            if (selectedStateObj) {
                selectedStateObj.districts.forEach(city => {
                    addCityOption(citySelect, city);
                });
            }
        } else {
            // If no state is selected, show ALL cities in India
            locationData.forEach(item => {
                item.districts.forEach(city => {
                    addCityOption(citySelect, city);
                });
            });
        }
    }

    function addCityOption(selectElement, cityName) {
        let option = document.createElement('option');
        option.value = cityName;
        option.textContent = cityName;
        selectElement.appendChild(option);
    }

    // Initialize
    loadData();
</script>

</body>
</html>