<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Blog de Adoção & Loja</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { padding-top: 60px; }
    .banner img { width: 100%; height: auto; border-radius: 10px; }
    .animal, .produto { border: 1px solid #ddd; border-radius: 10px; padding: 10px; margin-bottom: 20px; }
    .animal img, .produto img { width: 100%; border-radius: 8px; }
  </style>
</head>
<body>
  <div class="container">

    <h1 class="text-center mb-4">🐾 Adoção e Produtos</h1>

    <!-- BANNERS -->
    <section class="banner mb-5" id="bannerContainer"></section>

    <!-- ANIMAIS -->
    <section>
      <h2>🐶 Animais para Adoção</h2>
      <div class="row" id="animaisContainer"></div>
    </section>

    <!-- PRODUTOS -->
    <section class="mt-5">
      <h2>🛍️ Produtos à Venda</h2>
      <div class="row" id="produtosContainer"></div>
    </section>

  </div>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      carregarBanners();
      carregarAnimais();
      carregarProdutos();
    });

    function carregarBanners() {
      fetch('/api/getBanners')
        .then(r => r.json())
        .then(banners => {
          const container = document.getElementById('bannerContainer');
          container.innerHTML = banners.map(b =>
            `<img src="${b.imagem}" alt="Banner" class="mb-3">`
          ).join('');
        });
    }

    function carregarAnimais() {
      fetch('/api/getAnimais')
        .then(r => r.json())
        .then(animais => {
          const container = document.getElementById('animaisContainer');
          container.innerHTML = animais.map(a => `
            <div class="col-md-4">
              <div class="animal">
                <img src="${a.imagem}" alt="${a.nome}">
                <h5 class="mt-2">${a.nome}</h5>
                <p>${a.descricao}</p>
              </div>
            </div>
          `).join('');
        });
    }

    function carregarProdutos() {
      fetch('/api/getProdutos')
        .then(r => r.json())
        .then(produtos => {
          const container = document.getElementById('produtosContainer');
          container.innerHTML = produtos.map(p => `
            <div class="col-md-4">
              <div class="produto">
                <img src="${p.imagem}" alt="${p.nome}">
                <h5 class="mt-2">${p.nome}</h5>
                <p>${p.descricao}</p>
                <a class="btn btn-success w-100" target="_blank" href="${p.link}">Comprar</a>
              </div>
            </div>
          `).join('');
        });
    }
  </script>
</body>
</html>
