import React, { useState } from 'react';

const ConnexionUser = () => {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [error, setError] = useState(null);
  const [successMessage, setSuccessMessage] = useState(null);
  const [isSubmitting, setIsSubmitting] = useState(false);

  const handleEmailChange = (e) => {
    setEmail(e.target.value);
  };

  const handlePasswordChange = (e) => {
    setPassword(e.target.value);
  };

  const handleLocalStorage = (data) => {
    // Enregistrez les données dans localStorage après une connexion réussie
    localStorage.setItem('user', JSON.stringify(data));
  };

  const handleSubmit = async (e) => {
    e.preventDefault();

    setIsSubmitting(true);

    const formData = {
      email: email,
      password: password
    };

    try {
      const response = await fetch('http://localhost/finance-flow/finance_flow/backend/routes/connexionUser.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        credentials: 'include',
        body: JSON.stringify(formData),
      });

      if (response.ok) {
        const data = await response.json();
        setSuccessMessage(data.message);
        setError(null);

        // Enregistrez les informations de connexion dans localStorage
        handleLocalStorage(data);

        const storedUserData = JSON.parse(localStorage.getItem('user'));
        console.log('Données enregistrées dans localStorage :', storedUserData);

      } else {
        const errorData = await response.json();
        setError(errorData.error);
        setSuccessMessage(null);
      }
    } finally {
      setIsSubmitting(false);
    }
  };

  return (
    <div>
      <h2>Connexion Form</h2>
      {error && <div style={{ color: 'red' }}>{error}</div>}
      {successMessage && <div style={{ color: 'green' }}>{successMessage}</div>}
      <form onSubmit={handleSubmit}>
        <div>
          <label>Email:</label>
          <input className='form' type="email" value={email} onChange={handleEmailChange} />
        </div>
        <div>
          <label>Password:</label>
          <input className='form' type="password" value={password} onChange={handlePasswordChange} />
        </div>
        <button className='button' type="submit" disabled={isSubmitting}>Submit</button>
      </form>
    </div>
  );
};

export default ConnexionUser;
