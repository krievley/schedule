$(document).ready(function() {
    getCurrentWeek();
});

function getCurrentWeek() {
    //Get today's date.
    var today = new Date();
    //decrease date until today is a monday.
    while(today.getDay() !== 1) {
        today.setDate(today.getDate()-1);
    }
    //variable to hold the start day of the week.
    var startDay = today;
    alert(startDay);
}
