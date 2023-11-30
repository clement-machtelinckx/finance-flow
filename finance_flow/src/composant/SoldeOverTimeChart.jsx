import React, { useState, useEffect } from 'react';
import { Line } from 'react-chartjs-2';

const SoldeOverTimeChart = ({ id_compte }) => {
  // Déclarer et initialiser chartDataResult en tant que tableau vide
  const [chartDataResult, setChartDataResult] = useState([]);

  // Utiliser chartDataResult pour initialiser le state chartData
  const [chartData, setChartData] = useState({
    labels: [],
    datasets: [
      {
        label: 'Solde au fil du temps',
        data: chartDataResult, // Utiliser chartDataResult ici
        borderColor: 'rgba(75,192,192,1)',
        backgroundColor: 'rgba(75,192,192,0.4)',
        pointRadius: 5,
        pointHoverRadius: 8,
      },
    ],
  });

  useEffect(() => {
    const fetchData = async () => {
      try {
        // Fetch pour récupérer les données du graphique
        const responseChartData = await fetch(`http://localhost/finance-flow/finance_flow/backend/routes/showTransaction.php?id_compte=${id_compte}`);
        const newChartDataResult = await responseChartData.json();

        // Extraire les colonnes nécessaires
        const soldeTimeData = newChartDataResult.map(entry => entry.solde_time);
        const dateData = newChartDataResult.map(entry => entry.date);

        // Mettre à jour chartDataResult
        setChartDataResult(newChartDataResult);

        // Mettre à jour les données du graphique
        setChartData({
          labels: dateData,
          datasets: [
            {
              ...chartData.datasets[0], // Conserver d'autres propriétés du dataset
              data: soldeTimeData,
            },
          ],
        });
      } catch (error) {
        console.error('Une erreur s\'est produite lors de la récupération des données du graphique :', error);
      }
    };

    fetchData();
  }, [id_compte]);

  return (
    <div>
      <h2>Solde au fil du temps</h2>
      <Line data={chartData} />
    </div>
  );
};

export default SoldeOverTimeChart;
