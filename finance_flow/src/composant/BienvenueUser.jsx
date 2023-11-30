import React, { useEffect, useState } from 'react';

const BienvenueUser = () => {
    const [nomUtilisateur, setNomUtilisateur] = useState('');

    useEffect(() => {
        const utilisateur = JSON.parse(localStorage.getItem('user'));
        if (utilisateur && utilisateur.name) {
            setNomUtilisateur(utilisateur.name);
        }
    }, []);

    return (
        <div>
            {nomUtilisateur && <h3>Bienvenue {nomUtilisateur}</h3>}
        </div>
    );
};

export default BienvenueUser;
