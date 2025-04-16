<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS (com Popper.js incluído) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <title>Document</title>
</head>
<body>
    <h1>Painel de Controle</h1>
    <form id="animalForm">
    <h2>Cadastro de Animal</h2>
    <input name="nome" placeholder="Nome" required>
    <input name="descricao" placeholder="Descrição" required>
    <input name="imagem" placeholder="URL da Imagem" required>
    <button type="submit">Salvar</button>
    </form>

    <hr>
    <h2>Animais Cadastrados</h2>
    <div id="listaAnimais"></div>
    <!-- Modal de Edição -->
    <div class="modal fade" id="modalEditarAnimal" tabindex="-1" aria-labelledby="editarAnimalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <form id="formEditarAnimal">
            <div class="modal-header">
            <h5 class="modal-title" id="editarAnimalLabel">Editar Animal</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
            <input type="hidden" id="editId">
            <div class="mb-3">
                <label for="editNome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="editNome" required>
            </div>
            <div class="mb-3">
                <label for="editDescricao" class="form-label">Descrição</label>
                <textarea class="form-control" id="editDescricao" required></textarea>
            </div>
            <div class="mb-3">
                <label for="editImagem" class="form-label">URL da Imagem</label>
                <input type="text" class="form-control" id="editImagem" required>
            </div>
            </div>
            <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </form>
        </div>
    </div>
    </div>
    <h2 class="mt-5">🐶 Animais para Adoção</h2>
    <div id="listaAnimais"></div>
    <!-- Modal Animal -->
    <div class="modal fade" id="modalEditarAnimal" tabindex="-1">
    <div class="modal-dialog"><div class="modal-content">
        <form id="formEditarAnimal">
        <div class="modal-header"><h5>Editar Animal</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
        <div class="modal-body">
            <input type="hidden" id="editAnimalId">
            <input class="form-control mb-2" id="editAnimalNome" placeholder="Nome">
            <textarea class="form-control mb-2" id="editAnimalDescricao" placeholder="Descrição"></textarea>
            <input class="form-control" id="editAnimalImagem" placeholder="URL da Imagem">
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" type="submit">Salvar</button>
            <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
        </form>
    </div></div>
    </div>

    <h2 class="mt-5">🛍️ Produtos para Venda</h2>
    <div id="listaProdutos"></div>
    <!-- Modal Produto -->
    <div class="modal fade" id="modalEditarProduto" tabindex="-1">
    <div class="modal-dialog"><div class="modal-content">
        <form id="formEditarProduto">
        <div class="modal-header"><h5>Editar Produto</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
        <div class="modal-body">
            <input type="hidden" id="editProdutoId">
            <input class="form-control mb-2" id="editProdutoNome" placeholder="Nome">
            <textarea class="form-control mb-2" id="editProdutoDescricao" placeholder="Descrição"></textarea>
            <input class="form-control mb-2" id="editProdutoImagem" placeholder="URL da Imagem">
            <input class="form-control" id="editProdutoLink" placeholder="Link Externo">
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" type="submit">Salvar</button>
            <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
        </form>
    </div></div>
    </div>
    <h2 class="mt-5">🖼️ Banners Principais</h2>
    <div id="listaBanners"></div>
    <!-- Modal Banner -->
    <div class="modal fade" id="modalEditarBanner" tabindex="-1">
    <div class="modal-dialog"><div class="modal-content">
        <form id="formEditarBanner">
        <div class="modal-header"><h5>Editar Banner</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
        <div class="modal-body">
            <input type="hidden" id="editBannerId">
            <input class="form-control" id="editBannerImagem" placeholder="URL da Imagem">
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" type="submit">Salvar</button>
            <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
        </form>
    </div></div>
    </div>

    <script>
    async function carregarAnimais() {
    const animais = await fetch('/api/getAnimais').then(r => r.json());
    const html = animais.map(animal => `
        <div style="border:1px solid #ccc; padding:10px; margin:5px;">
        <img src="${animal.imagem}" width="100">
        <p><strong>${animal.nome}</strong>: ${animal.descricao}</p>
        <button onclick="editarAnimal(${animal.id}, '${animal.nome}', '${animal.descricao}', '${animal.imagem}')">Editar</button>
        <button onclick="excluirAnimal(${animal.id})">Excluir</button>
        </div>
    `).join('');
    document.getElementById('listaAnimais').innerHTML = html;
    }

    let modalAnimal = new bootstrap.Modal(document.getElementById('modalEditarAnimal'));
    let modalProduto = new bootstrap.Modal(document.getElementById('modalEditarProduto'));
    let modalBanner = new bootstrap.Modal(document.getElementById('modalEditarBanner'));

    document.addEventListener('DOMContentLoaded', () => {
    carregarAnimais();
    carregarProdutos();
    carregarBanners();
    });

    // === ANIMAIS ===
    async function carregarAnimais() {
    const dados = await fetch('/api/getAnimais').then(r => r.json());
    document.getElementById('listaAnimais').innerHTML = dados.map(a => `
        <div class="card mb-3 p-2">
        <img src="${a.imagem}" width="100">
        <h5>${a.nome}</h5>
        <p>${a.descricao}</p>
        <button class="btn btn-warning btn-sm" onclick="abrirModalAnimal(${a.id}, '${a.nome}', \`${a.descricao}\`, '${a.imagem}')">Editar</button>
        <button class="btn btn-danger btn-sm" onclick="excluirItem('/api/deleteAnimal/${a.id}', carregarAnimais)">Excluir</button>
        </div>
    `).join('');
    }

    function abrirModalAnimal(id, nome, desc, img) {
    document.getElementById('editAnimalId').value = id;
    document.getElementById('editAnimalNome').value = nome;
    document.getElementById('editAnimalDescricao').value = desc;
    document.getElementById('editAnimalImagem').value = img;
    modalAnimal.show();
    }

    document.getElementById('formEditarAnimal').addEventListener('submit', e => {
    e.preventDefault();
    const id = document.getElementById('editAnimalId').value;
    const dados = new URLSearchParams({
        nome: document.getElementById('editAnimalNome').value,
        descricao: document.getElementById('editAnimalDescricao').value,
        imagem: document.getElementById('editAnimalImagem').value
    });
    fetch(`/api/updateAnimal/${id}`, { method: 'PUT', headers: {'Content-Type': 'application/x-www-form-urlencoded'}, body: dados })
        .then(() => { modalAnimal.hide(); carregarAnimais(); });
    });

    // === PRODUTOS ===
    async function carregarProdutos() {
    const dados = await fetch('/api/getProdutos').then(r => r.json());
    document.getElementById('listaProdutos').innerHTML = dados.map(p => `
        <div class="card mb-3 p-2">
        <img src="${p.imagem}" width="100">
        <h5>${p.nome}</h5>
        <p>${p.descricao}</p>
        <button class="btn btn-warning btn-sm" onclick="abrirModalProduto(${p.id}, '${p.nome}', \`${p.descricao}\`, '${p.imagem}', '${p.link}')">Editar</button>
        <button class="btn btn-danger btn-sm" onclick="excluirItem('/api/deleteProduto/${p.id}', carregarProdutos)">Excluir</button>
        </div>
    `).join('');
    }

    function abrirModalProduto(id, nome, desc, img, link) {
    document.getElementById('editProdutoId').value = id;
    document.getElementById('editProdutoNome').value = nome;
    document.getElementById('editProdutoDescricao').value = desc;
    document.getElementById('editProdutoImagem').value = img;
    document.getElementById('editProdutoLink').value = link;
    modalProduto.show();
    }

    document.getElementById('formEditarProduto').addEventListener('submit', e => {
    e.preventDefault();
    const id = document.getElementById('editProdutoId').value;
    const dados = new URLSearchParams({
        nome: document.getElementById('editProdutoNome').value,
        descricao: document.getElementById('editProdutoDescricao').value,
        imagem: document.getElementById('editProdutoImagem').value,
        link: document.getElementById('editProdutoLink').value
    });
    fetch(`/api/updateProduto/${id}`, { method: 'PUT', headers: {'Content-Type': 'application/x-www-form-urlencoded'}, body: dados })
        .then(() => { modalProduto.hide(); carregarProdutos(); });
    });

    // === BANNERS ===
    async function carregarBanners() {
    const dados = await fetch('/api/getBanners').then(r => r.json());
    document.getElementById('listaBanners').innerHTML = dados.map(b => `
        <div class="card mb-3 p-2">
        <img src="${b.imagem}" width="200">
        <button class="btn btn-warning btn-sm mt-2" onclick="abrirModalBanner(${b.id}, '${b.imagem}')">Editar</button>
        <button class="btn btn-danger btn-sm mt-2" onclick="excluirItem('/api/deleteBanner/${b.id}', carregarBanners)">Excluir</button>
        </div>
    `).join('');
    }

    function abrirModalBanner(id, imagem) {
    document.getElementById('editBannerId').value = id;
    document.getElementById('editBannerImagem').value = imagem;
    modalBanner.show();
    }

    document.getElementById('formEditarBanner').addEventListener('submit', e => {
    e.preventDefault();
    const id = document.getElementById('editBannerId').value;
    const dados = new URLSearchParams({
        imagem: document.getElementById('editBannerImagem').value
    });
    fetch(`/api/updateBanner/${id}`, { method: 'PUT', headers: {'Content-Type': 'application/x-www-form-urlencoded'}, body: dados })
        .then(() => { modalBanner.hide(); carregarBanners(); });
    });

    // === EXCLUSÃO ===
    function excluirItem(url, callback) {
    if (confirm('Tem certeza que deseja excluir?')) {
        fetch(url, { method: 'DELETE' }).then(() => callback());
    }
    }
    </script>


    <script src="/js/admin.js"></script>   
</body>
</html>


