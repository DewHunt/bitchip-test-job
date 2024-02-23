<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Interfaces\EmployeeInterface;

use App\Models\Employee;
use DB,Auth;

class EmployeeController extends Controller
{
    protected $employeeRepo;

    function __construct(EmployeeInterface $employeeRepo) {
        $this->employee = $employeeRepo;
    }

    public function getAllEmployeeList(Request $request) {
        // $token = $request->bearerToken();
        // $key = env('JWT_SECRET');
        // $decodedData = JWT::decode($token, new Key($key, 'HS256'));
        // return $decodedData;
        $employeeList = $this->employee->getAllEmployeeList();
        return response()->json(['employeeList'=>$employeeList]);
    }
}
