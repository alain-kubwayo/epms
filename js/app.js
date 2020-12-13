// Make AJAX call to data.php file to fetch the output (json)
$(document).ready(function(){
    $.ajax({
        url: "http://localhost:8080/epms/data.php",
        method: "GET",
        success: function(data){
            console.log(data);
            var title = [];
            var salary = [];

            for(var i in data){
                title.push(data[i].Job);
                salary.push(data[i].Salary);
            }
            var chartdata = {
                labels: title,
                datasets:[{
                    label: 'Position',
                    backgroundColor: 'rgba(200, 200 200, 0.75)',
                    borderColor: 'rgba(200, 200, 200, 0.75)',
                    hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                    hoverBorderColor: 'rgba(200, 200, 200, 1)',
                    data: salary
                }]
            };
            var ctx = $("#mycanvas");

            var barGraph = new Chart(ctx, {
                type: 'bar',
                data: chartdata
            })
        },
        error: function(data){
            console.log(data);
        }
    });

});