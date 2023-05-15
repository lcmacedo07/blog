<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\AuthController;
use App\Models\Audit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;
use Exception;
use Illuminate\Support\Str;

class _ControlCommon extends BaseController
{

    private $authController;
    private $exception;

    public function __construct(AuthController $authController, Exception $exception)
    {
        $this->authController = $authController;
        $this->exception = $exception;
    }

    public function userAuthorization($gate)
    {
        $roleIrresctrict = 'super';
        if (!Auth::user()) {
            abort(401, 'Usuario sem login ou sessao expirada.');
        }
        $idUserLogin = Auth::user()->id;
        $permissionsUser = $this->authController->permissionsUser();

        if ((!in_array($gate, $permissionsUser)) && (!in_array($roleIrresctrict, $permissionsUser))) {
            abort(403, 'Nao autorizado!');
        } else {
            return $idUserLogin;
        }
    }


    public function dateFilters()
    {
        $dts = isset($_GET['dts']) ? $_GET['dts'] . ' 00:00:01' : env('START_DATE') . ' 00:00:01';
        $dtf = isset($_GET['dtf']) ? $_GET['dtf'] . ' 23:59:59' : date('Y-m-d H:i:s');
        return [
            'dts' => $dts,
            'dtf' => $dtf
        ];
    }

    public function registersPerPage()
    {
        $pgLimit = isset($_GET['limit']) ? $_GET['limit'] : 10;
        return $pgLimit;
    }

    public function keywordsToSearch($fields)
    {
        $keywords = isset($_GET['q']) ? $_GET['q'] : '';

        $fields = explode(',', $fields);
        $qtdFields = count($fields);

        if (isset($keywords) && $keywords != '') {
            $keywords = explode(' ', $keywords);
            $qtd = count($keywords);
            $search = '';

            for ($i = 0; $i < $qtd; $i++) {
                for ($j = 0; $j < $qtdFields; $j++) {
                    $search .= "($fields[$j] like '%$keywords[$i]%') or ";
                }
            }
            $search = rtrim($search, ' or ');
        }

        return $search;
    }

    public function sortByField()
    {
        $sortField = isset($_GET['sort']) ? $_GET['sort'] : '-id';
        $sinal = substr($sortField, 0, 1);
        $orderBy = ($sinal == '-') ? substr($sortField, 1) . ' DESC' : $sortField . ' ASC';
        return $orderBy;
    }

    public function fieldsToSelect($fieldsPreSelected)
    {
        $fields = isset($_GET['fields']) ? $_GET['fields'] : $fieldsPreSelected;
        $fields = explode(',', $fields);
        return $fields;
    }

    public function customStatusCode($type, $data)
    {
        $status = $data ? 200 : 500;

        if ($type == 'C' && $status == 200) {
            return response('Registro Criado!', 201);
        } else if ($type == 'U' && $status == 200) {
            return response('Registro Alterado!', 200);
        } else if ($type == 'D' && $status == 200) {
            return response('Registro Excluído!', 200);
        } else {
            return response([
                'type' => get_class($this->exception),
                'message' => $this->exception->getMessage()
            ], 500);
        }
    }

    public function generatePass($name, $email)
    {
        $name = explode(' ', $name);

        $minute = date('i');
        $hour = date('H');
        $leters = array('A', 'j', 'B', 'k', 'C', 'l', '%', 'm', 'E', 'n', '?', 'o', 'G', '&', '!', 'H', 'q', 'I', 'r', 'J', 's', '#', 't', 'L', 'u', 'M', '-', '$', 'v', 'N', 'w', 'O', '(', ':', 'y', 'Q', 'z', 'R', 'a', 'S', 'b', 'T', 'c', '+', 'd', 'V', 'e', '&', 'f', '@', 'g', 'Y', 'h', 'Z', 'i', 'X', 'j', 'W', '&', 'k', 'U');

        $hour = intval($hour);
        $minute = intval($minute);

        if (count($name) >= 3) {
            $pass = $name[2][0] . $leters[$minute] . $name[1][0] . $leters[$hour + 5] . $name[0][0] . $leters[$hour] . $email[1] . "@" . $email[0];
        } else {
            if (count($name) >= 2) {
                $pass = $name[1][0] . $leters[$minute] . $name[0][0] . $leters[$hour + 5] . "&" . $leters[$hour] . $email[1] . "@" . $email[0];
            } else {
                $pass = $leters[15] . $leters[$minute] . $name[0][0] . $leters[$hour + 5] . "&" . $leters[$hour] . $email[1] . "@" . $email[0];
            }
        }
        return $pass;
    }

    public function insertLog($id, $table, $action)
    {
        if (Auth::user()) {
            $user = Auth::user();

            $create = Audit::create([
                'uuid' => Str::uuid(),
                'user_id' => $user->id,
                'username' => $user->fullname,
                'email' => $user->email,
                'action' => $action,
                'model' => $table,
                'register' => $id
            ]);
        }
    }
}