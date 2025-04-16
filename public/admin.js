document.getElementById('animalForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const form = new FormData(this);
    await fetch('/api/postAnimal', {
      method: 'POST',
      body: new URLSearchParams([...form])
    });
    alert('Animal cadastrado!');
  });
  