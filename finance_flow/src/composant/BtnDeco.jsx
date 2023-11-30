import React from 'react';
import { useNavigate } from 'react-router-dom';

const BtnDeco = () => {
    const navigate = useNavigate();

    const handleDeconnexion = () => {
        console.log('Déconnexion appelée');
        navigate('/connexion'); // <--- potentiel bug ici
        // Effacez toutes les données du local storage
        localStorage.clear();

        // Call deconnexion.php here
        fetch('http://localhost/finance-flow/finance_flow/backend/routes/deconnexion.php', {
            credentials: 'include', // Ajoutez cette option pour inclure les cookies
        })
        .then(response => response.json())
        .then(data => {
            // Handle the response from deconnexion.php
            console.log(data);

            // Rediriger après la déconnexion

        })
        .catch(error => {
            // Handle any errors that occurred during the fetch request
            console.error(error);
        });
    };
    
    return (
        <button className='button' onClick={handleDeconnexion}>
            Déconnexion
        </button>
    );
};

export default BtnDeco;
