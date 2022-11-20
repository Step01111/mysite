<?php
namespace App\Controllers;

use App\Models\Art\Art;
use App\Exceptions\ErArgumentException;
use App\Exceptions\UnauthorizedException;

class ArtAPIController extends APIController
{
    public function create ()
    {
        try {
            $this->isAdmin();

            $request = $this->useRequest(file_get_contents('php://input'));

            $art = Art::create($request);
            
            if ($art->getId()) {
                $this->response->artId = $art->getId();
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
            
            if (Art::update($request)) {
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

            Art::delete($request->id);
            echo json_encode($this->response);
        } catch (ErArgumentException $e) {
            $this->errorResponse($e);
        } catch (UnauthorizedException $e) {
            $this->errorResponse($e);
        }
    }
}
