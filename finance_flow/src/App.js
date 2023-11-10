import React from 'react';
import  Header from './composant/Header';
import CreateCompteForm from './composant/CreaCompte';
import DisplayUser from './composant/UserDisplay';
import InscriptionForm from './composant/InscriptionUser';

export default function MyApp() {




  return (
    <div>
        <Header/>
        <InscriptionForm/>
        <CreateCompteForm />

    </div>
  );
}


