import React, { useState } from 'react';
import Header from './composant/Header';
import CreateCompteForm from './composant/CreaCompte';
import DisplayUser from './composant/DisplayUser';
import InscriptionForm from './composant/InscriptionUser';
import ConnexionUser from './composant/ConnexionUser';

export default function MyApp() {
  const [currentPage, setCurrentPage] = useState('connexion'); // 'inscription' or 'connexion'

  const handlePageChange = (page) => {
    setCurrentPage(page);
  };

  return (
    <div>
      <Header />
      {currentPage === 'inscription' && <InscriptionForm />}
      {currentPage === 'connexion' && <ConnexionUser />}
      <DisplayUser />
      <button onClick={() => handlePageChange('inscription')}>Inscription</button>
      <button onClick={() => handlePageChange('connexion')}>Connexion</button>
    </div>
  );
}
