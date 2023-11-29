import React from 'react';

const BtnDeco = () => {
    const handleDeconnexion = () => {
        console.log('Déconnexion appelée');

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
            window.location.href = 'http://localhost/finance-flow/finance_flow/login.php';
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
