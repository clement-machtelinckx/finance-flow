import React, { useState, useEffect } from 'react';
import { BrowserRouter as Router, Routes, Route, Link } from 'react-router-dom';

import Header from './composant/Header';
import CreateCompteForm from './composant/CreaCompte';
import InscriptionForm from './composant/InscriptionUser';
import ConnexionUser from './composant/ConnexionUser';
import BtnDeco from './composant/BtnDeco';
import ComptesList from './composant/DisplayCompteUser';
import BienvenueUser from './composant/BienvenueUser';
import DashBoard from './composant/DashBoard';


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
    <Router>
      <div className='app'>
        <Header />
        {/* {isLoggedIn && <BienvenueUser />} */}

        <Routes>
          {/* Utilisez Route pour définir les composants à afficher pour chaque chemin */}
          <Route path='/inscription' element={<InscriptionForm />} />
          <Route path='/connexion' element={<ConnexionUser />} />
          <Route path='/create-compte' element={<CreateCompteForm />} />
          <Route path='/comptes-list' element={<ComptesList />} />
          <Route path='/dashboard' element={<DashBoard />} />
        </Routes>

        {!isLoggedIn && (
          <div>
            {/* Utilisez Link pour créer des liens vers les différentes pages */}
            <Link to='/inscription' className='button'>Inscription</Link>
            <Link to='/connexion' className='button'>Connexion</Link>
          </div>
        )}
        {/* {isLoggedIn && <BtnDeco />} */}
      </div>
    </Router>
  );
}
