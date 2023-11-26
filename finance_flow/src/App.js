import React, { useState, useEffect } from 'react';
import Header from './composant/Header';
import CreateCompteForm from './composant/CreaCompte';
import DisplayUser from './composant/DisplayUser';
import InscriptionForm from './composant/InscriptionUser';
import ConnexionUser from './composant/ConnexionUser';
import BtnDeco from './composant/BtnDeco';

export default function MyApp() {
  const [currentPage, setCurrentPage] = useState('connexion'); // 'inscription' or 'connexion'
  const [isLoggedIn, setIsLoggedIn] = useState(false);

  useEffect(() => {
    // Effectuez la vérification de l'état de connexion ici
    // Si l'utilisateur est connecté, mettez setIsLoggedIn(true)
    // Sinon, mettez setIsLoggedIn(false)

    // Exemple:
    // setIsLoggedIn(true); // Remplacez cela par la logique réelle de vérification de connexion
  }, []); // Assurez-vous de dépendre des variables nécessaires

  const handlePageChange = (page) => {
    setCurrentPage(page);
  };

  return (
    <div>
      <Header />
      {currentPage === 'inscription' && <InscriptionForm />}
      {currentPage === 'connexion' && <ConnexionUser />}
      <DisplayUser />
      <CreateCompteForm />
      <button onClick={() => handlePageChange('inscription')}>Inscription</button>
      <button onClick={() => handlePageChange('connexion')}>Connexion</button>
      <BtnDeco />
    </div>
  );
}
