import React, { useState, useEffect } from 'react';

const ComptesList = () => {
  const [comptes, setComptes] = useState([]);

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
          const userComptes = data.filter(compte => compte.id_user === id_user);
          setComptes(userComptes);
        })
        .catch(error => {
          console.error('Une erreur s\'est produite lors de la récupération des comptes :', error);
        });
    } catch (error) {
      console.error('Erreur lors de la conversion de la chaîne JSON dans le local storage :', error);
    }
  }, []);

  return (
    <div>
      <h2>Liste des comptes :</h2>
      <ul>
        {comptes.map(compte => (
          <li key={compte.id}>
            <strong>Nom du compte :</strong> {compte.compte_name}, <strong>Solde :</strong> {compte.solde}
          </li>
        ))}
      </ul>
    </div>
  );
};

export default ComptesList;
