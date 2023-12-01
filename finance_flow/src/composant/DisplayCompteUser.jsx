import React, { useState, useEffect } from 'react';
import CompteOperationForm from './CompteOperationForm';
import TransactionList from './HistoriqueTransaction';
import SimpleLineChart from './VictoryTest';


import DeleteAccountButton from './DeleteCompte';

const ComptesList = () => {
  const [comptes, setComptes] = useState([]);
  const [selectedCompte, setSelectedCompte] = useState(null);

  useEffect(() => {
    // Obtenir la chaîne JSON du local storage
    const userDataString = localStorage.getItem('user');

    if (!userDataString) {
      console.error('La clé "user" n\'existe pas dans le local storage.');
      return;
    }

    try {
      // Convertir la chaîne JSON en objet JavaScript
      const userData = JSON.parse(userDataString);

      // Extraire la propriété 'id' de l'objet userData
      const id_user = userData.id;

      console.log(id_user);

      fetch(`http://localhost/finance-flow/finance_flow/backend/routes/showBDD.php?id_user=${id_user}`)
        .then(response => response.json())
        .then(data => {
          // Filtrer les comptes pour n'inclure que ceux de l'utilisateur connecté
          setComptes(data.filter(compte => compte.id_user === id_user));
        })
        .catch(error => {
          console.error('Une erreur s\'est produite lors de la récupération des comptes :', error);
        });
    } catch (error) {
      console.error('Erreur lors de la conversion de la chaîne JSON dans le local storage :', error);
    }
  }, []);

  const handleCompteClick = (compte) => {
    // Mettez à jour le compte sélectionné
    setSelectedCompte(compte);
  };

  const handleOperationSubmit = (montant, operationType) => {
    if (selectedCompte) {
      // Préparez les données à envoyer
      const data = {
        id: selectedCompte.id,
        montant,
        operationType,
      };
  
      // Effectuez la requête POST avec fetch
      fetch('http://localhost/finance-flow/finance_flow/backend/routes/operationCompte.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          // Assurez-vous d'ajouter tout en-tête supplémentaire nécessaire, par exemple, les informations d'authentification
        },
        body: JSON.stringify(data),
      })
        .then(response => {
          if (!response.ok) {
            throw new Error(`La requête a échoué avec le statut : ${response.status}`);
          }
          return response.json();
        })
        .then(responseData => {
          // Traitez la réponse du backend ici si nécessaire
          console.log('Réponse du backend :', responseData);
        })
        .catch(error => {
          console.error('Erreur lors de la requête POST :', error);
        });
    } else {
      console.error('Aucun compte sélectionné');
    }
  };

  const handleDeleteAccount = () => {
    if (selectedCompte) {
      // Préparez les données à envoyer
      const data = {
        id: selectedCompte.id,
      };
  
      // Effectuez la requête POST avec fetch
      fetch('http://localhost/finance-flow/finance_flow/backend/routes/deleteCompte.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          // Assurez-vous d'ajouter tout en-tête supplémentaire nécessaire, par exemple, les informations d'authentification
        },
        body: JSON.stringify(data), // Inclure l'ID du compte dans le corps de la requête JSON
      })
        .then(response => {
          if (!response.ok) {
            throw new Error(`La requête a échoué avec le statut : ${response.status}`);
          }
          return response.json();
        })
        .then(responseData => {
          // Traitez la réponse du backend ici si nécessaire
          console.log('Réponse du backend :', responseData);
          // Mettez à jour la liste des comptes après la suppression
          setComptes(prevComptes => prevComptes.filter(compte => compte.id !== selectedCompte.id));
          // Désélectionnez le compte après la suppression
          setSelectedCompte(null);
        })
        .catch(error => {
          console.error('Erreur lors de la requête DELETE :', error);
        });
    } else {
      console.error('Aucun compte sélectionné');
    }
  };
  
  

  return (
    <div>
      <h2>Liste des comptes :</h2>
      <ul>
        {comptes.map(compte => (
          <li
            key={compte.id}
            onClick={() => handleCompteClick(compte)}
            style={{ cursor: 'pointer', color: selectedCompte === compte ? 'blue' : 'black' }}
          >
            <strong>Nom du compte :</strong> {compte.compte_name}, <strong>Solde :</strong> {compte.solde}
          </li>
        ))}
      </ul>

      {selectedCompte && (
        <div>
          <h3>Compte sélectionné :</h3>
          <p><strong>Nom du compte :</strong> {selectedCompte.compte_name}</p>
          <p><strong>Solde :</strong> {selectedCompte.solde}</p>
          <p><strong>Date de creation :</strong> {selectedCompte.creation_date}</p>
          <CompteOperationForm onOperationSubmit={handleOperationSubmit} operationType="addition" />
          <CompteOperationForm onOperationSubmit={handleOperationSubmit} operationType="soustraction" />
          <DeleteAccountButton onDeleteClick={handleDeleteAccount} />
          <TransactionList id_compte={selectedCompte.id} />
          <SimpleLineChart id_compte={selectedCompte.id} />
          
          {/* Ajoutez d'autres détails du compte ici si nécessaire */}
        </div>
      )}
    </div>
  );
};

export default ComptesList;
