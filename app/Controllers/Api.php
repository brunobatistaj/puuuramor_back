<?php

namespace App\Controllers;

use App\Models\AnimalModel;
use App\Models\ProdutoModel;
use App\Models\BannerModel;

class Api extends BaseController
{
    public function getAnimais()
    {
        $model = new AnimalModel();
        return $this->response->setJSON($model->findAll());
    }

    public function getProdutos()
    {
        $model = new ProdutoModel();
        return $this->response->setJSON($model->findAll());
    }

    public function getBanners()
    {
        $model = new BannerModel();
        return $this->response->setJSON($model->findAll());
    }

    public function postAnimal()
    {
        $model = new AnimalModel();
        $model->save($this->request->getPost());
        return $this->response->setJSON(['status' => 'ok']);
    }

    public function postProduto()
    {
        $model = new ProdutoModel();
        $model->save($this->request->getPost());
        return $this->response->setJSON(['status' => 'ok']);
    }

    public function postBanner()
    {
        $model = new BannerModel();
        $model->save($this->request->getPost());
        return $this->response->setJSON(['status' => 'ok']);
    }

    // EDIÇÃO
    public function updateAnimal($id)
    {
        $model = new AnimalModel();
        $model->update($id, $this->request->getRawInput());
        return $this->response->setJSON(['status' => 'updated']);
    }

    public function updateProduto($id)
    {
        $model = new ProdutoModel();
        $model->update($id, $this->request->getRawInput());
        return $this->response->setJSON(['status' => 'updated']);
    }

    public function updateBanner($id)
    {
        $model = new BannerModel();
        $model->update($id, $this->request->getRawInput());
        return $this->response->setJSON(['status' => 'updated']);
    }

    // EXCLUSÃO
    public function deleteAnimal($id)
    {
        $model = new AnimalModel();
        $model->delete($id);
        return $this->response->setJSON(['status' => 'deleted']);
    }

    public function deleteProduto($id)
    {
        $model = new ProdutoModel();
        $model->delete($id);
        return $this->response->setJSON(['status' => 'deleted']);
    }

    public function deleteBanner($id)
    {
        $model = new BannerModel();
        $model->delete($id);
        return $this->response->setJSON(['status' => 'deleted']);
    }

}
