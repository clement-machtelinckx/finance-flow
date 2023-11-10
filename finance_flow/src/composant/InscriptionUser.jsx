// Composant d'inscription (InscriptionForm.jsx)
import React, { useState } from 'react';

const InscriptionForm = () => {
  const [name, setName] = useState('');
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');

  const handleSubmit = async (e) => {
    e.preventDefault();
  
    try {
    console.log("donnes envoyees ", JSON.stringify({
            name: name,
            email: email,
            password: password,
          }));
      const response = await fetch('http://localhost/finance-flow/finance_flow/backend/routes/inscripUser.php', {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          name: name,
          email: email,
          password: password,
        }),
      });
  
      if (response.ok) {
        console.log('Inscription réussie!');
        console.log("reponse", response)
      } else {
        console.error('Erreur lors de l\'inscription :', response.status);
      }
    } catch (error) {
      console.error('Erreur lors de l\'envoi de la requête :', error);
    }
  };
  

  return (
    <form onSubmit={handleSubmit}>
      <label>
        Nom:
        <input type="text" name="name" value={name} onChange={(e) => setName(e.target.value)} />
      </label>
      <br />
      <label>
        Email:
        <input type="email" name="email" value={email} onChange={(e) => setEmail(e.target.value)} />
      </label>
      <br />
      <label>
        Mot de passe:
        <input type="password" name="password" value={password} onChange={(e) => setPassword(e.target.value)} />
      </label>
      <br />
      <button type="submit">S'inscrire</button>
    </form>
  );
};

export default InscriptionForm;
