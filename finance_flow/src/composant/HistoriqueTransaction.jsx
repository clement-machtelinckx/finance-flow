import React, { useState, useEffect } from 'react';

const TransactionList = ({ id_compte }) => {
  const [transactions, setTransactions] = useState([]);

  useEffect(() => {
    // Effectuer la requête GET pour récupérer les transactions
    fetch(`http://localhost/finance-flow/finance_flow/backend/routes/showTransaction.php?id_compte=${id_compte}`)
      .then(response => response.json())
      .then(data => {
        // Mettre à jour l'état avec les transactions récupérées
        setTransactions(data);
      })
      .catch(error => {
        console.error('Une erreur s\'est produite lors de la récupération des transactions :', error);
      });
  }, [id_compte]);

  return (
    <div>
      <h2>Liste des transactions :</h2>
      <ul>
        {transactions.map(transaction => (
          <li key={transaction.id}>
            <strong>Montant :</strong> {transaction.montant}, <strong>Type :</strong> {transaction.calculator}, <strong>Date :</strong> {transaction.date}
          </li>
        ))}
      </ul>
    </div>
  );
};

export default TransactionList;
