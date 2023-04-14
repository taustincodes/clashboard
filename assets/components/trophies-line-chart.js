import Chart from "chart.js";
var chartData = document.querySelector(".chart-data");

var graphData = JSON.parse(chartData.dataset.trophyProgression);
var graphData = {
  x: graphData.x.split(",").map(Number),
  y: graphData.y.split(",").map(Number),
};

const ctx = document.getElementById("myChart2").getContext("2d");

const data = {
  labels: graphData.x,
  datasets: [
    {
      label: "Trophies",
      data: graphData.y,
      backgroundColor: ["rgba(2, 117, 216, 0.2)"],
      borderColor: ["rgb(2, 117, 216)"],
      fill: true,
    },
  ],
};

const config = {
  type: "line",
  data: data,
  options: {
    scales: {
      x: {
        display: true,
        title: {
          display: true,
          text: "Battle",
          color: "rgb(0,0,139)",
        },
        grid: {
          display: false,
        },
      },
      y: {
        display: true,
        title: {
          display: true,
          text: "Trophies",
          color: "rgb(0,0,139)",
        },
        grid: {
          display: false,
        },
      },
    },

    plugins: {
      legend: {
        display: false,
      },
    },
  },
  responsive: true,
  maintainAspectRatio: false,
};

const trophiesLineChart = new Chart(ctx, config);
