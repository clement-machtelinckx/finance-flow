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

  const handleSubmit = async (e) => {
    e.preventDefault();

    setIsSubmitting(true);

    // Create an object with the form data
    const formData = {
      email: email,
      password: password
    };

    try {
      const response = await fetch('http://localhost/finance-flow/finance_flow/backend/routes/connexionUser.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(formData)
      });

      if (response.ok) {
        const data = await response.json();
        // Handle the success response from the server
        setSuccessMessage(data.message);
      } else {
        // Handle the error response from the server
        const errorData = await response.json();
        setError(errorData.message);
      }
    } catch (error) {
      // Handle any fetch errors
      setError('An error occurred while processing your request.');
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
          <input type="email" value={email} onChange={handleEmailChange} />
        </div>
        <div>
          <label>Password:</label>
          <input type="password" value={password} onChange={handlePasswordChange} />
        </div>
        <button type="submit" disabled={isSubmitting}>Submit</button>
      </form>
    </div>
  );
};

export default ConnexionUser;
