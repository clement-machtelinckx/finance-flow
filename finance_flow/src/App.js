import React, { useState, useEffect } from 'react';
import Header from './composant/Header';
import CreateCompteForm from './composant/CreaCompte';
import DisplayUser from './composant/DisplayUser';
import InscriptionForm from './composant/InscriptionUser';
import ConnexionUser from './composant/ConnexionUser';
import BtnDeco from './composant/BtnDeco';
import ComptesList from './composant/DisplayCompteUser';

import './style.scss';

export default function MyApp() {
  const [currentPage, setCurrentPage] = useState('connexion'); // 'inscription' or 'connexion'
  const [isLoggedIn, setIsLoggedIn] = useState(false);

// ...

useEffect(() => {
  const checkAuthentication = () => {
    // Vérifier si les données de l'utilisateur existent dans le localStorage
    const userDataString = localStorage.getItem('user');
    
    if (userDataString) {
      const userData = JSON.parse(userDataString);

      // Vérifier si le champ "message" est égal à "connected"
      if (userData && userData.message === 'connected') {
        setIsLoggedIn(true);
      } else {
        setIsLoggedIn(false);
      }
    } else {
      setIsLoggedIn(false);
    }
  };

  checkAuthentication();
}, []); // Assurez-vous de dépendre des variables nécessaires

// ...


  const handlePageChange = (page) => {
    setCurrentPage(page);
  };

  return (
    <div>
      <Header />
      {isLoggedIn && <DisplayUser />}
      {currentPage === 'inscription' && !isLoggedIn && <InscriptionForm />}
      {currentPage === 'connexion' && !isLoggedIn && <ConnexionUser />}
      {isLoggedIn && <CreateCompteForm />}
      {isLoggedIn && <ComptesList />}
      {!isLoggedIn && (
        <div>
          <button className='button' onClick={() => handlePageChange('inscription')}>Inscription</button>
          <button className='button' onClick={() => handlePageChange('connexion')}>Connexion</button>
        </div>
      )}
      {isLoggedIn && <BtnDeco />}
    </div>
  );
}
