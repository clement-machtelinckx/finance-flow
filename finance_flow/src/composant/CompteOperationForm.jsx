// CompteOperationForm.jsx
import React, { useState } from 'react';

const CompteOperationForm = ({ onOperationSubmit, operationType }) => {
  const [montant, setMontant] = useState('');

  const handleSubmit = (e) => {
    e.preventDefault();

    // Valider que le montant est un nombre
    const montantValue = parseFloat(montant);
    if (isNaN(montantValue)) {
      console.error('Le montant doit être un nombre valide.');
      return;
    }

    // Envoyer le montant au composant parent avec le type d'opération
    onOperationSubmit(montantValue, operationType);

    // Réinitialiser le champ de montant après l'envoi
    setMontant('');
  };

  return (
    <form onSubmit={handleSubmit}>
      <label>
        Montant:
        <input
          type="text"
          value={montant}
          onChange={(e) => setMontant(e.target.value)}
        />
      </label>
      <button className='button' type="submit">Effectuer l'opération</button>
    </form>
  );
};

export default CompteOperationForm;
