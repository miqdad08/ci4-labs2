<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ArticleModel;
use App\Models\CategoryModel;

class ArticleController extends BaseController
{
    public function index()
    {
        $model = new ArticleModel();

        $data['articles'] = $model->getAll();

        return view('articles/index', $data);
    }

    public function detail($id)
    {
        $model = new ArticleModel();
        $data['article'] = $model->find($id);

        return view('articles/detail', $data);
    }

    public function create()
    {
        $categoryModel = new CategoryModel();

        $data['categories'] = $categoryModel->findAll();
        return view('articles/create', $data);
    }

    public function store()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'title' => 'required|min_length[5]',
            'content' => 'required',
            'category_id' => 'required',
            'image' => 'uploaded[image]|is_image[image]|max_size[image,2048]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $file = $this->request->getFile('image');
        $namaFile = $file->getRandomName();
        $file->move('uploads', $namaFile);

        $model = new ArticleModel();

        $model->save([
            'title' => $this->request->getPost('title'),
            'content' => $this->request->getPost('content'),
            'category_id' => $this->request->getPost('category_id'),
            'image' => $namaFile,
        ]);

        return redirect()->to('/')->with('success', 'Artikel berhasil ditambahkan');
    }

    public function edit($id)
    {
        $articleModel = new ArticleModel();
        $categoryModel = new CategoryModel();

        $data['article'] = $articleModel->find($id);
        $data['categories'] = $categoryModel->findAll();

        return view('articles/edit', $data);
    }

    public function update($id)
    {
        $model = new ArticleModel();
        $file = $this->request->getFile('image');

        if ($file->isValid() && !$file->hasMoved()) {
            $namaFile = $file->getRandomName();
            $file->move('uploads', $namaFile);
        } else {
            $namaFile = $this->request->getPost('old_image');
        }

        $model->update($id, [
            'title' => $this->request->getPost('title'),
            'content' => $this->request->getPost('content'),
            'category_id' => $this->request->getPost('category_id'),
            'image' => $namaFile,
        ]);

        return redirect()->to('/')->with('success', 'Artikel berhasil diupdate');
    }

    public function delete($id)
    {
        $model = new ArticleModel();
        $model->delete($id);

        return redirect()->to('/')->with('success', 'Artikel berhasil dihapus');
    }
}
