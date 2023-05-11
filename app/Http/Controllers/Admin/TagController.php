<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\Admin\TagInterface;
use App\Http\Requests\TagRequest;


class TagController extends Controller {
    private $interface;

    public function __construct(TagInterface $interface) {
        $this->interface = $interface;
    }

	public function index()
    {
        return $this->interface->index();
    }

    public function show($id)
    {
        return $this->interface->show($id);
    }

    public function details($id)
    {
        return $this->interface->details($id);
    }

    public function comboBox()
    {
        return $this->interface->comboBox();
    }

    public function create()
    {
        return $this->interface->create();
    }

    public function store(TagRequest $request)
    {
        return $this->interface->store($request);
    }

    public function edit($id)
    {
        return $this->interface->edit($id);
    }

    public function update($id, TagRequest $request)
    {

        return $this->interface->update($id, $request);
    }

    public function delete($id)
    {
        return $this->interface->delete($id);
    }

    public function destroy($id)
    {
        return $this->interface->destroy($id);
    }
     
}
