<?php

use App\Models\Roles;

function hasPermission($permission)
{
    return true;

    try{
        if (!Auth::check()) {
            return false;
        }
        $roleId=Auth::user()->role_id;
        $role = Roles::with('component_permissions.component')->find($roleId);
    
        $data = $role->component_permissions->map(function ($permission) {
            $componentTitle = $permission->component->title;
            $permissionTitle = $permission->title;
            $componentPermissionTitle = $componentTitle . '_' . $permissionTitle;
    
            return $componentPermissionTitle;
        });
         
        return $data->contains($permission);
    }
    catch (\Exception $e) {
        return false;
    }

    
}
  function custom_exception($e)
{
    switch ($e->getMessage()) {
        case "Internal Server Error":
            return response()->json(["status" => 500, "message" => "Internal Server Error"]);
            break;
        case "Not Found":
            return response()->json(["status" => 404, "message" => "Not Found"]);
            break;
        case "Unauthorized":
            return response()->json(["status" => 401, "message" => "Unauthorized"]);
            break;
        default:
            return response()->json(["status" => 422, "message" => $e->getMessage()]);
            break;
    }
}
