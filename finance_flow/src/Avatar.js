import React from 'react';

function Avatar() {
  const avatarUrl = '<img src="https://i.imgur.com/yXOvdOSs.jpg">'; // Remplacez par l'URL de votre image

  return (
    <div>
      <h2>Mon Avatar</h2>
      <img src={avatarUrl} alt="Avatar" />
    </div>
  );
}

export default Avatar;
