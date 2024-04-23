// <!DOCTYPE html>
// <html>
// <head>
//     <title>Calculate Total Hours</title>
// </head>
// <body>
//     <label for="start">Start Date and Time:</label>
//     <input type="datetime-local" id="start" name="start"><br><br>
    
//     <label for="end">End Date and Time:</label>
//     <input type="datetime-local" id="end" name="end"><br><br>

//     <button onclick="calculateTotalHours()">Calculate Total Hours</button><br><br>

//     <div id="result"></div>

//     <script>
//         function calculateTotalHours() {
//             var start = document.getElementById("start").value;
//             var end = document.getElementById("end").value;

//             if (start === "" || end === "") {
//                 alert("Please select both a start and end date/time.");
//                 return;
//             }

//             var startDate = new Date(start);
//             var endDate = new Date(end);

//             if (startDate >= endDate) {
//                 alert("End date/time must be after the start date/time.");
//                 return;
//             }

//             var timeDiff = Math.abs(endDate.getTime() - startDate.getTime());
//             var totalHours = Math.ceil(timeDiff / (1000 * 3600));

//             document.getElementById("result").innerText = "Total Hours: " + totalHours;
//         }
//     </script>
// </body>
// </html>
