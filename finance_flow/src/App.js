import React from 'react';
import  Header from './composant/Header';
import CreateCompteForm from './composant/CreaCompte';
import DisplayUser from './composant/UserDisplay';

export default function MyApp() {




  return (
    <div>
        <Header/>
        <CreateCompteForm />
        <DisplayUser/>
    </div>
  );
}


