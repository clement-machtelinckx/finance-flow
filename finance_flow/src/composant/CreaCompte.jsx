// Composant CreateCompteForm.js
import React, { useState } from 'react';

const CreateCompteForm = () => {
  const [compteName, setCompteName] = useState('');
  const [solde, setSolde] = useState('');

  const handleSubmit = async (e) => {
    e.preventDefault();

    // Récupérer les données du localStorage
    const userData = JSON.parse(localStorage.getItem('user'));
    const userId = userData ? userData.id : null;

    try {
      const response = await fetch('http://localhost/finance-flow/finance_flow/backend/routes/creaCompteRoute.php', {
        method: 'POST',
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          compte_name: compteName,
          solde: solde,
          id: userId, // Ajouter l'ID de l'utilisateur au corps de la requête
        }),
      });

      if (response.ok) {
        const data = await response.json();
        console.log(data); // Vous pouvez traiter la réponse comme nécessaire
      } else {
        const errorData = await response.text();
        console.error('Erreur de réponse du serveur :', response.status, errorData);
      }
    } catch (error) {
      console.error('Erreur lors de l\'envoi de la requête :', error);
    }
  };

  return (
    <div>
    <h2>Créer un compte</h2>
    <form onSubmit={handleSubmit}>
      <label>
        Compte Name:
        <input className='form' type="text" value={compteName} onChange={(e) => setCompteName(e.target.value)} />
      </label>
      <br />
      <label>
        Solde:
        <input className='form' type="text" value={solde} onChange={(e) => setSolde(e.target.value)} />
      </label>
      <br />
      <button className='button' type="submit">Créer Compte</button>
    </form>
    </div>
  );
};

export default CreateCompteForm;
