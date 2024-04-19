<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Concerts</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee&family=Inter:wght@100..900&family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    <style>
    </style>
</head>
<body>
    <script>
        // For each artist
        // Do an attraction search to get attractionId
        // Do an events search with attractionId

        function attractionSearch(url) {
            fetch(url)
            .then (res => res.text())
            .then (data =>
            {
                data = JSON.parse(data);
                // If artist is found, proceed
                if (data.page.totalElements > 0) {
                    // Get attractionId
                    id = data._embedded.attractions[0].id;
                    eventSearchURL = `https://app.ticketmaster.com/discovery/v2/events.json?attractionId=${id}&apikey=1IiUV6YIvdbcA2xr6D9bBGrKOIao6VGb&size=1`;
                    // Do event search
                    const response = eventSearch(eventSearchURL); 
                    
                } else {
                    console.log("No artist found");
                }
                
            })
            .catch (error => console.log(error))
        }

        function eventSearch(url) {
            fetch(eventSearchURL)
            .then (eventRes => eventRes.text())
            .then (eventData => 
                {
                    eventData = JSON.parse(eventData);
                    eventName = eventData._embedded.events[0].name; 
                    artistName = eventData._embedded.events[0]._embedded.attractions[0].name;          
                    venue = eventData._embedded.events[0]._embedded.venues[0].name; 
                    date = eventData._embedded.events[0].dates.start.localDate; 
                    localTime = eventData._embedded.events[0].dates.start.localTime; 
                    city = eventData._embedded.events[0]._embedded.venues[0].city.name; 
                    state = eventData._embedded.events[0]._embedded.venues[0].state.name; 
                    country = eventData._embedded.events[0]._embedded.venues[0].country.name;  
                    url = eventData._embedded.events[0].url; 

                    // Fill hidden form fields with data
                    document.forms["event"]["eventName"].value = eventName;
                    document.forms["event"]["artistName"].value = artistName; 
                    document.forms["event"]["venue"].value = venue; 
                    document.forms["event"]["date"].value = date; 
                    document.forms["event"]["localTime"].value = localTime; 
                    document.forms["event"]["city"].value = city; 
                    document.forms["event"]["state"].value = state; 
                    document.forms["event"]["country"].value = country; 
                    document.forms["event"]["url"].value = url; 

                    // Auto submit form to pass data to PHP
                    document.forms["event"].submit();
                })
            .catch (error => console.log(error))
        }

        async function fetchData() {
            const artists = ["Pink Pantheress", "Psychedelic Porn Crumpets", "Adele", "Maggie Rogers", "Death Cab for Cutie"];
            // const artists = ["Pink Pantheress", "asdfkjh", "Psychedelic Porn Crumpets", "Adele"];
            // const artists = ["adele", "asdkfj"];
            for (const artist of artists) {
                // console.log("artist: " + artist)
                attractionSearchURL = `https://app.ticketmaster.com/discovery/v2/attractions.json?keyword=${artist}&apikey=1IiUV6YIvdbcA2xr6D9bBGrKOIao6VGb&size=1`
                // Do attraction search to get attractionId
                attractionSearch(attractionSearchURL);

                // Delay to satisfy rate limit (max 5 requests per second)
                await new Promise(resolve => setTimeout(resolve, 500));
            }
        }

        // Get data from Ticketmaster
        fetchData();
        
    </script>
    <?php
        echo "<form id='eventForm' name='event' method='get' action='process_event.php'>";
        echo "<input type='hidden' name='eventName'>";
        echo "<input type='hidden' name='artistName'>";
        echo "<input type='hidden' name='venue'>";
        echo "<input type='hidden' name='date'>";
        echo "<input type='hidden' name='localTime'>";
        echo "<input type='hidden' name='city'>";
        echo "<input type='hidden' name='state'>";
        echo "<input type='hidden' name='country'>";
        echo "<input type='hidden' name='url'>";
        echo "</form>"

    ?>
</body>
</html>