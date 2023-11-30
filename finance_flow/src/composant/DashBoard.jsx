// Dashboard.jsx
import React from 'react';

import BienvenueUser from './BienvenueUser';
import CreateCompteForm from './CreaCompte';
import ComptesList from './DisplayCompteUser';
import BtnDeco from './BtnDeco';

const DashBoard = () => {
  return (
    <div>
      <h2>Tableau de bord</h2>

      <BienvenueUser />
      <CreateCompteForm />
      <ComptesList />
      <BtnDeco /> {/* Assurez-vous que BtnDeco est inclus ici */}
      {/* Ajoutez ici les composants et les fonctionnalités de votre tableau de bord */}
    </div>
  );
};

export default DashBoard;
