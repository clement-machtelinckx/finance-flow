// DeleteAccountButton.jsx
import React from 'react';

const DeleteAccountButton = ({ onDeleteClick }) => {
  const handleDeleteClick = () => {
    if (window.confirm("Êtes-vous sûr de vouloir supprimer ce compte ?")) {
      onDeleteClick();
    }
  };

  return (
    <button className="supprime" onClick={handleDeleteClick}>
      Supprimer le compte
    </button>
  );
};

export default DeleteAccountButton;
