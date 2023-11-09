import React, { useEffect, useState } from "react";

const DisplayUser = () => {
  const [userData, setUserData] = useState(null);

  useEffect(() => {
    const fetchData = async () => {
      try {
        const response = await fetch('http://localhost/finance-flow/finance_flow/backend/routes/showUsers.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          // Vous pouvez ajuster le body selon vos besoins
          body: JSON.stringify({
            // ...
          }),
        });

        if (response.ok) {
          const data = await response.json();
          setUserData(data); // Mettez à jour l'état avec les données JSON
        } else {
          console.error('Erreur de réponse du serveur :', response.status);
        }
      } catch (error) {
        console.error('Erreur lors de l\'envoi de la requête :', error);
      }
    };

    fetchData();
  }, []); // Utilisation de useEffect pour effectuer la requête au chargement du composant

  return (
    <div>
      {userData ? (
        <div>
          {/* Affichez les données JSON selon la structure de vos données */}
          <p>Nom: {userData.name}</p>
          <p>Email: {userData.email}</p>
          {/* ... autres données */}
        </div>
      ) : (
        <p>Chargement des données...</p>
      )}
    </div>
  );
};

export default DisplayUser;
