// Composant CreateCompteForm.js
import React, { useState } from 'react';

const CreateCompteForm = () => {
  const [compteName, setCompteName] = useState('');
  const [solde, setSolde] = useState('');

  const handleSubmit = async (e) => {
    e.preventDefault();

    try {
      const response = await fetch('http://localhost/finance-flow/finance_flow/backend/routes/showUsers.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          compte_name: compteName,
          solde: solde,
        }),
      });

      if (response.ok) {
        const data = await response.json();
        console.log(data); // Vous pouvez traiter la réponse comme nécessaire
      } else {
        console.error('Erreur de réponse du serveur :', response.status);
      }
    } catch (error) {
      console.error('Erreur lors de l\'envoi de la requête :', error);
    }
  };

  return (
    <form onSubmit={handleSubmit}>
      <label>
        Compte Name:
        <input type="text" value={compteName} onChange={(e) => setCompteName(e.target.value)} />
      </label>
      <br />
      <label>
        Solde:
        <input type="text" value={solde} onChange={(e) => setSolde(e.target.value)} />
      </label>
      <br />
      <button type="submit">Créer Compte</button>
    </form>
  );
};

export default CreateCompteForm;
