<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Interfaces\v1\TagInterface;
use App\Http\Requests\TagRequest;
use App\Http\Controllers\v1\_ControlCommon;


class TagController extends Controller {
    private $interface, $commons, $gate;

    public function __construct(TagInterface $interface, _ControlCommon $commons) {
        $this->interface = $interface;
        $this->commons = $commons;
        $this->gate = 'tags';
 
    }

	public function index()
    {
        $this->commons->userAuthorization($this->gate);
        return $this->interface->index();
    }

    public function show($id)
    {
        $this->commons->userAuthorization($this->gate);
        return $this->interface->show($id);
    }

    public function details($id)
    {
        $this->commons->userAuthorization($this->gate);
        return $this->interface->details($id);
    }

    public function comboBox()
    {
        $this->commons->userAuthorization($this->gate);
        return $this->interface->comboBox();
    }

    public function create()
    {
        $this->commons->userAuthorization($this->gate);
        return $this->interface->create();
    }

    public function store(TagRequest $request)
    {
        $this->commons->userAuthorization($this->gate);
        return $this->interface->store($request);
    }

    public function edit($id)
    {
        $this->commons->userAuthorization($this->gate);
        return $this->interface->edit($id);
    }

    public function update($id, TagRequest $request)
    {
        $this->commons->userAuthorization($this->gate);
        return $this->interface->update($id, $request);
    }

    public function delete($id)
    {
        $this->commons->userAuthorization($this->gate);
        return $this->interface->delete($id);
    }

    public function destroy($id)
    {
        $this->commons->userAuthorization($this->gate);
        return $this->interface->destroy($id);
    }
     
}
