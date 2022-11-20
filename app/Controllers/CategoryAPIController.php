<?php
namespace App\Controllers;

use App\Models\Category\Category;
use App\Exceptions\ErArgumentException;
use App\Exceptions\UnauthorizedException;

class CategoryAPIController extends APIController
{
    public function create ()
    {
        try {
            $this->isAdmin();

            $request = $this->useRequest(file_get_contents('php://input'));    

            $category = Category::create($request);
            
            if ($category->getId()) {
                $this->response->artId = $category->getId();
                echo json_encode($this->response);
            }
        } catch (ErArgumentException $e) {
            $this->errorResponse($e);
        } catch (UnauthorizedException $e) {
            $this->errorResponse($e);
        }
    }

    public function edit()
    {
        try {
            $this->isAdmin();

            $request = $this->useRequest(file_get_contents('php://input'));
            
            if (Category::update($request)) {
                echo json_encode($this->response);
            } else {
                throw new ErArgumentException('Ошибка отправки');
            }
        } catch (ErArgumentException $e) {
            $this->errorResponse($e);
        } catch (UnauthorizedException $e) {
            $this->errorResponse($e);
        }
    }

    public function delete()
    {
        try {
            $this->isAdmin();

            $request = $this->useRequest(file_get_contents('php://input'));

            Category::delete($request->id);
            echo json_encode($this->response);
        } catch (ErArgumentException $e) {
            $this->errorResponse($e);
        } catch (UnauthorizedException $e) {
            $this->errorResponse($e);
        }
    }
}
