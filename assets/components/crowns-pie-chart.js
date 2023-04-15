import Chart from "chart.js";

var chartData = document.querySelector(".chart-data");
var crownLog = JSON.parse(chartData.dataset.crownLog);
var crownLog = crownLog.split(",").map(Number);

const data = {
  labels: ["Triple Crowns", "Double Crowns", "Single Crowns"],
  datasets: [
    {
      data: crownLog,
      backgroundColor: [
        "rgb(2, 117, 216)",
        "rgb(0,0,139)",
        "rgba(2, 117, 216, 0.2)",
      ],
      hoverOffset: 4,
    },
  ],
};
const config = {
  type: "doughnut",
  data: data,
  options: {
    animation: {
      animateRotate: true,
      render: false,
      duration: 2000,
    },
    plugins: {
      legend: {
        display: true,
        position: "bottom",
        labels: {
          boxWidth: 10,
        },
      },
    },
  },
  responsive: true,
  maintainAspectRatio: false,
};


const crownsPieChart = new Chart(document.getElementById("myChart"), config);
