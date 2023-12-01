import React, { useState, useEffect } from 'react';
import { VictoryBar, VictoryChart, VictoryTheme, VictoryAxis } from 'victory';

const SoldeOverTimeChart = ({ id_compte }) => {
  const [chartData, setChartData] = useState([]);

  useEffect(() => {
    const fetchData = async () => {
      try {
        // Fetch pour récupérer les données du graphique depuis votre API PHP
        const responseChartData = await fetch(`http://localhost/finance-flow/finance_flow/backend/routes/getGraphData.php?id_compte=${id_compte}`);
        const chartDataResult = await responseChartData.json();

        // Triez les données par date
        const sortedChartData = chartDataResult.sort((a, b) => new Date(a.date) - new Date(b.date));

        // Calculer les variations de solde au fil du temps
        const balanceChanges = sortedChartData.map((data, index) => ({
          x: new Date(data.date).toLocaleDateString(),
          y: index === 0 ? 0 : data.solde_time - sortedChartData[index - 1].solde_time,
        }));

        // Mettre à jour les données du graphique
        setChartData(balanceChanges);
      } catch (error) {
        console.error('Une erreur s\'est produite lors de la récupération des données du graphique :', error);
      }
    };

    fetchData();
  }, [id_compte]);

  return (
    <div>
      <h2>Variation de solde au fil du temps</h2>
      <VictoryChart theme={VictoryTheme.material}>
        <VictoryAxis
          tickFormat={(date) => date} // Formater les dates pour l'axe x
        />
        <VictoryAxis dependentAxis />
        <VictoryBar data={chartData} x="x" y="y" />
      </VictoryChart>
    </div>
  );
};

export default SoldeOverTimeChart;
