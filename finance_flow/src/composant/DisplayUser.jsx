import React, { useEffect, useState } from 'react';

const DisplayUser = () => {
  const [user, setUser] = useState(null);

  useEffect(() => {
    const fetchConnectedUser = async () => {
      try {
        // Vérifier si un utilisateur est connecté
        const response = await fetch('http://localhost/finance-flow/finance_flow/backend/routes/getConnectedUser.php', {
          method: 'GET',
          headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
          },
        });
  
        if (response.ok) {
          const userData = await response.json();
          // Mettre à jour l'état uniquement si un utilisateur est connecté
          if (userData) {
            setUser(userData);
          }
        } else {
          console.error('Erreur lors de la récupération de l\'utilisateur :', response.status);
        }
      } catch (error) {
        console.error('Erreur lors de l\'envoi de la requête :', error);
      }
    };
  
    fetchConnectedUser();
  }, []); // Les crochets vides signifient que ce useEffect ne s'exécutera qu'une seule fois, après le montage initial du composant.
  

  return (
    <div>
      {user ? (
        <div>
          <h2>Utilisateur Connecté</h2>
          <p>Nom: {user.name}</p>
          <p>Email: {user.email}</p>
          <p>ID: {user.id}</p>
        </div>
      ) : (
        <p>Aucun utilisateur connecté</p>
      )}
    </div>
  );
};

export default DisplayUser;
